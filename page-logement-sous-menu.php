<?php
/*
Template Name: Page Logement Sous-Menu - Harmonisée avec Image Retour
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logement - Sous Menu</title>
    
    <style>
        /* Import Google Fonts - Rubik */
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');
        
        /* CSS HARMONISÉ - Page Logement Sous Menu Mobile-First */
        
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

        /* Container principal */
        .logement-page {
            min-height: 100dvh;
            background: #7391ff;
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
            height: calc(100dvh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Container principal rose - HARMONISÉ */
        .logement-container {
            background: #F4A6A6;
            border: 3px solid #000000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100dvh - 120px);
            min-height: 505px;
            max-height: 585px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            overflow: hidden;
            margin-top: 20px;
            margin-bottom: 12px;
        }

        /* Container des options - OPTIMISÉ AVEC SCROLL CONSERVÉ */
        .options-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 5px;
            scrollbar-width: thin;
            scrollbar-color: #CCCCCC #F0F0F0;
            justify-content: flex-start;
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
            min-height: 90px;
        }

        .logement-option:hover {
            transform: scale(1.02);
            text-decoration: none;
            color: #000;
        }

        .logement-option:active {
            transform: scale(0.98);
        }

        /* Icône de l'option - HARMONISÉE AVEC PAGE HABITANTS */
        .option-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .option-icon img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }

        /* Emojis fallback - HARMONISÉS AVEC PAGE HABITANTS */
        .option-icon .emoji-fallback {
            font-size: 58px;
            line-height: 1;
        }

        /* Texte de l'option - HARMONISÉ */
        .option-text {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.2;
            letter-spacing: 0.5px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
            max-width: 260px;
            word-break: break-word;
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

        /* OPTIMISATIONS POUR ÉCRANS TRÈS PETITS */
        @media (max-height: 600px), (max-width: 360px) {
            .logement-page {
                padding: 6px;
            }
            
            .logement-container {
                padding: 12px;
                min-height: 480px;
            }
            
            .options-container {
                gap: 22px;
                padding-bottom: 15px;
            }
            
            .option-icon {
                width: 60px;
                height: 60px;
            }
            
            .option-icon img {
                width: 55px;
                height: 55px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 48px;
            }
            
            .option-text {
                font-size: 14px;
            }
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 481px) {
            .logement-page {
                padding: 20px;
            }
            
            .main-container {
                height: calc(100vh - 40px);
            }
            
            .logement-container {
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
                padding: 20px;
                border: 6px solid #000000;
            }
            
            .options-container {
                gap: 35px;
                padding-bottom: 25px;
            }
            
            .option-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 12px;
            }
            
            .option-icon img {
                width: 75px;
                height: 75px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 68px;
            }
            
            .option-text {
                font-size: 18px;
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

        /* RESET pour éviter les interférences CSS du thème */
        .logement-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .logement-container {
            border: 3px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (min-width: 481px) {
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
                <a href="<?php echo esc_url(get_theme_mod('logement_url_candidature', '#')); ?>" class="logement-option">
                    <div class="option-icon candidature">
                        <?php
                        $icon_candidature = get_theme_mod('logement_icon_candidature');
                        if ($icon_candidature) : ?>
                            <img src="<?php echo esc_url($icon_candidature); ?>" alt="Candidature">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Candidature">📝</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_candidature', 'ENTRER MA CANDIDATURE')); ?>
                    </div>
                </a>
                
                <!-- Option 2: Éligibilité -->
                <a href="<?php echo esc_url(get_theme_mod('logement_url_eligibilite', '#')); ?>" class="logement-option">
                    <div class="option-icon eligibilite">
                        <?php
                        $icon_eligibilite = get_theme_mod('logement_icon_eligibilite');
                        if ($icon_eligibilite) : ?>
                            <img src="<?php echo esc_url($icon_eligibilite); ?>" alt="Éligibilité">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Éligibilité">✓</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_eligibilite', 'EST-CE QUE J\'Y AI DROIT?')); ?>
                    </div>
                </a>
                
                <!-- Option 3: Délais -->
                <a href="<?php echo esc_url(get_theme_mod('logement_url_delais', '#')); ?>" class="logement-option">
                    <div class="option-icon delais">
                        <?php
                        $icon_delais = get_theme_mod('logement_icon_delais');
                        if ($icon_delais) : ?>
                            <img src="<?php echo esc_url($icon_delais); ?>" alt="Délais">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Délais">⏳</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_delais', 'COMBIEN DE TEMPS JE VAIS ATTENDRE?')); ?>
                    </div>
                </a>
                
                <!-- Option 4: Autre Question -->
                <a href="<?php echo esc_url(get_theme_mod('logement_url_autre', '#')); ?>" class="logement-option">
                    <div class="option-icon autre">
                        <?php
                        $icon_autre = get_theme_mod('logement_icon_autre');
                        if ($icon_autre) : ?>
                            <img src="<?php echo esc_url($icon_autre); ?>" alt="Autre Question">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Autre">❓</span>
                        <?php endif; ?>
                    </div>
                    <div class="option-text">
                        <?php echo esc_html(get_theme_mod('logement_text_autre', 'J\'AI UNE AUTRE QUESTION')); ?>
                    </div>
                </a>
                
            </div>
        </div>
        
        <!-- Bouton retour -->
        <div class="retour-section">
            <a href="<?php echo home_url(); ?>" class="retour-button">
                <?php 
                $arrow_image = get_theme_mod('logement_retour_image');
                if ($arrow_image) : ?>
                    <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image" aria-hidden="true">
                <?php else : ?>
                    <span class="arrow" aria-hidden="true">←</span>
                <?php endif; ?>
                <span class="retour-text">RETOUR AU MENU</span>
            </a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>