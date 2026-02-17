<?php
/*
Template Name: Rapport Annuel - Navigation Bar
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
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

        /* BARRE DE NAVIGATION - Complètement séparée de l'iframe */
        .nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: max(70px, calc(env(safe-area-inset-top) + 70px));
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: max(20px, calc(env(safe-area-inset-top) + 10px)) 20px 20px;
            pointer-events: none;
        }

        /* Bouton fermer - dans la nav bar */
        .close-button {
            width: 50px;
            height: 50px;
            background: #fff;
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            pointer-events: auto;
            touch-action: manipulation;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
            user-select: none;
            -webkit-user-select: none;
        }

        .close-button:hover,
        .close-button:active {
            background: #f0f0f0;
            transform: scale(1.1);
        }

        /* Container PDF - SOUS la barre de navigation */
        .pdf-fullscreen {
            position: fixed;
            top: max(70px, calc(env(safe-area-inset-top) + 70px));
            left: 0;
            width: 100%;
            height: calc(100% - max(70px, calc(env(safe-area-inset-top) + 70px)));
            background: #525659;
            z-index: 1;
        }

        /* Iframe PDF */
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

        /* Mobile */
        @media (max-width: 480px) {
            .nav-bar {
                height: max(60px, calc(env(safe-area-inset-top) + 60px));
                padding: max(15px, calc(env(safe-area-inset-top) + 8px)) 15px 15px;
            }

            .close-button {
                width: 45px;
                height: 45px;
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .nav-bar {
                height: max(60px, calc(env(safe-area-inset-top) + 60px));
                padding: max(15px, calc(env(safe-area-inset-top) + 8px)) 15px 15px;
            }

            .pdf-fullscreen {
                top: max(60px, calc(env(safe-area-inset-top) + 60px));
                height: calc(100% - max(60px, calc(env(safe-area-inset-top) + 60px)));
            }

            .close-button {
                width: 45px;
                height: 45px;
                font-size: 24px;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>

    <!-- BARRE DE NAVIGATION avec le bouton -->
    <nav class="nav-bar" role="navigation">
        <a href="<?php echo esc_url(get_theme_mod('rapport_retour_url', home_url('/foyer'))); ?>"
            class="close-button"
            title="Fermer"
            aria-label="Fermer le rapport annuel">
            ✕
        </a>
    </nav>

    <!-- Container PDF -->
    <div class="pdf-fullscreen">
        <!-- PDF en plein écran -->
        <?php
        $pdf_url = get_theme_mod('rapport_pdf_url', '');
        if ($pdf_url) : ?>

            <!-- Script de détection mobile et ouverture auto -->
            <script>
                // Détection mobile
                const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

                if (isMobile) {
                    // Sur mobile : ouvrir directement le PDF
                    window.location.href = '<?php echo esc_url($pdf_url); ?>';
                }
            </script>

            <!-- Iframe pour desktop uniquement -->
            <iframe class="pdf-iframe"
                src="<?php echo esc_url($pdf_url); ?>#view=FitH&toolbar=0"
                title="Rapport Annuel"
                loading="lazy"></iframe>
        <?php else : ?>
            <div class="no-pdf">
                <p>Aucun PDF configuré.<br>Ajoutez l'URL dans Apparence > Personnaliser > Page Rapport Annuel</p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>