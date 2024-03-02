<?php get_header();?>


    
		<?php get_template_part('template-parts/hero'); ?>
	

    <section id="filtrePhoto">
		<?php get_template_part('template-parts/photo-filtre'); ?>
	</section>

    <section id="photo__container" class="blockCatalogue">
		<?php get_template_part('template-parts/photo-container'); ?>

		 
	</section>

    <!-- Partie bouton pour charger plus de photos -->
		 <div id="moreImage">
        <button id="viewMore" data-offset= "8" data-url="">Charger plus</button>
    </div>


<?php get_footer();?>