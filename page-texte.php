<?php
/*
Template Name: Page Texte - Modal
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?></title>

    <style>
        /* Import Google Fonts - Rubik */
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@100..900&display=swap');

        /* CSS HARMONISÉ - Page Texte Mobile-First */

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
            font-weight: 400;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Container principal */
        .texte-page {
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

        /* Container principal blanc */
        .texte-container {
            background: #FFFFFF;
            border: none;
            border-radius: 15px;
            width: calc(100% - 16px);
            max-width: 100%;
            height: calc(100svh - 80px);
            min-height: 600px;
            max-height: 650px;
            padding: 20px;
            padding-top: 50px;
            margin-top: 20px;
            margin-bottom: 12px;
            padding-bottom: 35px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Bouton de fermeture X */
        .close-button {
            position: absolute;
            top: 22px;
            right: 26px;
            width: 32px;
            height: 32px;
            background: #FFFFFF;
            border: 0.5px solid #000000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s ease, background 0.2s ease;
            text-decoration: none;
            z-index: 10;
        }

        .close-button:hover {
            transform: scale(1.1);
            background: #f5f5f5;
        }

        .close-icon {
            color: #000000;
            font-size: 33px;
            font-weight: 370;
            line-height: 1;
            position: relative;
            top: -1px;
        }

        /* Titre */
        .text-title {
            font-size: 22px;
            font-weight: 450;
            color: #000000;
            text-transform: uppercase;
            margin-bottom: 20px !important;
            line-height: 1.2;
            letter-spacing: 0.5px;
            margin-top: 15px;
            padding-left: 10px;
        }

        /* Zone de contenu scrollable */
        .text-content {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 14px;
            color: #000000;
            font-size: 15px;
            line-height: 1.45;
            text-align: justify;
            hyphens: auto;
            padding-top: 0px !important;
            margin-top: 0px !important;
            font-weight: 400;
            padding-left: 10px;
        }

        /* Style des paragraphes - RÈGLE GÉNÉRALE D'ABORD */
        .texte-page .texte-container .text-content p {
            margin: 0 0 18px 0 !important;
            margin-block: 0 18px !important;
            padding: 0 !important;
            display: block !important;
        }

        /* PUIS la règle spécifique pour le premier paragraphe APRÈS */
        .texte-page .texte-container .text-content p:first-child,
        .texte-page .texte-container .text-content p:first-of-type {
            margin-top: -16px !important;
            /* ← GAGNE car écrit en dernier */
            margin-bottom: 18px !important;
            padding: 0 !important;
        }

        /* Dernier paragraphe */
        .texte-page .texte-container .text-content p:last-child {
            margin-bottom: 0 !important;
        }

        /* Titres H2 */
        .text-content h2 {
            font-size: 18px;
            font-weight: 700;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 22px 0 10px 0;
            line-height: 1.2;
        }

        /* Sous-titres H3 */
        .text-content h3 {
            font-size: 16px;
            font-weight: 600;
            color: #000000;
            margin: 18px 0 8px 0;
            line-height: 1.2;
        }

        /* Listes à puces */
        .text-content ul,
        .text-content .wp-block-list {
            list-style: disc !important;
            padding-left: 20px !important;
            margin: 0 0 4px 0 !important;
        }

        .text-content ul li,
        .text-content .wp-block-list li {
            margin-bottom: 2px !important;
            line-height: 1.45;
        }

        /* Listes numérotées */
        .text-content ol {
            list-style: decimal !important;
            padding-left: 20px !important;
            margin: 0 0 10px 0 !important;
        }

        .text-content ol li {
            margin-bottom: 3px !important;
            line-height: 1.45;
        }

        /* Reset marges Gutenberg sur tous les blocs */
        .text-content > * {
            margin-block-start: 0 !important;
            margin-block-end: 0 !important;
        }

        .text-content .wp-block-paragraph {
            margin: 0 0 12px 0 !important;
        }

        /* Gras */
        .text-content strong,
        .text-content b {
            font-weight: 700;
            color: #000000;
        }

        /* Italique */
        .text-content em,
        .text-content i {
            font-style: italic;
        }

        /* Scrollbar custom */
        .text-content::-webkit-scrollbar {
            width: 6px;
        }

        .text-content::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .text-content::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .text-content::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* DESKTOP RESPONSIVE */
        @media (min-width: 481px) {
            .texte-page {
                padding: 20px;
            }

            .main-container {
                height: calc(100svh - 40px);
            }

            .texte-container {
                max-width: 680px;
                min-height: 650px;
                max-height: 750px;
                padding: 45px 50px;
                padding-top: 60px;
                border: none;
            }

            .close-button {
                top: 15px;
                right: 15px;
                width: 55px;
                height: 55px;
                border: 3px solid #000000;
            }

            .close-icon {
                font-size: 22px;
            }

            .text-title {
                font-size: 27px;
                margin-bottom: 22px;
                padding-left: 0;
            }

            .text-content {
                font-size: 15px;
                line-height: 1.6;
                padding-left: 0;
                padding-right: 30px;
                overflow-y: scroll;
            }

            .text-content::-webkit-scrollbar {
                width: 8px;
            }
        }

        /* TRÈS PETIT MOBILE - OPTIMISÉ */
        @media (max-width: 360px) {
            .texte-container {
                max-width: 320px;
                padding: 18px;
                padding-top: 48px;
            }

            .close-button {
                width: 45px;
                height: 45px;
                top: 10px;
                right: 10px;
                border: 2px solid #000000;
            }

            .close-icon {
                font-size: 18px;
            }

            .text-title {
                font-size: 18px;
            }

            .text-content {
                font-size: 13px;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        .texte-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .texte-container {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        .close-button {
            border: 2.5px solid #000000 !important;
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="texte-page">
        <div class="main-container">
            <div class="texte-container">

                <!-- Bouton de fermeture -->
                <a href="#" onclick="window.history.back(); return false;" class="close-button" aria-label="Fermer">
                    <span class="close-icon" aria-hidden="true">×</span>
                </a>


                <!-- Titre -->
                <h1 class="text-title">
                    <?php echo esc_html(get_the_title()); ?>
                </h1>

                <!-- Contenu -->
                <div class="text-content">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            // Force wpautop pour respecter les paragraphes
                            echo wpautop(get_the_content());
                        endwhile;
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>