<?php
/*
Template Name: Page Logement Sous-Menu - Balanced Optimization
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logement - Sous Menu</title>
    
    <style>
        /* CSS BALANCED OPTIMIZATION - Page Logement Sous Menu Mobile-First */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            overflow-x: hidden;
        }

        /* Container principal - Optimisé mais garde des bandes */
        .logement-page {
            min-height: 100dvh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* Padding réduit mais pas minimal pour garder des bandes */
            padding: 8px;
        }

        /* Container principal pour équilibrer l'espace */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            /* Utilise ~75% de l'écran au lieu de 100% ou 60% */
            height: calc(100dvh - 60px);
            width: 100%;
            max-width: 100%;
        }

        /* Container principal rose - TAILLE ÉQUILIBRÉE */
        .logement-container {
            background: #F4A6A6;
            border: 4px solid #000000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 360px; /* Légèrement agrandi de 340px */
            /* Hauteur qui nécessite un scroll léger mais pas excessif */
            height: calc(100dvh - 120px);
            min-height: 480px; /* Augmenté de 420px */
            max-height: 600px; /* Augmenté de 520px */
            padding: 18px 14px 14px 14px; /* Légèrement réduit */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow: hidden;
            margin-bottom: 12px;
        }

        /* Container des options - OPTIMISÉ AVEC SCROLL CONSERVÉ */
        .options-container {
            display: flex;
            flex-direction: column;
            /* Gap légèrement réduit pour optimiser l'espace */
            gap: 30px; /* Réduit de 35px à 30px */
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            scrollbar-width: thin;
            scrollbar-color: #CCCCCC #F0F0F0;
            justify-content: flex-start;
            /* Padding interne pour forcer un scroll léger */
            padding-bottom: 20px;
        }

        /* Scrollbar pour Chrome/Safari */
        .options-container::-webkit-scrollbar {
            width: 4px;
        }

        .options-container::-webkit-scrollbar-track {
            background: transparent;
        }

        .options-container::-webkit-scrollbar-thumb {
            background: #CCCCCC;
            border-radius: 4px;
        }

        .options-container::-webkit-scrollbar-thumb:hover {
            background: #AAAAAA;
        }

        /* Option individuelle - LÉGÈREMENT AGRANDIE */
        .logement-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
            /* Hauteur légèrement augmentée */
            min-height: 90px; /* Était implicite, maintenant défini */
        }

        .logement-option:hover {
            transform: scale(1.02);
            text-decoration: none;
            color: #000;
        }

        .logement-option:active {
            transform: scale(0.98);
        }

        /* Icône de l'option - MODÉRÉMENT AGRANDIE */
        .option-icon {
            /* Légèrement agrandi de 70px */
            width: 78px;
            height: 78px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px; /* Réduit de 12px */
            overflow: hidden;
        }

        .option-icon img {
            width: 90%;
            height: 90%;
            object-fit: contain;
        }

        /* Couleurs de fond des icônes */
        .option-icon.candidature {
            background: #E8F4FD;
        }

        .option-icon.eligibilite {
            background: #A8E6CF;
        }

        .option-icon.delais {
            background: #FFB84D;
        }

        .option-icon.autre {
            background: #D4B896;
        }

        /* Emojis fallback - LÉGÈREMENT AGRANDIS */
        .option-icon .emoji-fallback {
            font-size: 50px; /* Augmenté de 45px */
            line-height: 1;
        }

        /* Texte de l'option - LÉGÈREMENT AGRANDI */
        .option-text {
            font-size: 16px; /* Augmenté de 15px */
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.2;
            letter-spacing: 0.8px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            max-width: 260px; /* Légèrement agrandi */
            word-break: break-word;
        }

        /* Section bouton retour - OPTIMISÉE */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 55px; /* Légèrement réduit de 60px */
            flex-shrink: 0;
            width: 100%;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            padding: 8px 12px;
            border-radius: 10px;
            touch-action: manipulation;
        }

        .retour-button:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        .retour-button:active {
            transform: scale(0.95);
        }

        /* Flèche de retour - LÉGÈREMENT AGRANDIE */
        .arrow {
            font-size: 42px; /* Légèrement augmenté de 40px */
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour - LÉGÈREMENT AGRANDI */
        .retour-text {
            font-size: 17px; /* Légèrement augmenté de 16px */
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            letter-spacing: 0.8px;
        }

        /* OPTIMISATIONS POUR ÉCRANS TRÈS PETITS */
        @media (max-height: 600px), (max-width: 360px) {
            .logement-page {
                padding: 6px;
            }
            
            .main-container {
                height: calc(100dvh - 50px);
            }
            
            .logement-container {
                height: calc(100dvh - 90px);
                min-height: 420px; /* Retour à l'original pour petits écrans */
                max-height: 500px;
                padding: 15px 12px 12px 12px;
                border-radius: 20px;
                border-width: 3px;
                margin-bottom: 8px;
            }
            
            .options-container {
                gap: 25px; /* Légèrement réduit */
                padding-bottom: 15px;
            }
            
            .logement-option {
                min-height: 80px;
            }
            
            .option-icon {
                width: 70px; /* Retour proche de l'original */
                height: 70px;
                margin-bottom: 8px;
                border-radius: 12px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 45px; /* Retour à l'original */
            }
            
            .option-text {
                font-size: 14px; /* Légèrement réduit */
                letter-spacing: 0.6px;
                line-height: 1.1;
                max-width: 240px;
            }
            
            .retour-section {
                height: 50px;
            }
            
            .retour-button {
                gap: 8px;
                padding: 6px 10px;
            }
            
            .arrow {
                font-size: 36px;
            }
            
            .retour-text {
                font-size: 14px;
                letter-spacing: 0.6px;
            }
        }

        /* ÉCRANS MOYENS - ÉQUILIBRE OPTIMAL */
        @media (min-height: 700px) and (max-width: 480px) {
            .logement-container {
                height: calc(100dvh - 140px);
                max-height: 650px; /* Légèrement plus grand */
                max-width: 380px;
            }
            
            .options-container {
                gap: 35px; /* Retour au gap original */
                padding-bottom: 25px;
            }
            
            .option-icon {
                width: 85px; /* Plus grand sur écrans moyens */
                height: 85px;
                margin-bottom: 12px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 55px;
            }
            
            .option-text {
                font-size: 17px;
                max-width: 280px;
            }
            
            .retour-section {
                height: 65px;
            }
        }

        /* TABLETTE (481px+) */
        @media (min-width: 481px) {
            .logement-page {
                padding: 12px;
                min-height: 100vh;
            }
            
            .main-container {
                height: calc(100vh - 80px);
                max-width: 420px;
            }
            
            .logement-container {
                max-width: 400px;
                height: calc(100vh - 140px);
                max-height: 650px;
                min-height: 550px;
                padding: 22px 18px 18px 18px;
                border: 5px solid #000000;
                border-radius: 28px;
                margin-bottom: 15px;
            }
            
            .options-container {
                gap: 35px;
                padding-bottom: 25px;
            }
            
            .logement-option {
                min-height: 100px;
            }
            
            .option-icon {
                width: 88px;
                height: 88px;
                margin-bottom: 12px;
                border-radius: 18px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 58px;
            }
            
            .option-text {
                font-size: 17px;
                letter-spacing: 1px;
                max-width: 300px;
            }
            
            .arrow {
                font-size: 48px;
            }
            
            .retour-text {
                font-size: 17px;
                letter-spacing: 1px;
            }
            
            .retour-section {
                height: 65px;
            }
            
            .retour-button {
                gap: 12px;
                padding: 10px 14px;
            }
        }

        /* DESKTOP (768px+) */
        @media (min-width: 768px) {
            .main-container {
                max-width: 450px;
            }
            
            .logement-container {
                max-width: 420px;
                padding: 25px 20px 20px 20px;
                border: 6px solid #000000;
                border-radius: 30px;
            }
            
            .options-container {
                gap: 40px;
                padding-bottom: 30px;
            }
            
            .option-icon {
                width: 90px;
                height: 90px;
                margin-bottom: 15px;
                border-radius: 20px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 60px;
            }
            
            .option-text {
                font-size: 18px;
                letter-spacing: 1.2px;
            }
            
            .arrow {
                font-size: 55px;
            }
            
            .retour-text {
                font-size: 18px;
                letter-spacing: 1.2px;
            }
        }

        /* MODE PAYSAGE SUR MOBILE */
        @media (orientation: landscape) and (max-height: 500px) {
            .logement-page {
                padding: 4px;
                justify-content: flex-start;
            }
            
            .main-container {
                height: calc(100dvh - 8px);
                justify-content: space-between;
            }
            
            .logement-container {
                height: calc(100dvh - 55px);
                width: calc(100% - 8px);
                padding: 10px 8px 8px 8px;
                border-radius: 15px;
                border-width: 3px;
                margin-bottom: 4px;
            }
            
            .options-container {
                gap: 18px;
                padding-bottom: 10px;
            }
            
            .logement-option {
                min-height: 65px;
            }
            
            .option-icon {
                width: 55px;
                height: 55px;
                margin-bottom: 5px;
                border-radius: 10px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 32px;
            }
            
            .option-text {
                font-size: 11px;
                letter-spacing: 0.4px;
                line-height: 1;
                max-width: 200px;
            }
            
            .retour-section {
                height: 40px;
            }
            
            .retour-button {
                gap: 5px;
                padding: 5px 8px;
            }
            
            .arrow {
                font-size: 26px;
            }
            
            .retour-text {
                font-size: 10px;
                letter-spacing: 0.3px;
            }
        }

        /* OPTIMISATIONS TACTILES ET ACCESSIBILITÉ */
        
        /* Focus accessible au clavier */
        .logement-option:focus,
        .retour-button:focus {
            outline: 3px solid #FFD700;
            outline-offset: 2px;
        }

        /* Amélioration contraste pour accessibilité */
        @media (prefers-contrast: high) {
            .logement-container {
                border-width: 6px;
            }
            
            .option-text {
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
            .logement-option,
            .retour-button {
                transition: none;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        .logement-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .logement-container {
            border: 4px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (min-width: 481px) {
            .logement-container {
                border: 5px solid #000000 !important;
            }
        }

        @media (min-width: 768px) {
            .logement-container {
                border: 6px solid #000000 !important;
            }
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="logement-page">
    <div class="main-container">
        <div class="logement-container">
            
            <!-- Container des options -->
            <div class="options-container">
                
                <!-- Option 1: Candidature -->
                <a href="<?php echo get_logement_option_url('candidature'); ?>" class="logement-option">
                    <div class="option-icon candidature">
                        <?php 
                        $icon_candidature = get_theme_mod('logement_icon_candidature');
                        if ($icon_candidature) : ?>
                            <img src="<?php echo esc_url($icon_candidature); ?>" alt="Candidature">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Document">📝</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_candidature', 'ENTRER MA CANDIDATURE')); ?>
                    </div>
                </a>
                
                <!-- Option 2: Éligibilité -->
                <a href="<?php echo get_logement_option_url('eligibilite'); ?>" class="logement-option">
                    <div class="option-icon eligibilite">
                        <?php 
                        $icon_eligibilite = get_theme_mod('logement_icon_eligibilite');
                        if ($icon_eligibilite) : ?>
                            <img src="<?php echo esc_url($icon_eligibilite); ?>" alt="Éligibilité">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Question">❓</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_eligibilite', 'EST-CE QUE J\'Y AI DROIT?')); ?>
                    </div>
                </a>
                
                <!-- Option 3: Délais -->
                <a href="<?php echo get_logement_option_url('delais'); ?>" class="logement-option">
                    <div class="option-icon delais">
                        <?php 
                        $icon_delais = get_theme_mod('logement_icon_delais');
                        if ($icon_delais) : ?>
                            <img src="<?php echo esc_url($icon_delais); ?>" alt="Délais">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Horloge">⏰</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_delais', 'COMBIEN DE TEMPS JE VAIS ATTENDRE?')); ?>
                    </div>
                </a>

                <!-- Option 4: Par défaut visible (comme dans la maquette) -->
                <a href="<?php echo get_logement_option_url('autre'); ?>" class="logement-option">
                    <div class="option-icon autre">
                        <?php 
                        $icon_autre = get_theme_mod('logement_icon_autre');
                        if ($icon_autre) : ?>
                            <img src="<?php echo esc_url($icon_autre); ?>" alt="Autre">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Question">❓</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_autre', 'AUTRE QUESTION?')); ?>
                    </div>
                </a>

                <!-- Options supplémentaires si activées -->
                <?php if (get_theme_mod('logement_show_option4', false)) : ?>
                <a href="<?php echo get_logement_option_url('option5'); ?>" class="logement-option">
                    <div class="option-icon autre">
                        <?php 
                        $icon_option5 = get_theme_mod('logement_icon_option5');
                        if ($icon_option5) : ?>
                            <img src="<?php echo esc_url($icon_option5); ?>" alt="Option 5">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Plus">➕</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_option5', 'OPTION SUPPLÉMENTAIRE')); ?>
                    </div>
                </a>
                <?php endif; ?>
                
            </div>
        </div>
        
        <!-- Bouton retour -->
        <div class="retour-section">
            <a href="<?php echo get_theme_mod('logement_retour_url', home_url()); ?>" class="retour-button">
                <span class="arrow">←</span>
                <span class="retour-text"><?php echo esc_html(get_theme_mod('logement_retour_text', 'RETOUR HOMEPAGE')); ?></span>
            </a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>