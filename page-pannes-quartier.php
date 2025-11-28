<?php
/*
Template Name: Pannes Quartier - Dynamique
*/

// Détecter le quartier depuis le slug de la page
$page_slug = get_post_field('post_name', get_post());
$quartier = '';

// Extraire le nom du quartier depuis le slug (ex: "pannes-prins" -> "prins")
if (strpos($page_slug, 'pannes-') === 0) {
    $quartier = str_replace('pannes-', '', $page_slug);
} else {
    $quartier = 'default';
}

// Convertir en format lisible (ex: "prins" -> "Prins")
$quartier_display = ucfirst($quartier);

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannes - <?php echo esc_html($quartier_display); ?></title>
    
    <style>
        /* CSS identique à la page pannes normale */
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

        .pannes-page {
            min-height: 100vh;
            background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 50%, #9370DB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
        }

        .pannes-container {
            background: #F4D03F;
            border: 4px solid #000000;
            border-radius: 25px;
            width: 100%;
            max-width: 340px;
            height: calc(100vh - 100px);
            max-height: 500px;
            min-height: 420px;
            padding: 20px 15px 15px 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
        }

        .pannes-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-shrink: 0;
            min-height: 60px;
        }

        .tools-icon {
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tools-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .tools-icon .emoji-fallback {
            font-size: 40px;
            line-height: 1;
        }

        .pannes-title {
            font-size: 18px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-align: center;
            line-height: 1.2;
        }

        .pannes-grid-container {
            background: #E8E8E8;
            border-radius: 15px;
            padding: 20px 15px;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pannes-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr 1fr;
            gap: 25px;
            width: 100%;
            max-width: 280px;
            height: 100%;
            max-height: 280px;
        }

        .panne-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            cursor: pointer;
            padding: 10px;
        }

        .panne-item:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        .panne-icon {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 8px;
        }

        .panne-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .panne-icon .emoji-fallback {
            font-size: 50px;
            line-height: 1;
        }

        .panne-text {
            font-size: 14px;
            font-weight: bold;
            color: #000;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            letter-spacing: 0.5px;
        }

        /* Affichage numéro téléphone */
        .panne-phone {
            text-align: center;
            animation: slideIn 0.3s ease;
        }

        .panne-phone .phone-number {
            font-size: 16px;
            font-weight: bold;
            color: #000;
            margin-bottom: 4px;
            letter-spacing: 1px;
        }

        .panne-phone .phone-instruction {
            font-size: 10px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            animation: pulse 1.5s infinite;
        }

        /* Animation slide in */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation pulse pour instruction */
        @keyframes pulse {
            0%, 100% {
                opacity: 0.6;
            }
            50% {
                opacity: 1;
            }
        }

        /* État clicked */
        .panne-item.clicked {
            background-color: #f0f0f0;
            transform: scale(0.98);
        }

        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 60px;
            flex-shrink: 0;
        }

        .retour-button {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
        }

        .retour-button:hover {
            transform: scale(1.05);
            text-decoration: none;
            color: #000;
        }

        .arrow {
            font-size: 40px;
            font-weight: bold;
            color: #000;
            line-height: 1;
        }

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
            .pannes-page {
                padding: 20px;
            }
            
            .pannes-container {
                max-width: 380px;
                min-height: 580px;
                padding: 30px 25px 20px 25px;
                border: 6px solid #000000;
            }
            
            .pannes-header {
                margin-bottom: 25px;
                min-height: 80px;
                gap: 20px;
            }
            
            .tools-icon {
                width: 70px;
                height: 70px;
            }
            
            .tools-icon .emoji-fallback {
                font-size: 56px;
            }
            
            .pannes-title {
                font-size: 20px;
            }
            
            .pannes-grid-container {
                padding: 25px 20px;
            }
            
            .pannes-grid {
                gap: 30px;
                max-width: 320px;
                max-height: 320px;
            }
            
            .panne-icon {
                width: 80px;
                height: 80px;
                margin-bottom: 12px;
            }
            
            .panne-icon .emoji-fallback {
                font-size: 64px;
            }
            
            .panne-text {
                font-size: 16px;
            }
            
            .arrow {
                font-size: 50px;
            }
            
            .retour-text {
                font-size: 18px;
            }
        }

        @media (max-width: 360px) {
            .pannes-container {
                max-width: 300px;
                padding: 15px 12px;
            }
            
            .pannes-grid {
                gap: 20px;
                max-width: 250px;
            }
            
            .panne-icon {
                width: 50px;
                height: 50px;
            }
            
            .panne-icon .emoji-fallback {
                font-size: 40px;
            }
            
            .panne-text {
                font-size: 12px;
            }
        }

        /* RESET */
        .pannes-page * {
            border: none !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .pannes-container {
            border: 4px solid #000000 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        @media (min-width: 481px) {
            .pannes-container {
                border: 6px solid #000000 !important;
            }
        }
    </style>
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="pannes-page">
    <div class="pannes-container">
        
        <!-- Header avec titre et icône -->
        <div class="pannes-header">
            <div class="tools-icon">
                <?php 
                $tools_icon = get_theme_mod("pannes_{$quartier}_tools_icon");
                if (!$tools_icon) $tools_icon = get_theme_mod('pannes_tools_icon'); // Fallback global
                if ($tools_icon) : ?>
                    <img src="<?php echo esc_url($tools_icon); ?>" alt="Outils">
                <?php else : ?>
                    <span class="emoji-fallback" role="img" aria-label="Outils">🔧</span>
                <?php endif; ?>
            </div>
            <h1 class="pannes-title">
                <?php 
                $titre = get_theme_mod("pannes_{$quartier}_title", "PANNES<br>{$quartier_display}");
                echo wp_kses($titre, array('br' => array()));
                ?>
            </h1>
        </div>
        
        <!-- Zone grise avec grille des pannes -->
        <div class="pannes-grid-container">
            <div class="pannes-grid">
                
                <!-- Panne 1 -->
                <div class="panne-item" 
                     data-telephone="<?php echo esc_attr(get_quartier_panne_telephone($quartier, 'panne1')); ?>"
                     data-url="<?php echo esc_attr(get_quartier_panne_url($quartier, 'panne1')); ?>"
                     onclick="handlePanneClick(this)">
                    <div class="panne-icon">
                        <?php 
                        $icon = get_theme_mod("pannes_{$quartier}_icon_panne1");
                        if (!$icon) $icon = get_theme_mod('pannes_icon_panne1'); // Fallback global
                        if ($icon) : ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="Panne 1">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Panne 1">🔧</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php 
                        $text = get_theme_mod("pannes_{$quartier}_text_panne1");
                        if (!$text) $text = get_theme_mod('pannes_text_panne1', 'CHAUFFAGE'); // Fallback global
                        echo esc_html($text);
                        ?>
                    </div>
                    <div class="panne-phone" style="display: none;">
                        <div class="phone-number"></div>
                        <div class="phone-instruction">Cliquez pour appeler</div>
                    </div>
                </div>
                
                <!-- Panne 2 -->
                <div class="panne-item" 
                     data-telephone="<?php echo esc_attr(get_quartier_panne_telephone($quartier, 'panne2')); ?>"
                     data-url="<?php echo esc_attr(get_quartier_panne_url($quartier, 'panne2')); ?>"
                     onclick="handlePanneClick(this)">
                    <div class="panne-icon">
                        <?php 
                        $icon = get_theme_mod("pannes_{$quartier}_icon_panne2");
                        if (!$icon) $icon = get_theme_mod('pannes_icon_panne2'); // Fallback global
                        if ($icon) : ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="Panne 2">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Panne 2">⚙️</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php 
                        $text = get_theme_mod("pannes_{$quartier}_text_panne2");
                        if (!$text) $text = get_theme_mod('pannes_text_panne2', 'ASCENSEUR'); // Fallback global
                        echo esc_html($text);
                        ?>
                    </div>
                    <div class="panne-phone" style="display: none;">
                        <div class="phone-number"></div>
                        <div class="phone-instruction">Cliquez pour appeler</div>
                    </div>
                </div>
                
                <!-- Panne 3 -->
                <div class="panne-item" 
                     data-telephone="<?php echo esc_attr(get_quartier_panne_telephone($quartier, 'panne3')); ?>"
                     data-url="<?php echo esc_attr(get_quartier_panne_url($quartier, 'panne3')); ?>"
                     onclick="handlePanneClick(this)">
                    <div class="panne-icon">
                        <?php 
                        $icon = get_theme_mod("pannes_{$quartier}_icon_panne3");
                        if (!$icon) $icon = get_theme_mod('pannes_icon_panne3'); // Fallback global
                        if ($icon) : ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="Panne 3">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Panne 3">🔩</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php 
                        $text = get_theme_mod("pannes_{$quartier}_text_panne3");
                        if (!$text) $text = get_theme_mod('pannes_text_panne3', 'TÉLÉVISION'); // Fallback global
                        echo esc_html($text);
                        ?>
                    </div>
                    <div class="panne-phone" style="display: none;">
                        <div class="phone-number"></div>
                        <div class="phone-instruction">Cliquez pour appeler</div>
                    </div>
                </div>
                
                <!-- Panne 4 -->
                <div class="panne-item" 
                     data-telephone="<?php echo esc_attr(get_quartier_panne_telephone($quartier, 'panne4')); ?>"
                     data-url="<?php echo esc_attr(get_quartier_panne_url($quartier, 'panne4')); ?>"
                     onclick="handlePanneClick(this)">
                    <div class="panne-icon">
                        <?php 
                        $icon = get_theme_mod("pannes_{$quartier}_icon_panne4");
                        if (!$icon) $icon = get_theme_mod('pannes_icon_panne4'); // Fallback global
                        if ($icon) : ?>
                            <img src="<?php echo esc_url($icon); ?>" alt="Panne 4">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Panne 4">🛠️</span>
                        <?php endif; ?>
                    </div>
                    <div class="panne-text">
                        <?php 
                        $text = get_theme_mod("pannes_{$quartier}_text_panne4");
                        if (!$text) $text = get_theme_mod('pannes_text_panne4', 'INTERNET'); // Fallback global
                        echo esc_html($text);
                        ?>
                    </div>
                    <div class="panne-phone" style="display: none;">
                        <div class="phone-number"></div>
                        <div class="phone-instruction">Cliquez pour appeler</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- Bouton retour -->
    <div class="retour-section">
        <a href="<?php echo get_theme_mod("pannes_{$quartier}_retour_url", '/quartiers'); ?>" class="retour-button">
            <span class="arrow">←</span>
            <span class="retour-text"><?php echo esc_html(get_theme_mod("pannes_{$quartier}_retour_text", 'RETOUR AUX QUARTIERS')); ?></span>
        </a>
    </div>
</div>

<script>
let clickedItems = new Map();
let resetTimers = new Map();

function handlePanneClick(element) {
    const telephone = element.getAttribute('data-telephone');
    const url = element.getAttribute('data-url');
    const itemId = element.querySelector('.panne-text').textContent;
    
    // Si pas de téléphone configuré, utilise l'URL normale
    if (!telephone || telephone === '') {
        if (url && url !== '#' && url !== '') {
            window.open(url, '_blank');
        }
        return;
    }
    
    // Si déjà cliqué une fois
    if (clickedItems.get(itemId)) {
        // Deuxième clic = appel
        window.location.href = 'tel:' + telephone;
        resetPanneItem(element, itemId);
        return;
    }
    
    // Premier clic = affichage numéro
    showPhoneNumber(element, telephone, itemId);
}

function showPhoneNumber(element, telephone, itemId) {
    // Marquer comme cliqué
    clickedItems.set(itemId, true);
    element.classList.add('clicked');
    
    // Cacher le texte original
    const originalText = element.querySelector('.panne-text');
    const phoneDisplay = element.querySelector('.panne-phone');
    const phoneNumber = element.querySelector('.phone-number');
    
    originalText.style.display = 'none';
    phoneNumber.textContent = telephone;
    phoneDisplay.style.display = 'block';
    
    // Timer de reset après 5 secondes
    const timer = setTimeout(() => {
        resetPanneItem(element, itemId);
    }, 5000);
    
    resetTimers.set(itemId, timer);
}

function resetPanneItem(element, itemId) {
    // Nettoyer les timers
    const timer = resetTimers.get(itemId);
    if (timer) {
        clearTimeout(timer);
        resetTimers.delete(itemId);
    }
    
    // Remettre à l'état initial
    clickedItems.delete(itemId);
    element.classList.remove('clicked');
    
    const originalText = element.querySelector('.panne-text');
    const phoneDisplay = element.querySelector('.panne-phone');
    
    originalText.style.display = 'block';
    phoneDisplay.style.display = 'none';
}

// Reset tous les items si on clique ailleurs
document.addEventListener('click', function(event) {
    if (!event.target.closest('.panne-item')) {
        clickedItems.forEach((value, key) => {
            const allItems = document.querySelectorAll('.panne-item');
            allItems.forEach(item => {
                const text = item.querySelector('.panne-text').textContent;
                if (text === key) {
                    resetPanneItem(item, key);
                }
            });
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>