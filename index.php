<!-- Boucle WordPress pour afficher le contenu de la page -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<h1><?php get_the_title(); ?></h1>
<section class="container">
    <?php the_content(); ?>


</section>

<?php endwhile;
endif; ?>
