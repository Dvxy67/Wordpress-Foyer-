<?php
/*
Template Name: Assistant Social - Quartier
*/

// Détecter le quartier depuis le slug
$page_slug = get_post_field('post_name', get_post());
$quartier = '';

if (strpos($page_slug, 'assistant-social-') === 0) {
    $quartier = str_replace('assistant-social-', '', $page_slug);
} else {
    $quartier = 'default';
}

// Données des assistants sociaux par quartier
$assistants_data = [
    'peterbos' => [
        'adresse' => 'Parc du Peterbos 7c',
        'multi'   => true,
        'options' => [
            ['label' => 'Blocs 9-12-14-15', 'nom' => 'Karen Petrosian',  'tel' => '0483/44.81.67'],
            ['label' => 'Blocs 1-4-5-7-13', 'nom' => 'Cynthia Pourtoy',  'tel' => '0483/44.81.72'],
        ],
    ],
    'shakespeare' => [
        'adresse' => 'Parc du Peterbos 7c (permanence jeudi)',
        'multi'   => true,
        'options' => [
            ['label' => 'Blocs 9-12-14-15', 'nom' => 'Richala Mohamed', 'tel' => '0484/66.47.35'],
            ['label' => 'Blocs 1-4-5-7-13', 'nom' => 'Cynthia Pourtoy', 'tel' => '0483/44.81.72'],
        ],
    ],
    'goujons' => [
        'adresse' => 'Rue des Goujons 63',
        'multi'   => false,
        'nom'     => 'Daniel De La Granja',
        'tel'     => '0485/84.91.38',
    ],
    'dauphinelles' => [
        'adresse' => 'Av. des Dauphinelles 13',
        'multi'   => false,
        'nom'     => 'Gédéon Onema',
        'tel'     => '0483/44.86.01',
    ],
    'asters' => [
        'adresse' => 'Av. des Dauphinelles 13',
        'multi'   => false,
        'nom'     => 'Gédéon Onema',
        'tel'     => '0483/44.86.01',
    ],
    'rauter' => [
        'adresse' => 'Rue Victor Rauter 34',
        'multi'   => false,
        'nom'     => 'Rody Mayuma',
        'tel'     => '0488/99.90.09',
    ],
    'democratie' => [
        'adresse' => 'Rue Victor Rauter 34',
        'multi'   => false,
        'nom'     => 'Rody Mayuma',
        'tel'     => '0488/99.90.09',
    ],
    'square-albert' => [
        'adresse' => 'Square Albert 1er 7/8',
        'multi'   => false,
        'nom'     => 'Rody Mayuma',
        'tel'     => '0488/99.90.09',
    ],
    'orphelinat' => [
        'adresse' => 'Orphelinat 30A Weeshuis',
        'multi'   => false,
        'nom'     => 'Gédéon Onema',
        'tel'     => '0483/44.86.01',
    ],
    'bon-air' => [
        'adresse' => 'Rue du Sillon 98 Voorstraat',
        'multi'   => false,
        'nom'     => 'Karine Tiberghien',
        'tel'     => '0484/81.79.07',
    ],
    'craps' => [
        'adresse' => 'Rue du Sillon 98 Voorstraat',
        'multi'   => false,
        'nom'     => 'Karine Tiberghien',
        'tel'     => '0484/81.79.07',
    ],
    'sillon' => [
        'adresse' => 'Rue du Sillon 98 Voorstraat',
        'multi'   => false,
        'nom'     => 'Karine Tiberghien',
        'tel'     => '0484/81.79.07',
    ],
    'la-roue' => [
        'adresse' => 'Droits de l\'Homme 1A',
        'multi'   => false,
        'nom'     => 'Karen Petrosian',
        'tel'     => '0483/44.81.67',
    ],
    'gryzon' => [
        'adresse' => 'Droits de l\'Homme 1A',
        'multi'   => false,
        'nom'     => 'Karen Petrosian',
        'tel'     => '0483/44.81.67',
    ],
    'trefles' => [
        'adresse' => 'Route de Lennik 282B',
        'multi'   => false,
        'nom'     => 'Karen Petrosian',
        'tel'     => '0483/44.81.67',
    ],
    'lennik' => [
        'adresse' => '',
        'multi'   => false,
        'nom'     => 'À compléter',
        'tel'     => '0800 00 000',
    ],
    'la-digue' => [
        'adresse' => '',
        'multi'   => false,
        'nom'     => 'À compléter',
        'tel'     => '0800 00 000',
    ],
];

$data = isset($assistants_data[$quartier]) ? $assistants_data[$quartier] : null;
$quartier_display = ucfirst(str_replace('-', ' ', $quartier));
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assistant Social - <?php echo esc_html($quartier_display); ?></title>

    <style>

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
            padding: 20px 20px 20px 20px;
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
            margin-bottom: 20px;
            flex-shrink: 0;
        }

        .as-icon {
            font-size: 40px;
            line-height: 1;
            flex-shrink: 0;
        }

        .as-title {
            font-size: 22px;
            font-weight: 600;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        /* Zone contenu */
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

        /* Adresse */
        .as-adresse {
            font-size: 13px;
            font-weight: 400;
            color: #555;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Carte assistant (simple) */
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

        /* Choix de blocs (multi) */
        .as-bloc-title {
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
            font-size: 16px;
            font-weight: 600;
            color: #000;
            text-transform: uppercase;
        }

        /* État après sélection bloc */
        .as-bloc-item.selected {
            background: #000;
        }
        .as-bloc-item.selected .as-bloc-label,
        .as-bloc-item.selected .as-bloc-nom {
            color: #fff;
        }

        /* Bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100px;
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

        /* Animation */
        @keyframes slideInMobile {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .retour-section { animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both; }

        /* Desktop */
        @media (min-width: 481px) {
            .as-page { padding: 20px; }
            .main-container { height: calc(100vh - 40px); }
            .as-container {
                max-width: 400px;
                border: 6px solid #000;
                padding: 25px;
            }
            .as-title { font-size: 24px; }
        }

        /* Reset outline/box-shadow interférences */
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
                <h1 class="as-title">Assistant<br>Social<br><?php echo esc_html(strtoupper($quartier_display)); ?></h1>
            </div>

            <!-- Contenu -->
            <div class="as-content">
                <?php if (!$data) : ?>
                    <p style="text-align:center; color:#555;">Aucune information disponible pour ce quartier.</p>

                <?php elseif ($data['multi']) : ?>
                    <!-- Multi-assistants : choix de blocs -->
                    <?php if (!empty($data['adresse'])) : ?>
                        <div class="as-adresse"><?php echo esc_html($data['adresse']); ?></div>
                    <?php endif; ?>
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
                    <!-- Assistant unique -->
                    <?php if (!empty($data['adresse'])) : ?>
                        <div class="as-adresse"><?php echo esc_html($data['adresse']); ?></div>
                    <?php endif; ?>
                    <div class="as-card">
                        <div class="as-nom"><?php echo esc_html($data['nom']); ?></div>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $data['tel'])); ?>"
                           class="as-tel-btn"
                           onclick="handleCall(event, this, '<?php echo esc_js($data['tel']); ?>')">
                            <?php echo esc_html($data['tel']); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Bouton retour -->
        <div class="retour-section">
            <a href="/assistant-social" class="retour-button">
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
    function handleCall(event, el, tel) {
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (!isMobile) {
            event.preventDefault();
        }
    }

    function selectBloc(el, nom, tel) {
        // Retirer la sélection précédente
        document.querySelectorAll('.as-bloc-item.selected').forEach(function(item) {
            item.classList.remove('selected');
        });

        // Marquer comme sélectionné
        el.classList.add('selected');

        // Sur mobile : lancer l'appel
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if (isMobile) {
            setTimeout(function() {
                window.location.href = 'tel:' + tel.replace(/[^0-9+]/g, '');
            }, 400);
        }
    }
</script>

<?php get_footer(); ?>
