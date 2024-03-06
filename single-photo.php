<?php get_header();?>

<?php 
$photoId = get_field('photo');
$reference = get_field('reference');
$refUppercase = strtoupper($reference);

// Récupération des catégories de la photo principale
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie_name = $categories ? $categories[0]->name : '';
$formats = get_the_terms(get_the_ID(), 'format');
$FORMATS = $formats ? ucwords($formats[0]->name) : '';

// Récupération des années de la taxonomie 'annee'
$annees_terms = get_the_terms(get_the_ID(), 'annee');
$annee = ($annees_terms && !is_wp_error($annees_terms)) ? $annees_terms[0]->name : 'Non défini';


// Définition de l'URL des vignettes pour le post précédent et suivant
$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

<!-- J'affiche la photo et ses informations -->
<section class="photos__catalog">
    <div class="photos__gallery">
        <div class="photo__detail">            
            <div class="photo__container">
                <img src="<?php echo esc_url($photoId); ?>" alt="<?php the_title_attribute(); ?>">
                <div class="singlePhotoOverlay">
                    <div class="icon__fullscreen" data-reference="<?php echo esc_attr($reference); ?>" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fullscreen.svg" alt="Icone fullscreen">
                    </div>
                </div>
            </div>
            
            <div class="photo__info">                
                <h2><?php echo esc_html(get_the_title()); ?></h2>
            
                <div class="photo__taxo">
                    <p>RÉFÉRENCE    : <span id="single-reference"><?php echo esc_html($refUppercase); ?></span></p>
                    <p>CATÉGORIE    : <?php echo esc_html($categorie_name); ?></p>
                    <p>FORMAT    : <?php echo esc_html($FORMATS); ?></p>
                    <p>TYPE    : <?php echo esc_html(get_field('type')); ?></p>
                    <p>ANNÉE: <?php echo esc_html($annee); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Partie contact et navigation entre les photos -->
    <div class="contact__container">
        <div class="contact">
            <p class="interested">Cette photo vous intéresse ?</p>            
            <!-- Bouton CTA avec référence -->
            <button class="modale-contact" id="contact__button" data-reference="<?php echo $refUppercase; ?>">Contact</button>
        </div>

        <div class="navPhotos">
    <div class="navArrow">
        <?php if (!empty($previousPost)) : ?>
            <div class="arrowContainer">
                <img class="arrow arrow__left" tabindex="0" src="<?php echo esc_url(get_theme_file_uri() . '/assets/images/arrow_left.png'); ?>" alt="Photo précédente" data-thumbnail-url="<?php echo esc_url($previousThumbnailURL); ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
                <div class="minaturePhoto" id="miniaturePhoto">
                    <!-- Chargement de la photo miniature avec JS -->
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($nextPost)) : ?>
            <div class="arrowContainer">
                <img class="arrow arrow__right" tabindex="0" src="<?php echo esc_url(get_theme_file_uri() . '/assets/images/arrow_right.png'); ?>" alt="Photo suivante" data-thumbnail-url="<?php echo esc_url($nextThumbnailURL); ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
                <div class="minaturePhoto" id="miniaturePhoto">
                    <!-- Chargement de la photo miniature avec JS -->
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>





    </div>
</section>

<section class="suggestions">
    <div class="title__suggestion">
        <h3>VOUS AIMEREZ AUSSI</h3>
    </div>

    <div class="photo__similar">
        <?php
        $categories = get_the_terms(get_the_ID(), 'categorie');
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'post__not_in' => array(get_the_ID()),
            'orderby'=> 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'id',
                    'terms' => $categories ? wp_list_pluck($categories, 'term_id') : array(),
                ),
            ),
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();        
                $photoId = get_field('photo');
                $reference = get_field('reference');
                $refUppercase = strtoupper($reference);
                get_template_part('template-parts/block-photo');
            endwhile;
        else :
            echo '<p class="photoNotFound">Pas de photo similaire trouvée pour la catégorie.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>

<?php get_footer(); ?>
