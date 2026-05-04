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

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Rubik', sans-serif;
            font-weight: 400;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Page wrapper */
        .texte-page {
            min-height: 100svh;
            background: #6b92ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100svh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Carte blanche */
        .texte-container {
            background: #FFFFFF;
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
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Bouton fermeture */
        .close-button {
            position: absolute;
            top: 22px;
            right: 26px;
            width: 32px;
            height: 32px;
            background: #FFFFFF;
            border: 2.5px solid #000000;
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
            margin-bottom: 20px;
            line-height: 1.2;
            letter-spacing: 0.5px;
            margin-top: 15px;
            padding-left: 10px;
        }

        /* Zone contenu scrollable */
        .text-content {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 0 14px 0 10px;
            color: #000000;
            font-size: 15px;
            line-height: 1.5;
            font-weight: 400;
        }

        /* Restaurer la mise en page Gutenberg (le reset * écrase les marges par défaut) */
        .text-content p,
        .text-content .wp-block-paragraph {
            margin-top: 0;
            margin-bottom: 0.7em;
        }
        .text-content p:last-child,
        .text-content .wp-block-paragraph:last-child {
            margin-bottom: 0;
        }
        .text-content h1,
        .text-content h2,
        .text-content h3,
        .text-content h4,
        .text-content h5,
        .text-content h6 {
            font-weight: 600;
            margin-top: 1.4em;
            margin-bottom: 0.5em;
            line-height: 1.3;
        }
        .text-content h1 { font-size: 1.5em; }
        .text-content h2 { font-size: 1.3em; }
        .text-content h3 { font-size: 1.1em; }
        .text-content ul,
        .text-content ol,
        .text-content .wp-block-list {
            margin: 0.7em 0;
            padding-left: 1.2em;
        }
        .text-content li {
            margin-bottom: 0.3em;
        }
        .text-content strong { font-weight: 700; }
        .text-content em { font-style: italic; }
        .text-content a { color: #000; text-decoration: underline; }
        .text-content blockquote {
            border-left: 3px solid #ccc;
            padding-left: 1em;
            margin: 1em 0;
            color: #555;
        }

        /* Scrollbar */
        .text-content::-webkit-scrollbar { width: 6px; }
        .text-content::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .text-content::-webkit-scrollbar-thumb { background: #888; border-radius: 10px; }
        .text-content::-webkit-scrollbar-thumb:hover { background: #555; }

        /* Animation */
        @keyframes slideInMobile {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Desktop */
        @media (min-width: 481px) {
            .texte-page { padding: 20px; }
            .main-container { height: calc(100svh - 40px); }

            .texte-container {
                max-width: 680px;
                min-height: 650px;
                max-height: 750px;
                padding: 45px 50px;
                padding-top: 60px;
            }

            .close-button {
                top: 15px;
                right: 15px;
                width: 55px;
                height: 55px;
                border: 3px solid #000000;
            }

            .close-icon { font-size: 22px; }

            .text-title {
                font-size: 27px;
                margin-bottom: 22px;
                padding-left: 0;
            }

            .text-content {
                line-height: 1.6;
                padding-left: 0;
                padding-right: 30px;
                overflow-y: scroll;
            }

            .text-content::-webkit-scrollbar { width: 8px; }
        }

        /* Très petit mobile */
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

            .close-icon { font-size: 18px; }
            .text-title { font-size: 18px; }
            .text-content { font-size: 13px; }
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
                            echo apply_filters('the_content', get_the_content());
                        endwhile;
                    endif;
                    ?>
                </div>

            </div>
        </div>
    </div>

<?php get_footer(); ?>