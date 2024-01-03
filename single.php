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

<!-- Création du bandeau inférieur -->
<div class="banner">
    <div class="banner-content">
        <p>Cette photo vous intéresse ?</p>
        <button class="banner-button">Contact</button>
    </div>
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


    </div>
</div>


<?php
get_footer();
?>