<?php
/*
Template Name: Page Logement Sous-Menu
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logement - Sous Menu</title>
    
    <style>
        /* CSS FINAL - Page Logement Sous Menu */
        
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
        .logement-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container principal rose */
        .logement-container {
            background: #F4A6A6;
            border: 6px solid #000000;
            border-radius: 25px;
            width: 100%;
            max-width: 380px;
            min-height: 600px;
            padding: 30px 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Container des options */
        .options-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
            flex: 1;
        }

        /* Option individuelle */
        .logement-option {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
        }

        .logement-option:hover {
            transform: scale(1.02);
            text-decoration: none;
            color: #000;
        }

        /* Icône de l'option */
        .option-icon {
            width: 90px;
            height: 90px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .option-icon img {
            width: 100%;
            height: 100%;
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

        /* Emojis fallback */
        .option-icon .emoji-fallback {
            font-size: 60px;
            line-height: 1;
        }

        /* Texte de l'option */
        .option-text {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.2;
            letter-spacing: 1px;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            max-width: 280px;
        }

        /* Section bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 15px;
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
            font-size: 60px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour */
        .retour-text {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 2px;
            letter-spacing: 1px;
        }

        /* MOBILE RESPONSIVE */
        @media (max-width: 480px) {
            .logement-page {
                padding: 15px;
            }
            
            .logement-container {
                max-width: 320px;
                min-height: 500px;
                padding: 25px 20px;
                border: 4px solid #000000;
            }
            
            .options-container {
                gap: 30px;
            }
            
            .option-icon {
                width: 70px;
                height: 70px;
            }
            
            .option-icon .emoji-fallback {
                font-size: 45px;
            }
            
            .option-text {
                font-size: 16px;
                max-width: 240px;
            }
            
            .arrow {
                font-size: 45px;
            }
            
            .retour-text {
                font-size: 16px;
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
            border: 6px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (max-width: 480px) {
            .logement-container {
                border: 4px solid #000000 !important;
            }
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="logement-page">
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

            <!-- Option 4: Autre (optionnelle) -->
            <?php if (get_theme_mod('logement_show_option4', false)) : ?>
            <a href="<?php echo get_logement_option_url('autre'); ?>" class="logement-option">
                <div class="option-icon autre">
                    <?php 
                    $icon_autre = get_theme_mod('logement_icon_autre');
                    if ($icon_autre) : ?>
                        <img src="<?php echo esc_url($icon_autre); ?>" alt="Autre">
                    <?php else : ?>
                        <span class="emoji-fallback" role="img" aria-label="Autre">❓</span>
                    <?php endif; ?>
                </div>
                <div class="option-text">
                    <?php echo esc_html(get_theme_mod('logement_text_autre', 'AUTRE OPTION')); ?>
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

<?php wp_footer(); ?>
</body>
</html>