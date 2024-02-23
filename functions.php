<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');

function theme_enqueue_styles_and_scripts() {
    // Chargement du style.css du thème
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/sass/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/sass/style.css'));

    // Chargement du script avec jQuery
    wp_enqueue_script('script', get_theme_file_uri() . '/js/modale.js', array('jquery'),time(), true);
   
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
