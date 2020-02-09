<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body>

<header>
    <div class="site-header">
        <div class="logo-text">
            <a href="<?= home_url()?>">
                <p>FRANKEY<br>LAB.</p>
            </a>
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
</header>
