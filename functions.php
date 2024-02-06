<?php

// Chargement des styles et des scripts
function theme_enqueue_styles_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js');
    wp_enqueue_script('script-pagination', get_template_directory_uri() . '/assets/js/charger-plus.js');
    wp_localize_script('script-pagination', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'nonce'   => wp_create_nonce('ajax-nonce'),));
    wp_enqueue_script('script-filtres', get_template_directory_uri() . '/assets/js/homeFilters.js');
    wp_enqueue_script('script-lightbox', get_template_directory_uri() . '/assets/js/lightbox.js');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles_scripts');

// Chargement des styles personnalisés
function theme_enqueue_styles_custom()
{
    wp_enqueue_style('style-custom', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('theme-custom', get_template_directory_uri() . '/assets/css/theme.css');
    wp_enqueue_style('single-custom', get_stylesheet_directory_uri() . '/assets/css/single.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css', array(), null);
}



add_action('wp_enqueue_scripts', 'theme_enqueue_styles_custom');

// Prise en charge du 'custom logo' dans WordPress
add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
));

// Enregistrement des menus
function register_custom_menus()
{
    register_nav_menus(array(
        'main-menu' => __('Menu Principal', 'Nathalie Mota'), 
        'footer-menu' => __('Menu Secondaire', 'Nathalie Mota'), 
    ));
}
 
add_action('init', 'register_custom_menus');

// Ajout d'un filtre pour le bouton Contact
function ajouter_id_bouton_contact($atts, $item, $args, $depth) {
    if ($item->title == 'Contact') {
        $atts['id'] = 'contact-button';
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'ajouter_id_bouton_contact', 10, 4);

// Ouverture du type de contenu personnalisé "photographies" avec single-photo.php
function custom_single_template($single) {
    global $post;
    if ($post->post_type === 'photographies') {
        return get_template_directory() . '/single-photo.php';
    }
    return $single;
}
add_filter('single_template', 'custom_single_template');

// Fonction AJAX pour le chargement de plus d'éléments
function charger_plus() {
    check_ajax_referer('ajax-nonce', 'nonce');
    $page = $_POST['page'];
    $ordreTriage = $_POST['order'];
    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $ordreTriage,
        'paged' => $page,
    );
    $photo_query = new WP_Query($args);
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('templates_part/photo_block');
        }
        wp_reset_postdata();
    }
    wp_die();
}

add_action('wp_ajax_charger_plus', 'charger_plus');
add_action('wp_ajax_nopriv_charger_plus', 'charger_plus');

// Fonction AJAX pour récupérer les photos filtrées
function filtrer_photos() {

    // Vérification du nonce avant exécution de la requête
    check_ajax_referer('ajax-nonce', 'nonce');

    $tax_query = array('relation' => 'AND');
    $order = $_POST['order'] ?? 'ASC';

    // Si une catégorie est présente et n'est pas égale à all
    if (isset($_POST['category']) && $_POST['category'] !== 'all') {
        $category = $_POST['category'];
        $tax_query[] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $category,
        );
    }

    // Si un format est présent et n'est pas égal à all
    if (isset($_POST['format']) && $_POST['format'] !== 'all') {
        $format = $_POST['format'];
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $args = array(
        'post_type' => 'photographies',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => $order,
        'paged' => 1,
        'tax_query' => $tax_query,
    );

    $photo_query = new WP_Query($args);

    // Stockage du résultat en tampon temporairement
    ob_start();

    // Définition de la structure d'affichage des nouveaux éléments
    if ($photo_query->have_posts()) {
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            get_template_part('templates_part/photo_block');
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    // Récupération des informations en tampon dans une variable
    $output = ob_get_clean();

    // Affichage de la variable
    echo $output;

    wp_die();
}

add_action('wp_ajax_filtrer_photos', 'filtrer_photos');
add_action('wp_ajax_nopriv_filtrer_photos', 'filtrer_photos');
?>
