
<footer>
<!--Affichage du menu footer -->
    <div>
        <?php 
        /*On appelle le menu là où on souhaite l'afficher*/
        wp_nav_menu([
            'theme_location' => 'footer-menu',
            'container' => false,
            'menu_class' => 'menu',
        ]);
        ?>
    </div>
</footer>