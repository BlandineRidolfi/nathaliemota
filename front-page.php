<?php get_header();?>

<main>

    <section id="header">
		<?php get_template_part('template-parts/hero'); ?>
	</section>

    <section id="filtrePhoto">
		<?php get_template_part('template-parts/photo-filtre'); ?>
	</section>

    <section id="photo__container" class="blockCatalogue">
		<?php get_template_part('template-parts/photo-container'); ?>
	</section>

</main>

<?php get_footer();?>