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
            justify-content: center;
            margin-bottom: 0px;
            gap: 40px;
            min-height: 60px;
            flex-shrink: 0;
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
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="quartiers-page">
    <div class="main-container">
        <div class="quartiers-container">

            <div class="titre-section">
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
            <a href="<?php echo esc_url(get_theme_mod('habitants_url_back', '/')); ?>" class="retour-button">
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

<?php get_footer(); ?>
