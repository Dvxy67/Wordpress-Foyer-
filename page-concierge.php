<?php
/*
Template Name: Concierge - Sélection Quartier
*/

$quartiers = [
    ['label' => 'Peterbos',     'slug' => 'peterbos'],
    ['label' => 'Shakespeare',  'slug' => 'shakespeare'],
    ['label' => 'Goujons',      'slug' => 'goujons'],
    ['label' => 'Dauphinelles', 'slug' => 'dauphinelles'],
    ['label' => 'Asters',       'slug' => 'asters'],
    ['label' => 'Rauter',       'slug' => 'rauter'],
    ['label' => 'Démocratie',   'slug' => 'democratie'],
    ['label' => 'Square Albert','slug' => 'square-albert'],
    ['label' => 'Orphelinat',   'slug' => 'orphelinat'],
    ['label' => 'Bon Air',      'slug' => 'bon-air'],
    ['label' => 'Craps',        'slug' => 'craps'],
    ['label' => 'Sillon',       'slug' => 'sillon'],
    ['label' => 'La Roue',      'slug' => 'la-roue'],
    ['label' => 'Gryzon',       'slug' => 'gryzon'],
    ['label' => 'Trèfles',      'slug' => 'trefles'],
    ['label' => 'Lennik',       'slug' => 'lennik'],
    ['label' => 'La Digue',     'slug' => 'la-digue'],
];
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Concierge</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .quartiers-page {
            min-height: 100svh;
            background: #6b92ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100svh - 16px);
            width: 100%;
            max-width: 100%;
        }

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
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .titre-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0px;
            gap: 0;
            min-height: 60px;
            flex-shrink: 0;
        }

        .titre-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

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

        .titre-text {
            font-size: 25px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

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

        .quartiers-scroll::-webkit-scrollbar { width: 6px; }
        .quartiers-scroll::-webkit-scrollbar-track { background: #F0F0F0; }
        .quartiers-scroll::-webkit-scrollbar-thumb { background: #CCCCCC; border-radius: 4px; }
        .quartiers-scroll::-webkit-scrollbar-thumb:hover { background: #AAAAAA; }

        .quartiers-list { list-style: none; margin: 0; padding: 0; }

        .quartier-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 15px;
            font-size: 22px;
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
            -webkit-tap-highlight-color: transparent;
        }

        .quartier-item:active { background-color: #7391ff; color: #fff; }

        .quartiers-list li:first-child .quartier-item { border-top: 2px solid #ebecf4; }
        .quartier-item:last-child { border-bottom: none; }

        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 118px;
            flex-shrink: 0;
            width: 100%;
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        .retour-button {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }


        .arrow {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .arrow img { width: 100%; height: 100%; object-fit: contain; }
        .arrow .emoji-fallback { font-size: 40px; font-weight: bold; color: #000; line-height: 1; }

        @keyframes slideInMobile {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .quartiers-page *:not(.quartier-item):not(.quartiers-container) {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .quartiers-container { border: 3px solid #000000 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important; }

        .quartiers-page .quartiers-list .quartier-item { border-bottom: 2px solid #ebecf4 !important; }
        .quartiers-page .quartiers-list li:last-child .quartier-item { border-bottom: none !important; }

        @media (min-width: 481px) {
            .quartiers-container {
                border: 6px solid #000000 !important;
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
            }
        }

        @media (hover: hover) {
            .quartier-item:hover { background-color: #DFDFDF; color: #000; text-decoration: none; }
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
        }

        .titre-section.search-mode .search-input-wrapper {
            display: flex;
            flex: 1;
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

            <div class="titre-section">
                <div class="titre-content">
                    <div class="immeuble-icon">
                        <?php
                        $concierge_icone = get_theme_mod('concierge_image_icone');
                        if ($concierge_icone) : ?>
                            <img src="<?php echo esc_url($concierge_icone); ?>" alt="Concierge">
                        <?php else : ?>
                            <span class="emoji-fallback">🔑</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="titre-text">Mon<br>Concierge</h1>
                </div>
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

            <div class="quartiers-scroll">
                <ul class="quartiers-list">
                    <?php foreach ($quartiers as $q) : ?>
                        <li>
                            <a href="/concierge-<?php echo esc_attr($q['slug']); ?>"
                               class="quartier-item">
                                <?php echo esc_html(strtoupper($q['label'])); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <div class="retour-section">
            <a href="<?php echo esc_url(home_url('/habitants')); ?>" class="retour-button">
                <span class="arrow">
                    <?php
                    $image_retour = get_theme_mod('quartiers_image_retour');
                    if ($image_retour) : ?>
                        <img src="<?php echo esc_url($image_retour); ?>" alt="Retour">
                    <?php else : ?>
                        <span class="emoji-fallback">←</span>
                    <?php endif; ?>
                </span>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fuse.js@7/dist/fuse.min.js"></script>
<script>
    <?php
    // Construire la map slug → URL pour le JS
    $concierge_url_map = [];
    foreach ($quartiers as $q) {
        $concierge_url_map[strtolower($q['label'])] = '/concierge-' . $q['slug'];
    }
    ?>
    const quartiersUrls = <?php echo json_encode($concierge_url_map); ?>;

    // Correspondances rues → quartiers (à compléter au fur et à mesure)
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

    function normalise(str) {
        return str.toLowerCase()
                  .normalize('NFD')
                  .replace(/[̀-ͯ]/g, '')
                  .replace(/['\-]/g, ' ');
    }

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
</script>

<?php get_footer(); ?>
