<?php
// Chargement des styles et scripts
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');
function theme_enqueue_styles_and_scripts() {
    // Enqueue jQuery from CDN
    wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);

    // Chargement du style.css du thème
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/sass/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/sass/style.css'));

    // Chargement du script avec jQuery
    wp_enqueue_script('script', get_theme_file_uri() . '/js/modale.js', array('jquery'), time(), true);

    // Affichage des images miniature (script JQuery)
    wp_enqueue_script('photosMiniature', get_stylesheet_directory_uri() . '/js/photosMiniature.js', array('jquery'), '1.0.0', true);

    

    // Gestion du Menu Burger (script JQuery)
    wp_enqueue_script('menuBurgerJS', get_stylesheet_directory_uri() . '/js/menuBurger.js', array('jquery'), '1.0.0', true);

    
}

// Ajout d'une fonction permettant de gérer les menus depuis WP
function enregistrement_nav_menus() {
    register_nav_menus(
        array(
            'menu-1' => esc_html__( 'Header', 'mota' ),
            'menu-2' => esc_html__( 'Footer', 'mota' ),
        )
    );
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );

// LOAD-MORE PHOTOS 

  // Ajout du script load-more-photos.js et filtre.js avec wp_localize_script pour passer des paramètres AJAX
  function enqueue_load_more_photos_script()
  {
      wp_enqueue_script('load-more', get_stylesheet_directory_uri() . '/js/load-more.js', array('jquery'), null, true);
  
      //wp_enqueue_script('filtres', get_stylesheet_directory_uri() . '/js/filtres.js', array('jquery'), null, true);
  
      // Utilisez wp_localize_script pour passer des paramètres à votre script
      wp_localize_script('load-more', 'ajax_params', array(
          'ajax_url' => admin_url('admin-ajax.php'),
      ));
  
      wp_localize_script('filtre', 'ajax_params', array(
          'ajax_url' => admin_url('admin-ajax.php'),
      ));
  }
  add_action('wp_enqueue_scripts', 'enqueue_load_more_photos_script');
  
  // Fonction pour charger plus de photos via AJAX
  function load_more_photos()
  {
      // Récupère le numéro de page à partir des données POST
      $page = $_POST['page'];
  
      // Arguments de la requête pour récupérer les photos
      $args = array(
          'post_type'      => 'photo',     // Type de publication : photo
          'posts_per_page' => 8,          // Nombre de photos par page (-1 pour toutes)
          'orderby'        => 'date',      // Tri aléatoire
          'order'          => 'DESC',       // Ordre ascendant
          /*'paged'          => $page,       // Numéro de page*/
          'offset' => $_POST[
              'offset'
          ]
      );
  
      // Exécute la requête WP_Query avec les arguments
      $photo_block = new WP_Query($args);
  
      // Vérifie s'il y a des photos dans la requête
      if ($photo_block->have_posts()) :
          // Boucle à travers les photos
          while ($photo_block->have_posts()) :
              $photo_block->the_post();
              // Inclut la partie du modèle pour afficher un bloc de photo
              get_template_part('template-parts/block-photo', get_post_format());
          endwhile;
  
          // Réinitialise les données post
          wp_reset_postdata();
      else :
          // Aucune photo trouvée
          echo 'Aucune photo trouvée.';
      
      endif;
      
      // Termine l'exécution de la fonction
      die();
  }
  
  // Ajoute l'action AJAX pour les utilisateurs connectés
  add_action('wp_ajax_load_more_photos', 'load_more_photos');
  // Ajoute l'action AJAX pour les utilisateurs non connectés
  add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');