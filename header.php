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
			<div class="siteNavigation__logo">
				<a href="<?php echo home_url('/'); ?>">
					<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/logo.png'; ?>" alt="Logo">
				</a>
			</div>
								
			<div class="siteNavigation__menu">
	
				<?php
				// Fonction pour déclarer mon header WP
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
