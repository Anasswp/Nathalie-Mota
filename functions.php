<?php
/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.css');
    
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');



add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
));

/* Enregistrement du menu principal */
function register_custom_menus()
{
    
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'Nathalie Mota'), 
        'footer-menu' => __('Menu Secondaire', 'Nathalie Mota'), 
    ));
}
 
add_action('init', 'register_custom_menus');