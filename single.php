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



<?php
get_footer();
?>
