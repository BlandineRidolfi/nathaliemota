<?php

// Je récupère la photo
$photoId = get_the_post_thumbnail_url(null, "large");
// Je récupère le titre de la photo
$title_photo = get_the_title();
// Je récupère l'url du post
$url_post = get_permalink();
// Je récupère la référence de la photo
$reference = get_field('reference');
// Je récupère les catégories de la photo
$categories = get_the_terms(get_the_ID(), 'categorie');
$categorie = $categories[0]->name;

?>

<div class="blockPhotoRelative">
    <!-- J'affiche la photo en incluant son URL et son alt -->
    <img src="<?php echo esc_url($photoId); ?>" alt="<?php the_title_attribute(); ?>">

    <div class="overlay">

        <!-- J'affiche le titre de la photo -->
        <h2><?php echo esc_html($title_photo); ?></h2>

        <!-- J'affiche la catégorie -->
        <h3><?php echo esc_html($categorie); ?></h3>

        <!-- J'ajoute l'icône pour voir la photo en entier -->
        <div class="eye-icon">
            <a href="<?php echo esc_url(get_permalink()); ?>">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon_eye.svg" alt="voir la photo">
            </a>
        </div>
        <div class="icon-fullscreen" data-full="<?php echo esc_attr($id_photo); ?>" data-category="<?php echo esc_attr($categorie); ?>" data-reference="<?php echo esc_attr($reference); ?>">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fullscreen.svg" alt="Icone fullscreen">
        </div>
    </div>
</div>
