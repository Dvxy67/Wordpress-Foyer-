<?php
/*
Template Name: Services Habitants - Contrôle CSS Direct
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services pour les habitants</title>

    <style>
        /* Import Google Fonts - Rubik */
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600;700;800;900&display=swap');

        /* MOBILE FIRST CSS - Utilisation maximale de l'espace écran */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Rubik', sans-serif;
            font-weight: 500;
            overflow-x: hidden;
        }

        /* ICÔNE 1 : LES PANNES */
        .icon-pannes img {
            width: 65px;
            height: 65px;
            transform: rotate(17deg);
        }

        /* ICÔNE 2 : LE CONCIERGE */
        .icon-concierge img {
            width: 75px;
            height: 75px;
            transform: rotate(0deg);
        }

        /* ICÔNE 3 : LES POMPIERS */
        .icon-pompiers img {
            width: 80px;
            height: 80px;
            transform: rotate(0deg);
        }

        /* ICÔNE 4 : BRUXELLES PROPRETÉ */
        .icon-proprete img {
            width: 65px;
            height: 65px;
        }

        /* ICÔNE 5 : L'ASSISTANT SOCIAL */
        .icon-assistant img {
            width: 85px;
            height: 85px;
        }

        /* ICÔNE 6 : LE RÈGLEMENT */
        .icon-reglement img {
            width: 55px;
            height: 55px;
        }

        /* ICÔNE 7 : AIDE PSYCHOLOGIQUE */
        .icon-psychologique img {
            width: 75px;
            height: 75px;
        }

        /* ICÔNE 8 : L'ENTRETIEN DU LOGEMENT */
        .icon-entretien img {
            width: 78px;
            height: 78px;
        }

        /* === STYLES MOBILE PAR DÉFAUT === */
        .habitants-page {
            min-height: 100dvh;
            background: #6b92ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 8px;
            position: relative;
        }

        /* Container principal optimisé */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100dvh - 16px);
            width: 100%;
            max-width: 100%;
        }

        /* Grille principale - RÉDUIT DE 30PX */
        .services-grid {
            background: #eed05d;
            border: 3px solid #000000;
            border-radius: 25px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: repeat(4, 1fr);
            gap: 0;
            width: calc(100% - 16px);
            max-width: 370px;
            height: calc(100dvh - 150px);
            /* ← MODIF : 120px → 150px (30px plus petit) */
            min-height: 505px;
            max-height: 585px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        /* Item de service - DIMENSIONS HARMONISÉES */
        .service-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 6px 6px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s ease;
            text-decoration: none;
            color: inherit;
        }

        .service-item:active {
            transform: scale(0.97);
        }

        /* Zone icône - TAILLE HARMONISÉE FIXE */
        .service-icon {
            width: 70px;
            height: 70px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Images uploadées - Style de base */
        .service-icon img {
            object-fit: contain;
            transition: transform 0.2s ease;
        }

        /* Supprimer le carré bleu/jaune sur les items de service */
        .service-item,
        .service-item img,
        .service-icon,
        .service-icon img {
            outline: none !important;
            -webkit-tap-highlight-color: transparent !important;
            -webkit-touch-callout: none;
            user-select: none;
        }

        .service-item:focus,
        .service-item:active,
        .service-item img:focus,
        .service-item img:active {
            outline: none !important;
            box-shadow: none !important;
        }

        .service-item:focus:not(:focus-visible) {
            outline: none !important;
        }

        /* Style émojis en fallback */
        .service-icon .emoji-fallback {
            font-size: 58px;
            line-height: 1;
        }

        /* Titre de service - TAILLE HARMONISÉE */
        .service-title {
            font-size: 15px !important;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            line-height: 1.1;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
            letter-spacing: 0.5px;
            text-align: center;
            word-break: break-word;
        }

        /* Section bouton retour - IDENTIQUE À PAGE LOGEMENT */
        .retour-section {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 118px;
            /* ← IDENTIQUE à page logement */
        }

        .retour-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #000;
            transition: transform 0.2s ease;
            padding: 10px 15px;
            border-radius: 10px;
            touch-action: manipulation;
        }

        .retour-button:active {
            transform: scale(0.95);
        }

        /* Flèche de retour - TAILLE HARMONISÉE */
        .arrow {
            font-size: 45px;
            font-weight: 500;
            color: #000;
            line-height: 1;
        }

        /* Image de la flèche retour (si uploadée) */
        .arrow-image {
            width: 90px;
            height: 90px;
            object-fit: contain;
        }

        /* Texte retour homepage - TAILLE HARMONISÉE */
        .retour-text {
            font-size: 16px;
            font-weight: 500;
            color: #000;
            text-transform: uppercase;
            text-decoration: underline;
            text-decoration-thickness: 1.5px;
            text-underline-offset: 2px;
            letter-spacing: 0.5px;
        }

        /* Supprimer le carré bleu sur les boutons retour */

        .retour-button,
        .retour-button img,
        .arrow-image {
            outline: none;
            -webkit-tap-highlight-color: transparent;
            /* Pour Safari/iOS */
        }

        /* Supprimer le focus au clic mais le garder au clavier */
        .retour-button:focus:not(:focus-visible),
        .retour-button img:focus:not(:focus-visible) {
            outline: none;
        }

        /* Garder un focus accessible au clavier (optionnel) */
        .retour-button:focus-visible {
            outline: 2px solid rgba(0, 0, 0, 0.3);
            outline-offset: 3px;
            border-radius: 8px;
        }


        /* Animation d'entrée */
        @keyframes slideInMobile {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .services-grid {
            animation: slideInMobile 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .retour-section {
            animation: slideInMobile 0.6s cubic-bezier(0.4, 0, 0.2, 1) 0.2s both;
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="habitants-page">
        <div class="main-container">
            <!-- Grille des services -->
            <div class="services-grid">
                <!-- Ligne 1 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_pannes', '/pannes')); ?>" class="service-item" role="button" aria-label="Accéder au service Les Pannes">
                    <div class="service-icon icon-pannes">
                        <?php
                        $image_pannes = get_theme_mod('habitants_image_pannes');
                        if ($image_pannes) : ?>
                            <img src="<?php echo esc_url($image_pannes); ?>" alt="Les Pannes">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Outil">🔧</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_pannes', 'LES PANNES'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_concierge', '/concierge')); ?>" class="service-item" role="button" aria-label="Accéder au service Le Concierge">
                    <div class="service-icon icon-concierge">
                        <?php
                        $image_concierge = get_theme_mod('habitants_image_concierge');
                        if ($image_concierge) : ?>
                            <img src="<?php echo esc_url($image_concierge); ?>" alt="Le Concierge">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Concierge">👤🗝️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_concierge', 'LE CONCIERGE'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 2 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_pompiers', 'tel:112')); ?>" class="service-item" role="button" aria-label="Accéder au service Les Pompiers">
                    <div class="service-icon icon-pompiers">
                        <?php
                        $image_pompiers = get_theme_mod('habitants_image_pompiers');
                        if ($image_pompiers) : ?>
                            <img src="<?php echo esc_url($image_pompiers); ?>" alt="Les Pompiers">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Camion de pompiers">🚒</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_pompiers', 'LES POMPIERS'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_proprete', 'https://www.arp-gan.be')); ?>" class="service-item" role="button" aria-label="Accéder au service Bruxelles Propreté">
                    <div class="service-icon icon-proprete">
                        <?php
                        $image_proprete = get_theme_mod('habitants_image_proprete');
                        if ($image_proprete) : ?>
                            <img src="<?php echo esc_url($image_proprete); ?>" alt="Bruxelles Propreté">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Recyclage">🗑️♻️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_proprete', 'BRUXELLES<br>PROPRETÉ'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 3 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_assistant', '/assistant-social')); ?>" class="service-item" role="button" aria-label="Accéder au service Assistant Social">
                    <div class="service-icon icon-assistant">
                        <?php
                        $image_assistant = get_theme_mod('habitants_image_assistant');
                        if ($image_assistant) : ?>
                            <img src="<?php echo esc_url($image_assistant); ?>" alt="Assistant Social">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Assistant social">👤📄</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_assistant', 'L\'ASSISTANT<br>SOCIAL'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_reglement', '/reglement')); ?>" class="service-item" role="button" aria-label="Accéder au service Le Règlement">
                    <div class="service-icon icon-reglement">
                        <?php
                        $image_reglement = get_theme_mod('habitants_image_reglement');
                        if ($image_reglement) : ?>
                            <img src="<?php echo esc_url($image_reglement); ?>" alt="Le Règlement">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Document validé">📄✅</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_reglement', 'LE RÈGLEMENT'), array('br' => array())); ?></div>
                </a>

                <!-- Ligne 4 -->
                <a href="<?php echo esc_url(get_theme_mod('habitants_url_psychologique', '/aide-psychologique')); ?>" class="service-item" role="button" aria-label="Accéder au service Aide Psychologique">
                    <div class="service-icon icon-psychologique">
                        <?php
                        $image_psychologique = get_theme_mod('habitants_image_psychologique');
                        if ($image_psychologique) : ?>
                            <img src="<?php echo esc_url($image_psychologique); ?>" alt="Aide Psychologique">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Support psychologique">💬❤️</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_psychologique', 'AIDE<br>PSYCHOLOGIQUE'), array('br' => array())); ?></div>
                </a>

                <a href="<?php echo esc_url(get_theme_mod('habitants_url_entretien', '/entretien-logement')); ?>" class="service-item" role="button" aria-label="Accéder au service Entretien du Logement">
                    <div class="service-icon icon-entretien">
                        <?php
                        $image_entretien = get_theme_mod('habitants_image_entretien');
                        if ($image_entretien) : ?>
                            <img src="<?php echo esc_url($image_entretien); ?>" alt="Entretien du Logement">
                        <?php else : ?>
                            <span class="emoji-fallback" role="img" aria-label="Manuel d'entretien">📖🔧</span>
                        <?php endif; ?>
                    </div>
                    <div class="service-title"><?php echo wp_kses(get_theme_mod('habitants_nom_entretien', 'L\'ENTRETIEN<br>DU LOGEMENT'), array('br' => array())); ?></div>
                </a>
            </div>

            <!-- Bouton retour - IDENTIQUE À PAGE LOGEMENT (sans texte) -->
            <div class="retour-section">
                <a href="<?php echo esc_url(get_theme_mod('habitants_retour_url', home_url())); ?>" class="retour-button" role="button" aria-label="Retour à la page d'accueil">
                    <?php
                    $arrow_image = get_theme_mod('habitants_retour_image');
                    if ($arrow_image) : ?>
                        <img src="<?php echo esc_url($arrow_image); ?>" alt="Retour" class="arrow-image" aria-hidden="true">
                    <?php else : ?>
                        <span class="arrow" aria-hidden="true">←</span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>

</html>