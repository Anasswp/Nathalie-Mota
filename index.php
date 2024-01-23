<?php
get_header();
?>

    <div class="hero-area">
        <h1 class="hero-title">Photographe Event</h1>
        <div class="hero-thumbnail">
            <?php
            // Affichage aléatoire d'une photo
            $args = array(
                'post_type' => 'photographies',
                'posts_per_page' => 1,
                'orderby' => 'rand',
            );

            $photo_aleatoire_hero = new WP_Query($args);

            if ($photo_aleatoire_hero->have_posts()) {
                while ($photo_aleatoire_hero->have_posts()) {
                    $photo_aleatoire_hero->the_post();
                    the_content();
                }
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
    <div class="bloc-photos">

    <div class="filter-area swiper-container">
    <form class="flexrow swiper-wrapper" method="post" >
    <!--  -->
    <!-- $terms->term_id :  -->
    <!-- $terms->taxonomy : nom de la taxonomie -->
    <!-- $terms->name : nom de l'élément de la taxonomie -->
    <!-- $terms->term_taxonomy_id : n° de l'élément de la taxonomie -->
        <div class="filterleft swiper-slide flexrow">
            <div id="filtre-categorie" class="select-filter flexcolumn">   
                <span class="categorie_id-down dashicons dashicons-arrow-down select-close"></span>
                <label for="categorie_id"><p>catégories</p></label>
                <select class="option-filter" name="categorie_id" id="categorie_id">
                    <!-- Génération automatique de la liste des catégories en fonction de ce qu'il y a dans WP -->
                    <option id="categorie_0" value=""></option>
                    <?php
                        $categorie = get_terms('categorie', array('hide_empty' => false)); 
                        foreach ( $categorie as $terms) : 
                    ?>
                        <?php if($terms->term_taxonomy_id == $categorie_id): ?>
                            <option id="categorie<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>" selected><?php echo $terms->name; ?></option>
                        <?php else : ?>
                            <option id="categorie<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"><?php echo $terms->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <div id="filtre-format" class="select-filter flexcolumn">      
                <span class="format_id-down dashicons dashicons-arrow-down select-close"></span>
                <label for="format_id"><p>formats</p></label>
                <select class="option-filter" name="format_id" id="format_id"> 
                    <!-- Génération automatique de la liste des formats en fonction de ce qu'il y a dans WP -->
                    <option id="format_0" value=""></option>
                    <?php
                        $format= get_terms('formats', array('hide_empty' => false)); 
                        foreach ( $format as $terms) : 
                    ?>
                        <?php if($terms->term_taxonomy_id == $format_id): ?>
                            <option id="format_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>" selected><?php echo $terms->name; ?></option>
                        <?php else : ?>
                            <option id="format_<?php echo $terms->term_taxonomy_id; ?>" value="<?php echo $terms->term_taxonomy_id; ?>"><?php echo $terms->name; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="filterright swiper-slide flexrow">
            <div id="filtre-date" class="select-filter flexcolumn">       
                <span class="date-down dashicons dashicons-arrow-down select-close"></span>
                <label for="date"><p>trier par</p></label>
                <select class="option-filter" name="date" id="date">
                    <option value=""></option>
                    <option value="desc" <?php if($order === "desc"): ?>selected<?php endif; ?>>à partir des plus récentes</option>
                    <option value="asc" <?php if($order === "asc" ): ?>selected<?php endif; ?>>à partir des plus anciennes</option>
                </select>
            </div>
        </div>        
    </form>
</div>
        <div class="display-photos">
            <div class="photo-area">
                <!-- Création d'une loop pour afficher toutes les photos -->
                <?php
                $args = array(
                    'post_type' => 'photographies',
                    'posts_per_page' => 12,
                    'orderby' => 'date',
                    'order' => 'ASC',
                    'paged' => 1,
                );

                $photo_query = new WP_Query($args);

                if ($photo_query->have_posts()) {
                    while ($photo_query->have_posts()) {
                        $photo_query->the_post();
                        get_template_part('templates_part/photo_block');
                    }
                    wp_reset_postdata();
                } else {
                    echo 'Aucune photo trouvée.';
                }
                ?>
            </div>
        </div>
        <div class="home-button">
            <button id="load-more" class="see-more">Charger plus</button>
        </div>
    </div>

<?php
get_footer();
?>