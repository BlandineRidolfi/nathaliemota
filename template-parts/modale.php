<?php
/**
 * Modal contact
 *
 * @package WordPress
 * @subpackage mota theme
 */
?>

<!-- Ajout de popup dans contact -->

<div class="popup__overlay">

	<div class="popup__contact">
		<div class="popup-title__container">
			<span class="popup__close"></span>
            <img src="<?php echo get_template_directory_uri() . '/assets/images/contact.png'; ?>" alt="contact">
		</div>
		<div class="popup__informations"></p>
			<?php
				// insertion du formulaire
				echo do_shortcode('[contact-form-7 id="eede9d9" title="ContactModale"]');
				?>
		</div>
	</div>
</div>