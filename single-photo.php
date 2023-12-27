<?php
get_header();

// Récupération de l'identifiant de la photo (nom) dans l'URL //
$slug = get_query_var('photographies');

// Construction des critères de recherche //
$args = [
    'post_type' => 'photographies',
    'name' => $slug,
    'posts_per_page' => 1
];

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) :
    while ($custom_query->have_posts()) : $custom_query->the_post();

        $reference = get_field('reference');
        $type = get_field('type');
        $categories = wp_get_post_terms(get_the_ID(), 'categorie');
        $formats = wp_get_post_terms(get_the_ID(), 'formats');

    endwhile; // Fermeture de la boucle while //
    wp_reset_postdata(); // Réinitialisation des données du post //

endif; // Fermeture de la condition if //

include('single.php'); ?>

<?php 
get_footer();
?>
