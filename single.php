<?php
get_header();
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
        <button class="banner-button">Contact</button>
    
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

            <div class="array-post">
                <div class="previous-post">
                    <!-- Récupération du post précédent par date -->
                    <?php
                    $previous_post = get_previous_post();
                    // Si le post précédent existe, affichage du post //
                    if (!empty($previous_post)) :
                    ?>
                        <a href="<?php echo get_permalink($previous_post->ID); ?>">
                            <img class="previous-post-image" src="<?php echo get_the_post_thumbnail_url($previous_post->ID); ?>" alt="Image précédente">
                        </a>
                    <!-- Si post précédent non-existant, affichage -->
                    <?php else : 
                        $last_post = $last_post->posts[0]; 
                    ?>
                        <a href="<?php echo get_permalink($last_post->ID); ?>">
                            <img class="previous-post-image" src="<?php echo get_the_post_thumbnail_url($last_post->ID); ?>" alt="Image précédente">
                        </a>
                    <?php endif; ?>
                </div>

                <div class="next-post">
                    <!-- Récupération du post suivant par date -->
                    <?php
                    $next_post = get_next_post();
                    // Si post suivant existant, affichage du post //
                    if (!empty($next_post)) :
                    ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>">
                            <img class="next-post-image" src="<?php echo get_the_post_thumbnail_url($next_post->ID); ?>" alt="Image suivante">
                        </a>
                    <!-- Si post suivant non-existant, affichage -->
                    <?php else : 
                        $first_post = $first_post->posts[0];
                    ?>
                        <a href="<?php echo get_permalink($first_post->ID); ?>">
                            <img class="next-post-image" src="<?php echo get_the_post_thumbnail_url($first_post->ID); ?>" alt="Image suivante">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
get_footer();
?>