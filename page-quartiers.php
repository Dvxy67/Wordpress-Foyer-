<?php
/*
Template Name: Page Quartiers - Harmonisée
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Quartiers</title>

    <style>
        /* CSS HARMONISÉ - Page Quartiers Mobile-First */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Container principal */
        .quartiers-page {
            min-height: 100svh;
            background: #6b92ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        /* Container principal pour équilibrer l'espace - AJOUTÉ ! */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100svh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Container de la grille */
        .quartiers-container {
            background: #eed05d;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100svh - 120px);
            max-height: 585px;
            min-height: 505px;
            padding: 15px 15px 0px 15px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Section titre avec immeuble - OPTIMISÉE */
        .titre-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0px;
            gap: 40px;
            min-height: 60px;
            flex-shrink: 0;
        }

        /* Image d'immeuble - RÉDUITE */
        .immeuble-icon {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .immeuble-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .immeuble-icon .emoji-fallback {
            font-size: 40px;
            line-height: 1;
        }

        /* Titre "J'HABITE À" - RÉDUIT */
        .titre-text {
            font-size: 25px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Zone scrollable - OPTIMISÉE */
        .quartiers-scroll {
            flex: 1;
            background: #FFFFFF;
            border-radius: 0px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #CCCCCC #F0F0F0;
            border-bottom-left-radius: 2px;
            border-bottom-right-radius: 2px;
        }

        /* Scrollbar pour Chrome/Safari */
        .quartiers-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .quartiers-scroll::-webkit-scrollbar-track {
            background: #F0F0F0;
        }

        .quartiers-scroll::-webkit-scrollbar-thumb {
            background: #CCCCCC;
            border-radius: 4px;
        }

        .quartiers-scroll::-webkit-scrollbar-thumb:hover {
            background: #AAAAAA;
        }

        /* Liste des quartiers */
        .quartiers-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Item de quartier - TYPOGRAPHIE IDENTIQUE À HABITANTS */
        .quartier-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 15px;
            font-size: 22px !important;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-decoration: none;
            line-height: 1.1;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #ebecf4;
            background: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.2s ease;
            min-height: 45px;
        }

        /* SÉLECTIONNÉ - Bleu au clic */
        .quartier-item.selected {
            background-color: #7391ff !important;
            color: #FFFFFF !important;
        }

        /* Premier quartier avec bordure en haut */
        .quartiers-list li:first-child .quartier-item {
            border-top: 2px solid #ebecf4;
        }

        /* Dernier quartier sans bordure */
        .quartier-item:last-child {
            border-bottom: none;
        }

        /* Section bouton retour - IDENTIQUE À LOGEMENT */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 118px;
            /* ← MODIF : 70px → 118px */
            flex-shrink: 0;
            width: 100%;
            /* ← AJOUT : pour correspondre à logement */
        }

        .retour-button {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Centré maintenant */
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
        }

        /* Flèche/Image de retour - IDENTIQUE À LOGEMENT */
        .arrow {
            width: 90px;
            /* ← MODIF : 80px → 90px */
            height: 90px;
            /* ← MODIF : 80px → 90px */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .arrow img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .arrow .emoji-fallback {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour - HARMONISÉ */
        .retour-text {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            letter-spacing: 1px;
        }

        /* Supprimer le carré bleu sur les boutons retour */
        .retour-button,
        .retour-button img,
        .arrow-image {
            outline: none;
            -webkit-tap-highlight-color: transparent;
            /* Pour Safari/iOS */
        }

        /* Supprimer le focus au clic mais le garder au clavier */
        .retour-button:focus:not(:focus-visible),
        .retour-button img:focus:not(:focus-visible) {
            outline: none;
        }

        /* Garder un focus accessible au clavier (optionnel) */
        .retour-button:focus-visible {
            outline: 2px solid rgba(0, 0, 0, 0.3);
            outline-offset: 3px;
            border-radius: 8px;
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 390px) {}

        /* Animation d'entrée */
        @keyframes slideInMobile {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .quartiers-container {
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .retour-section {
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        /* RESET pour éviter les interférences CSS du thème */
        /* Exclure quartier-item et quartiers-container du reset */
        .quartiers-page *:not(.quartier-item):not(.quartiers-container) {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles - TOUT DOIT ÊTRE ICI */
        .quartiers-container {
            border: 3px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        /* Bordure des items - avec sélecteur plus spécifique */
        .quartiers-page .quartiers-list .quartier-item {
            border-bottom: 2px solid #ebecf4 !important;
        }

        .quartiers-page .quartiers-list li:last-child .quartier-item {
            border-bottom: none !important;
        }

        @media (min-width: 481px) {
            .quartiers-container {
                border: 6px solid #000000 !important;
                padding-bottom: 0.2px;
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
            }

            .quartiers-scroll {
                border-bottom-left-radius: 1px;
                border-bottom-right-radius: 1px;
            }
        }

        @media (hover: hover) {
            .quartier-item:hover { background-color: #DFDFDF; }
            .quartier-item.selected:hover { background-color: #5b7ae6 !important; }
            .retour-button:hover { transform: scale(1.05); }
            .search-result-item:hover { background-color: #DFDFDF; }
        }

        /* RECHERCHE PAR RUE */
        .search-icon-btn {
            background: none;
            border: none !important;
            cursor: pointer;
            font-size: 18px;
            padding: 4px;
            color: #000;
            line-height: 1;
            flex-shrink: 0;
            box-shadow: none !important;
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        .search-input-wrapper {
            display: none;
            align-items: center;
            gap: 6px;
            flex: 1;
            min-width: 0;
        }

        .search-input {
            flex: 1;
            width: 100%;
            border: 2px solid #000 !important;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 15px;
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            outline: none !important;
            background: #fff;
            box-shadow: none !important;
            color: #000;
            min-width: 0;
        }

        .search-close-btn {
            background: none;
            border: none !important;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            padding: 4px;
            line-height: 1;
            flex-shrink: 0;
            box-shadow: none !important;
            outline: none !important;
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }

        .titre-section.search-mode .titre-text,
        .titre-section.search-mode .search-icon-btn {
            display: none;
        }

        .titre-section.search-mode {
            gap: 8px;
            justify-content: flex-start;
        }

        .titre-section.search-mode .search-input-wrapper {
            display: flex;
        }

        .search-result-item {
            display: flex;
            flex-direction: column;
            padding: 10px 15px;
            border-bottom: 2px solid #ebecf4 !important;
            background: #fff;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .search-result-rue {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .search-result-quartier {
            font-size: 19px;
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
            letter-spacing: 0.5px;
        }

        .search-no-result {
            padding: 30px 15px;
            text-align: center;
            color: #888;
            font-size: 14px;
            font-weight: normal;
            text-transform: none;
            letter-spacing: 0;
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="quartiers-page">
        <div class="main-container">
            <div class="quartiers-container">

                <!-- Section titre avec immeuble -->
                <div class="titre-section">
                    <div class="immeuble-icon">
                        <?php
                        $image_immeuble = get_theme_mod('quartiers_image_immeuble');
                        if ($image_immeuble) : ?>
                            <img src="<?php echo esc_url($image_immeuble); ?>" alt="Immeuble">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Immeuble">🏢</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="titre-text">J'HABITE À</h1>
                    <button class="search-icon-btn" onclick="activateSearch()" aria-label="Rechercher par rue">🔍</button>
                    <div class="search-input-wrapper">
                        <input type="text" id="rue-search" class="search-input"
                               placeholder="Votre rue..."
                               oninput="handleSearch(this.value)"
                               autocomplete="off"
                               aria-label="Rechercher une rue">
                        <button class="search-close-btn" onclick="deactivateSearch()" aria-label="Fermer">✕</button>
                    </div>
                </div>

                <!-- Zone scrollable des quartiers -->
                <div class="quartiers-scroll">
                    <ul class="quartiers-list">
                        <?php
                        // Récupérer la liste des quartiers et des liens
                        $quartiers       = get_quartiers_list();
                        $quartiers_liens = function_exists('get_quartiers_links') ? get_quartiers_links() : array();

                        if (! empty($quartiers)) :
                            foreach ($quartiers as $index => $quartier) :
                                // Lien correspondant (même index que dans la liste des quartiers)
                                $url = (isset($quartiers_liens[$index]) && $quartiers_liens[$index] !== '')
                                    ? $quartiers_liens[$index]
                                    : '#';
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($url); ?>"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html(strtoupper($quartier)); ?>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                        else :
                            // Quartiers par défaut (si rien n'a été configuré)
                            $default_quartiers = array(
                                'PRINS',
                                'PETERBOS',
                                'RAUTER',
                                'LA ROUE',
                                'SQUARE ALBERT',
                                'LENNIK',
                                'BON AIR',
                                'GOUJONS',
                                'DAUPHINELLES',
                            );
                            foreach ($default_quartiers as $quartier) :
                            ?>
                                <li>
                                    <a href="#"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html($quartier); ?>
                                    </a>
                                </li>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Bouton retour -->
            <div class="retour-section">
                <a href="<?php echo home_url('/habitants'); ?>" class="retour-button">
                    <span class="arrow">
                        <?php
                        $image_retour = get_theme_mod('quartiers_image_retour');
                        if ($image_retour) : ?>
                            <img src="<?php echo esc_url($image_retour); ?>" alt="Retour">
                        <?php else : ?>
                            <span class="emoji-fallback">←</span>
                        <?php endif; ?>
                    </span>
                    <!-- <span class="retour-text">RETOUR AU MENU</span> -->
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fuse.js@7/dist/fuse.min.js"></script>

    <?php
    // URLs des quartiers pour la recherche JS
    $quartiers_for_js = get_quartiers_list();
    $liens_for_js = function_exists('get_quartiers_links') ? get_quartiers_links() : array();
    $quartiers_url_map = array();
    foreach ($quartiers_for_js as $i => $q) {
        $quartiers_url_map[strtolower(trim($q))] = isset($liens_for_js[$i]) ? $liens_for_js[$i] : '#';
    }
    ?>
    <script>
        // Correspondances rues → quartiers
        const ruesData = [
            { rue: '8 Heures',            quartier: 'La Roue' },
            { rue: 'Aurore',              quartier: 'Bon Air' },
            { rue: 'Bonheur',             quartier: 'Bon Air' },
            { rue: 'Bourgeois',           quartier: 'Bon Air' },
            { rue: 'Citoyen',             quartier: 'La Roue' },
            { rue: 'Colombophiles',       quartier: 'La Roue' },
            { rue: 'Coudyser',            quartier: 'Bon Air' },
            { rue: 'Craps',               quartier: 'Bon Air' },
            { rue: 'Croix-Rouge',         quartier: 'Bon Air' },
            { rue: 'Dignité',             quartier: 'Bon Air' },
            { rue: "Droits de l'Homme",   quartier: 'La Roue' },
            { rue: 'Energie',             quartier: 'La Roue' },
            { rue: 'Enthousiasme',        quartier: 'Bon Air' },
            { rue: 'Fécondité',           quartier: 'Bon Air' },
            { rue: 'Fraternelle',         quartier: 'Bon Air' },
            { rue: 'Grives',              quartier: 'La Roue' },
            { rue: 'Guillaume Melckmans', quartier: 'La Roue' },
            { rue: 'Hoorickx',            quartier: 'La Roue' },
            { rue: 'Hygiène',             quartier: 'Bon Air' },
            { rue: 'Itterbeek',           quartier: 'Bon Air' },
            { rue: 'J. Lagey',            quartier: 'Bon Air' },
            { rue: 'Loisirs',             quartier: 'La Roue' },
            { rue: 'Loups',               quartier: 'La Roue' },
            { rue: 'Modestie',            quartier: 'Bon Air' },
            { rue: 'Mons',                quartier: 'La Roue' },
            { rue: 'Muylders',            quartier: 'Bon Air' },
            { rue: 'Nicodème',            quartier: 'Bon Air' },
            { rue: 'Persévérance',        quartier: 'La Roue' },
            { rue: 'Plébéiens',           quartier: 'La Roue' },
            { rue: 'Salubrité',           quartier: 'Bon Air' },
            { rue: 'Santé',               quartier: 'Bon Air' },
            { rue: 'Séverine',            quartier: 'Bon Air' },
            { rue: 'Société Nationale',   quartier: 'La Roue' },
            { rue: 'Solidarité',          quartier: 'La Roue' },
            { rue: 'Symbole',             quartier: 'La Roue' },
            { rue: 'Tempérance',          quartier: 'Bon Air' },
            { rue: 'Tranquilité',         quartier: 'La Roue' },
            { rue: 'Volonté',             quartier: 'La Roue' },
            { rue: 'Wauters',             quartier: 'La Roue' },
        ];

        const quartiersUrls = <?php echo json_encode($quartiers_url_map); ?>;

        // Normalise accents et casse pour la recherche
        function normalise(str) {
            return str.toLowerCase()
                      .normalize('NFD')
                      .replace(/[̀-ͯ]/g, '')
                      .replace(/['\-]/g, ' ');
        }

        // Ajoute une version normalisée à chaque rue pour Fuse
        const ruesDataNorm = ruesData.map(item => ({
            ...item,
            rueNorm: normalise(item.rue)
        }));

        const fuse = new Fuse(ruesDataNorm, {
            keys: ['rueNorm'],
            threshold: 0.4,
            minMatchCharLength: 2,
        });

        let originalListHTML = '';

        document.addEventListener('DOMContentLoaded', function () {
            originalListHTML = document.querySelector('.quartiers-list').innerHTML;
        });

        function activateSearch() {
            document.querySelector('.titre-section').classList.add('search-mode');
            document.getElementById('rue-search').focus();
        }

        function deactivateSearch() {
            document.querySelector('.titre-section').classList.remove('search-mode');
            document.getElementById('rue-search').value = '';
            document.querySelector('.quartiers-list').innerHTML = originalListHTML;
        }

        function handleSearch(query) {
            const list = document.querySelector('.quartiers-list');

            if (!query.trim()) {
                list.innerHTML = originalListHTML;
                return;
            }

            const results = fuse.search(normalise(query));

            if (results.length === 0) {
                list.innerHTML = '<li class="search-no-result">Aucune rue trouvée</li>';
                return;
            }

            list.innerHTML = results.map(({ item }) => {
                const url = quartiersUrls[item.quartier.toLowerCase()] || '#';
                return `<li>
                    <a href="${url}" class="search-result-item">
                        <span class="search-result-rue">Rue ${item.rue}</span>
                        <span class="search-result-quartier">→ ${item.quartier.toUpperCase()}</span>
                    </a>
                </li>`;
            }).join('');
        }

        // Sélection des quartiers (comportement existant)
        function selectQuartier(element) {
            document.querySelectorAll('.quartier-item').forEach(function(item) {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
        }
    </script>

<?php get_footer(); ?>