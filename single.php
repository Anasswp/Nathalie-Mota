<?php
get_header();

while (have_posts()) :
    the_post(); ?>

        <div class="content">
            <?php the_content(); ?>
        </div>

<?php
endwhile;
get_footer();
?>
