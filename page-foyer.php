<?php
/*
Template Name: Page Foyer - Harmonisée avec Image Retour
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Foyer</title>

    <style>
        /* Import Google Fonts - Rubik */
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');

        /* CSS HARMONISÉ - Page Foyer Mobile-First */

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

        /* Container principal */
        .foyer-page {
            min-height: 100dvh;
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
            height: calc(100dvh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Container principal vert turquoise - HARMONISÉ */
        .foyer-container {
            background: #6cd7da;
            border: 3px solid #000000;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100vh - 120px);
            min-height: 505px;
            max-height: 585px;
            padding: 15px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Container des options - OPTIMISÉ */
        .options-container {
            display: flex;
            flex-direction: column;
            gap: 40px;
            flex: 1;
            justify-content: center;
            padding: 20px 0;
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
            font-size: 20px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.2;
            letter-spacing: 0.5px;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
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

        /* Flèche de retour - HARMONISÉE (90x90px pour image) */
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
            text-align: center;
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
            .foyer-page {
                padding: 15px;
            }

            .main-container {
                height: calc(100vh - 40px);
            }

            .foyer-container {
                max-width: 400px;
                min-height: 560px;
                max-height: 660px;
                padding: 20px;
                border: 6px solid #000000;
            }

            .options-container {
                gap: 45px;
            }

            .option-text {
                font-size: 20px;
            }

            .arrow {
                font-size: 55px;
            }

            .retour-section {
                height: 75px;
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
                font-size: 20px;
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
            border: 3px solid #000000 !important;
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
        <div class="main-container">
            <div class="foyer-container">

                <!-- Container des options -->
                <div class="options-container">

                    <!-- Option 1: La Vision -->
                    <a href="<?php echo get_foyer_option_url('vision'); ?>" class="foyer-option">
                        <div class="option-text">
                            <?php echo wp_kses_post(get_theme_mod('foyer_text_vision', 'LA VISION')); ?>
                        </div>
                    </a>

                    <!-- Option 2: Les Chiffres -->
                    <a href="<?php echo get_foyer_option_url('chiffres'); ?>" class="foyer-option">
                        <div class="option-text">
                            <?php echo wp_kses_post(get_theme_mod('foyer_text_chiffres', 'LES CHIFFRES')); ?>
                        </div>
                    </a>

                    <!-- Option 3: Le Rapport Annuel -->
                    <a href="<?php echo get_foyer_option_url('rapport'); ?>" class="foyer-option">
                        <div class="option-text">
                            <?php echo wp_kses_post(get_theme_mod('foyer_text_rapport', 'LE RAPPORT<br>ANNUEL')); ?>
                        </div>
                    </a>

                    <!-- Option 4: Communiqués de Presse -->
                    <a href="<?php echo get_foyer_option_url('communiques'); ?>" class="foyer-option">
                        <div class="option-text">
                            <?php echo wp_kses_post(get_theme_mod('foyer_text_communiques', 'COMMUNIQUÉS<br>DE PRESSE')); ?>
                        </div>
                    </a>

                    <!-- Option 5: Conseil d'Administration -->
                    <a href="<?php echo get_foyer_option_url('conseil'); ?>" class="foyer-option">
                        <div class="option-text">
                            <?php echo wp_kses_post(get_theme_mod('foyer_text_conseil', 'LE CONSEIL<br>D\'ADMINISTRATION')); ?>
                        </div>
                    </a>

                    <!-- Option 6: Optionnelle -->
                    <?php if (get_theme_mod('foyer_show_option6', false)) : ?>
                        <a href="<?php echo get_foyer_option_url('option6'); ?>" class="foyer-option">
                            <div class="option-text">
                                <?php echo wp_kses_post(get_theme_mod('foyer_text_option6', 'OPTION 6')); ?>
                            </div>
                        </a>
                    <?php endif; ?>

                </div>
            </div>

            <!-- Bouton retour -->
            <div class="retour-section">
                <a href="<?php echo get_theme_mod('foyer_retour_url', home_url()); ?>" class="retour-button">
                    <?php
                    $arrow_image = get_theme_mod('foyer_retour_image');
                    if ($arrow_image) : ?>
                        <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image" aria-hidden="true">
                    <?php else : ?>
                        <span class="arrow" aria-hidden="true">←</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

<?php get_footer(); ?>