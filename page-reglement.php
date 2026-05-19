<?php
/*
Template Name: Règlement - EmbedPDF Version
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Règlement</title>

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
            background: #525659;
        }

        /* BARRE DE NAVIGATION - Superposée au-dessus du PDF */
        .nav-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: max(80px, calc(env(safe-area-inset-top) + 80px));
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.85) 0%, rgba(0, 0, 0, 0.4) 70%, rgba(0, 0, 0, 0) 100%);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: max(20px, calc(env(safe-area-inset-top) + 10px)) 25px 20px;
            pointer-events: none;
        }

        /* Bouton fermer - flottant au-dessus du PDF */
        .close-button {
            width: 52px;
            height: 52px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 26px;
            font-weight: 700;
            color: #000;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25), 0 2px 8px rgba(0, 0, 0, 0.15);
            pointer-events: auto;
            touch-action: manipulation;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0.1);
            user-select: none;
            -webkit-user-select: none;
        }

        .close-button:hover {
            background: #fff;
            transform: scale(1.08);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.3), 0 3px 12px rgba(0, 0, 0, 0.2);
        }

        .close-button:active {
            transform: scale(0.98);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }

        /* Container PDF - Plein écran */
        .pdf-fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #525659;
            z-index: 1;
        }

        /* Container EmbedPDF */
        #pdf-viewer {
            width: 100%;
            height: 100%;
        }

        /* Message de chargement */
        .loading-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 18px;
            text-align: center;
            z-index: 2;
        }

        .loading-message::after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            margin-left: 10px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Message d'erreur */
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
                height: max(70px, calc(env(safe-area-inset-top) + 70px));
                padding: max(12px, calc(env(safe-area-inset-top) + 8px)) 20px 15px;
            }

            .close-button {
                width: 48px;
                height: 48px;
                font-size: 22px;
            }
        }
    </style>
</head>

<body <?php body_class(); ?>>

    <!-- BARRE DE NAVIGATION avec le bouton -->
    <nav class="nav-bar" role="navigation">
        <a href="<?php echo esc_url(get_theme_mod('reglement_retour_url', home_url('/foyer'))); ?>"
            class="close-button"
            title="Fermer"
            aria-label="Fermer le règlement">
            ✕
        </a>
    </nav>

    <!-- Container PDF -->
    <div class="pdf-fullscreen">
        <?php
        $pdf_url_fr = get_theme_mod('reglement_pdf_url', '');
        $pdf_url_nl = 'https://ardjea.dreamhosters.com/wp-content/uploads/2026/05/260128-FA_ROI-simplifie_NL.pdf';
        $pdf_url = (strpos(get_locale(), 'nl') === 0) ? $pdf_url_nl : $pdf_url_fr;
        if ($pdf_url) : ?>

            <!-- Message de chargement -->
            <div class="loading-message" id="loading">
                Chargement du PDF
            </div>

            <!-- Container EmbedPDF -->
            <div id="pdf-viewer"></div>

            <!-- EmbedPDF Library -->
            <script type="module">
                const pdfUrl = '<?php echo esc_js($pdf_url); ?>';

                if (!pdfUrl || pdfUrl.trim() === '') {
                    document.getElementById('loading').innerHTML = 'Aucune URL de PDF configurée.<br><small>Configurez l\'URL dans Apparence > Personnaliser</small>';
                } else {
                    try {
                        const { default: EmbedPDF } = await import('https://cdn.jsdelivr.net/npm/@embedpdf/snippet@2/dist/embedpdf.js');

                        const loadingEl = document.getElementById('loading');
                        if (loadingEl) loadingEl.style.display = 'none';

                        EmbedPDF.init({
                            type: 'container',
                            target: document.getElementById('pdf-viewer'),
                            src: pdfUrl
                        });

                    } catch (error) {
                        document.getElementById('loading').innerHTML = 'Erreur: Impossible de charger le PDF.<br><small>' + error.message + '</small><br><br><a href="' + pdfUrl + '" target="_blank" style="color: #fff; text-decoration: underline;">Ouvrir le PDF directement</a>';
                    }
                }
            </script>

        <?php else : ?>
            <div class="no-pdf">
                <p>Aucun PDF configuré.<br>Ajoutez l'URL dans Apparence > Personnaliser > Page Règlement</p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>
