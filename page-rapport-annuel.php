<?php
/*
Template Name: Rapport Annuel - Plein Écran
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Annuel</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            overflow: hidden;
            height: 100vh;
            width: 100vw;
        }

        /* Container plein écran */
        .pdf-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #525659;
        }

        /* Bouton fermer - fixé en haut à droite */
        .close-button {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: #6cd7da;
            border: 3px solid #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 28px;
            font-weight: 700;
            color: #000;
            cursor: pointer;
            transition: all 0.2s ease;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .close-button:hover {
            background: #5bc5c8;
            transform: scale(1.1);
        }

        /* Iframe PDF plein écran */
        .pdf-iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Message si pas de PDF */
        .no-pdf {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: #fff;
            font-size: 18px;
            padding: 20px;
            text-align: center;
        }

        /* Mobile - bouton un peu plus petit */
        @media (max-width: 480px) {
            .close-button {
                width: 45px;
                height: 45px;
                font-size: 24px;
                top: 15px;
                right: 15px;
            }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="pdf-fullscreen">
        <!-- Bouton fermer -->
        <a href="<?php echo get_theme_mod('rapport_retour_url', '/foyer'); ?>" class="close-button" title="Fermer">
            ✕
        </a>

        <!-- PDF en plein écran -->
        <?php
        $pdf_url = get_theme_mod('rapport_pdf_url', '');
        if ($pdf_url) : ?>
            <iframe class="pdf-iframe" src="<?php echo esc_url($pdf_url); ?>#view=FitH&toolbar=0" title="Rapport Annuel"></iframe>
        <?php else : ?>
            <div class="no-pdf">
                <p>Aucun PDF configuré.<br>Ajoutez l'URL dans Apparence > Personnaliser > Page Rapport Annuel</p>
            </div>
        <?php endif; ?>
    </div>

    <?php wp_footer(); ?>
</body>

</html>