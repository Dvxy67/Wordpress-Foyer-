<?php
/*
Template Name: Page Pannes
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Pannes</title>
    
    <style>
        /* CSS FINAL - Page Pannes Mobile-First */
        
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
        .pannes-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        /* Container principal jaune */
        .pannes-container {
            background: #F4D03F;
            border: 4px solid #000000;
            border-radius: 25px;
            width: 100%;
            max-width: 340px;
            height: calc(100vh - 100px);
            max-height: 500px;
            min-height: 420px;
            padding: 20px 15px 15px 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Header avec titre et icône */
        .pannes-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-shrink: 0;
            min-height: 60px;
        }

        /* Icône clé anglaise */
        .tools-icon {
            width: 50px;
            height: 50px;
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

        /* Titre "LES PANNES" */
        .pannes-title {
            font-size: 20px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Zone grise avec grille */
        .pannes-grid-container {
            background: #E8E8E8;
            border-radius: 15px;
            padding: 20px 15px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Grille 2x2 des pannes */
        .pannes-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 25px;
            width: 100%;
            max-width: 280px;
            height: 100%;
            max-height: 280px;
        }

        /* Item de panne individuel */
        .panne-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
            padding: 10px;
        }

        .panne-item:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        /* Icône de la panne */
        .panne-icon {
            width: 60px;
            height: 60px;
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

        /* Emojis fallback */
        .panne-icon .emoji-fallback {
            font-size: 50px;
            line-height: 1;
        }

        /* Texte de la panne */
        .panne-text {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }

        /* Section bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px;
            flex-shrink: 0;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
        }

        .retour-button:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        /* Flèche de retour */
        .arrow {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour */
        .retour-text {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            letter-spacing: 1px;
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 481px) {
            .pannes-page {
                padding: 20px;
            }
            
            .pannes-container {
                max-width: 380px;
                min-height: 580px;
                padding: 30px 25px 20px 25px;
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
                font-size: 24px;
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
            
            .panne-text {
                font-size: 16px;
            }
            
            .arrow {
                font-size: 50px;
            }
            
            .retour-text {
                font-size: 18px;
            }
        }

        /* TRÈS PETIT MOBILE */
        @media (max-width: 360px) {
            .pannes-container {
                max-width: 300px;
                padding: 15px 12px;
            }
            
            .pannes-grid {
                gap: 20px;
                max-width: 250px;
            }
            
            .panne-icon {
                width: 50px;
                height: 50px;
            }
            
            .panne-icon .emoji-fallback {
                font-size: 40px;
            }
            
            .panne-text {
                font-size: 12px;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        .pannes-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .pannes-container {
            border: 4px solid #000000 !important;
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
    <div class="pannes-container">
        
        <!-- Header avec titre et icône -->
        <div class="pannes-header">
            <div class="tools-icon">
                <?php 
                $tools_icon = get_theme_mod('pannes_tools_icon');
                if ($tools_icon) : ?>
                    <img src="<?php echo esc_url($tools_icon); ?>" alt="Outils">
                <?php else : ?>
                    <span class="emoji-fallback" role="img" aria-label="Outils">🔧</span>
                <?php endif; ?>
            </div>
            <h1 class="pannes-title">
                <?php echo esc_html(get_theme_mod('pannes_title', 'LES PANNES')); ?>
            </h1>
        </div>
        
        <!-- Zone grise avec grille des pannes -->
        <div class="pannes-grid-container">
            <div class="pannes-grid">
                
                <!-- Panne 1: Chauffage -->
                <a href="<?php echo get_panne_option_url('chauffage'); ?>" class="panne-item">
                    <div class="panne-icon">
                        <?php 
                        $icon_chauffage = get_theme_mod('pannes_icon_chauffage');
                        if ($icon_chauffage) : ?>
                            <img src="<?php echo esc_url($icon_chauffage); ?>" alt="Chauffage">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Radiateur">🔥</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php echo esc_html(get_theme_mod('pannes_text_chauffage', 'CHAUFFAGE')); ?>
                    </div>
                </a>
                
                <!-- Panne 2: Ascenseur -->
                <a href="<?php echo get_panne_option_url('ascenseur'); ?>" class="panne-item">
                    <div class="panne-icon">
                        <?php 
                        $icon_ascenseur = get_theme_mod('pannes_icon_ascenseur');
                        if ($icon_ascenseur) : ?>
                            <img src="<?php echo esc_url($icon_ascenseur); ?>" alt="Ascenseur">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Ascenseur">🛗</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php echo esc_html(get_theme_mod('pannes_text_ascenseur', 'ASCENSEUR')); ?>
                    </div>
                </a>
                
                <!-- Panne 3: Télévision -->
                <a href="<?php echo get_panne_option_url('television'); ?>" class="panne-item">
                    <div class="panne-icon">
                        <?php 
                        $icon_television = get_theme_mod('pannes_icon_television');
                        if ($icon_television) : ?>
                            <img src="<?php echo esc_url($icon_television); ?>" alt="Télévision">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Télévision">📺</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php echo esc_html(get_theme_mod('pannes_text_television', 'TÉLÉVISION')); ?>
                    </div>
                </a>
                
                <!-- Panne 4: Internet -->
                <a href="<?php echo get_panne_option_url('internet'); ?>" class="panne-item">
                    <div class="panne-icon">
                        <?php 
                        $icon_internet = get_theme_mod('pannes_icon_internet');
                        if ($icon_internet) : ?>
                            <img src="<?php echo esc_url($icon_internet); ?>" alt="Internet">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Internet">🌐</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php echo esc_html(get_theme_mod('pannes_text_internet', 'INTERNET')); ?>
                    </div>
                </a>
                
            </div>
        </div>
    </div>
    
    <!-- Bouton retour -->
    <div class="retour-section">
        <a href="<?php echo get_theme_mod('pannes_retour_url', home_url()); ?>" class="retour-button">
            <span class="arrow">←</span>
            <span class="retour-text"><?php echo esc_html(get_theme_mod('pannes_retour_text', 'RETOUR AUX QUARTIERS')); ?></span>
        </a>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
