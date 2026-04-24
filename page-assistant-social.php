<?php
/*
Template Name: Assistant Social - Sélection Quartier
*/

$quartiers = [
    ['label' => 'Peterbos',              'slug' => 'peterbos'],
    ['label' => 'Shakespeare',           'slug' => 'shakespeare'],
    ['label' => 'Goujons',               'slug' => 'goujons'],
    ['label' => 'Dauphinelles',          'slug' => 'dauphinelles'],
    ['label' => 'Asters',                'slug' => 'asters'],
    ['label' => 'Rauter',                'slug' => 'rauter'],
    ['label' => 'Démocratie',            'slug' => 'democratie'],
    ['label' => 'Square Albert',         'slug' => 'square-albert'],
    ['label' => 'Orphelinat',            'slug' => 'orphelinat'],
    ['label' => 'Bon Air',               'slug' => 'bon-air'],
    ['label' => 'Craps',                 'slug' => 'craps'],
    ['label' => 'Sillon',                'slug' => 'sillon'],
    ['label' => 'La Roue',               'slug' => 'la-roue'],
    ['label' => 'Gryzon',                'slug' => 'gryzon'],
    ['label' => 'Trèfles',              'slug' => 'trefles'],
    ['label' => 'Lennik',                'slug' => 'lennik'],
    ['label' => 'La Digue',              'slug' => 'la-digue'],
];
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant Social</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: 'Rubik', sans-serif;
            font-weight: 500;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .as-page {
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
        }

        .as-container {
            background: #eed05d;
            border: 3px solid #000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100svh - 120px);
            min-height: 400px;
            max-height: 600px;
            padding: 20px 20px 0 20px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Header */
        .as-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            flex-shrink: 0;
        }

        .as-icon { font-size: 40px; line-height: 1; flex-shrink: 0; }

        .as-title {
            font-size: 22px;
            font-weight: 600;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        /* Liste scrollable */
        .as-list-container {
            background: #E8E8E8;
            border-radius: 0 0 10px 10px;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 15px 12px;
        }

        .as-list-container::-webkit-scrollbar { width: 5px; }
        .as-list-container::-webkit-scrollbar-track { background: #ddd; border-radius: 10px; }
        .as-list-container::-webkit-scrollbar-thumb { background: #999; border-radius: 10px; }

        .as-quartier-item {
            display: block;
            background: #fff;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #000;
            font-size: 17px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease, background 0.2s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .as-quartier-item:last-child { margin-bottom: 0; }

        .as-quartier-item:hover {
            transform: scale(1.02);
            background: #f0f0f0;
            text-decoration: none;
            color: #000;
        }

        .as-quartier-item:active {
            background: #000;
            color: #fff;
        }

        /* Bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100px;
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        .retour-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            padding: 10px 15px;
            border-radius: 10px;
            -webkit-tap-highlight-color: transparent;
        }

        .retour-button:hover { transform: scale(1.05); text-decoration: none; color: #000; }

        .arrow { font-size: 45px; font-weight: 500; color: #000; line-height: 1; }
        .arrow-image { width: 90px; height: 90px; object-fit: contain; }

        @keyframes slideInMobile {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Desktop */
        @media (min-width: 481px) {
            .as-page { padding: 20px; }
            .main-container { height: calc(100vh - 40px); }
            .as-container {
                max-width: 400px;
                border: 6px solid #000;
                padding: 25px 25px 0 25px;
                max-height: 680px;
            }
            .as-title { font-size: 24px; }
            .as-quartier-item { font-size: 18px; padding: 16px 20px; }
        }

        .as-page * { outline: none; }
        .as-container { box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important; border: 3px solid #000 !important; }
        @media (min-width: 481px) { .as-container { border: 6px solid #000 !important; } }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="as-page">
    <div class="main-container">
        <div class="as-container">

            <!-- Header -->
            <div class="as-header">
                <div class="as-icon">👤</div>
                <h1 class="as-title">Assistant<br>Social</h1>
            </div>

            <!-- Liste des quartiers -->
            <div class="as-list-container">
                <?php foreach ($quartiers as $q) : ?>
                    <a href="/assistant-social-<?php echo esc_attr($q['slug']); ?>"
                       class="as-quartier-item">
                        <?php echo esc_html($q['label']); ?>
                    </a>
                <?php endforeach; ?>
            </div>

        </div>

        <!-- Bouton retour -->
        <div class="retour-section">
            <a href="<?php echo esc_url(get_theme_mod('habitants_url_back', '/')); ?>" class="retour-button">
                <?php
                $arrow_image = get_theme_mod('pannes_retour_image');
                if ($arrow_image) : ?>
                    <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image">
                <?php else : ?>
                    <span class="arrow">←</span>
                <?php endif; ?>
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
