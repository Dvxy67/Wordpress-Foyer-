<?php
/*
Template Name: Services Habitants - Contrôle CSS Direct
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services pour les habitants</title>

    <style>
        /* Import Google Fonts - Rubik */
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');

        /* MOBILE FIRST CSS - Utilisation maximale de l'espace écran */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            font-weight: 500;
            overflow-x: hidden;
        }

        /* ============================================
           🎨 CONTRÔLES DES ICÔNES - MODIFIE ICI
           ============================================ */
        
        /* ICÔNE 1 : LES PANNES */
        .icon-pannes img {
            width: 65px;         
            height: 65px;        
            transform: rotate(17deg);  
        }

        /* ICÔNE 2 : LE CONCIERGE */
        .icon-concierge img {
            width: 75px;
            height: 75px;
            transform: rotate(0deg);
        }

        /* ICÔNE 3 : LES POMPIERS */
        .icon-pompiers img {
            width: 80px;
            height: 80px;
            transform: rotate(0deg);
        }

        /* ICÔNE 4 : BRUXELLES PROPRETÉ */
        .icon-proprete img {
            width: 65px;
            height: 65px;
        }

        /* ICÔNE 5 : L'ASSISTANT SOCIAL */
        .icon-assistant img {
            width: 85px;
            height: 85px;
        }

        /* ICÔNE 6 : LE RÈGLEMENT */
        .icon-reglement img {
            width: 55px;
            height: 55px;
        }

        /* ICÔNE 7 : AIDE PSYCHOLOGIQUE */
        .icon-psychologique img {
            width: 75px;
            height: 75px;
        }

        /* ICÔNE 8 : L'ENTRETIEN DU LOGEMENT */
        .icon-entretien img {
            width: 75px;
            height: 75px;
        }

        /* ============================================
           FIN DES CONTRÔLES - NE MODIFIE PAS EN DESSOUS
           ============================================ */

        /* === STYLES MOBILE PAR DÉFAUT === */
        .habitants-page {
            min-height: 100dvh;
            background: #7391ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
            position: relative;
        }

        /* Container principal optimisé */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100dvh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Grille principale - RÉDUIT DE 30PX */
        .services-grid {
            background: #e9d16f;
            border: 3px solid #000000;
            border-radius: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(4, 1fr);
            gap: 0;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100dvh - 150px);  /* ← MODIF : 120px → 150px (30px plus petit) */
            min-height: 505px;
            max-height: 585px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            margin-bottom: 12px;
        }

        /* Item de service - DIMENSIONS HARMONISÉES */
        .service-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 6px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .service-item:hover,
        .service-item:focus {
            transform: scale(1.03);
            outline: none;
        }

        .service-item:active {
            transform: scale(0.97);
        }

        /* Zone icône - TAILLE HARMONISÉE FIXE */
        .service-icon {
            width: 70px;
            height: 70px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Images uploadées - Style de base */
        .service-icon img {
            object-fit: contain;
            transition: transform 0.2s ease;
        }

        /* Style émojis en fallback */
        .service-icon .emoji-fallback {
            font-size: 58px;
            line-height: 1;
        }

        /* Titre de service - TAILLE HARMONISÉE */
        .service-title {
            font-size: 14px !important;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            line-height: 1.1;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
            letter-spacing: 0.5px;
            text-align: center;
            word-break: break-word;
        }

        /* Section bouton retour - IDENTIQUE À PAGE LOGEMENT */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 118px;  /* ← IDENTIQUE à page logement */
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
            touch-action: manipulation;
        }

        .retour-button:hover,
        .retour-button:focus {
            transform: scale(1.05);
            outline: none;
        }

        .retour-button:active {
            transform: scale(0.95);
        }

        /* Flèche de retour - TAILLE HARMONISÉE */
        .arrow {
            font-size: 45px;
            font-weight: 500;
            color: #000;
            line-height: 1;
        }

        /* Image de la flèche retour (si uploadée) */
        .arrow-image {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        /* Texte retour homepage - TAILLE HARMONISÉE */
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

        .services-grid {
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .retour-section {
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }

        /* === RESPONSIVE DESKTOP === */
        @media (min-width: 481px) {
            .habitants-page {
                padding: 20px;
            }

            .main-container {
                height: calc(100vh - 40px);
            }

            .services-grid {
                max-width: 400px;  /* ← Ajusté pour correspondre à logement-container */
                min-height: 560px; /* ← Ajusté pour correspondre à logement-container */
                max-height: 660px; /* ← Ajusté pour correspondre à logement-container */
                padding: 20px;
                gap: 5px;
                border: 6px solid #000000;
            }

            .service-item {
                padding: 10px;
            }

            .service-icon {
                width: 85px;
                height: 85px;
                margin-bottom: 10px;
            }

            .service-title {
                font-size: 16px !important;
            }

            .retour-section {
                height: 75px;
            }

            .arrow {
                font-size: 55px;
            }

            .arrow-image {
                width: 110px;
                height: 110px;
            }

            .retour-text {
                font-size: 18px;
            }
        }

        /* === RESPONSIVE GRANDS ÉCRANS (Tablettes/Desktop larges) === */
        @media (min-width: 769px) {
            .services-grid {
                max-width: 550px;
                min-height: 620px;
                max-height: 750px;
                padding: 25px;
                gap: 8px;
            }

            .service-item {
                padding: 12px;
            }

            .service-icon {
                width: 100px;
                height: 100px;
                margin-bottom: 12px;
            }

            .service-title {
                font-size: 18px !important;
            }

            .retour-section {
                height: 80px;
            }

            .arrow {
                font-size: 65px;
            }

            .arrow-image {
                width: 130px;
                height: 130px;
            }

            .retour-text {
                font-size: 20px;
            }
        }

        /* === OPTIMISATIONS POUR ÉCRANS TRÈS PETITS === */
        @media (max-height: 600px),
        (max-width: 360px) {
            .habitants-page {
                padding: 6px;
            }

            .main-container {
                height: calc(100dvh - 12px);
            }

            .services-grid {
                width: calc(100% - 12px);
                max-width: 350px;
                min-height: 480px;
                max-height: 545px;
                padding: 12px;
                margin-top: 15px;
                margin-bottom: 10px;
            }

            .service-item {
                padding: 6px 4px;
            }

            .service-icon {
                width: 60px;
                height: 60px;
                margin-bottom: 6px;
            }

            .service-title {
                font-size: 12px !important;
            }

            .retour-section {
                height: 55px;
            }

            .arrow {
                font-size: 38px;
            }

            .arrow-image {
                width: 75px;
                height: 75px;
            }

            .retour-text {
                font-size: 14px;
            }
        }

        /* === OPTIMISATIONS POUR ÉCRANS TRÈS HAUTS (> 900px) === */
        @media (min-height: 900px) and (max-width: 480px) {
            .services-grid {
                min-height: 650px;
                max-height: 750px;
                padding: 20px;
                gap: 5px;
            }

            .service-item {
                padding: 12px 8px;
            }

            .service-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 10px;
            }

            .service-title {
                font-size: 16px !important;
            }

            .retour-section {
                height: 80px;
            }

            .arrow {
                font-size: 52px;
            }

            .arrow-image {
                width: 105px;
                height: 105px;
            }

            .retour-text {
                font-size: 18px;
            }
        }

        /* === OPTIMISATIONS POUR ÉCRANS TRÈS BAS === */
        @media (max-height: 500px) {
            .habitants-page {
                padding: 4px;
            }

            .main-container {
                height: calc(100dvh - 8px);
            }

            .services-grid {
                width: calc(100% - 8px);
                max-width: 340px;
                height: calc(100dvh - 100px);
                min-height: 440px;
                max-height: 480px;
                padding: 10px;
                margin-top: 12px;
                margin-bottom: 8px;
                gap: 0;
            }

            .service-item {
                padding: 5px 3px;
            }

            .service-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 4px;
            }

            .service-title {
                font-size: 11px !important;
            }

            .retour-section {
                height: 50px;
            }

            .arrow {
                font-size: calc((100dvh - 140px) / 20);
                min-font-size: 18px;
                max-font-size: 25px;
            }

            .retour-text {
                font-size: calc((100dvh - 140px) / 45);
                min-font-size: 8px;
                max-font-size: 12px;
            }
        }

        /* === OPTIMISATIONS TACTILES ET ACCESSIBILITÉ === */

        /* Focus accessible au clavier */
        .service-item:focus,
        .retour-button:focus {
            outline: 3px solid #FFD700;
            outline-offset: 2px;
        }

        /* Amélioration contraste pour accessibilité */
        @media (prefers-contrast: high) {
            .services-grid {
                border-width: 6px;
            }

            .service-title {
                text-decoration-thickness: 2px;
                font-weight: 900;
            }

            .retour-text {
                text-decoration-thickness: 2px;
                font-weight: 900;
            }
        }

        /* Réduction des animations si demandée */
        @media (prefers-reduced-motion: reduce) {

            .services-grid,
            .retour-section {
                animation: none;
            }

            .service-item,
            .retour-button {
                transition: none;
            }
        }

        /* Support pour les propriétés CSS modernes */
        @supports (font-size: clamp(10px, 4vw, 16px)) {
            .service-title {
                font-size: clamp(9px, 3vw, 16px);
            }

            .retour-text {
                font-size: clamp(12px, 4vw, 20px);
            }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="habitants-page">
        <div class="main-container">
            <!-- Grille des services -->
            <div class="services-grid">
                <!-- Ligne 1 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_pannes', '/pannes')); ?>" class="service-item" role="button" aria-label="Accéder au service Les Pannes">
                    <div class="service-icon icon-pannes">
                        <?php
                        $image_pannes = get_theme_mod('habitants_image_pannes');
                        if ($image_pannes) : ?>
                            <img src="<?php echo esc_url($image_pannes); ?>" alt="Les Pannes">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Outil">🔧</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_pannes', 'LES PANNES'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_concierge', '/concierge')); ?>" class="service-item" role="button" aria-label="Accéder au service Le Concierge">
                    <div class="service-icon icon-concierge">
                        <?php
                        $image_concierge = get_theme_mod('habitants_image_concierge');
                        if ($image_concierge) : ?>
                            <img src="<?php echo esc_url($image_concierge); ?>" alt="Le Concierge">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Concierge">👤🗝️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_concierge', 'LE CONCIERGE'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 2 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_pompiers', 'tel:112')); ?>" class="service-item" role="button" aria-label="Accéder au service Les Pompiers">
                    <div class="service-icon icon-pompiers">
                        <?php
                        $image_pompiers = get_theme_mod('habitants_image_pompiers');
                        if ($image_pompiers) : ?>
                            <img src="<?php echo esc_url($image_pompiers); ?>" alt="Les Pompiers">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Camion de pompiers">🚒</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_pompiers', 'LES POMPIERS'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_proprete', 'https://www.arp-gan.be')); ?>" class="service-item" role="button" aria-label="Accéder au service Bruxelles Propreté">
                    <div class="service-icon icon-proprete">
                        <?php
                        $image_proprete = get_theme_mod('habitants_image_proprete');
                        if ($image_proprete) : ?>
                            <img src="<?php echo esc_url($image_proprete); ?>" alt="Bruxelles Propreté">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Recyclage">🗑️♻️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_proprete', 'BRUXELLES<br>PROPRETÉ'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 3 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_assistant', '/assistant-social')); ?>" class="service-item" role="button" aria-label="Accéder au service Assistant Social">
                    <div class="service-icon icon-assistant">
                        <?php
                        $image_assistant = get_theme_mod('habitants_image_assistant');
                        if ($image_assistant) : ?>
                            <img src="<?php echo esc_url($image_assistant); ?>" alt="Assistant Social">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Assistant social">👤📄</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_assistant', 'L\'ASSISTANT<br>SOCIAL'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_reglement', '/reglement')); ?>" class="service-item" role="button" aria-label="Accéder au service Le Règlement">
                    <div class="service-icon icon-reglement">
                        <?php
                        $image_reglement = get_theme_mod('habitants_image_reglement');
                        if ($image_reglement) : ?>
                            <img src="<?php echo esc_url($image_reglement); ?>" alt="Le Règlement">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Document validé">📄✅</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_reglement', 'LE RÈGLEMENT'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 4 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_psychologique', '/aide-psychologique')); ?>" class="service-item" role="button" aria-label="Accéder au service Aide Psychologique">
                    <div class="service-icon icon-psychologique">
                        <?php
                        $image_psychologique = get_theme_mod('habitants_image_psychologique');
                        if ($image_psychologique) : ?>
                            <img src="<?php echo esc_url($image_psychologique); ?>" alt="Aide Psychologique">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Support psychologique">💬❤️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_psychologique', 'AIDE<br>PSYCHOLOGIQUE'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_entretien', '/entretien-logement')); ?>" class="service-item" role="button" aria-label="Accéder au service Entretien du Logement">
                    <div class="service-icon icon-entretien">
                        <?php
                        $image_entretien = get_theme_mod('habitants_image_entretien');
                        if ($image_entretien) : ?>
                            <img src="<?php echo esc_url($image_entretien); ?>" alt="Entretien du Logement">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Manuel d'entretien">📖🔧</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_entretien', 'L\'ENTRETIEN<br>DU LOGEMENT'), array('br' => array())); ?></div>
                </a>
            </div>

            <!-- Bouton retour - IDENTIQUE À PAGE LOGEMENT (sans texte) -->
            <div class="retour-section">
                <a href="<?php echo esc_url(get_theme_mod('habitants_retour_url', home_url())); ?>" class="retour-button" role="button" aria-label="Retour à la page d'accueil">
                    <?php
                    $arrow_image = get_theme_mod('habitants_retour_image');
                    if ($arrow_image) : ?>
                        <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image" aria-hidden="true">
                    <?php else : ?>
                        <span class="arrow" aria-hidden="true">←</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>

</html>