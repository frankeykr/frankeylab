<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body>

<header>
<?php
wp_nav_menu( array(
    'theme_location'  => 'global',
    'container'       => 'nav',
    'container_class' => 'global-navi',
    'menu_id'         => 'global-menu-list',
    'menu_class'      => '',
));
?>
</header>
