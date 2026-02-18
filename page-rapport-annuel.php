<?php
/*
Template Name: Rapport Annuel - EmbedPDF Version
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
            background: #525659;
        }

        /* BARRE DE NAVIGATION - Complètement séparée */
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
            top: 70px;
            left: 0;
            width: 100%;
            height: calc(100% - 70px);
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
                height: 60px;
                padding: 10px 15px;
            }

            .pdf-fullscreen {
                top: 60px;
                height: calc(100% - 60px);
            }

            .close-button {
                width: 45px;
                height: 45px;
                font-size: 24px;
            }
        }

        /* Style personnalisé pour EmbedPDF - masquer la toolbar si besoin */
        /* EmbedPDF ajoute ses propres contrôles, on peut les personnaliser ici */
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
        <?php
        $pdf_url = get_theme_mod('rapport_pdf_url', '');
        if ($pdf_url) : ?>
            
            <!-- Message de chargement -->
            <div class="loading-message" id="loading">
                Chargement du PDF
            </div>

            <!-- Container EmbedPDF -->
            <div id="pdf-viewer"></div>

            <!-- EmbedPDF Library -->
            <script type="module">
                console.log('[EmbedPDF] Démarrage...');
                
                const pdfUrl = '<?php echo esc_js($pdf_url); ?>';
                console.log('[EmbedPDF] URL du PDF:', pdfUrl);
                
                // Vérification que l'URL n'est pas vide
                if (!pdfUrl || pdfUrl.trim() === '') {
                    console.error('[EmbedPDF] ERREUR: URL du PDF vide');
                    document.getElementById('loading').innerHTML = 'Aucune URL de PDF configurée.<br><small>Configurez l\'URL dans Apparence > Personnaliser</small>';
                } else {
                    try {
                        // Import EmbedPDF depuis le CDN
                        const { default: EmbedPDF } = await import('https://cdn.jsdelivr.net/npm/@embedpdf/snippet@2/dist/embedpdf.js');
                        
                        console.log('[EmbedPDF] Bibliothèque chargée');
                        
                        // Masquer le message de chargement
                        const loadingEl = document.getElementById('loading');
                        if (loadingEl) {
                            loadingEl.style.display = 'none';
                        }
                        
                        // Initialisation du viewer (super simple !)
                        const viewer = EmbedPDF.init({
                            type: 'container',
                            target: document.getElementById('pdf-viewer'),
                            src: pdfUrl
                        });
                        
                        console.log('[EmbedPDF] Viewer initialisé avec succès');
                        
                    } catch (error) {
                        console.error('[EmbedPDF] Erreur lors du chargement:', error);
                        document.getElementById('loading').innerHTML = 'Erreur: Impossible de charger EmbedPDF.<br><small>' + error.message + '</small><br><br><a href="' + pdfUrl + '" target="_blank" style="color: #fff; text-decoration: underline;">Ouvrir le PDF directement</a>';
                    }
                }
            </script>

        <?php else : ?>
            <div class="no-pdf">
                <p>Aucun PDF configuré.<br>Ajoutez l'URL dans Apparence > Personnaliser > Page Rapport Annuel</p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>