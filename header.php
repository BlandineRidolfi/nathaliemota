                              <!-- HEADER -->

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php wp_head(); ?>
</head>

<body class="mainContainer">
    <?php wp_body_open(); ?>

    <header class="site-header">
        <nav id="site-navigation" class="siteNavigation" role="navigation">
            <!-- Logo -->
            <div class="siteNavigation__logo">
                <a href="<?php echo home_url('/'); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>" alt="Logo">
                </a>
            </div>

            <!-- Menu burger -->
            <div class="burgerMenu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
                                        
            <!-- Menu principal -->
            <div class="siteNavigation__menu">
                <?php
                // Utilisation de la fonction wp_nav_menu pour afficher le menu WP
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'container'      => 'false',
                        'menu_class'     => 'navMenu',
                    )
                );
                ?>
            </div>    
        </nav>
    </header>
