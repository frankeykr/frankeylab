<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= get_stylesheet_directory_uri()?>/image/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta charset="<?php bloginfo('charset'); ?>">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2546334153394027"
     crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a57697c894.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <?php wp_head(); ?>
</head>
<body>

<header class="<?php if (is_single()) {echo 'header-single-page';}?>">
    <div class="site-header">
        <div class="logo-text">
            <a href="<?= home_url()?>">
                <p>도쿄직장인、<br>후랑키</p>
            </a>
        </div>
        <div class="hamburger-menu">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <?php
        wp_nav_menu( array(
            'theme_location'  => 'global',
            'container'       => 'nav',
            'container_class' => 'global-navi',
            'menu_id'         => 'global-menu-list',
            'menu_class'      => '',
        ));
        ?>
    </div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('.hamburger-menu').click(function(){
                $('.site-header').toggleClass('is-active');
            });
        });
    </script>
</header>


