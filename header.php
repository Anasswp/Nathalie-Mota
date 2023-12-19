<?php 
/**
 * The header
 * @package Nathalie-Mota
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <div>
        <?php the_custom_logo() ?>
    </div>

<?php 
/*On appelle le menu là où on souhaite l'afficher*/
wp_nav_menu([
    'theme_location' => 'main-menu',
]);
?>