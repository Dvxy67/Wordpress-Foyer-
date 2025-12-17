<?php
/*
Template Name: Page Quartiers - Harmonisée
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Quartiers</title>

    <style>
        /* CSS HARMONISÉ - Page Quartiers Mobile-First */

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
        .quartiers-page {
            min-height: 100dvh;
            background: linear-gradient(135deg, #7391ff 0%, #5b7ae6 50%, #7391ff 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
        }

        /* Container principal pour équilibrer l'espace - AJOUTÉ ! */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100dvh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Container de la grille */
        .quartiers-container {
            background: #e9d16f;
            border-radius: 25px;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100dvh - 120px);
            max-height: 585px;
            min-height: 505px;
            padding: 15px 15px 0 15px;
            margin-top: 20px;
            margin-bottom: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Section titre avec immeuble - OPTIMISÉE */
        .titre-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0px;
            gap: 12px;
            min-height: 60px;
            flex-shrink: 0;
        }

        /* Image d'immeuble - RÉDUITE */
        .immeuble-icon {
            width: 80px;
            height: 80px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .immeuble-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .immeuble-icon .emoji-fallback {
            font-size: 40px;
            line-height: 1;
        }

        /* Titre "J'HABITE À" - RÉDUIT */
        .titre-text {
            font-size: 22px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Zone scrollable - OPTIMISÉE */
        .quartiers-scroll {
            flex: 1;
            background: #FFFFFF;
            border-radius: 0px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #CCCCCC #F0F0F0;
        }

        /* Scrollbar pour Chrome/Safari */
        .quartiers-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .quartiers-scroll::-webkit-scrollbar-track {
            background: #F0F0F0;
        }

        .quartiers-scroll::-webkit-scrollbar-thumb {
            background: #CCCCCC;
            border-radius: 4px;
        }

        .quartiers-scroll::-webkit-scrollbar-thumb:hover {
            background: #AAAAAA;
        }

        /* Liste des quartiers */
        .quartiers-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Item de quartier - TYPOGRAPHIE IDENTIQUE À HABITANTS */
        .quartier-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 15px;
            font-size: 22px !important;
            font-weight: 500;
            /* ← MODIF : bold → 500 (comme habitants) */
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            /* ← MODIF : none → underline (comme habitants) */
            text-decoration-thickness: 1.5px;
            /* ← AJOUT : comme habitants */
            text-underline-offset: 2px;
            /* ← AJOUT : comme habitants */
            line-height: 1.1;
            /* ← AJOUT : comme habitants */
            letter-spacing: 0.5px;
            /* ← AJOUT : comme habitants */
            border-bottom: 2px solid #ebecf4;
            background: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.2s ease;
            min-height: 45px;
        }

        /* Hover normal */
        .quartier-item:hover {
            background-color: #F8F8F8;
        }

        /* SÉLECTIONNÉ - Bleu au clic */
        .quartier-item.selected {
            background-color: #7391ff !important;
            color: #FFFFFF !important;
        }

        .quartier-item.selected:hover {
            background-color: #5b7ae6 !important;
        }

        /* Dernier quartier sans bordure */
        .quartier-item:last-child {
            border-bottom: none;
        }

        /* Section bouton retour - IDENTIQUE À LOGEMENT */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 118px;
            /* ← MODIF : 70px → 118px */
            flex-shrink: 0;
            width: 100%;
            /* ← AJOUT : pour correspondre à logement */
        }

        .retour-button {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Centré maintenant */
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
        }

        .retour-button:hover {
            transform: scale(1.05);
        }

        /* Flèche/Image de retour - IDENTIQUE À LOGEMENT */
        .arrow {
            width: 90px;
            /* ← MODIF : 80px → 90px */
            height: 90px;
            /* ← MODIF : 80px → 90px */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .arrow img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .arrow .emoji-fallback {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

        /* Texte retour - HARMONISÉ */
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
            .quartiers-page {
                padding: 20px;
            }

            .main-container {
                height: calc(100vh - 40px);
                /* ← AJOUT : comme logement */
            }

            .quartiers-container {
                max-width: 400px;
                /* ← MODIF : 380px → 400px */
                min-height: 560px;
                /* ← AJOUT : comme logement */
                max-height: 660px;
                /* ← AJOUT : comme logement */
                border: 6px solid #000000;
                padding: 20px;
            }

            .titre-section {
                margin-bottom: 20px;
                gap: 15px;
                min-height: 80px;
            }

            .immeuble-icon {
                width: 70px;
                height: 70px;
            }

            .immeuble-icon .emoji-fallback {
                font-size: 56px;
            }

            .titre-text {
                font-size: 22px;
            }

            .quartier-item {
                padding: 16px 20px;
                font-size: 16px !important;
                min-height: 55px;
            }

            .arrow {
                width: 100px;
                height: 100px;
            }

            .arrow .emoji-fallback {
                font-size: 50px;
            }

            .retour-text {
                font-size: 18px;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        /* Exclure quartier-item et quartiers-container du reset */
        .quartiers-page *:not(.quartier-item):not(.quartiers-container) {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles - TOUT DOIT ÊTRE ICI */
        .quartiers-container {
            border: 3px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        /* Bordure des items - avec sélecteur plus spécifique */
        .quartiers-page .quartiers-list .quartier-item {
            border-bottom: 2px solid #ebecf4 !important;
        }

        .quartiers-page .quartiers-list li:last-child .quartier-item {
            border-bottom: none !important;
        }

        @media (min-width: 481px) {
            .quartiers-container {
                border: 6px solid #000000 !important;
            }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="quartiers-page">
        <div class="main-container">
            <div class="quartiers-container">

                <!-- Section titre avec immeuble -->
                <div class="titre-section">
                    <div class="immeuble-icon">
                        <?php
                        $image_immeuble = get_theme_mod('quartiers_image_immeuble');
                        if ($image_immeuble) : ?>
                            <img src="<?php echo esc_url($image_immeuble); ?>" alt="Immeuble">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Immeuble">🏢</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="titre-text">J'HABITE À</h1>
                </div>

                <!-- Zone scrollable des quartiers -->
                <div class="quartiers-scroll">
                    <ul class="quartiers-list">
                        <?php
                        // Récupérer la liste des quartiers et des liens
                        $quartiers       = get_quartiers_list();
                        $quartiers_liens = function_exists('get_quartiers_links') ? get_quartiers_links() : array();

                        if (! empty($quartiers)) :
                            foreach ($quartiers as $index => $quartier) :
                                // Lien correspondant (même index que dans la liste des quartiers)
                                $url = (isset($quartiers_liens[$index]) && $quartiers_liens[$index] !== '')
                                    ? $quartiers_liens[$index]
                                    : '#';
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($url); ?>"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html(strtoupper($quartier)); ?>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                        else :
                            // Quartiers par défaut (si rien n'a été configuré)
                            $default_quartiers = array(
                                'PRINS',
                                'PETERBOS',
                                'RAUTER',
                                'LA ROUE',
                                'SQUARE ALBERT',
                                'LENNIK',
                                'BON AIR',
                                'GOUJONS',
                                'DAUPHINELLES',
                            );
                            foreach ($default_quartiers as $quartier) :
                            ?>
                                <li>
                                    <a href="#"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html($quartier); ?>
                                    </a>
                                </li>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Bouton retour -->
            <div class="retour-section">
                <a href="<?php echo home_url(); ?>" class="retour-button">
                    <span class="arrow">
                        <?php
                        $image_retour = get_theme_mod('quartiers_image_retour');
                        if ($image_retour) : ?>
                            <img src="<?php echo esc_url($image_retour); ?>" alt="Retour">
                        <?php else : ?>
                            <span class="emoji-fallback">←</span>
                        <?php endif; ?>
                    </span>
                    <!-- <span class="retour-text">RETOUR AU MENU</span> -->
                </a>
            </div>
        </div>
    </div>

    <script>
        // JavaScript pour la sélection des quartiers
        function selectQuartier(element) {
            // Enlever la sélection de tous les autres quartiers
            var quartiers = document.querySelectorAll('.quartier-item');
            quartiers.forEach(function(item) {
                item.classList.remove('selected');
            });

            // Ajouter la sélection à l'élément cliqué
            element.classList.add('selected');

            // Optionnel : faire quelque chose avec le quartier sélectionné
            var quartierNom = element.dataset.quartier;
            console.log('Quartier sélectionné:', quartierNom);
        }
    </script>

    <?php wp_footer(); ?>
</body>

</html>
</head>

<body <?php body_class(); ?>>

    <div class="quartiers-page">
        <div class="main-container">
            <div class="quartiers-container">

                <!-- Section titre avec immeuble -->
                <div class="titre-section">
                    <div class="immeuble-icon">
                        <?php
                        $image_immeuble = get_theme_mod('quartiers_image_immeuble');
                        if ($image_immeuble) : ?>
                            <img src="<?php echo esc_url($image_immeuble); ?>" alt="Immeuble">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Immeuble">🏢</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="titre-text">J'HABITE À</h1>
                </div>

                <!-- Zone scrollable des quartiers -->
                <div class="quartiers-scroll">
                    <ul class="quartiers-list">
                        <?php
                        // Récupérer la liste des quartiers et des liens
                        $quartiers       = get_quartiers_list();
                        $quartiers_liens = function_exists('get_quartiers_links') ? get_quartiers_links() : array();

                        if (! empty($quartiers)) :
                            foreach ($quartiers as $index => $quartier) :
                                // Lien correspondant (même index que dans la liste des quartiers)
                                $url = (isset($quartiers_liens[$index]) && $quartiers_liens[$index] !== '')
                                    ? $quartiers_liens[$index]
                                    : '#';
                        ?>
                                <li>
                                    <a href="<?php echo esc_url($url); ?>"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html(strtoupper($quartier)); ?>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                        else :
                            // Quartiers par défaut (si rien n'a été configuré)
                            $default_quartiers = array(
                                'PRINS',
                                'PETERBOS',
                                'RAUTER',
                                'LA ROUE',
                                'SQUARE ALBERT',
                                'LENNIK',
                                'BON AIR',
                                'GOUJONS',
                                'DAUPHINELLES',
                            );
                            foreach ($default_quartiers as $quartier) :
                            ?>
                                <li>
                                    <a href="#"
                                        class="quartier-item"
                                        data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>">
                                        <?php echo esc_html($quartier); ?>
                                    </a>
                                </li>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Bouton retour -->
            <div class="retour-section">
                <a href="<?php echo home_url(); ?>" class="retour-button">
                    <span class="arrow">
                        <?php
                        $image_retour = get_theme_mod('quartiers_image_retour');
                        if ($image_retour) : ?>
                            <img src="<?php echo esc_url($image_retour); ?>" alt="Retour">
                        <?php else : ?>
                            <span class="emoji-fallback">←</span>
                        <?php endif; ?>
                    </span>
                    <!-- <span class="retour-text">RETOUR AU MENU</span> -->
                </a>
            </div>
        </div>
    </div>

    <script>
        // JavaScript pour la sélection des quartiers
        function selectQuartier(element) {
            // Enlever la sélection de tous les autres quartiers
            var quartiers = document.querySelectorAll('.quartier-item');
            quartiers.forEach(function(item) {
                item.classList.remove('selected');
            });

            // Ajouter la sélection à l'élément cliqué
            element.classList.add('selected');

            // Optionnel : faire quelque chose avec le quartier sélectionné
            var quartierNom = element.dataset.quartier;
            console.log('Quartier sélectionné:', quartierNom);
        }
    </script>

    <?php wp_footer(); ?>
</body>

</html>