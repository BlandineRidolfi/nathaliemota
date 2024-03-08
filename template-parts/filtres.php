                                  <!-- PARTIE FILTRES DE LA PAGE D'ACCUEIL -->

<?php
// Définition des taxonomies
$taxonomy_labels = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'annees' => 'TRIER PAR',
];

// Début du conteneur #filtrePhoto
echo "<div id='filtrePhoto'>";

// Section de gauche avec les filtres catégorie et format
echo "<div class='left-filter filter-container' id='left-filter'>";

// Boucle sur les taxonomies pour la section gauche (catégorie et format)
foreach ($taxonomy_labels as $taxonomy_slug => $label) {
    // Je retire 'annees' de la section gauche
    if ($taxonomy_slug !== 'annees') {
        // Je récupére les termes de la taxonomie
        $terms = get_terms($taxonomy_slug);

        // Je vérifie si des termes existent et qu'il n'y a pas d'erreur WordPress
        if ($terms && !is_wp_error($terms)) {
            // J'ajoute une classe CSS spécifique pour chaque select
            $select_class = 'custom-select ' . $taxonomy_slug . '-select';

            // Début du conteneur pour la taxonomie
            echo "<div class='taxonomy-container'>";
            // Début de la balise label
            echo "<label for='$taxonomy_slug'>";
            // J'affiche le select avec l'ID et la classe appropriée
            echo "<select id='$taxonomy_slug' class='$select_class'>";
            // Option par défaut avec le label de la taxonomie
            echo "<option value=''>$label</option>";

            // J'affiche chaque terme comme une option
            foreach ($terms as $term) {
                echo "<option value='$term->slug'>$term->name</option>";
            }

            // Fin du select 
            echo "</select>";
            // Fin de la balise label
            echo "</label>";
            // Fin du conteneur pour la taxonomie
            echo "</div>";
        }
    }
}

// Fin de la section de gauche avec les filtres catégorie et format
echo "</div>";

// Section de droite du filtre trier par
echo "<div class='right-filter filter-container' id='right-filter'>";
// Classe CSS spécifique pour la taxonomie 'annees'
$select_class_annees = 'custom-select annees-select';
// Début du conteneur pour la taxonomie 'annees'
echo "<div class='taxonomy-container'>";
// Début de la balise label
echo "<label for='annees'>";
// J'affiche le select avec l'ID et la classe appropriée
echo "<select id='annees' class='$select_class_annees'>";
// Option par défaut avec le label de la taxonomie 'annees'
echo "<option value=''>{$taxonomy_labels['annees']}</option>";
// Options spécifiques pour 'annees'
echo "<option value='date_asc'>A partir des plus récentes</option>";
echo "<option value='date_desc'>A partir des plus anciennes</option>";
// Fin du select 
echo "</select>";
// Fin de la balise label
echo "</label>";
// Fin du conteneur pour la taxonomie 'annees'
echo "</div>";
// Fin de la section de droite avec le filtre trier par
echo "</div>";

// Fin du conteneur #filtrePhoto
echo "</div>";
