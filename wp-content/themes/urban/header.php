<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

<?php wp_head(); ?>
</head>

<body <?php body_class();?> >
<div class="wrap_header" id="header">
       <header>
            <div class="container">
                <!-- LOGO -->
                <div class="logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri() ?>/assets/img/logo.svg" alt="LOGO">
                    </a>
                </div>
                <!-- LOGO END -->
                <!-- NAV -->
                <div class="navbar">
                    <a href="#" class="navbarmenu">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
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
                    <a href="#">
                        Contact Us
                    </a>
                </div>
            </div>
       </header>
    </div>
       <div class="main_container">
