<!doctype html>
<html <?php language_attributes(); ?>>

    <!-- Elements repris du theme hello elementor -->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Photographe</title>
        <?php wp_head(); ?>
    </head>

<body>

<header>
    <div class="logo">
        <?php the_custom_logo() ?>
    </div>
    <nav>
        <?php 
        wp_nav_menu(array(
            'theme_location' => 'main-menu',
            'container' => false,
            'menu_class' => 'menu',
        ));
        ?>
    </nav>
    <div class="burger-menu">
        <div class="burger-icon" id="burger-icon">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
</header>


        <?php 
        /*On appelle la modale dans notre header*/
        include('templates_part/modale.php');
        ?>

</html>

</body>
