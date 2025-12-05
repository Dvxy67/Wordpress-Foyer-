<?php
/*
Template Name: Services Habitants - Full Screen Mobile
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

        /* === STYLES MOBILE PAR DÉFAUT === */
        .habitants-page {
            min-height: 100dvh;
            background: #7391ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* Padding réduit au minimum pour maximiser l'espace */
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

        /* Grille principale - DIMENSIONS HARMONISÉES */
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
            /* Hauteur augmentée de 10px */
            height: calc(100vh - 120px);
            min-height: 430px;
            max-height: 510px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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

        /* Images uploadées - TAILLE HARMONISÉE */
        .service-icon img {
            width: 65px;
            height: 65px;
            object-fit: contain;
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

        /* Section bouton retour - HARMONISÉE */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 65px;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 10px;
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
            animation: slideInMobile 0.6s ease-out;
        }

        .retour-section {
            animation: slideInMobile 0.6s ease-out 0.2s both;
        }

        /* === OPTIMISATIONS POUR ÉCRANS TRÈS PETITS === */
        @media (max-height: 600px) {
            .services-grid {
                height: calc(100dvh - 100px);
                min-height: 350px;
                padding: 10px;
            }
            
            .service-item {
                min-height: calc((100dvh - 140px) / 4 - 5px);
                padding: 6px 4px;
            }
            
            .service-icon {
                height: calc((100dvh - 180px) / 8);
                min-height: 28px;
                margin-bottom: 4px;
            }
            
            .service-icon img {
                width: calc((100dvh - 180px) / 8);
                height: calc((100dvh - 180px) / 8);
                min-width: 26px;
                min-height: 26px;
                max-width: 40px;
                max-height: 40px;
            }
            
            .service-title {
                font-size: calc((100dvh - 180px) / 45);
                min-font-size: 8px;
                max-font-size: 12px;
                line-height: 1;
            }
            
            .retour-section {
                height: 50px;
            }
            
            .retour-button {
                padding: 8px 12px;
                gap: 8px;
            }
        }

        /* === ÉCRANS TRÈS LARGES EN MODE PORTRAIT === */
        @media (min-height: 800px) and (max-width: 480px) {
            .services-grid {
                height: calc(100dvh - 140px);
                max-height: 700px;
                max-width: 380px;
            }
            
            .service-icon {
                max-height: 60px;
            }
            
            .service-icon img {
                max-width: 55px;
                max-height: 55px;
            }
            
            .service-title {
                max-font-size: 16px;
            }
            
            .retour-section {
                height: 80px;
            }
        }

        /* === TABLETTE (481px+) === */
        @media (min-width: 481px) {
            .habitants-page {
                padding: 20px;
            }
            
            .main-container {
                height: calc(100vh - 40px);
            }

            .services-grid {
                width: calc(100% - 40px);
                max-width: 400px;
                height: calc(100vh - 160px);
                min-height: 560px;
                max-height: 660px;
                padding: 20px;
                border: 6px solid #000000;
                border-radius: 25px;
                margin-bottom: 20px;
                gap: 10px;
            }
            
            .service-item {
                padding: 12px 10px;
            }
            
            .service-icon {
                width: 90px;
                height: 90px;
                margin-bottom: 10px;
            }
            
            .service-icon img {
                width: 85px;
                height: 85px;
            }
            
            .service-icon .emoji-fallback {
                font-size: 75px;
            }
            
            .service-title {
                font-size: 16px;
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

        /* === DESKTOP (768px+) === */
        @media (min-width: 768px) {
            .services-grid {
                max-width: 450px;
            }
        }
            
            .arrow {
                font-size: 55px;
            }
            
            .retour-text {
                font-size: 20px;
            }
            
            .retour-section {
                height: auto;
                margin-top: 20px;
            }
        }

        /* === MODE PAYSAGE SUR MOBILE === */
        @media (orientation: landscape) and (max-height: 500px) {
            .habitants-page {
                padding: 5px;
                justify-content: flex-start;
            }
            
            .main-container {
                height: calc(100dvh - 10px);
                justify-content: space-between;
            }
            
            .services-grid {
                height: calc(100dvh - 70px);
                width: calc(100% - 10px);
                padding: 8px;
                margin-bottom: 5px;
            }
            
            .service-item {
                min-height: calc((100dvh - 110px) / 4 - 2px);
                padding: 4px 3px;
            }
            
            .service-icon {
                height: calc((100dvh - 140px) / 8);
                min-height: 20px;
                max-height: 30px;
                margin-bottom: 3px;
            }
            
            .service-icon img {
                width: calc((100dvh - 140px) / 8);
                height: calc((100dvh - 140px) / 8);
                min-width: 18px;
                min-height: 18px;
                max-width: 28px;
                max-height: 28px;
            }
            
            .service-title {
                font-size: calc((100dvh - 140px) / 50);
                min-font-size: 7px;
                max-font-size: 10px;
                line-height: 1;
            }
            
            .retour-section {
                height: 40px;
            }
            
            .retour-button {
                padding: 5px 10px;
                gap: 5px;
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
                <div class="service-icon">
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
        
        <!-- Bouton retour -->
        <div class="retour-section">
            <a href="<?php echo esc_url(get_theme_mod('habitants_retour_url', home_url())); ?>" class="retour-button" role="button" aria-label="Retour à la page d'accueil">
                <span class="arrow" aria-hidden="true">←</span>
                <span class="retour-text"><?php echo esc_html(get_theme_mod('habitants_retour_text', 'RETOUR HOMEPAGE')); ?></span>
            </a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>