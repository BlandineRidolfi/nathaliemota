<?php get_header();?>

<?php 
/* Récupération des champs de groupe ACF */
$photoId = get_field('photo');
$reference = get_field('reference');
$refUppercase = strtoupper($reference); // Instruction PHP qui utilise la fonction strtoupper pour convertir une chaîne de caractère en UPPERCASE
$type = get_field('type');

// Récupération des termes de la taxonomie 'annee' associés à l'article
$annees_terms = get_the_terms(get_the_ID(), 'annee');
// Vérification de l'existence des termes et non-vide
if ($annees_terms && !is_wp_error($annees_terms)) {
    // Prendre le premier terme, car un article peut avoir plusieurs termes
    $annee = $annees_terms[0]->name;
  } else {
    // Définition d'une valeur par défaut si aucun terme n'est trouvé
    $annee = 'Non défini';
  }

$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$FORMATS = $formats ? ucwords($formats[0]->name) : ''; // expression conditionnelle en PHP qui utilise la fonction ucwords pour mettre en majuscule la première lettre de chaque mot dans une chaîne de caractères

// Je définis URL des vignettes pour le post précédent et suivant

$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';
?>

<!--J'affiche la photo et ses informations-->
<section class="photos__catalog">
    <div class="photos__gallery">
        <div class="photo__detail">            
            <div class="photo__container">
                <!-- J'affiche la photo -->
                <img src="<?php echo $photoId; ?>" alt="<?php the_title_attribute(); ?>">
            </div>
            
            <div class="photo__info"> 
                <div class="photo__title">                
                    <h2><?php echo get_the_title(); ?></h2>
                </div>
                <div class="photo__taxo">
                    <p>RÉFÉRENCES: <?php echo esc_html($refUppercase); ?></p>
                    <p>CATÉGORIE: <?php echo esc_html($categories[0]->name); ?></p>
                    <p>FORMAT: <?php echo esc_html($FORMATS); ?></p>
                    <p>TYPE: <?php echo esc_html($type); ?></p>
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
            <button id="contact__button" data-reference="<?php esc_attr($reference); ?>">Contact</button>
        </div>

        <div class="navPhotos">

        <!-- Conteneur miniature -->
        <div class="minaturePhoto" id="miniaturePhoto">
            <!-- Chargement de la photo miniature avec JS -->
        </div>

        <div class="navArrow">
            <?php if (!empty($previousPost)) : ?>
                <img class="arrow arrow__left" src="<?php echo get_theme_file_uri() . '/assets/images/arrow_left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
            <?php endif; ?>

            <?php if (!empty($nextPost)) : ?>
                <img class="arrow arrow__right" src="<?php echo get_theme_file_uri() . '/assets/images/arrow_right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
            <?php endif; ?>
        </div>

    </div>
  </div>
</section>

<section>
  <div class="title__suggestion">
    <h3>VOUS AIMEREZ AUSSI</h3>
  </div>
  <div class="photo__similar">
    <?php
    // Récupération des catégories de la photo principale
    $categories = get_the_terms(get_the_ID(), 'categorie');
    // Arguments de la requête pour récupérer les photos similaires
    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 2,
      'post__not_in' => array(get_the_ID()),
      'tax_query' => array(
        array(
          'taxonomy' => 'categorie',
          'field' => 'id',
          'terms' => $categories ? wp_list_pluck($categories, 'term_id') : array(),
        ),
      ),
    );
    // Exécution de la requête WP_Query avec les arguments définis
    $query = new WP_Query($args);
    // Boucle à travers les photos similaires
    while ($query->have_posts()) :
      $query->the_post();
      // Récupération de l'ID de la photo et de la référence
      $photoId = get_field('photo');
      $reference = get_field('reference');
      $refUppercase = strtoupper($reference);
      // Affiche le bloc de photo en utilisant un template part (partie de modèle)
      get_template_part('template-parts/block-photo');
    endwhile;
    // Affiche un message si aucune photo similaire n'est trouvée
    if (!$query->have_posts()) :
      echo '<p class="photoNotFound">Aucune photo similaire n\'a été trouvée pour la catégorie.</p>';
    endif;
    // Réinitialisation des données de post après la boucle de requête
    wp_reset_postdata();
    ?>
  </div>
</section>
<?php get_footer(); ?>