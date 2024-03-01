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

        if ($photo_block->have_posts()) :
    
        set_query_var('block-photo_args', array('context' => 'front-page'));
        while ($photo_block->have_posts()) :
            $photo_block->the_post();
        get_template_part('template-parts/block-photo', get_post_format()); 
        ?>

    <?php
        endwhile; 
        wp_reset_postdata(); 
    else :
        echo 'Aucune photo trouvée.';
    endif; 
    ?>

     <div id="moreImage">
     <button id="viewMore" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>
     </div>