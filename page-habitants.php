<?php
/*
Template Name: Services Habitants - Mobile First
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services pour les habitants</title>
    
    <style>
        /* MOBILE FIRST CSS - Reproduction exacte de l'image de référence */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* === STYLES MOBILE PAR DÉFAUT (320px+) === */
        .habitants-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            position: relative;
        }

        /* Grille principale - Mobile */
        .services-grid {
            background: #F4D03F;
            border: 4px solid #000000;
            border-radius: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(4, 1fr);
            gap: 0;
            width: 100%;
            max-width: 320px;
            height: 420px;
            padding: 12px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Item de service - Mobile */
        .service-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 8px 5px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease;
            text-decoration: none;
            color: inherit;
            min-height: 90px;
        }

        .service-item:hover,
        .service-item:focus {
            transform: scale(1.03);
            outline: none;
        }

        .service-item:active {
            transform: scale(0.97);
        }

        /* Zone icône - Mobile */
        .service-icon {
            height: 35px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px; /* Pour émojis fallback */
        }

        /* Images uploadées - Mobile */
        .service-icon img {
            width: 32px;
            height: 32px;
            object-fit: contain;
            max-width: 35px;
            max-height: 35px;
        }

        /* Style émojis en fallback - Mobile */
        .service-icon .emoji-fallback {
            font-size: 24px;
            line-height: 1;
        }

        /* Titre de service - Mobile */
        .service-title {
            font-size: 9px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            line-height: 1;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 1px;
            letter-spacing: 0.3px;
            text-align: center;
            word-break: break-word;
        }

        /* Section bouton retour - Mobile */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            padding: 10px;
            border-radius: 10px;
        }

        .retour-button:hover,
        .retour-button:focus {
            transform: scale(1.05);
            outline: none;
        }

        .retour-button:active {
            transform: scale(0.95);
        }

        /* Flèche de retour - Mobile */
        .arrow {
            font-size: 35px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour homepage - Mobile */
        .retour-text {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 2px;
            letter-spacing: 0.5px;
        }

        /* Animation d'entrée */
        @keyframes slideInMobile {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
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

        /* === TABLETTE (481px+) === */
        @media (min-width: 481px) {
            .habitants-page {
                padding: 20px;
            }

            .services-grid {
                max-width: 380px;
                height: 480px;
                padding: 15px;
                border: 5px solid #000000;
                border-radius: 22px;
                margin-bottom: 30px;
            }
            
            .service-item {
                padding: 12px 8px;
                min-height: 105px;
            }
            
            .service-icon {
                height: 42px;
                margin-bottom: 6px;
                font-size: 28px;
            }
            
            .service-icon img {
                width: 38px;
                height: 38px;
                max-width: 42px;
                max-height: 42px;
            }
            
            .service-icon .emoji-fallback {
                font-size: 28px;
            }
            
            .service-title {
                font-size: 11px;
                text-decoration-thickness: 1.5px;
                text-underline-offset: 1.5px;
                letter-spacing: 0.4px;
            }
            
            .retour-button {
                gap: 12px;
            }
            
            .arrow {
                font-size: 42px;
            }
            
            .retour-text {
                font-size: 16px;
                text-decoration-thickness: 1.5px;
                letter-spacing: 0.7px;
            }
        }

        /* === DESKTOP (768px+) === */
        @media (min-width: 768px) {
            .habitants-page {
                padding: 25px;
                overflow: hidden;
            }

            .services-grid {
                max-width: 420px;
                height: 520px;
                padding: 20px;
                border: 6px solid #000000;
                border-radius: 25px;
                margin-bottom: 40px;
            }
            
            .service-item {
                padding: 15px 10px;
                min-height: 120px;
            }
            
            .service-icon {
                height: 50px;
                margin-bottom: 8px;
                font-size: 32px;
            }
            
            .service-icon img {
                width: 45px;
                height: 45px;
                max-width: 50px;
                max-height: 50px;
            }
            
            .service-icon .emoji-fallback {
                font-size: 32px;
            }
            
            .service-title {
                font-size: 13px;
                text-decoration-thickness: 2px;
                text-underline-offset: 2px;
                letter-spacing: 0.5px;
            }
            
            .retour-button {
                gap: 15px;
            }
            
            .arrow {
                font-size: 50px;
            }
            
            .retour-text {
                font-size: 18px;
                text-decoration-thickness: 2px;
                text-underline-offset: 3px;
                letter-spacing: 1px;
            }
        }

        /* === LARGE DESKTOP (1024px+) === */
        @media (min-width: 1024px) {
            .services-grid {
                max-width: 450px;
                height: 580px;
                padding: 25px;
            }
            
            .service-item {
                padding: 18px 12px;
                min-height: 135px;
            }
            
            .service-icon {
                height: 55px;
                margin-bottom: 10px;
                font-size: 36px;
            }
            
            .service-icon img {
                width: 50px;
                height: 50px;
                max-width: 55px;
                max-height: 55px;
            }
            
            .service-icon .emoji-fallback {
                font-size: 36px;
            }
            
            .service-title {
                font-size: 14px;
            }
            
            .arrow {
                font-size: 55px;
            }
            
            .retour-text {
                font-size: 20px;
            }
        }

        /* === OPTIMISATIONS TACTILES === */
        
        /* Zone de toucher élargie sur mobile */
        @media (max-width: 480px) {
            .service-item {
                min-height: 95px;
                touch-action: manipulation;
            }
            
            .retour-button {
                min-height: 60px;
                min-width: 250px;
                touch-action: manipulation;
            }
        }

        /* Focus accessible au clavier */
        .service-item:focus,
        .retour-button:focus {
            outline: 3px solid #FFD700;
            outline-offset: 2px;
        }

        /* Amélioration contraste pour accessibilité */
        @media (prefers-contrast: high) {
            .services-grid {
                border-width: 8px;
            }
            
            .service-title {
                text-decoration-thickness: 3px;
                font-weight: 900;
            }
            
            .retour-text {
                text-decoration-thickness: 3px;
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
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="habitants-page">
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

<?php wp_footer(); ?>
</body>
</html>