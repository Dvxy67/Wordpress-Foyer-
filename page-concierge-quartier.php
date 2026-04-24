<?php
/*
Template Name: Concierge - Quartier
*/

$page_slug = get_post_field('post_name', get_post());
$quartier  = '';

if (strpos($page_slug, 'concierge-') === 0) {
    $quartier = str_replace('concierge-', '', $page_slug);
} else {
    $quartier = 'default';
}

$concierges_data = [
    'peterbos' => [
        'multi'   => true,
        'options' => [
            ['label' => 'Blocs 1-4-5',    'nom' => 'Koene Veronique',     'tel' => '0489/10.93.52'],
            ['label' => 'Blocs 7-9-12',   'nom' => 'Debontridder Aurore', 'tel' => '0479/38.94.17'],
            ['label' => 'Blocs 13-14-15', 'nom' => 'Vincke Alain',        'tel' => '0476/86.76.81'],
        ],
    ],
    'shakespeare' => [
        'multi' => false,
        'nom'   => 'Van Nuffelen Sylvain',
        'tel'   => '0484/65.91.74',
    ],
    'goujons' => [
        'multi'   => true,
        'options' => [
            ['label' => 'Général',                    'nom' => 'Gatta Kome',     'tel' => '0484/65.73.67'],
            ['label' => 'Blocs 59-61 (jusqu\'au 9e)', 'nom' => 'Sene El Hadji', 'tel' => '0486/41.38.01'],
            ['label' => 'Blocs 63-61 (10e au 18e)',   'nom' => 'Tassa Abdellah', 'tel' => '0486/98.19.46'],
        ],
    ],
    'dauphinelles' => [
        'multi' => false,
        'nom'   => 'Ben Dhiaf Hassen',
        'tel'   => '0476/86.86.02',
    ],
    'asters' => [
        'multi' => false,
        'nom'   => 'Ben Dhiaf Hassen',
        'tel'   => '0476/86.86.02',
    ],
    'rauter' => [
        'multi' => false,
        'nom'   => 'El Maroudi Keltoum',
        'tel'   => '0476/88.57.85',
    ],
    'democratie' => [
        'multi' => false,
        'nom'   => 'El Maroudi Keltoum',
        'tel'   => '0476/88.57.85',
    ],
    'square-albert' => [
        'multi'   => true,
        'options' => [
            ['label' => 'Blocs 1-14',  'nom' => 'Bouchal Abdelaziz', 'tel' => '0488/08.87.10'],
            ['label' => 'Blocs 15-28', 'nom' => 'Echrafih Hassan',   'tel' => '0473/84.48.45'],
        ],
    ],
    'orphelinat' => [
        'multi' => false,
        'nom'   => 'De Carvalho Gabriel',
        'tel'   => '0473/53.80.89',
    ],
    'bon-air' => [
        'multi' => false,
        'nom'   => 'Nassiri Tarik',
        'tel'   => '0490/68.04.97',
    ],
    'craps' => [
        'multi' => false,
        'nom'   => 'Nassiri Tarik',
        'tel'   => '0490/68.04.97',
    ],
    'sillon' => [
        'multi' => false,
        'nom'   => 'Khadmi Mohammed',
        'tel'   => '0476/94.63.55',
    ],
    'la-roue' => [
        'multi'   => true,
        'options' => [
            ['label' => 'Maisons',   'nom' => 'Lopezlistan Maria',  'tel' => '0476/86.76.82'],
            ['label' => 'Immeubles', 'nom' => 'Van Wichelen Alain', 'tel' => '0474/74.29.86'],
        ],
    ],
    'gryzon' => [
        'multi' => false,
        'nom'   => 'Rachdi Lataifa',
        'tel'   => '0476/88.18.85',
    ],
    'trefles' => [
        'multi'   => true,
        'options' => [
            ['label' => 'Blocs 276-278-280A',       'nom' => 'Ferdaoui Touria',          'tel' => '0476/88.36.53'],
            ['label' => 'Blocs 280B/C-282A/B-284A', 'nom' => 'El Fakiri Soufian',        'tel' => '0497/59.03.82'],
            ['label' => 'Blocs 284B-286-288',        'nom' => 'Menlaikhaf Nour Eddine',  'tel' => '0476/86.52.19'],
        ],
    ],
    'lennik' => [
        'multi' => false,
        'nom'   => 'À compléter',
        'tel'   => '',
    ],
    'la-digue' => [
        'multi' => false,
        'nom'   => 'À compléter',
        'tel'   => '',
    ],
];

$data             = isset($concierges_data[$quartier]) ? $concierges_data[$quartier] : null;
$quartier_display = ucfirst(str_replace('-', ' ', $quartier));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Concierge - <?php echo esc_html($quartier_display); ?></title>

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
            border: 3px solid #000000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            min-height: 300px;
            max-height: 560px;
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .as-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
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

        .as-content {
            background: #E8E8E8;
            border-radius: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 20px;
            gap: 18px;
        }

        /* Carte concierge unique */
        .as-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .as-nom {
            font-size: 20px;
            font-weight: 600;
            color: #000;
            text-align: center;
            text-transform: uppercase;
        }

        .as-tel-btn {
            background: #000;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-family: 'Rubik', sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s ease, background 0.2s ease;
            -webkit-tap-highlight-color: transparent;
        }

        .as-tel-btn:hover { transform: scale(1.05); background: #222; color: #fff; text-decoration: none; }

        /* Choix de bâtiment (multi) */
        .as-bloc-title {
            font-family: 'Rubik', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 5px;
        }

        .as-blocs {
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
        }

        .as-bloc-item {
            background: #fff;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 12px 16px;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            -webkit-tap-highlight-color: transparent;
            text-align: center;
        }

        .as-bloc-item:hover { transform: scale(1.02); background: #f5f5f5; }

        .as-bloc-label {
            font-size: 13px;
            font-weight: 500;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 3px;
        }

        .as-bloc-nom {
            font-family: 'Rubik', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #000;
            text-transform: uppercase;
        }

        .as-bloc-item.selected { background: #000; }
        .as-bloc-item.selected .as-bloc-label,
        .as-bloc-item.selected .as-bloc-nom { color: #fff; }

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

        @media (min-width: 481px) {
            .as-page { padding: 20px; }
            .main-container { height: calc(100vh - 40px); }
            .as-container { max-width: 400px; border: 6px solid #000; padding: 25px; }
            .as-title { font-size: 24px; }
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

            <div class="as-header">
                <div class="as-icon">🔑</div>
                <h1 class="as-title">Concierge<br><?php echo esc_html(strtoupper($quartier_display)); ?></h1>
            </div>

            <div class="as-content">
                <?php if (!$data) : ?>
                    <p style="text-align:center; color:#555;">Aucune information disponible pour ce quartier.</p>

                <?php elseif ($data['multi']) : ?>
                    <div class="as-bloc-title">Quel est votre bâtiment ?</div>
                    <div class="as-blocs">
                        <?php foreach ($data['options'] as $option) : ?>
                            <div class="as-bloc-item"
                                 onclick="selectBloc(this, '<?php echo esc_js($option['nom']); ?>', '<?php echo esc_js($option['tel']); ?>')">
                                <div class="as-bloc-label"><?php echo esc_html($option['label']); ?></div>
                                <div class="as-bloc-nom"><?php echo esc_html($option['nom']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else : ?>
                    <div class="as-card">
                        <div class="as-nom"><?php echo esc_html($data['nom']); ?></div>
                        <?php if (!empty($data['tel'])) : ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $data['tel'])); ?>"
                               class="as-tel-btn"
                               onclick="handleCall(event)">
                                <?php echo esc_html($data['tel']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="retour-section">
            <a href="/concierge" class="retour-button">
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

<script>
    function handleCall(event) {
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (!isMobile) {
            event.preventDefault();
        }
    }

    function selectBloc(el, nom, tel) {
        document.querySelectorAll('.as-bloc-item.selected').forEach(function(item) {
            item.classList.remove('selected');
        });

        el.classList.add('selected');

        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (isMobile) {
            setTimeout(function() {
                window.location.href = 'tel:' + tel.replace(/[^0-9+]/g, '');
            }, 400);
        }
    }
</script>

<?php get_footer(); ?>
