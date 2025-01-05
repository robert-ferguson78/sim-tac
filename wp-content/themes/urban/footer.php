<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
</div><!-- end of content-wrapper div -->
</div>
<footer>
                <div class="container">
                    <div class="footernav">
                        <div class="logo_social block_column">
                            <div class="logo">
                                <a href="<?php echo site_url(); ?>">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/img/urban-assault-log-trans-white.svg" alt="">
                                </a>
                            </div>
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/profile.php?id=100091886806286">
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/fb.svg" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/">
                                        <img src="<?php echo get_template_directory_uri() ?>/assets/img/youtube.svg" alt="">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footernavbar block_column">
                            <nav>
                                  <?php
                                        wp_nav_menu(
                                        array(
                                            'menu_class'    => 'header_navlist',
                                            'theme_location'  => 'footer',
                                            'container' => false,
                                        )
                                        );
                              ?>
                            </nav>
                        </div>
                    </div>
                    <div class="footer_bottom">
                        <p>
                            © 2024 urban. All Rights Reserved.
                        </p>
                    </div>
                </div>
            </footer>
<?php wp_footer(); ?>
</body>

</html>