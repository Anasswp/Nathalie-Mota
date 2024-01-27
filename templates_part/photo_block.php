<?php
    // Récupération des informations de la photo
    $titre_post = get_the_title();
    $titre_nettoye = sanitize_title($titre_post);
    $lien_post = get_template_directory_uri() . '/photographies/'. $titre_nettoye;
    $photo_post = get_the_content();
    $date_post = get_the_date('Y');
    $reference_photo = get_field('reference');

    // Récupération du format de la photo
    $formats = get_the_terms(get_the_ID(), 'formats');
        if ($formats && !is_wp_error($formats)) {
            $noms_formats = array();
            foreach ($formats as $format) {
                $noms_formats[] = $format->name;
            }
            $liste_formats = join(', ', $noms_formats);
        }

    // Récupération de la catégorie de la photo
    $categories = get_the_terms(get_the_ID(), 'categorie');
        if ($categories && !is_wp_error($categories)) {
            $noms_categories = array();
            foreach ($categories as $categorie) {
                $noms_categories[] = $categorie->name;
            }
            $liste_categories = join(', ', $noms_categories);
        }
?>

<div class="photo-block">
    <?php echo $photo_post; ?>
    <div class="photo-details">
        <div class="icons-container">
            <div class="icon expand-icon">
                <i class="fa-solid fa-expand full-screen"></i>
            </div>
            <div class="icon eye-icon autres-photos">
                <i class="fa-regular fa-eye oeil"></i>
                <!-- Ajoutez ici d'autres éléments si nécessaire -->
            </div>
            <div class="icon third-icon">
                <!-- Ajoutez ici le code pour la troisième icône ou laissez vide si vous ne l'utilisez pas -->
            </div>
        </div>
    </div>
    <!-- Ajoutez ici d'autres blocs photo si nécessaire -->
</div>
