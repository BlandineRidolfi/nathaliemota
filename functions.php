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

    // Chargement de plus d'images avec Ajax (script JQuery)
    wp_enqueue_script('Ajax-charge-plus-images', get_stylesheet_directory_uri() . '/js/load-more.js', array('jquery'), '1.0.0', true);

    // Gestion du Menu Burger (script JQuery)
    wp_enqueue_script('menuBurgerJS', get_stylesheet_directory_uri() . '/js/menuBurger.js', array('jquery'), '1.0.0', true);

    // Localisation de la variable ajaxloadmore pour le script principal
    wp_localize_script('Ajax-charge-plus-images', 'ajaxloadmore', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'query_vars' => json_encode(array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'orderby' => 'date',
            'order' => 'ASC',
        ))
    ));
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

// Chargement photos Ajax load more
function load_more_photos($args) {
    $paged = $_POST['page'] + 1;
    $query_vars = json_decode(stripslashes($_POST['query']), true);
    $query_vars['paged'] = $paged;
    $query_vars['posts_per_page'] = 12;
    $query_vars['orderby'] = 'date';

    $photos = new WP_Query($query_vars);
    if ($photos->have_posts()) {
        ob_start();
        while ($photos->have_posts()) {
            $photos->the_post();
            get_template_part('template-parts/block-photo', null);
        }
        wp_reset_postdata();

        $output = ob_get_clean(); // Get the buffer and clean it
        echo $output; // Echo the output
    } else {
        ob_clean(); // Clean any previous output
        echo 'no_posts';
    }
    die();
}

add_action('wp_ajax_nopriv_load_more', function () {
    load_more_photos(json_encode(array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'ASC',
    )));
});

add_action('wp_ajax_load_more', function () {
    load_more_photos(json_encode(array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'ASC',
    )));
});
