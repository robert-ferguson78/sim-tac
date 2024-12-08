<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="preload" href="/wp-content/themes/urban/assets/fonts/Destroy.woff2" as="font" type="font/woff2" crossorigin>

<?php wp_head(); ?>
</head>

<body <?php body_class(get_url_as_class()); ?> >
<div class="wrap_header" id="header">
       <header>
            <div class="container">
                <!-- LOGO -->
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/assets/img/urban-assault-log-trans.svg" alt="LOGO">
                    </a>
                </div>
                <!-- LOGO END -->
                <!-- NAV -->
                <div class="navbar">
                    <a href="#" class="navbarmenu">
                        <span class="bar1"></span>
                        <span class="bar2"></span>
                        <span class="bar3"></span>
                    </a>
                    <nav>
                        <?php
                            wp_nav_menu(
                            array(
                                'menu_class'    => 'header_navlist',
                                'theme_location'  => 'primary',
                                'container' => false,
                            )
                            );
                        ?>
                    </nav>
                </div>
                <!-- NAV END -->
                <div class="rightbtn">
                    <a href="/contact-us/">
                        Contact Us
                    </a>
                </div>
            </div>
       </header>
    </div>
       <div class="main_container">
            <div class="content-wrapper">
