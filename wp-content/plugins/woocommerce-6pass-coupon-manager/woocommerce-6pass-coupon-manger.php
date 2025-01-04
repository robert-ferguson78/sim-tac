<?php
/**
 * Plugin Name: WooCommerce 6-Pass Coupon Manager
 * Description: Generates unique coupons upon purchasing a 6-pass ticket and limits usage to 6 items across all orders. Coupons can only be applied to tickets named "full day" (case-insensitive).
 * Version: 1.4.0
 * Author: Your Name
 * License: GPL2
 * Text Domain: woocommerce-6pass-coupon-manager
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class WC_6Pass_Coupon_Manager {

    /**
     * Constructor to initialize hooks.
     */
    public function __construct() {
        // Hook into order completion to generate coupon.
        add_action( 'woocommerce_order_status_completed', array( $this, 'generate_coupon_on_purchase' ), 10, 1 );

        // Hook into order completion to update items_redeemed.
        add_action( 'woocommerce_order_status_completed', array( $this, 'update_coupon_usage' ), 20, 1 );

        // Validate the coupon before applying.
        add_filter( 'woocommerce_coupon_is_valid', array( $this, 'validate_coupon' ), 10, 2 );

        // Limit the discount amount based on remaining items.
        add_filter( 'woocommerce_coupon_get_discount_amount', array( $this, 'limit_coupon_discount' ), 10, 5 );

        // Add 'Items Redeemed' column to the coupons list.
        add_filter( 'manage_edit-shop_coupon_columns', array( $this, 'add_items_redeemed_column' ) );
        add_action( 'manage_shop_coupon_posts_custom_column', array( $this, 'display_items_redeemed_column' ), 10, 2 );
        add_filter( 'manage_edit-shop_coupon_sortable_columns', array( $this, 'make_items_redeemed_sortable' ) );
        add_action( 'pre_get_posts', array( $this, 'items_redeemed_orderby' ) );

        // Add 'Items Redeemed' field to the single coupon edit screen.
        add_action( 'woocommerce_coupon_options', array( $this, 'add_items_redeemed_field' ) );
        add_action( 'woocommerce_coupon_options_save', array( $this, 'save_items_redeemed_field' ) );

        // Make the 'Items Redeemed' field read-only to prevent manual editing.
        add_action( 'admin_footer', array( $this, 'make_items_redeemed_readonly' ) );

        // Display remaining uses on the cart page.
        add_action( 'woocommerce_before_cart', array( $this, 'display_remaining_coupon_uses' ) );

        // Display exclusion notice on product pages.
        add_action( 'woocommerce_single_product_summary', array( $this, 'display_exclusion_notice' ), 15 );

        // Load textdomain for translations.
        add_action( 'init', array( $this, 'load_textdomain' ) );
    }

    /**
     * Load plugin textdomain for translations.
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'woocommerce-6pass-coupon-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }

    /**
 * Generate a unique coupon when a 6-pass ticket is purchased.
 *
 * @param int $order_id The ID of the completed order.
 */
public function generate_coupon_on_purchase( $order_id ) {
    if ( ! $order_id ) return;

    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        error_log( "generate_coupon_on_purchase triggered for Order ID: $order_id" );
    }

    $order = wc_get_order( $order_id );

    $six_pass_product_id = 32965; // Replace with your actual 6-pass ticket product ID.
    $contains_6_pass = false;

    // Check if the order contains the 6-pass ticket.
    foreach ( $order->get_items() as $item ) {
        if ( $item->get_product_id() == $six_pass_product_id ) {
            $contains_6_pass = true;
            break;
        }
    }

    if ( $contains_6_pass ) {
        // Generate a unique coupon code with lowercase prefix.
        $coupon_code = '6pass-' . strtolower( wp_generate_password( 8, false ) );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "Generating coupon: $coupon_code" );
        }

        // Create the coupon.
        $coupon = new WC_Coupon();
        $coupon->set_code( $coupon_code );
        $coupon->set_discount_type( 'percent_product' ); // 100% discount per item.
        $coupon->set_amount( 100 ); // 100% discount.
        $coupon->set_individual_use( false );
        $coupon->set_usage_limit( null ); // Unlimited usage but controlled via 'items_redeemed'.
        $coupon->set_free_shipping( false );

        // Calculate the expiry date: 5 years from now.
        $expiry_date = new DateTime();
        $expiry_date->add( new DateInterval( 'P5Y' ) ); // Adds 5 years.
        $coupon->set_date_expires( $expiry_date->getTimestamp() );

        // Initialize 'items_redeemed' meta.
        $coupon->update_meta_data( 'items_redeemed', 0 );

        // Save the coupon.
        $coupon_id = $coupon->save();

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            if ( $coupon_id ) {
                error_log( "Coupon $coupon_code created successfully with ID: $coupon_id" );
            } else {
                error_log( "Failed to create coupon $coupon_code" );
            }
        }

        // Prepare the HTML email content.
        $first_name = $order->get_billing_first_name(); // Fetch customer's first name.
        $expiry_date_formatted = $expiry_date->format( 'F j, Y' ); // e.g., January 1, 2029

        $html_message = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Your 6 Game Day Pass Coupon</title>
        </head>
        <body style="margin:0; padding:0; font-family: Arial, sans-serif;">

            <!-- Banner Section -->
            <div style="background-color: #000000; padding: 20px 0;">
                <h1 style="color: #FFFFFF; margin: 0; text-align: center;">Here is your 6 Game Day Pass</h1>
            </div>

            <!-- Coupon Code Section -->
            <div style="padding: 60px 20px; text-align: center;">
                <div style="background-color: #FFFFFF; display: inline-block; padding: 20px 40px; border-radius: 8px;">
                    <p style="font-size: 32px; color: #000000; margin: 0; font-weight: bold;">' . esc_html( $coupon_code ) . '</p>
                </div>
            </div>

            <!-- Instructions Section -->
            <div style="padding: 20px; text-align: center; color: #000000;">
                <p style="font-size: 20px; line-height: 1.5;">
                    To claim your game days, simply add the game day tickets to your basket as usual and in either the cart or checkout enter your voucher code. This will discount the ticket prices.</p> 
                 <p style="font-size: 20px; line-height: 1.5;">
                 Multiple full day game tickets can be bought for the same day or differnet days to the total of 6 full day game tickets.
                </p>
                <p style="font-size: 24px; line-height: 1.5;">
                    Special events and Rental package tickets are exempt from this 6 Day Game Pass (Only full day games with your own gear are redeemable).
                </p>
                <p style="font-size: 24px; line-height: 1.5;">
                    Do not share your 6 day game pass code. It is unique to you and can only be used to purchase 6 times full day game tickets..
                </p>
            </div>

            <!-- Footer Section -->
            <div style="background-color: #000000; padding: 20px 0;">
                <p style="color: #FFFFFF; margin: 0; text-align: center;">
                    For further details email <a href="mailto:info@urbanassault.ie" style="color: #FFFFFF; text-decoration: underline;">info@urbanassault.ie</a> or Phone: 086 411 8610
                </p>
            </div>

        </body>
        </html>
        ';

        // Set the email headers for HTML content.
        $headers = array( 'Content-Type: text/html; charset=UTF-8' );

        // Email details.
        $to = $order->get_billing_email();
        $subject = 'Your 6 Game Day Pass Coupon Code';

        // Send the HTML email.
        $mail_sent = wp_mail( $to, $subject, $html_message, $headers );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            if ( $mail_sent ) {
                error_log( "HTML Coupon email sent to $to successfully." );
            } else {
                error_log( "Failed to send HTML Coupon email to $to." );
            }
        }

        // Optionally, add the coupon code to the order notes.
        $order->add_order_note( sprintf( __( 'Generated coupon code: %s', 'woocommerce-6pass-coupon-manager' ), $coupon_code ) );
    }
}

    /**
     * Validate the 6-pass coupon before applying it to the cart.
     *
     * @param bool $valid Whether the coupon is valid.
     * @param WC_Coupon $coupon The coupon object.
     * @return bool Modified validity.
     */
    public function validate_coupon( $valid, $coupon ) {
        if ( ! $valid ) return $valid;

        // Standardize coupon code to lowercase for consistency
        $coupon_code_lower = strtolower( $coupon->get_code() );

        // Check if it's a 6pass coupon.
        if ( strpos( $coupon_code_lower, '6pass-' ) !== 0 ) return $valid;

        // Get total items redeemed so far.
        $items_redeemed = (int) $coupon->get_meta( 'items_redeemed', true );

        // Maximum allowed items.
        $max_items = 6;

        // Calculate items being discounted in the current cart.
        $cart = WC()->cart;
        $discounted_items = 0;

        foreach ( $cart->get_cart() as $cart_item ) {
            $product = $cart_item['data'];
            $product_name = strtolower( $product->get_name() );

            // Check if the product name is "full day" (case-insensitive).
            if ( trim( $product_name ) === 'full day' ) {
                $discounted_items += $cart_item['quantity'];
            }
        }

        // Calculate remaining items that can be discounted.
        $remaining = $max_items - $items_redeemed;

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "validate_coupon: Coupon {$coupon->get_code()}, Items Redeemed = $items_redeemed, Discounted Items = $discounted_items, Remaining = $remaining" );
        }

        if ( $remaining <= 0 ) {
            wc_add_notice( 'This coupon has already been used the maximum number of times.', 'error' );
            return false;
        }

        // Allow partial discounts by not returning false if discounted_items > remaining.
        if ( $discounted_items > $remaining ) {
            wc_add_notice( sprintf( 'This coupon will only be applied to %d "Full Day" ticket(s). The remaining %d "Full Day" ticket(s) will be at full price.', $remaining, $discounted_items - $remaining ), 'notice' );
        }

        return $valid;
    }

    /**
     * Limit the discount amount based on remaining items.
     *
     * @param float $discount The calculated discount amount.
     * @param float $discounting_amount The amount discounting.
     * @param array $cart_item The cart item.
     * @param bool $single Whether it's a single discount.
     * @param WC_Coupon $coupon The coupon object.
     * @return float Modified discount.
     */
    public function limit_coupon_discount( $discount, $discounting_amount, $cart_item, $single, $coupon ) {
        // Standardize coupon code to lowercase for consistency
        $coupon_code_lower = strtolower( $coupon->get_code() );

        // Check if it's a 6pass coupon.
        if ( strpos( $coupon_code_lower, '6pass-' ) !== 0 ) {
            return $discount;
        }

        // Get total items redeemed so far.
        $items_redeemed = (int) $coupon->get_meta( 'items_redeemed', true );

        // Maximum allowed items.
        $max_items = 6;

        // Calculate remaining items.
        $remaining = $max_items - $items_redeemed;

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "limit_coupon_discount: Coupon {$coupon->get_code()}, Items Redeemed = $items_redeemed, Remaining = $remaining" );
        }

        if ( $remaining <= 0 ) {
            return 0;
        }

        // Get the product name and check if it's "full day".
        $product = $cart_item['data'];
        $product_name = strtolower( $product->get_name() );

        if ( trim( $product_name ) !== 'full day' ) {
            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                error_log( "limit_coupon_discount: Product '{$product->get_name()}' is not eligible for coupon $coupon_code_lower." );
            }
            return 0;
        }

        // Get the quantity of this cart item.
        $quantity = $cart_item['quantity'];

        // Determine the number of items to discount for this cart item.
        $discount_quantity = min( $quantity, $remaining );

        // Calculate the discount: price * discount_quantity.
        $product_price = $product->get_price();
        $discount = $product_price * $discount_quantity;

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "limit_coupon_discount: Discounting $discount_quantity 'Full Day' ticket(s) at $product_price each. Total discount: $discount" );
        }

        return $discount;
    }

    /**
     * Update the 'items_redeemed' meta field after order completion.
     *
     * @param int $order_id The ID of the completed order.
     */
    public function update_coupon_usage( $order_id ) {
        if ( ! $order_id ) return;

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "update_coupon_usage triggered for Order ID: $order_id" );
        }

        $order = wc_get_order( $order_id );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            error_log( "Fetching used coupons for Order ID: $order_id" );
        }

        // Retrieve all used coupons in the order
        $used_coupons = $order->get_used_coupons();

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            if ( empty( $used_coupons ) ) {
                error_log( "No coupons used in Order ID: $order_id" );
            } else {
                error_log( "Used coupons in Order ID $order_id: " . implode( ', ', $used_coupons ) );
            }
        }

        // Loop through applied coupons.
        foreach ( $used_coupons as $coupon_code ) {
            // Standardize coupon code to lowercase for consistency
            $coupon_code_lower = strtolower( $coupon_code );

            if ( strpos( $coupon_code_lower, '6pass-' ) === 0 ) {
                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( "Processing 6PASS coupon: $coupon_code" );
                }

                $coupon = new WC_Coupon( $coupon_code );

                // Get items redeemed so far.
                $items_redeemed = (int) $coupon->get_meta( 'items_redeemed', true );

                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( "Current items_redeemed for $coupon_code: $items_redeemed" );
                }

                // Calculate remaining redemption capacity
                $remaining = 6 - $items_redeemed;

                if ( $remaining <= 0 ) {
                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                        error_log( "Coupon $coupon_code has reached its redemption limit." );
                    }
                    continue; // Skip processing as redemption limit is reached
                }

                // Count how many "Full Day" tickets are discounted in this order, limited by remaining
                $discounted_items = 0;

                foreach ( $order->get_items() as $item ) {
                    $product = $item->get_product();
                    $product_name = strtolower( $product->get_name() );
                    $quantity = $item->get_quantity();

                    // Check if the product name is "full day" (case-insensitive).
                    if ( trim( $product_name ) !== 'full day' ) continue;

                    // Determine how many items can be discounted based on remaining
                    if ( $discounted_items + $quantity > $remaining ) {
                        $quantity_to_discount = $remaining - $discounted_items;
                        if ( $quantity_to_discount > 0 ) {
                            $discounted_items += $quantity_to_discount;

                            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                                error_log( "Discounting 'Full Day' product ID {$product->get_id()}, quantity: $quantity_to_discount (Capped by remaining limit: $remaining)" );
                            }
                        }
                        break; // Redemption limit reached
                    } else {
                        $discounted_items += $quantity;

                        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                            error_log( "Discounting 'Full Day' product ID {$product->get_id()}, quantity: $quantity" );
                        }
                    }
                }

                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( "Total discounted 'Full Day' items in Order ID $order_id for coupon $coupon_code: $discounted_items" );
                }

                if ( $discounted_items > 0 ) {
                    // Update items_redeemed.
                    $new_total = $items_redeemed + $discounted_items;

                    // Ensure we don't exceed the max limit.
                    $new_total = min( $new_total, 6 );

                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                        error_log( "Updating items_redeemed for $coupon_code: from $items_redeemed to $new_total" );
                    }

                    $coupon->update_meta_data( 'items_redeemed', $new_total );
                    $coupon->save();

                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                        error_log( "items_redeemed updated to $new_total for coupon $coupon_code" );
                    }
                } else {
                    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                        error_log( "No 'Full Day' items left to discount for coupon $coupon_code in Order ID $order_id." );
                    }
                }
            } else {
                if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                    error_log( "Skipping non-6PASS coupon: $coupon_code" );
                }
            }
        }
    }

    /**
     * Add 'Items Redeemed' column to the coupons list table.
     *
     * @param array $columns Existing columns.
     * @return array Modified columns.
     */
    public function add_items_redeemed_column( $columns ) {
        // Insert the new column after the 'coupon_code' column.
        $new_columns = array();

        foreach ( $columns as $key => $value ) {
            $new_columns[ $key ] = $value;
            if ( 'coupon_code' === $key ) {
                $new_columns['items_redeemed'] = __( 'Items Redeemed', 'woocommerce-6pass-coupon-manager' );
            }
        }

        return $new_columns;
    }

    /**
     * Display the 'Items Redeemed' column content.
     *
     * @param string $column The column name.
     * @param int $post_id The coupon post ID.
     */
    public function display_items_redeemed_column( $column, $post_id ) {
        if ( 'items_redeemed' === $column ) {
            $items_redeemed = get_post_meta( $post_id, 'items_redeemed', true );
            echo esc_html( $items_redeemed ? $items_redeemed : 0 );
        }
    }

    /**
     * Make the 'Items Redeemed' column sortable.
     *
     * @param array $columns Existing sortable columns.
     * @return array Modified sortable columns.
     */
    public function make_items_redeemed_sortable( $columns ) {
        $columns['items_redeemed'] = 'items_redeemed';
        return $columns;
    }

    /**
     * Handle sorting by 'items_redeemed'.
     *
     * @param WP_Query $query The current WP_Query instance.
     */
    public function items_redeemed_orderby( $query ) {
        if ( ! is_admin() ) return;

        $orderby = $query->get( 'orderby' );

        if ( 'items_redeemed' === $orderby ) {
            $query->set( 'meta_key', 'items_redeemed' );
            $query->set( 'orderby', 'meta_value_num' );
        }
    }

    /**
     * Add 'Items Redeemed' field to the single coupon edit screen.
     */
    public function add_items_redeemed_field() {
        woocommerce_wp_text_input( array(
            'id'                => 'items_redeemed',
            'label'             => __( 'Items Redeemed', 'woocommerce-6pass-coupon-manager' ),
            'description'       => __( 'Number of items already redeemed with this coupon.', 'woocommerce-6pass-coupon-manager' ),
            'desc_tip'          => true,
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => '0',
                'step' => '1',
            ),
        ) );
    }

    /**
     * Save the 'Items Redeemed' field value.
     *
     * @param int $post_id The coupon post ID.
     */
    public function save_items_redeemed_field( $post_id ) {
        if ( isset( $_POST['items_redeemed'] ) ) {
            $items_redeemed = intval( $_POST['items_redeemed'] );
            update_post_meta( $post_id, 'items_redeemed', $items_redeemed );

            if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
                error_log( "save_items_redeemed_field: Saved items_redeemed = $items_redeemed for Coupon ID $post_id" );
            }
        }
    }

    /**
     * Make the 'Items Redeemed' field read-only to prevent manual editing.
     */
    public function make_items_redeemed_readonly() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#items_redeemed').attr('readonly', true);
            });
        </script>
        <?php
    }

    /**
     * Display remaining coupon uses on the cart page.
     */
    public function display_remaining_coupon_uses() {
        if ( ! is_admin() && WC()->cart->has_discount() ) {
            foreach ( WC()->cart->get_applied_coupons() as $coupon_code ) {
                $coupon_code_lower = strtolower( $coupon_code );
                if ( strpos( $coupon_code_lower, '6pass-' ) === 0 ) {
                    $coupon = new WC_Coupon( $coupon_code );
                    $items_redeemed = (int) $coupon->get_meta( 'items_redeemed', true );
                    $max_items = 6;
                    $remaining = $max_items - $items_redeemed;

                    wc_print_notice( sprintf( __( 'You have %d coupon use(s) remaining.', 'woocommerce-6pass-coupon-manager' ), $remaining ), 'notice' );
                }
            }
        }
    }

    /**
     * Display exclusion notice on product pages.
     */
    public function display_exclusion_notice() {
        global $product;

        // Check if the current product's name is not "full day".
        // $product_name = strtolower( $product->get_name() );
        // if ( trim( $product_name ) !== 'full day' ) {
        //     wc_print_notice( __( 'This ticket is not eligible for the 6-Pass Coupon.', 'woocommerce-6pass-coupon-manager' ), 'notice' );
        // }
    }
}

// Initialize the plugin.
new WC_6Pass_Coupon_Manager();