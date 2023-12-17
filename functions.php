<?php
/*Chargement de 'style.css pour le bon fonctionnement du theme*/
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri(). '/style.css');
}

/* Enregistrement du menu principal */
function register_my_menu() 
{
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );