<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');

function theme_enqueue_styles_and_scripts() {
	// Enqueue jQuery from CDN
	wp_enqueue_script('jquery-cdn', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
	
    // Chargement du style.css du thème
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/sass/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/sass/style.css'));

    // Chargement du script avec jQuery
    wp_enqueue_script('script', get_theme_file_uri() . '/js/modale.js', array('jquery'),time(), true);

	// Affichage des images miniature (script JQuery)
    wp_enqueue_script('photosMiniature', get_stylesheet_directory_uri() . '/js/photosMiniature.js', array('jquery'), '1.0.0', true);
   
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
