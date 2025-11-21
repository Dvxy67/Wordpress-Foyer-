<?php
/*
Template Name: Page Foyer - Harmonisée
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Foyer</title>
    
    <style>
        /* CSS HARMONISÉ - Page Foyer Mobile-First */
        
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

        /* Container principal */
        .foyer-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        /* Container principal vert turquoise - TOTAL FIT ÉCRAN */
        .foyer-container {
            background: #7FCDCD;
            border: 4px solid #000000;
            border-radius: 25px;
            width: 100%;
            max-width: 340px;
            height: calc(100vh - 120px);
            max-height: 480px;
            min-height: 400px;
            padding: 25px 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Container des options - OPTIMISÉ */
        .options-container {
            display: flex;
            flex-direction: column;
            gap: 35px;
            flex: 1;
            justify-content: center;
        }

        /* Option individuelle */
        .foyer-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .foyer-option:hover {
            transform: scale(1.02);
            text-decoration: none;
            color: #000;
        }

        /* Texte de l'option - HARMONISÉ */
        .option-text {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.2;
            letter-spacing: 1px;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            text-underline-offset: 3px;
        }

        /* Section bouton retour - COMPACTE */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 70px;
            flex-shrink: 0;
        }

        .retour-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
        }

        .retour-button:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        /* Image/Icône de la flèche - HARMONISÉE */
        .arrow-container {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .arrow-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* Fallback flèche */
        .arrow-fallback {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour - HARMONISÉ */
        .retour-text {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            letter-spacing: 1px;
            text-align: center;
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 481px) {
            .foyer-page {
                padding: 20px;
            }
            
            .foyer-container {
                max-width: 380px;
                min-height: 650px;
                padding: 40px 30px;
                border: 6px solid #000000;
            }
            
            .options-container {
                gap: 60px;
            }
            
            .option-text {
                font-size: 20px;
            }
            
            .arrow-container {
                width: 80px;
                height: 80px;
            }
            
            .arrow-fallback {
                font-size: 60px;
            }
            
            .retour-text {
                font-size: 18px;
            }
        }

        /* TRÈS PETIT MOBILE - OPTIMISÉ */
        @media (max-width: 360px) {
            .foyer-container {
                max-width: 300px;
                padding: 20px 15px;
            }
            
            .options-container {
                gap: 25px;
            }
            
            .option-text {
                font-size: 14px;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        .foyer-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .foyer-container {
            border: 4px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (min-width: 481px) {
            .foyer-container {
                border: 6px solid #000000 !important;
            }
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="foyer-page">
    <div class="foyer-container">
        
        <!-- Container des options -->
        <div class="options-container">
            
            <!-- Option 1: La Vision -->
            <a href="<?php echo get_foyer_option_url('vision'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_vision', 'LA VISION')); ?>
                </div>
            </a>
            
            <!-- Option 2: Les Chiffres -->
            <a href="<?php echo get_foyer_option_url('chiffres'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_chiffres', 'LES CHIFFRES')); ?>
                </div>
            </a>
            
            <!-- Option 3: Le Rapport Annuel -->
            <a href="<?php echo get_foyer_option_url('rapport'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_rapport', 'LE RAPPORT ANNUEL')); ?>
                </div>
            </a>
            
            <!-- Option 4: Communiqués de Presse -->
            <a href="<?php echo get_foyer_option_url('communiques'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_communiques', 'COMMUNIQUÉS DE PRESSE')); ?>
                </div>
            </a>
            
            <!-- Option 5: Conseil d'Administration -->
            <a href="<?php echo get_foyer_option_url('conseil'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_conseil', 'LE CONSEIL D\'ADMINISTRATION')); ?>
                </div>
            </a>

            <!-- Option 6: Optionnelle -->
            <?php if (get_theme_mod('foyer_show_option6', false)) : ?>
            <a href="<?php echo get_foyer_option_url('option6'); ?>" class="foyer-option">
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('foyer_text_option6', 'OPTION 6')); ?>
                </div>
            </a>
            <?php endif; ?>
            
        </div>
    </div>
    
    <!-- Bouton retour -->
    <div class="retour-section">
        <a href="<?php echo get_theme_mod('foyer_retour_url', home_url()); ?>" class="retour-button">
            <div class="arrow-container">
                <?php 
                $arrow_image = get_theme_mod('foyer_arrow_image');
                if ($arrow_image) : ?>
                    <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour">
                <?php else : ?>
                    <span class="arrow-fallback" role="img" aria-label="Flèche retour">←</span>
                <?php endif; ?>
            </div>
            <span class="retour-text"><?php echo esc_html(get_theme_mod('foyer_retour_text', 'RETOUR HOMEPAGE')); ?></span>
        </a>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>