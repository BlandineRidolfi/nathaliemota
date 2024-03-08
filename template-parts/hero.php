                                        <!-- PARTIE HERO HEADER -->

<div class="hero">
    <h1>Photographe event</h1>

    <?php
    // Arguments pour la requête de photo aléatoire
    $photo_args = array(
        'post_type'      => 'photo',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );

    // Exécute la requête WP_Query
    $photo_query = new WP_Query($photo_args);

    // Vérifie s'il y a des photos dans la requête
    if ($photo_query->have_posts()) {
        // Boucle à travers les photos
        while ($photo_query->have_posts()) {
            $photo_query->the_post();
            // Affiche la vignette de la photo en taille complète
            echo get_the_post_thumbnail(get_the_ID(), 'full');
        }
        // Réinitialise les données post
        wp_reset_postdata();
    }
    ?>
</div>
