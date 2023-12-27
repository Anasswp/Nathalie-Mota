<?php
/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles_scripts()
{
    // Chargement des styles
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.css');

    // Chargement des scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');




/*Active prise en charge du 'custom logo' dans WordPress*/
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




/* Template single-photo pour affichage du custom_post_type photographies */
function custom_single_template($single) {
    global $post;
    if ($post->post_type === 'photographies') {
        return get_template_directory() . '/single-photo.php';
    }
    return $single;
}
add_filter('single_template', 'custom_single_template');