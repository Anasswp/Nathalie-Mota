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

 ?>

<div class="single-post">
    <!-- Zone gauche - Informations photos -->
    <div class="single-container">
        <div class="single-info">
            <h2><?php echo the_title();?></h2>
            <p>RÉFÉRENCE : <span id="single-reference"><?php echo esc_html($reference); ?></span></p>
            <p>CATÉGORIE :
                <?php foreach ($categories as $categorie) {
                    echo esc_html($categorie->name);
                } ?>
            </p>
            <p>FORMAT :
                <?php foreach ($formats as $format) {
                    echo esc_html($format->name);
                } ?>
            </p>
            <p>TYPE : <?php echo $type;?></p>
            <p>ANNÉE : <?php echo the_date('Y');?></p>
        </div>
    </div>
    <!-- Zone droite - La photo -->
    <div class="single-image">
        <div class="single-content">
            <?php the_content();?>
        </div>
    </div>
</div>

<!-- Ajout du bandeau d'interactions inférieur -->
<div class="banner">
    <div class="banner-content">
        <p>Cette photo vous intéresse ?</p>
        <button class="banner-button" id="contact-post">Contact</button>
    
        <div class="array-post">
            <?php
            // Requête pour obtenir le dernier post
            $args_dernier = array(
                'post_type' => 'photographies',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'DESC',
            );

            $last_post = new WP_Query($args_dernier);

            // Requête pour obtenir le premier post
            $args_premier = array(
                'post_type' => 'photographies',
                'posts_per_page' => 1,
                'orderby' => 'date',
                'order' => 'ASC',
            );

            $first_post = new WP_Query($args_premier);
            ?>
         
            <div class="previous-post">
                <div class="fleche-container">
                    <!-- Récupération du post précédent par date -->
                    <?php
                    $previous_post = get_previous_post();
                    // Si le post précédent existe, affichage du post
                    if (!empty($previous_post)) :
                    ?>
                        <img class="previous-post-image" src="<?php echo get_the_post_thumbnail_url($previous_post->ID); ?>" alt="Image précédente">
                        <a href="<?php echo get_permalink($previous_post); ?>">
                            <img class="fleches fleche-gauche" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/previous-arrow.png' ?>" alt="Flèche de gauche"/>
                        </a>
                    <!-- Si post précédent non-existant, affichage -->
                    <?php else : 
                        $last_post = $last_post->posts[0]; 
                    ?>
                        <a href="<?php echo get_permalink($last_post->ID); ?>">
                            <img class="fleches fleche-gauche" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/previous-arrow.png' ?>" alt="Flèche de gauche"/>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="next-post">
                <div class="fleche-container">
                    <!-- Récupération du post suivant par date -->
                    <?php
                    $next_post = get_next_post();
                    // Si post suivant existant, affichage du post
                    if (!empty($next_post)) :
                    ?>
                        <img class="next-post-image" src="<?php echo get_the_post_thumbnail_url($next_post->ID); ?>" alt="Image suivante">
                        <a href="<?php echo get_permalink($next_post->ID); ?>">
                            <img class="fleches fleche-droite" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/next-arrow.png' ?>" alt="Flèche de droite"/>
                        </a>
                    <!-- Si post suivant non-existant, affichage -->
                    <?php else : 
                        $first_post = $first_post->posts[0];
                    ?>
                        <a href="<?php echo get_permalink($first_post->ID); ?>">
                            <img class="fleches fleche-droite" src="<?php echo get_stylesheet_directory_uri() . '/assets/img/next-arrow.png' ?>" alt="Flèche de droite"/>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if( have_posts() ) : while( have_posts() ) : the_post(); ?>


<!-- Dernière partie - Photos similaires -->
<div class="similar-photo">
    <h3>Vous aimerez aussi</h3>
    <div class="block-photos">
        <div class="block-content">
            <?php
                // Récupération de la catégorie de la photo actu
                $categories = wp_get_post_terms(get_the_ID(), 'categorie');
                if ($categories && !is_wp_error($categories)) {

                    $ID_categories = wp_list_pluck($categories, 'term_id');
                    
                    // Récupération de deux photos de la même catégorie
                    $photos_similaires = new WP_Query(array(
                        'post_type' => 'photographies',
                        'posts_per_page' => 2,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field' => 'id',
                                'terms' => $ID_categories,
                            ),
                        ),
                    ));

                    if ($photos_similaires->have_posts()) {
                        while ($photos_similaires->have_posts()) {
                            $photos_similaires->the_post();
                            // Affichage de la photo similaire 
                            get_template_part('templates_part/photo_block');
                        }
                        wp_reset_postdata();
                    } else {
                        echo "Aucune photo similaire pour le moment.";
                    }
                }
            ?>
        </div>
       
    </div>
</div>

<?php endwhile; endif; ?>

<?php 
get_footer();
?>
