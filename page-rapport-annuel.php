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
            display: flex;
            flex-direction: column;
        }

        /* Container du canvas PDF */
        .pdf-container {
            flex: 1;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        /* Canvas PDF */
        #pdf-canvas {
            max-width: 100%;
            height: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        /* Contrôles de navigation */
        .pdf-controls {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            padding: 10px 20px;
            border-radius: 30px;
            display: flex;
            gap: 15px;
            align-items: center;
            z-index: 9998;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .pdf-controls button {
            background: #fff;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .pdf-controls button:hover:not(:disabled) {
            background: #f0f0f0;
            transform: scale(1.1);
        }

        .pdf-controls button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .pdf-controls .page-info {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            min-width: 80px;
            text-align: center;
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

            .pdf-container {
                padding: 10px;
            }

            .pdf-controls {
                bottom: 10px;
                padding: 8px 15px;
                gap: 10px;
            }

            .pdf-controls button {
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .pdf-controls .page-info {
                font-size: 12px;
                min-width: 60px;
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
        <?php
        $pdf_url = get_theme_mod('rapport_pdf_url', '');
        if ($pdf_url) : ?>
            
            <!-- Message de chargement -->
            <div class="loading-message" id="loading">
                Chargement du PDF
            </div>

            <!-- Container du canvas -->
            <div class="pdf-container" id="pdf-container" style="display: none;">
                <canvas id="pdf-canvas"></canvas>
            </div>

            <!-- Contrôles de navigation -->
            <div class="pdf-controls" id="pdf-controls" style="display: none;">
                <button id="prev-page" title="Page précédente">◀</button>
                <span class="page-info">
                    <span id="page-num">1</span> / <span id="page-count">-</span>
                </span>
                <button id="next-page" title="Page suivante">▶</button>
            </div>

            <!-- PDF.js Library (version classique, plus compatible) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
            
            <script>
                // Attendre que PDF.js soit complètement chargé
                window.addEventListener('load', function() {
                    // Vérifier que pdfjsLib existe
                    if (typeof pdfjsLib === 'undefined') {
                        console.error('[PDF] ERREUR: PDF.js n\'a pas pu être chargé depuis le CDN');
                        document.getElementById('loading').innerHTML = 'Erreur: Impossible de charger la bibliothèque PDF.<br><small>Vérifiez votre connexion internet.</small>';
                        return;
                    }

                    console.log('[PDF] Démarrage du script PDF.js (version classique)');
                    
                    // Configuration du worker
                    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
                    console.log('[PDF] Worker configuré');

                    // Variables globales
                    let pdfDoc = null;
                    let pageNum = 1;
                    let pageRendering = false;
                    let pageNumPending = null;
                    let scale = 1.5;

                    const canvas = document.getElementById('pdf-canvas');
                    const ctx = canvas.getContext('2d');
                    const pdfUrl = '<?php echo esc_js($pdf_url); ?>';
                    
                    console.log('[PDF] URL du PDF:', pdfUrl);
                    
                    // Vérification que l'URL n'est pas vide
                    if (!pdfUrl || pdfUrl.trim() === '') {
                        console.error('[PDF] ERREUR: URL du PDF vide');
                        document.getElementById('loading').innerHTML = 'Aucune URL de PDF configurée.<br><small>Configurez l\'URL dans Apparence > Personnaliser</small>';
                        return;
                    }
                    
                    // Éléments DOM
                    const loading = document.getElementById('loading');
                    const container = document.getElementById('pdf-container');
                    const controls = document.getElementById('pdf-controls');
                    const pageNumDisplay = document.getElementById('page-num');
                    const pageCountDisplay = document.getElementById('page-count');
                    const prevButton = document.getElementById('prev-page');
                    const nextButton = document.getElementById('next-page');

                    /**
                     * Affiche une page spécifique du PDF
                     */
                    function renderPage(num) {
                        pageRendering = true;
                        console.log('[PDF] Rendu de la page', num);
                        
                        pdfDoc.getPage(num).then(function(page) {
                            // Ajuste le scale selon la largeur de l'écran
                            const viewport = page.getViewport({ scale: 1 });
                            const containerWidth = container.clientWidth - 40;
                            scale = containerWidth / viewport.width;
                            
                            const scaledViewport = page.getViewport({ scale: scale });
                            canvas.height = scaledViewport.height;
                            canvas.width = scaledViewport.width;

                            const renderContext = {
                                canvasContext: ctx,
                                viewport: scaledViewport
                            };

                            const renderTask = page.render(renderContext);

                            renderTask.promise.then(function() {
                                pageRendering = false;
                                console.log('[PDF] Page', num, 'rendue avec succès');
                                if (pageNumPending !== null) {
                                    renderPage(pageNumPending);
                                    pageNumPending = null;
                                }
                            });
                        });

                        pageNumDisplay.textContent = num;
                        updateButtons();
                    }

                    function queueRenderPage(num) {
                        if (pageRendering) {
                            pageNumPending = num;
                        } else {
                            renderPage(num);
                        }
                    }

                    function onPrevPage() {
                        if (pageNum <= 1) return;
                        pageNum--;
                        queueRenderPage(pageNum);
                    }

                    function onNextPage() {
                        if (pageNum >= pdfDoc.numPages) return;
                        pageNum++;
                        queueRenderPage(pageNum);
                    }

                    function updateButtons() {
                        prevButton.disabled = pageNum <= 1;
                        nextButton.disabled = pageNum >= pdfDoc.numPages;
                    }

                    // Événements
                    prevButton.addEventListener('click', onPrevPage);
                    nextButton.addEventListener('click', onNextPage);

                    // Support du swipe sur mobile
                    let touchStartX = 0;
                    let touchEndX = 0;

                    canvas.addEventListener('touchstart', (e) => {
                        touchStartX = e.changedTouches[0].screenX;
                    });

                    canvas.addEventListener('touchend', (e) => {
                        touchEndX = e.changedTouches[0].screenX;
                        handleSwipe();
                    });

                    function handleSwipe() {
                        if (touchEndX < touchStartX - 50) {
                            onNextPage();
                        }
                        if (touchEndX > touchStartX + 50) {
                            onPrevPage();
                        }
                    }

                    // Support des flèches clavier
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'ArrowLeft') onPrevPage();
                        if (e.key === 'ArrowRight') onNextPage();
                    });

                    // Chargement du PDF
                    console.log('[PDF] Début du chargement...');
                    
                    const loadingTask = pdfjsLib.getDocument({
                        url: pdfUrl,
                        cMapUrl: 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/cmaps/',
                        cMapPacked: true
                    });
                    
                    loadingTask.promise.then(function(pdf) {
                        console.log('[PDF] PDF chargé avec succès!');
                        console.log('[PDF] Nombre de pages:', pdf.numPages);
                        
                        pdfDoc = pdf;
                        pageCountDisplay.textContent = pdf.numPages;

                        loading.style.display = 'none';
                        container.style.display = 'flex';
                        controls.style.display = 'flex';

                        renderPage(pageNum);
                    }).catch(function(error) {
                        console.error('[PDF] ERREUR lors du chargement:', error);
                        loading.innerHTML = 'Erreur de chargement du PDF.<br><small>' + error.message + '</small><br><br><a href="' + pdfUrl + '" target="_blank" style="color: #fff; text-decoration: underline;">Ouvrir le PDF directement</a>';
                    });

                    // Recalcul du rendu lors du redimensionnement
                    let resizeTimeout;
                    window.addEventListener('resize', () => {
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(() => {
                            if (pdfDoc) {
                                renderPage(pageNum);
                            }
                        }, 250);
                    });
                });
            </script>

        <?php else : ?>
            <div class="no-pdf">
                <p>Aucun PDF configuré.<br>Ajoutez l'URL dans Apparence > Personnaliser > Page Rapport Annuel</p>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>