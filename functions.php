<?php
/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles_scripts()
{
    // Chargement des styles
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.css');
    wp_enqueue_style('single', get_stylesheet_directory_uri() . '/assets/css/single.css');

    // Chargement des scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
    wp_enqueue_script( 'swiper-element-bundle.min', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), '9.2.0', true );
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


/* Ajout du filtre pour le bouton Contact */
function ajouter_id_bouton_contact($atts, $item, $args, $depth) {
    // On vérifie si c'est le bouton de contact
    if ($item->title == 'Contact') {
        $atts['id'] = 'contact-button'; // Remplace 'menu-item-90' par l'ID que je voudrais utiliser
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'ajouter_id_bouton_contact', 10, 4);


/* Template single-photo pour affichage du custom_post_type photographies */
function custom_single_template($single) {
    global $post;
    if ($post->post_type === 'photographies') {
        return get_template_directory() . '/single-photo.php';
    }
    return $single;
}
add_filter('single_template', 'custom_single_template');