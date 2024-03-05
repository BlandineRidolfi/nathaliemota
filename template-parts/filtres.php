<?php
// Affichage taxonomies
$taxonomy = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annee' => 'TRIER PAR',
];

foreach ($taxonomy as $taxonomy_slug => $label) {
    $terms = get_terms($taxonomy_slug);
    if ($terms && !is_wp_error($terms)) {

        echo "<select id='$taxonomy_slug' class='custom-select taxonomy-select'>";

        echo "<option value=''>$label</option>";

        // Ajout des options spécifiques pour la taxonomie "annee"
        if ($taxonomy_slug === 'annee') {
            echo "<option value='date_asc'>A partir des plus récentes</option>";
            echo "<option value='date_desc'>A partir des plus anciennes</option>";
        } else {
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }
        }

        echo "</select>";
    }
}
