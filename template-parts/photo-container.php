<?php
     // Récupération de 12 photos aléatoires pour le bloc initial
          $args = array(
             'post_type' => 'photo',
             'posts_per_page' => 8,
             'orderby' => 'date',
             'order' => 'ASC',
            );
     $photo_block = new WP_Query($args);

      wp_localize_script('Ajax-charge-plus-images', 'ajaxloadmore', array(
                             'ajaxurl' => admin_url('admin-ajax.php'),
                             'query_vars' => json_encode($args)
                             )
                        );
        // Je vérifie s'il y a des photos
        if ($photo_block->have_posts()) :
        
        // Je défini les arguments pour le bloc photo
        set_query_var('block-photo_args', array('context' => 'front-page'));

        // Je fais une boucle pour pouvoir afficher chaque photo
        while ($photo_block->have_posts()) :
            $photo_block->the_post();
            get_template_part('template-parts/block-photo', get_post_format());
        endwhile;
        
        // Je réinitialise la requète
        wp_reset_postdata(); 
    else :
        echo 'Aucune photo trouvée.';
    endif; 
        ?>

    <!-- Partie bouton pour charger plus de photos -->
    <div id="moreImage">
        <button id="viewMore" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
    </div>