                                <!-- Partie block photo page d'accueil -->

<?php
// Je récupère 8 photos aléatoires pour le bloc initial
$args = array(
    'post_type'      => 'photo',
    'posts_per_page' => 8,
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Initialisation de la requête WP_Query
$photo_block = new WP_Query($args);

// Je vérifie s'il y a des photos
if ($photo_block->have_posts()) :

    // Je définie les arguments pour le bloc photo
    set_query_var('photo_block_args', array('context' => 'front-page'));

    // Boucle pour afficher chaque photo
    while ($photo_block->have_posts()) :
        $photo_block->the_post();
        // J'utilise get_template_part avec le format par défaut (fallback)
        get_template_part('template-parts/block-photo', get_post_format());
    endwhile;

    // Je réinitialise la requête
    wp_reset_postdata();
else :
    // Message si aucune photo trouvée
    echo 'Aucune photo trouvée.';
endif;
?>

        
   