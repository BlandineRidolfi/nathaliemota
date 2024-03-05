<footer>

<nav>
        <?php
        // Fonction pour le menu footer
        wp_nav_menu(
            array(
                'theme_location' => 'menu-2',
                'container'      => 'false',
                'menu_class'     => 'footerMenu',
            )
        );
        ?>
        
        <?php get_template_part('template-parts/modale'); ?>
        
     <!-- Appel de la lightBox -->
     <?php get_template_part('template-parts/lightbox'); ?>
        

</nav>
    
</footer>

<?php wp_footer(); ?>

</body>
</html>