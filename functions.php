<?php

function theme_enqueue_styles(){
    // Chargement du style.css du th�me enfant
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/assets/sass/style.css', array(), filemtime(get_stylesheet_directory() . '/assets/sass/style.css'));

}

// Action qui permet de charger des scripts dans notre th�me
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/* Ajout de la librairie JQuery  */
function librairie_JQuery() {
    wp_enqueue_script('JQuery-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array('jquery'), '3.7.1', true);
}
add_action( 'wp_enqueue_scripts', 'librairie_JQuery' );

/* Chargement des script JS du th�me enfant */
function script_JS_Custo() {

    // Gestion de la Modale
    wp_enqueue_script('Modale', get_stylesheet_directory_uri() . '/assets/js/modale.js', array('jquery'), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'script_JS_Custo' );

// Astuce pour éviter d'avoir des <p> partout dans CF7
add_filter('wpcf7_autop_or_not', '__return_false');

function enregistrement_nav_menus() {

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primaire', 'mota' ),
			'menu-2' => esc_html__( 'Secondaire', 'mota' ),
		)
	);
}
add_action( 'after_setup_theme', 'enregistrement_nav_menus' );
