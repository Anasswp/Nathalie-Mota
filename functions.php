
<?php
/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles_scripts()
{
    // Chargement des scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js');
    wp_enqueue_script('script-pagination', get_template_directory_uri() . '/js/charger-plus.js');
    wp_localize_script('script-pagination', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce'   => wp_create_nonce('ajax-nonce'),));
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');


/*Chargement du style et des scripts pour le bon fonctionnement du theme*/
function theme_enqueue_styles_custom()
{
    // Chargement des styles
    wp_enqueue_style('style-custom', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-custom', get_template_directory_uri() . '/assets/css/theme.css');
    wp_enqueue_style('single-custom', get_stylesheet_directory_uri() . '/assets/css/single.css');

    
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles_custom');



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


/* Chargement du contenu supplémentaire */
// Fonction AJAX pour le charger plus
function charger_plus() {

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $page = $_POST['page'];
    $ordreTriage = $_POST['order'];
    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 12,
        'orderby' => 'date',
        'order' => $ordreTriage,
        'paged' => $page,
    );

    $photo_query = new WP_Query($args);

    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('template_part/photo-bloc');
        }
        wp_reset_postdata();
    }

    wp_die();
}

add_action('wp_ajax_charger_plus', 'charger_plus');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');