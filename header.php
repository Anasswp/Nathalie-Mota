<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body>

    <header>
        <div>
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
    </header>

    <div class="modale">
        <?php 
        /*On appelle la modale dans notre header*/
        include('templates_part/modale.php');
        ?>
    </div>
</html>

</body>
