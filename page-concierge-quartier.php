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
            ['label' => 'Blocs 276-278-280A',       'nom' => 'Ferdaoui Touria',         'tel' => '0476/88.36.53'],
            ['label' => 'Blocs 280B/C-282A/B-284A', 'nom' => 'El Fakiri Soufian',       'tel' => '0497/59.03.82'],
            ['label' => 'Blocs 284B-286-288',        'nom' => 'Menlaikhaf Nour Eddine', 'tel' => '0476/86.52.19'],
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }

        body {
            font-family: 'Rubik', sans-serif;
            font-weight: 500;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .pannes-page {
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

        .pannes-container {
            background: #eed05d;
            border: 3px solid #000000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100vh - 120px);
            min-height: 505px;
            max-height: 585px;
            padding: 15px 15px 0 15px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .pannes-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 10px;
            flex-shrink: 0;
            min-height: 60px;
        }

        .tools-icon {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tools-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .tools-icon .emoji-fallback {
            font-size: 40px;
            line-height: 1;
        }

        .pannes-title {
            font-size: 25px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            line-height: 1.2;
        }

        /* Zone de contenu — identique au pannes-grid-container */
        .pannes-grid-container {
            background: #E8E8E8;
            border-radius: 0px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 25px 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-y: auto;
        }

        /* Concierge unique */
        .concierge-nom {
            font-size: 20px;
            font-weight: 600;
            color: #000;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .concierge-tel-btn {
            display: block;
            text-decoration: none;
            text-align: center;
            -webkit-tap-highlight-color: transparent;
            animation: slideIn 0.3s ease;
        }

        .concierge-tel-btn .phone-number {
            font-size: 22px;
            font-weight: bold;
            color: #000;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .concierge-tel-btn .phone-instruction {
            font-size: 11px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 1.5s infinite;
        }

        /* Sélection bâtiment (multi) */
        .batiment-title {
            font-family: 'Rubik', sans-serif;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #555;
            margin-bottom: 12px;
            text-align: center;
        }

        .batiment-liste {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .batiment-btn {
            display: block;
            width: 100%;
            padding: 9px 12px;
            margin-bottom: 6px;
            background: #f0f0f0;
            border: none !important;
            border-radius: 8px;
            font-family: 'Rubik', sans-serif;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            transition: background 0.15s ease;
            -webkit-tap-highlight-color: transparent;
            outline: none !important;
            box-shadow: none !important;
        }

        .batiment-btn:last-child { margin-bottom: 0; }
        .batiment-btn:active { background: #e0e0e0; }

        /* Affichage numéro après sélection */
        .panne-phone {
            text-align: center;
            animation: slideIn 0.3s ease;
        }

        .panne-phone .phone-number {
            font-size: 22px;
            font-weight: bold;
            color: #000;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }

        .panne-phone .phone-instruction {
            font-size: 11px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 1.5s infinite;
        }

        .phone-nom {
            font-size: 13px;
            color: #555;
            text-transform: uppercase;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50%       { opacity: 1; }
        }

        /* Bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 118px;
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        .retour-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            padding: 10px 15px;
            border-radius: 10px;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }


        .arrow { font-size: 45px; font-weight: 500; color: #000; line-height: 1; }
        .arrow-image { width: 90px; height: 90px; object-fit: contain; }

        @keyframes slideInMobile {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Reset interférences thème */
        .pannes-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .pannes-container {
            border: 3px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        /* Desktop */
        @media (min-width: 481px) {
            .pannes-page { padding: 20px; }
            .main-container { height: calc(100vh - 40px); }
            .pannes-container {
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
                padding: 20px;
                border: 6px solid #000000 !important;
            }
            .pannes-header { margin-bottom: 25px; min-height: 80px; gap: 20px; }
            .pannes-title { font-size: 20px; }
        }

        @media (hover: hover) {
            .batiment-btn:hover { background: #e0e0e0; }
            .retour-button:hover { transform: scale(1.05); text-decoration: none; color: #000; }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="pannes-page">
    <div class="main-container">
        <div class="pannes-container">

            <div class="pannes-header">
                <div class="tools-icon">
                    <?php
                    $concierge_icone = get_theme_mod('concierge_image_icone');
                    if ($concierge_icone) : ?>
                        <img src="<?php echo esc_url($concierge_icone); ?>" alt="Concierge">
                    <?php else : ?>
                        <span class="emoji-fallback" role="img">🔑</span>
                    <?php endif; ?>
                </div>
                <h1 class="pannes-title">Concierge<br><?php echo esc_html(strtoupper($quartier_display)); ?></h1>
            </div>

            <div class="pannes-grid-container">
                <?php if (!$data) : ?>
                    <p style="text-align:center;color:#555;">Aucune information disponible.</p>

                <?php elseif ($data['multi']) : ?>
                    <div class="batiment-title">Quel est votre bâtiment ?</div>
                    <div class="batiment-liste">
                        <?php foreach ($data['options'] as $option) :
                            $tel_js  = esc_js($option['tel']);
                            $nom_js  = esc_js($option['nom']);
                        ?>
                            <button class="batiment-btn"
                                    onclick="selectBatiment(this, '<?php echo $nom_js; ?>', '<?php echo $tel_js; ?>')">
                                <?php echo esc_html($option['label']); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>

                <?php else : ?>
                    <?php if (!empty($data['tel'])) : ?>
                        <div class="concierge-nom"><?php echo esc_html($data['nom']); ?></div>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $data['tel'])); ?>"
                           class="concierge-tel-btn"
                           onclick="handleCall(event)">
                            <div class="phone-number"><?php echo esc_html($data['tel']); ?></div>
                            <div class="phone-instruction">Appuyez pour appeler</div>
                        </a>
                    <?php else : ?>
                        <div class="concierge-nom"><?php echo esc_html($data['nom']); ?></div>
                    <?php endif; ?>
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
        if (!isMobile) event.preventDefault();
    }

    function selectBatiment(btn, nom, tel) {
        const container = btn.closest('.pannes-grid-container');

        container.innerHTML = `
            <div class="panne-phone">
                <div class="phone-nom">${nom}</div>
                <div class="phone-number">${tel}</div>
                <div class="phone-instruction">Appuyez pour appeler</div>
            </div>
        `;

        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (isMobile) {
            setTimeout(() => {
                window.location.href = 'tel:' + tel.replace(/[^0-9+]/g, '');
            }, 500);
        }
    }
</script>

<?php get_footer(); ?>
