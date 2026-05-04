<?php
/*
Template Name: Pannes Quartier - Harmonisée avec Image Retour
*/

// Détecter le quartier depuis le slug de la page
$page_slug = get_post_field('post_name', get_post());
$quartier = '';

// Extraire le nom du quartier depuis le slug (ex: "pannes-prins" -> "prins")
if (strpos($page_slug, 'pannes-') === 0) {
    $quartier = str_replace('pannes-', '', $page_slug);
} else {
    $quartier = 'default';
}

// Convertir en format lisible (ex: "prins" -> "Prins")
$quartier_display = ucfirst($quartier);

// Données multi-concierges : quartiers avec plusieurs concierges selon le bâtiment
$multi_concierge = [
    'peterbos' => [
        ['label' => 'Blocs 1-4-5',    'tel' => '0489 10 93 52'],
        ['label' => 'Blocs 7-9-12',   'tel' => '0479 38 94 17'],
        ['label' => 'Blocs 13-14-15', 'tel' => '0476 86 76 81'],
    ],
    'la-roue' => [
        ['label' => 'Maisons',   'tel' => '0476 86 76 82'],
        ['label' => 'Immeubles', 'tel' => '0474 74 29 86'],
    ],
    'goujons' => [
        ['label' => 'Général',                   'tel' => '0484 65 73 67'],
        ['label' => 'Blocs 59-61 (jusqu\'au 9e)', 'tel' => '0486 41 38 01'],
        ['label' => 'Blocs 63-61 (10e au 18e)',  'tel' => '0486 98 19 46'],
    ],
    'square-albert' => [
        ['label' => 'Blocs 1-14',  'tel' => '0488 08 87 10'],
        ['label' => 'Blocs 15-28', 'tel' => '0473 84 48 45'],
    ],
];

$is_multi = isset($multi_concierge[$quartier]);
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannes - <?php echo esc_html($quartier_display); ?></title>

    <style>
        /* Import Google Fonts - Rubik */

        /* CSS HARMONISÉ - Page Pannes */
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

        /* Container principal pour équilibrer l'espace */
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
            transform: rotate(24deg);
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

        .pannes-grid-container {
            background: #E8E8E8;
            border-radius: 0px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 20px 5px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .pannes-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            row-gap: 35px;
            column-gap: 15px;
            justify-items: center;
            align-items: center;
            width: 100%;
            max-width: 280px;
            height: 100%;
            max-height: 280px;
        }

        .panne-item,
        a.panne-item:link,
        a.panne-item:visited,
        a.panne-item:hover,
        a.panne-item:active {
            color: #000;
            text-decoration: none;
        }

        .panne-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
            padding: 5px;
        }

        /* Supprimer le carré bleu/jaune sur les items de panne */
        .panne-item,
        .panne-item img,
        .panne-icon,
        .panne-icon img,
        a.panne-item {
            outline: none !important;
            -webkit-tap-highlight-color: transparent !important;
            -webkit-touch-callout: none;
            user-select: none;
        }

        .panne-item:focus,
        .panne-item:active,
        .panne-item img:focus,
        .panne-item img:active,
        a.panne-item:focus,
        a.panne-item:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .panne-item:focus:not(:focus-visible),
        a.panne-item:focus:not(:focus-visible) {
            outline: none !important;
        }

        .panne-item:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        .panne-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .panne-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .panne-icon .emoji-fallback {
            font-size: 50px;
            line-height: 1;
        }

        /* TAILLES INDIVIDUELLES DES ICÔNES - MOBILE */
        /* Modifiez les valeurs ci-dessous selon votre maquette */

        /* Panne 1 - Chauffage */
        .panne-icon-1 {
            width: 80px !important;
            height: 80px !important;
        }

        /* Panne 2 - Ascenseur */
        .panne-icon-2 {
            width: 80px !important;
            height: 80px !important;
        }

        /* Panne 3 - Télévision */
        .panne-icon-3 {
            width: 80px !important;
            height: 80px !important;
        }

        /* Panne 4 - Internet */
        .panne-icon-4 {
            width: 80px !important;
            height: 80px !important;
        }

        .panne-text {
            font-size: 18px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }

        /* TAILLES INDIVIDUELLES DES TEXTES - MOBILE */
        /* Modifiez les valeurs ci-dessous selon votre maquette */

        /* Texte Panne 1 - Chauffage */
        .panne-text-1 {
            font-size: 20px !important;
        }

        /* Texte Panne 2 - Ascenseur */
        .panne-text-2 {
            font-size: 20px !important;
        }

        /* Texte Panne 3 - Télévision */
        .panne-text-3 {
            font-size: 20px !important;
        }

        /* Texte Panne 4 - Internet */
        .panne-text-4 {
            font-size: 20px !important;
        }


        /* Affichage numéro téléphone */
        .panne-phone {
            text-align: center;
            animation: slideIn 0.3s ease;
        }

        .panne-phone .phone-number {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            margin-bottom: 4px;
            letter-spacing: 1px;
        }

        .panne-phone .phone-instruction {
            font-size: 10px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 1.5s infinite;
        }

        /* Animation slide in */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation pulse pour instruction */
        @keyframes pulse {

            0%,
            100% {
                opacity: 0.6;
            }

            50% {
                opacity: 1;
            }
        }

        /* État clicked */
        .panne-item.clicked {
            transform: scale(0.98);
        }

        /* Zone sélection bâtiment (multi-concierges) */
        .batiment-selector {
            display: none;
            position: absolute;
            inset: 0;
            z-index: 10;
            background: #E8E8E8;
            padding: 20px 15px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            animation: slideIn 0.3s ease;
            text-align: center;
        }

        .batiment-selector.visible {
            display: flex;
        }

        .batiment-selector-title {
            font-family: 'Rubik', sans-serif;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #555;
            margin-bottom: 12px;
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

        .batiment-btn:last-child {
            margin-bottom: 0;
        }

        .batiment-btn:hover,
        .batiment-btn:active {
            background: #e0e0e0;
        }

        /* Section bouton retour - HARMONISÉE */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 118px;
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
        }

        .retour-button:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        /* Flèche de retour - HARMONISÉE */
        .arrow {
            font-size: 45px;
            font-weight: 500;
            color: #000;
            line-height: 1;
        }

        /* Image de la flèche retour - HARMONISÉE 90x90px */
        .arrow-image {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        /* Texte retour - HARMONISÉ */
        .retour-text {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
            letter-spacing: 0.5px;
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
        @media (min-width: 481px) {
            .pannes-page {
                padding: 20px;
            }

            .main-container {
                height: calc(100vh - 40px);
            }

            .pannes-container {
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
                padding: 20px;
                border: 6px solid #000000;
            }

            .pannes-header {
                margin-bottom: 25px;
                min-height: 80px;
                gap: 20px;
            }

            .tools-icon {
                width: 70px;
                height: 70px;
            }

            .tools-icon .emoji-fallback {
                font-size: 56px;
            }

            .pannes-title {
                font-size: 20px;
            }

            .pannes-grid-container {
                padding: 25px 20px;
            }

            .pannes-grid {
                gap: 30px;
                max-width: 320px;
                max-height: 320px;
            }

            .panne-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 12px;
            }

            .panne-icon .emoji-fallback {
                font-size: 64px;
            }

            /* TAILLES INDIVIDUELLES DES ICÔNES - DESKTOP */
            /* Modifiez les valeurs ci-dessous selon votre maquette */

            /* Panne 1 - Chauffage */
            .panne-icon-1 {
                width: 80px !important;
                height: 80px !important;
            }

            /* Panne 2 - Ascenseur */
            .panne-icon-2 {
                width: 80px !important;
                height: 80px !important;
            }

            /* Panne 3 - Télévision */
            .panne-icon-3 {
                width: 80px !important;
                height: 80px !important;
            }

            /* Panne 4 - Internet */
            .panne-icon-4 {
                width: 80px !important;
                height: 80px !important;
            }

            .panne-text {
                font-size: 16px;
            }

            /* TAILLES INDIVIDUELLES DES TEXTES - DESKTOP */
            /* Modifiez les valeurs ci-dessous selon votre maquette */

            /* Texte Panne 1 - Chauffage */
            .panne-text-1 {
                font-size: 16px !important;
            }

            /* Texte Panne 2 - Ascenseur */
            .panne-text-2 {
                font-size: 16px !important;
            }

            /* Texte Panne 3 - Télévision */
            .panne-text-3 {
                font-size: 16px !important;
            }

            /* Texte Panne 4 - Internet */
            .panne-text-4 {
                font-size: 16px !important;
            }


            .retour-section {
                height: 75px;
            }

            .arrow {
                font-size: 55px;
            }

            .retour-text {
                font-size: 18px;
            }
        }

        @media (max-width: 360px) {
            .pannes-container {
                max-width: 300px;
                padding: 12px;
            }

            .pannes-grid {
                row-gap: 25px;
                column-gap: 12px;
                max-width: 280px;
                max-height: 280px;
            }

            .panne-icon {
                width: 70px;
                height: 70px;
            }

            .panne-icon-1,
            .panne-icon-2,
            .panne-icon-3,
            .panne-icon-4 {
                width: 70px !important;
                height: 70px !important;
            }

            .panne-icon .emoji-fallback {
                font-size: 50px;
            }

            .panne-text {
                font-size: 15px;
            }

            .panne-text-1,
            .panne-text-2,
            .panne-text-3,
            .panne-text-4 {
                font-size: 15px !important;
            }
        }

        /* Ajustement pour iPhone 12/13/14 (390px) et modèles similaires */
        @media (min-width: 375px) and (max-width: 430px) {
            .panne-icon {
                width: 88px;
                height: 88px;
            }

            .panne-icon-1,
            .panne-icon-2,
            .panne-icon-3,
            .panne-icon-4 {
                width: 88px !important;
                height: 88px !important;
            }

            .panne-text {
                font-size: 20px;
            }

            .panne-text-1,
            .panne-text-2,
            .panne-text-3,
            .panne-text-4 {
                font-size: 15px !important;
            }
        }

        /* Textes individuels aussi */
        .panne-text-1,
        .panne-text-2,
        .panne-text-3,
        .panne-text-4 {
            font-size: 15px !important;
        }

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

        .pannes-container {
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .retour-section {
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        /* RESET pour éviter les interférences CSS du thème */
        .pannes-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .pannes-container {
            border: 3px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (min-width: 481px) {
            .pannes-container {
                border: 6px solid #000000 !important;
            }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="pannes-page">
        <div class="main-container">
            <div class="pannes-container">

                <!-- Header avec titre -->
                <div class="pannes-header">
                    <div class="tools-icon">
                        <?php
                        // Icône spécifique au quartier ou globale
                        $tools_icon = get_theme_mod("pannes_{$quartier}_tools_icon");
                        if (empty($tools_icon)) {
                            $tools_icon = get_theme_mod('pannes_tools_icon');
                        }

                        if ($tools_icon) : ?>
                            <img src="<?php echo esc_url($tools_icon); ?>" alt="Outils">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Outils">🔧</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="pannes-title">
                        <?php
                        $title = get_theme_mod("pannes_{$quartier}_title", "PANNES<br>" . strtoupper($quartier_display));
                        echo wp_kses($title, array('br' => array()));
                        ?>
                    </h1>
                </div>

                <!-- Grille des pannes -->
                <div class="pannes-grid-container">
                    <div class="pannes-grid">
                        <?php for ($i = 1; $i <= 4; $i++) :
                            // Récupérer les valeurs spécifiques au quartier ou globales
                            $icon = get_theme_mod("pannes_{$quartier}_icon_panne{$i}");
                            if (empty($icon)) {
                                $icon = get_theme_mod("pannes_icon_panne{$i}");
                            }

                            $text = get_theme_mod("pannes_{$quartier}_text_panne{$i}");
                            if (empty($text)) {
                                $text = get_theme_mod(
                                    "pannes_text_panne{$i}",
                                    $i == 1 ? 'CHAUFFAGE' : ($i == 2 ? 'ASCENSEUR' : ($i == 3 ? 'TÉLÉVISION' : 'INTERNET'))
                                );
                            }

                            // Numéros par défaut : chauffage et ascenseur
                            $default_telephones = [
                                1 => '0800 11 111',
                                2 => '0800 22 222',
                                3 => '',
                                4 => '',
                            ];

                            // URLs par défaut : TV et Internet pointent vers les fiches explicatives
                            $default_urls = [
                                1 => '#',
                                2 => '#',
                                3 => '/panne-television',
                                4 => '/panne-internet',
                            ];

                            $telephone = get_theme_mod("pannes_{$quartier}_telephone_panne{$i}");
                            if (empty($telephone)) {
                                $telephone = get_theme_mod("pannes_telephone_panne{$i}", $default_telephones[$i]);
                            }

                            $url = get_theme_mod("pannes_{$quartier}_url_panne{$i}");
                            if (empty($url)) {
                                $url = get_theme_mod("pannes_url_panne{$i}", $default_urls[$i]);
                            }

                            // Si pas de téléphone, utiliser l'URL
                            $onclick = '';
                            if ($is_multi && ($i == 1 || $i == 2)) {
                                $options_json = esc_attr(json_encode($multi_concierge[$quartier], JSON_UNESCAPED_UNICODE));
                                $onclick = "event.preventDefault(); showBatimentSelector(this, " . $options_json . ");";
                            } elseif (!empty($telephone)) {
                                $onclick = "event.preventDefault(); showPhoneNumber(this, '" . esc_js($telephone) . "');";
                            }
                        ?>
                            <a href="<?php echo esc_url($url); ?>"
                                class="panne-item"
                                data-telephone="<?php echo esc_attr($telephone); ?>"
                                onclick="<?php echo $onclick; ?>">
                                <div class="panne-icon panne-icon-<?php echo $i; ?>">
                                    <?php if ($icon) : ?>
                                        <img src="<?php echo esc_url($icon); ?>" alt="<?php echo esc_attr($text); ?>">
                                    <?php else : ?>
                                        <span class="emoji-fallback" role="img">
                                            <?php echo $i == 1 ? '🔥' : ($i == 2 ? '🛗' : ($i == 3 ? '📺' : '🌐')); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="panne-text panne-text-<?php echo $i; ?>"><?php echo esc_html(strtoupper($text)); ?></div>
                            </a>
                        <?php endfor; ?>
                    </div>

                    <!-- Sélection bâtiment (multi-concierges) -->
                    <div id="batiment-selector" class="batiment-selector"></div>
                </div>
            </div>

            <!-- Bouton retour -->
            <div class="retour-section">
                <a href="<?php
                            // URL de retour avec fallback : spécifique > globale > défaut
                            $retour_url = get_theme_mod("pannes_{$quartier}_retour_url");
                            if (empty($retour_url)) {
                                $retour_url = get_theme_mod('pannes_retour_url', '/quartiers');
                            }
                            echo esc_url($retour_url);
                            ?>" class="retour-button">
                    <?php
                    // Image de retour spécifique au quartier ou globale
                    $arrow_image = get_theme_mod("pannes_{$quartier}_retour_image");
                    if (empty($arrow_image)) {
                        $arrow_image = get_theme_mod('pannes_retour_image');
                    }

                    if ($arrow_image) : ?>
                        <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image" aria-hidden="true">
                    <?php else : ?>
                        <span class="arrow" aria-hidden="true">←</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <script>
        function showPhoneNumber(element, phoneNumber) {
            // Cacher la zone bâtiment si ouverte
            document.getElementById('batiment-selector').classList.remove('visible');

            // Réinitialiser tous les autres items déjà ouverts
            document.querySelectorAll('.panne-item.clicked').forEach(function(other) {
                if (other !== element) {
                    other.classList.remove('clicked');
                    const otherText = other.querySelector('.panne-text');
                    const originalText = other.dataset.originalText;
                    if (originalText) {
                        otherText.innerHTML = originalText;
                    }
                }
            });

            // Sauvegarder le texte original si pas encore fait
            const textContainer = element.querySelector('.panne-text');
            if (!element.dataset.originalText) {
                element.dataset.originalText = textContainer.innerHTML;
            }

            // Ajouter la classe clicked
            element.classList.add('clicked');

            // Remplacer le texte par le numéro de téléphone
            textContainer.innerHTML = `
        <div class="panne-phone">
            <div class="phone-number">${phoneNumber}</div>
            <div class="phone-instruction">Appuyez pour appeler</div>
        </div>
    `;

            // Sur mobile : lancer l'appel automatiquement
            // Sur desktop : afficher uniquement le numéro
            const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            if (isMobile) {
                setTimeout(() => {
                    window.location.href = 'tel:' + phoneNumber;
                }, 500);
            }
        }

        function showBatimentSelector(element, options) {
            // Réinitialiser les autres items déjà ouverts
            document.querySelectorAll('.panne-item.clicked').forEach(function(other) {
                if (other !== element) {
                    other.classList.remove('clicked');
                    const otherText = other.querySelector('.panne-text');
                    const originalText = other.dataset.originalText;
                    if (originalText) {
                        otherText.innerHTML = originalText;
                    }
                }
            });

            element.classList.add('clicked');

            const selector = document.getElementById('batiment-selector');

            let html = '<div class="batiment-selector-title">Quel est votre bâtiment ?</div>';
            options.forEach(function(opt) {
                const tel = opt.tel.replace(/'/g, "\\'");
                html += `<button class="batiment-btn" onclick="selectBatiment('${tel}')">${opt.label}</button>`;
            });

            selector.innerHTML = html;
            selector.classList.add('visible');
        }

        function selectBatiment(phoneNumber) {
            const clickedItem = document.querySelector('.panne-item.clicked');
            if (clickedItem) {
                showPhoneNumber(clickedItem, phoneNumber);
            }
        }
    </script>

<?php get_footer(); ?>