<?php
/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri(). '/style.css');
}

/* Enregistrement du menu principal */
function register_custom_menus() {
    register_nav_menus(array(
        'menu_principal' => __('header', 'Photographe'),
        'menu_secondaire' => __('footer', 'Photographe'),
    ));
}
 
add_action('init', 'register_custom_menus');