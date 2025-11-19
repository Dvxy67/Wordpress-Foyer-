<?php
/*
Template Name: Page Quartiers - Scroll + Sélection
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Quartiers</title>
    
    <style>
        /* CSS FINAL - Scroll + Sélection au clic */
        
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
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container de la grille */
        .quartiers-container {
            background: #F4D03F;
            border: 6px solid #000000;
            border-radius: 25px;
            width: 100%;
            max-width: 380px;
            height: 550px;
            padding: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        /* Section titre avec immeuble */
        .titre-section {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            gap: 15px;
            min-height: 80px;
        }

        /* Image d'immeuble */
        .immeuble-icon {
            width: 70px;
            height: 70px;
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
            font-size: 56px;
            line-height: 1;
        }

        /* Titre "J'HABITE À" */
        .titre-text {
            font-size: 22px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Zone scrollable - MAINTENUE ! */
        .quartiers-scroll {
            flex: 1;
            background: #FFFFFF;
            border-radius: 10px;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: #CCCCCC #F0F0F0;
        }

        /* Scrollbar pour Chrome/Safari */
        .quartiers-scroll::-webkit-scrollbar {
            width: 8px;
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

        /* Item de quartier - TOUS BLANCS par défaut */
        .quartier-item {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-decoration: none;
            border-bottom: 1px solid #E5E5E5;
            background: #FFFFFF;
            cursor: pointer;
            transition: background-color 0.2s ease;
            min-height: 55px;
        }

        /* Hover normal */
        .quartier-item:hover {
            background-color: #F8F8F8;
        }

        /* SÉLECTIONNÉ - Bleu au clic */
        .quartier-item.selected {
            background-color: #3498DB !important;
            color: #FFFFFF !important;
        }

        .quartier-item.selected:hover {
            background-color: #2980B9 !important;
        }

        /* Dernier quartier sans bordure */
        .quartier-item:last-child {
            border-bottom: none;
        }

        /* Section bouton retour */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
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
        }

        /* Flèche de retour */
        .arrow {
            font-size: 50px;
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
            .quartiers-page {
                padding: 15px;
            }
            
            .quartiers-container {
                max-width: 320px;
                height: 450px;
                padding: 10px;
                border: 4px solid #000000;
            }
            
            .titre-section {
                gap: 10px;
                margin-bottom: 15px;
                min-height: 60px;
            }
            
            .immeuble-icon {
                width: 50px;
                height: 50px;
            }
            
            .immeuble-icon .emoji-fallback {
                font-size: 40px;
            }
            
            .titre-text {
                font-size: 16px;
            }
            
            .quartier-item {
                padding: 12px 15px;
                font-size: 14px;
                min-height: 45px;
            }
            
            .arrow {
                font-size: 35px;
            }
            
            .retour-text {
                font-size: 14px;
            }
        }

        /* RESET pour éviter les interférences CSS du thème */
        .quartiers-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Exceptions pour nos styles */
        .quartiers-container {
            border: 6px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        .quartier-item {
            border-bottom: 1px solid #E5E5E5 !important;
        }

        .quartier-item:last-child {
            border-bottom: none !important;
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="quartiers-page">
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
                // Récupérer la liste des quartiers
                $quartiers = get_quartiers_list();
                
                if (!empty($quartiers)) :
                    foreach ($quartiers as $quartier) :
                ?>
                    <li>
                        <a href="#" 
                           class="quartier-item" 
                           data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>"
                           onclick="selectQuartier(this); return false;">
                            <?php echo esc_html(strtoupper($quartier)); ?>
                        </a>
                    </li>
                <?php
                    endforeach;
                else :
                    // Quartiers par défaut
                    $default_quartiers = ['PRINS', 'PETERBOS', 'RAUTER', 'LA ROUE', 'SQUARE ALBERT', 'LENNIK', 'BON AIR', 'GOUJONS', 'DAUPHINELLES'];
                    foreach ($default_quartiers as $quartier) :
                ?>
                    <li>
                        <a href="#" 
                           class="quartier-item" 
                           data-quartier="<?php echo esc_attr(strtolower($quartier)); ?>"
                           onclick="selectQuartier(this); return false;">
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
            <span class="arrow">←</span>
            <span class="retour-text">RETOUR AU MENU</span>
        </a>
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