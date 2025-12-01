<?php
/**
 * Fonctions du thème Foyer Ander Lechtois
 */

// Empêcher l'accès direct
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configuration du thème
 */
function foyer_theme_setup() {
    // Support des images à la une
    add_theme_support('post-thumbnails');
    
    // Support du titre dynamique
    add_theme_support('title-tag');
    
    // Support des formats de posts
    add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));
    
    // Support de l'éditeur de blocs
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Menus de navigation
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'foyer-theme'),
        'footer' => __('Menu Footer', 'foyer-theme'),
    ));
    
    // Tailles d'images personnalisées
    add_image_size('card-illustration', 300, 250, true);
    add_image_size('footer-logo', 120, 120, true);
}
add_action('after_setup_theme', 'foyer_theme_setup');

/**
 * Enqueue des styles et scripts
 */
function foyer_enqueue_assets() {
    // Stylesheet principal
    wp_enqueue_style(
        'foyer-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );
    
    // JavaScript pour le slider
    wp_enqueue_script(
        'foyer-slider',
        get_template_directory_uri() . '/assets/js/slider.js',
        array(),
        '1.0.0',
        true
    );
    
    // Variables pour JavaScript
    wp_localize_script('foyer-slider', 'foyerAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('foyer_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'foyer_enqueue_assets');

/**
 * Widgets et sidebars
 */
function foyer_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer Widgets', 'foyer-theme'),
        'id' => 'footer-widgets',
        'description' => __('Widgets affichés dans le footer', 'foyer-theme'),
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'foyer_widgets_init');

/**
 * ===============================
 * FONCTIONS HELPER
 * ===============================
 */

/**
 * Fonction pour récupérer les images avec fallback
 */
function get_foyer_image($type, $fallback = '') {
    // Pour le footer_logo, utiliser directement la clé
    if ($type === 'footer_logo') {
        $image = get_theme_mod('footer_logo', '');
    } else {
        $image = get_theme_mod($type . '_image', '');
    }
    
    // Si une image est définie, la retourner
    if (!empty($image)) {
        return $image;
    }
    
    // Sinon, utiliser le fallback
    if (!empty($fallback)) {
        return get_template_directory_uri() . '/assets/images/' . $fallback;
    }
    
    return false;
}

/**
 * Récupère le lien d'une carte configuré dans le customizer
 */
function get_foyer_link($link_key) {
    // Récupérer la valeur du customizer
    $link_url = get_theme_mod($link_key . '_link', '#');
    
    // Si le lien est vide ou juste #, retourner #
    if (empty($link_url) || $link_url === '#') {
        return '#';
    }
    
    return esc_url($link_url);
}

/**
 * Options de personnalisation du thème
 */
function foyer_customize_register($wp_customize) {
    // Section pour les images des cartes
    $wp_customize->add_section('foyer_cards', array(
        'title' => __('Images des Cartes', 'foyer-theme'),
        'priority' => 30,
    ));
    
    // Image habitant
    $wp_customize->add_setting('habitant_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitant_image', array(
        'label' => __('Image "Je suis habitant"', 'foyer-theme'),
        'section' => 'foyer_cards',
        'settings' => 'habitant_image',
    )));
    
    // Image logement
    $wp_customize->add_setting('logement_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logement_image', array(
        'label' => __('Image "Je cherche un logement"', 'foyer-theme'),
        'section' => 'foyer_cards',
        'settings' => 'logement_image',
    )));
    
    // Image foyer
    $wp_customize->add_setting('foyer_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'foyer_image', array(
        'label' => __('Image "Je découvre le foyer"', 'foyer-theme'),
        'section' => 'foyer_cards',
        'settings' => 'foyer_image',
    )));
    
    // Logo footer
    $wp_customize->add_setting('footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Logo Footer (Logo + Texte complet)', 'foyer-theme'),
        'description' => __('Image complète contenant le logo et le texte "FOYER ANDER LECHTOIS..."', 'foyer-theme'),
        'section' => 'foyer_cards',
        'settings' => 'footer_logo',
    )));
    
    // Section pour les liens des cartes
    $wp_customize->add_section('foyer_links', array(
        'title' => __('Liens des Cartes', 'foyer-theme'),
        'priority' => 31,
    ));
    
    // Lien habitant
    $wp_customize->add_setting('habitant_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('habitant_link', array(
        'label' => __('Lien "Je suis habitant"', 'foyer-theme'),
        'section' => 'foyer_links',
        'type' => 'url',
    ));
    
    // Lien logement
    $wp_customize->add_setting('logement_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('logement_link', array(
        'label' => __('Lien "Je cherche un logement"', 'foyer-theme'),
        'section' => 'foyer_links',
        'type' => 'url',
    ));
    
    // Lien foyer
    $wp_customize->add_setting('foyer_link', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('foyer_link', array(
        'label' => __('Lien "Je découvre le foyer"', 'foyer-theme'),
        'section' => 'foyer_links',
        'type' => 'url',
    ));
    
    // Section pour la page Habitants
    $wp_customize->add_section('habitants_services', array(
        'title' => __('Page Habitants - Services', 'foyer-theme'),
        'priority' => 32,
    ));
    
    // Services - Liens et Icônes
    $services = array(
        'pannes' => 'Pannes',
        'concierge' => 'Concierge', 
        'pompiers' => 'Pompiers',
        'proprete' => 'Bruxelles Propreté',
        'assistant' => 'Assistant Social',
        'reglement' => 'Règlement',
        'psycho' => 'Aide Psychologique',
        'entretien' => 'Entretien du Logement'
    );
    
    foreach ($services as $key => $label) {
        // Lien du service
        $wp_customize->add_setting('lien_' . $key, array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control('lien_' . $key, array(
            'label' => __('Lien ' . $label, 'foyer-theme'),
            'section' => 'habitants_services',
            'type' => 'url',
        ));
        
        // Icône du service
        $wp_customize->add_setting('icon_' . $key, array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'icon_' . $key, array(
            'label' => __('Icône ' . $label, 'foyer-theme'),
            'section' => 'habitants_services',
            'settings' => 'icon_' . $key,
        )));
    }
}
add_action('customize_register', 'foyer_customize_register');

/**
 * Ajouter du CSS personnalisé pour le logo footer
 */
function foyer_custom_styles() {
    ?>
    <style>
        /* Styles pour le logo en bas de page */
        .bottom-logo {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            text-align: center;
            max-width: 150px;
        }
        
        .bottom-logo img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .bottom-logo-placeholder {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.95);
            padding: 10px 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
        }
        
        .logo-icon {
            font-size: 24px;
            font-weight: bold;
            color: #8B5CF6;
            background: linear-gradient(45deg, #8B5CF6, #EC4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .logo-text {
            font-size: 10px;
            line-height: 1.1;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .bottom-logo {
                bottom: 15px;
                max-width: 120px;
            }
            
            .bottom-logo-placeholder {
                padding: 8px 12px;
            }
            
            .logo-icon {
                font-size: 20px;
            }
            
            .logo-text {
                font-size: 9px;
            }
        }
    </style>
    <?php
}
add_action('wp_head', 'foyer_custom_styles');

/**
 * NOTE: Les fonctions get_foyer_image() et get_foyer_link() sont définies plus haut dans le fichier
 * Versions supprimées pour éviter les doublons
 */

/**
 * Nettoyage et optimisation
 */
function foyer_cleanup_head() {
    // Supprimer les liens inutiles
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'foyer_cleanup_head');

/**
 * Personnalisation de l'administration
 */
function foyer_admin_styles() {
    echo '<style>
        .customize-control-description {
            font-style: italic;
            margin-top: 5px;
        }
    </style>';
}
add_action('customize_controls_print_styles', 'foyer_admin_styles');

/**
 * Support pour les images responsive
 */
function foyer_responsive_images($html, $post_id, $post_image_id, $size, $attr) {
    if (in_array($size, array('card-illustration', 'footer-logo'))) {
        $attr['loading'] = 'lazy';
    }
    return $html;
}
add_filter('post_thumbnail_html', 'foyer_responsive_images', 10, 5);


/**
 * Customizer pour les services habitants - Configuration complète
 */
function habitants_services_customize_register($wp_customize) {
    // Section pour les services habitants
    $wp_customize->add_section('habitants_services_section', array(
        'title'    => 'Services Habitants - Configuration',
        'priority' => 30,
        'description' => 'Configurez les 8 services : images, noms et liens'
    ));
    
    // --- SERVICE 1: LES PANNES ---
    
    // Image
    $wp_customize->add_setting('habitants_image_pannes', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_pannes', array(
        'label'    => '1. Image - Service 1',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_pannes'
    )));
    
    // Nom
    $wp_customize->add_setting('habitants_nom_pannes', array(
        'default'   => 'LES PANNES',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('habitants_nom_pannes', array(
        'label'    => '1. Nom - Service 1',
        'section'  => 'habitants_services_section',
        'type'     => 'text',
        'description' => 'Utilisez <br> pour une nouvelle ligne (ex: BRUXELLES<br>PROPRETÉ)'
    ));
    
    // URL
    $wp_customize->add_setting('habitants_url_pannes', array(
        'default'   => '/pannes',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_pannes', array(
        'label'    => '1. Lien - Service 1',
        'section'  => 'habitants_services_section',
        'type'     => 'url',
        'description' => 'URL de destination pour ce service'
    ));
    
    // --- SERVICE 2: LE CONCIERGE ---
    
    $wp_customize->add_setting('habitants_image_concierge', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_concierge', array(
        'label'    => '2. Image - Service 2',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_concierge'
    )));
    
    $wp_customize->add_setting('habitants_nom_concierge', array(
        'default'   => 'LE CONCIERGE',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('habitants_nom_concierge', array(
        'label'    => '2. Nom - Service 2',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_concierge', array(
        'default'   => '/concierge',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_concierge', array(
        'label'    => '2. Lien - Service 2',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- SERVICE 3: LES POMPIERS ---
    
    $wp_customize->add_setting('habitants_image_pompiers', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_pompiers', array(
        'label'    => '3. Image - Service 3',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_pompiers'
    )));
    
    $wp_customize->add_setting('habitants_nom_pompiers', array(
        'default'   => 'LES POMPIERS',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('habitants_nom_pompiers', array(
        'label'    => '3. Nom - Service 3',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_pompiers', array(
        'default'   => 'tel:112',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_pompiers', array(
        'label'    => '3. Lien - Service 3',
        'section'  => 'habitants_services_section',
        'type'     => 'url',
        'description' => 'Ex: tel:112 pour appel direct'
    ));
    
    // --- SERVICE 4: BRUXELLES PROPRETÉ ---
    
    $wp_customize->add_setting('habitants_image_proprete', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_proprete', array(
        'label'    => '4. Image - Service 4',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_proprete'
    )));
    
    $wp_customize->add_setting('habitants_nom_proprete', array(
        'default'   => 'BRUXELLES<br>PROPRETÉ',
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control('habitants_nom_proprete', array(
        'label'    => '4. Nom - Service 4',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_proprete', array(
        'default'   => 'https://www.arp-gan.be',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_proprete', array(
        'label'    => '4. Lien - Service 4',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- SERVICE 5: L'ASSISTANT SOCIAL ---
    
    $wp_customize->add_setting('habitants_image_assistant', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_assistant', array(
        'label'    => '5. Image - Service 5',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_assistant'
    )));
    
    $wp_customize->add_setting('habitants_nom_assistant', array(
        'default'   => 'L\'ASSISTANT<br>SOCIAL',
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control('habitants_nom_assistant', array(
        'label'    => '5. Nom - Service 5',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_assistant', array(
        'default'   => '/assistant-social',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_assistant', array(
        'label'    => '5. Lien - Service 5',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- SERVICE 6: LE RÈGLEMENT ---
    
    $wp_customize->add_setting('habitants_image_reglement', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_reglement', array(
        'label'    => '6. Image - Service 6',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_reglement'
    )));
    
    $wp_customize->add_setting('habitants_nom_reglement', array(
        'default'   => 'LE RÈGLEMENT',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('habitants_nom_reglement', array(
        'label'    => '6. Nom - Service 6',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_reglement', array(
        'default'   => '/reglement',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_reglement', array(
        'label'    => '6. Lien - Service 6',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- SERVICE 7: AIDE PSYCHOLOGIQUE ---
    
    $wp_customize->add_setting('habitants_image_psychologique', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_psychologique', array(
        'label'    => '7. Image - Service 7',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_psychologique'
    )));
    
    $wp_customize->add_setting('habitants_nom_psychologique', array(
        'default'   => 'AIDE<br>PSYCHOLOGIQUE',
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control('habitants_nom_psychologique', array(
        'label'    => '7. Nom - Service 7',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_psychologique', array(
        'default'   => '/aide-psychologique',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_psychologique', array(
        'label'    => '7. Lien - Service 7',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- SERVICE 8: L'ENTRETIEN DU LOGEMENT ---
    
    $wp_customize->add_setting('habitants_image_entretien', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_entretien', array(
        'label'    => '8. Image - Service 8',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_entretien'
    )));
    
    $wp_customize->add_setting('habitants_nom_entretien', array(
        'default'   => 'L\'ENTRETIEN<br>DU LOGEMENT',
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control('habitants_nom_entretien', array(
        'label'    => '8. Nom - Service 8',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_url_entretien', array(
        'default'   => '/entretien-logement',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_url_entretien', array(
        'label'    => '8. Lien - Service 8',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
    
    // --- BOUTON RETOUR ---
    
    $wp_customize->add_setting('habitants_retour_text', array(
        'default'   => 'RETOUR HOMEPAGE',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('habitants_retour_text', array(
        'label'    => 'Texte Bouton Retour',
        'section'  => 'habitants_services_section',
        'type'     => 'text'
    ));
    
    $wp_customize->add_setting('habitants_retour_url', array(
        'default'   => home_url(),
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('habitants_retour_url', array(
        'label'    => 'URL Bouton Retour',
        'section'  => 'habitants_services_section',
        'type'     => 'url'
    ));
}
add_action('customize_register', 'habitants_services_customize_register');

/**
 * Customizer pour la page Quartiers
 */
function quartiers_customize_register( $wp_customize ) {

    // Section quartiers
    $wp_customize->add_section( 'quartiers_section', array(
        'title'       => 'Page Quartiers - Configuration',
        'priority'    => 32,
        'description' => 'Configurez l\'image d\'immeuble et les quartiers',
    ) );

    // Image d'immeuble
    $wp_customize->add_setting( 'quartiers_image_immeuble', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control(
        $wp_customize,
        'quartiers_image_immeuble',
        array(
            'label'    => 'Image - Immeuble',
            'section'  => 'quartiers_section',
            'settings' => 'quartiers_image_immeuble',
        )
    ) );

    // Quartier en évidence
    $wp_customize->add_setting( 'quartiers_quartier_actuel', array(
        'default'           => 'PETERBOS',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'quartiers_quartier_actuel', array(
        'label'    => 'Quartier en évidence (fond bleu)',
        'section'  => 'quartiers_section',
        'settings' => 'quartiers_quartier_actuel',
        'type'     => 'text',
    ) );

    // Liste des quartiers (un par ligne)
    $wp_customize->add_setting( 'quartiers_liste_quartiers', array(
        'default'           => "PRINS\nPETERBOS\nRAUTER\nLA ROUE\nSQUARE ALBERT\nLENNIK\nBON AIR\nGOUJONS\nDAUPHINELLES",
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'quartiers_liste_quartiers', array(
        'label'    => 'Liste des quartiers (un par ligne)',
        'section'  => 'quartiers_section',
        'settings' => 'quartiers_liste_quartiers',
        'type'     => 'textarea',
    ) );

    // ✅ Liste des liens (un par ligne, dans le même ordre que les quartiers)
    $wp_customize->add_setting( 'quartiers_liste_liens', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );

    $wp_customize->add_control( 'quartiers_liste_liens', array(
        'label'       => 'Liens des quartiers (un par ligne, dans le même ordre)',
        'section'     => 'quartiers_section',
        'settings'    => 'quartiers_liste_liens',
        'type'        => 'textarea',
        'description' => "Mettez un lien par ligne, dans le même ordre que les quartiers. Laissez vide pour un quartier sans lien.",
    ) );

}
add_action( 'customize_register', 'quartiers_customize_register' );

/**
 * Helper : récupérer la liste des quartiers sous forme de tableau
 */
function get_quartiers_list() {
    $quartiers_text = get_theme_mod(
        'quartiers_liste_quartiers',
        "PRINS\nPETERBOS\nRAUTER\nLA ROUE\nSQUARE ALBERT\nLENNIK\nBON AIR\nGOUJONS\nDAUPHINELLES"
    );

    $quartiers = preg_split( '/\r\n|\r|\n/', $quartiers_text );
    $quartiers = array_map( 'trim', $quartiers );
    $quartiers = array_filter( $quartiers ); // enlève les lignes vides

    return $quartiers;
}

/**
 * ✅ Helper : récupérer la liste des liens (indexés dans le même ordre que les quartiers)
 */
function get_quartiers_links() {
    $liens_text = get_theme_mod( 'quartiers_liste_liens', '' );

    // On garde même les lignes vides pour ne pas décaler les index
    $liens = preg_split( '/\r\n|\r|\n/', $liens_text );
    $liens = array_map( 'trim', $liens );

    return $liens;
}

/**
 * Helper : vérifier si un quartier est celui "en évidence"
 */
function is_quartier_actuel( $quartier ) {
    $quartier_actuel = get_theme_mod( 'quartiers_quartier_actuel', 'PETERBOS' );

    return strtoupper( trim( $quartier ) ) === strtoupper( trim( $quartier_actuel ) );
}

 
/**
 * Configuration WordPress Customizer pour Page Logement Sous-Menu
 * À ajouter dans functions.php
 */

// Customizer pour la page Logement Sous-Menu
function logement_sous_menu_customizer($wp_customize) {
    
    // Section principale
    $wp_customize->add_section('logement_sous_menu_section', array(
        'title' => 'Page Logement - Sous Menu',
        'description' => 'Configuration des options de la page logement sous-menu',
        'priority' => 120,
    ));

    // --- OPTION 1: CANDIDATURE ---
    
    // Icône Candidature
    $wp_customize->add_setting('logement_icon_candidature', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logement_icon_candidature', array(
        'label' => 'Icône - Candidature',
        'section' => 'logement_sous_menu_section',
        'settings' => 'logement_icon_candidature',
        'description' => 'Icône pour "Entrer ma candidature" (PNG/JPG)',
    )));

    // Texte Candidature
    $wp_customize->add_setting('logement_text_candidature', array(
        'default' => 'ENTRER MA CANDIDATURE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_text_candidature', array(
        'label' => 'Texte - Candidature',
        'section' => 'logement_sous_menu_section',
        'type' => 'text',
    ));

    // URL Candidature
    $wp_customize->add_setting('logement_url_candidature', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('logement_url_candidature', array(
        'label' => 'URL - Candidature',
        'section' => 'logement_sous_menu_section',
        'type' => 'url',
        'description' => 'Lien vers la page de candidature',
    ));

    // --- OPTION 2: ÉLIGIBILITÉ ---
    
    // Icône Éligibilité
    $wp_customize->add_setting('logement_icon_eligibilite', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logement_icon_eligibilite', array(
        'label' => 'Icône - Éligibilité',
        'section' => 'logement_sous_menu_section',
        'settings' => 'logement_icon_eligibilite',
        'description' => 'Icône pour "Est-ce que j\'y ai droit?" (PNG/JPG)',
    )));

    // Texte Éligibilité
    $wp_customize->add_setting('logement_text_eligibilite', array(
        'default' => 'EST-CE QUE J\'Y AI DROIT?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_text_eligibilite', array(
        'label' => 'Texte - Éligibilité',
        'section' => 'logement_sous_menu_section',
        'type' => 'text',
    ));

    // URL Éligibilité
    $wp_customize->add_setting('logement_url_eligibilite', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('logement_url_eligibilite', array(
        'label' => 'URL - Éligibilité',
        'section' => 'logement_sous_menu_section',
        'type' => 'url',
        'description' => 'Lien vers la page d\'éligibilité',
    ));

    // --- OPTION 3: DÉLAIS ---
    
    // Icône Délais
    $wp_customize->add_setting('logement_icon_delais', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logement_icon_delais', array(
        'label' => 'Icône - Délais',
        'section' => 'logement_sous_menu_section',
        'settings' => 'logement_icon_delais',
        'description' => 'Icône pour "Combien de temps je vais attendre?" (PNG/JPG)',
    )));

    // Texte Délais
    $wp_customize->add_setting('logement_text_delais', array(
        'default' => 'COMBIEN DE TEMPS JE VAIS ATTENDRE?',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_text_delais', array(
        'label' => 'Texte - Délais',
        'section' => 'logement_sous_menu_section',
        'type' => 'text',
    ));

    // URL Délais
    $wp_customize->add_setting('logement_url_delais', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('logement_url_delais', array(
        'label' => 'URL - Délais',
        'section' => 'logement_sous_menu_section',
        'type' => 'url',
        'description' => 'Lien vers la page des délais',
    ));

    // --- OPTION 4: AUTRE (OPTIONNELLE) ---
    
    // Activer Option 4
    $wp_customize->add_setting('logement_show_option4', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_show_option4', array(
        'label' => 'Afficher Option 4',
        'section' => 'logement_sous_menu_section',
        'type' => 'checkbox',
        'description' => 'Activer une 4ème option',
    ));

    // Icône Option 4
    $wp_customize->add_setting('logement_icon_autre', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logement_icon_autre', array(
        'label' => 'Icône - Option 4',
        'section' => 'logement_sous_menu_section',
        'settings' => 'logement_icon_autre',
        'description' => 'Icône pour la 4ème option (PNG/JPG)',
    )));

    // Texte Option 4
    $wp_customize->add_setting('logement_text_autre', array(
        'default' => 'AUTRE OPTION',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_text_autre', array(
        'label' => 'Texte - Option 4',
        'section' => 'logement_sous_menu_section',
        'type' => 'text',
    ));

    // URL Option 4
    $wp_customize->add_setting('logement_url_autre', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('logement_url_autre', array(
        'label' => 'URL - Option 4',
        'section' => 'logement_sous_menu_section',
        'type' => 'url',
    ));

    // --- BOUTON RETOUR ---
    
    // Texte du bouton retour
    $wp_customize->add_setting('logement_retour_text', array(
        'default' => 'RETOUR HOMEPAGE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('logement_retour_text', array(
        'label' => 'Texte - Bouton Retour',
        'section' => 'logement_sous_menu_section',
        'type' => 'text',
    ));

    // URL du bouton retour
    $wp_customize->add_setting('logement_retour_url', array(
        'default' => home_url(),
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('logement_retour_url', array(
        'label' => 'URL - Bouton Retour',
        'section' => 'logement_sous_menu_section',
        'type' => 'url',
        'description' => 'URL de retour (par défaut: homepage)',
    ));
}
add_action('customize_register', 'logement_sous_menu_customizer');

/**
 * Fonction helper pour récupérer les URLs des options
 */
function get_logement_option_url($option) {
    switch ($option) {
        case 'candidature':
            return get_theme_mod('logement_url_candidature', '#');
        case 'eligibilite':
            return get_theme_mod('logement_url_eligibilite', '#');
        case 'delais':
            return get_theme_mod('logement_url_delais', '#');
        case 'autre':
            return get_theme_mod('logement_url_autre', '#');
        default:
            return '#';
    }
}

/**
 * Support pour les images uploadées
 */
function logement_theme_support() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'logement_theme_support');

/**
 * Configuration WordPress Customizer pour Page Foyer
 * À ajouter dans functions.php
 */

// Customizer pour la page Foyer
function foyer_customizer($wp_customize) {
    
    // Section principale
    $wp_customize->add_section('foyer_section', array(
        'title' => 'Page Foyer - Configuration',
        'description' => 'Configuration des options de la page foyer',
        'priority' => 130,
    ));

    // --- OPTION 1: LA VISION ---
    
    // Texte Vision
    $wp_customize->add_setting('foyer_text_vision', array(
        'default' => 'LA VISION',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_vision', array(
        'label' => 'Texte - La Vision',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Vision
    $wp_customize->add_setting('foyer_url_vision', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_vision', array(
        'label' => 'URL - La Vision',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'Lien vers la page Vision',
    ));

    // --- OPTION 2: LES CHIFFRES ---
    
    // Texte Chiffres
    $wp_customize->add_setting('foyer_text_chiffres', array(
        'default' => 'LES CHIFFRES',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_chiffres', array(
        'label' => 'Texte - Les Chiffres',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Chiffres
    $wp_customize->add_setting('foyer_url_chiffres', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_chiffres', array(
        'label' => 'URL - Les Chiffres',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'Lien vers la page Chiffres',
    ));

    // --- OPTION 3: LE RAPPORT ANNUEL ---
    
    // Texte Rapport
    $wp_customize->add_setting('foyer_text_rapport', array(
        'default' => 'LE RAPPORT ANNUEL',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_rapport', array(
        'label' => 'Texte - Le Rapport Annuel',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Rapport
    $wp_customize->add_setting('foyer_url_rapport', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_rapport', array(
        'label' => 'URL - Le Rapport Annuel',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'Lien vers le Rapport Annuel (PDF ou page)',
    ));

    // --- OPTION 4: COMMUNIQUÉS DE PRESSE ---
    
    // Texte Communiqués
    $wp_customize->add_setting('foyer_text_communiques', array(
        'default' => 'COMMUNIQUÉS DE PRESSE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_communiques', array(
        'label' => 'Texte - Communiqués de Presse',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Communiqués
    $wp_customize->add_setting('foyer_url_communiques', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_communiques', array(
        'label' => 'URL - Communiqués de Presse',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'Lien vers la page des communiqués',
    ));

    // --- OPTION 5: LE CONSEIL D'ADMINISTRATION ---
    
    // Texte Conseil
    $wp_customize->add_setting('foyer_text_conseil', array(
        'default' => 'LE CONSEIL D\'ADMINISTRATION',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_conseil', array(
        'label' => 'Texte - Le Conseil d\'Administration',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Conseil
    $wp_customize->add_setting('foyer_url_conseil', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_conseil', array(
        'label' => 'URL - Le Conseil d\'Administration',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'Lien vers la page du Conseil',
    ));

    // --- OPTION 6: OPTIONNELLE ---
    
    // Activer Option 6
    $wp_customize->add_setting('foyer_show_option6', array(
        'default' => false,
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_show_option6', array(
        'label' => 'Afficher Option 6',
        'section' => 'foyer_section',
        'type' => 'checkbox',
        'description' => 'Activer une 6ème option',
    ));

    // Texte Option 6
    $wp_customize->add_setting('foyer_text_option6', array(
        'default' => 'OPTION 6',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_text_option6', array(
        'label' => 'Texte - Option 6',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL Option 6
    $wp_customize->add_setting('foyer_url_option6', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_url_option6', array(
        'label' => 'URL - Option 6',
        'section' => 'foyer_section',
        'type' => 'url',
    ));

    // --- BOUTON RETOUR ---
    
    // Image de la flèche
    $wp_customize->add_setting('foyer_arrow_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'foyer_arrow_image', array(
        'label' => 'Image - Flèche de Retour',
        'section' => 'foyer_section',
        'settings' => 'foyer_arrow_image',
        'description' => 'Upload de votre image de flèche (PNG/JPG)',
    )));

    // Texte du bouton retour
    $wp_customize->add_setting('foyer_retour_text', array(
        'default' => 'RETOUR HOMEPAGE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('foyer_retour_text', array(
        'label' => 'Texte - Bouton Retour',
        'section' => 'foyer_section',
        'type' => 'text',
    ));

    // URL du bouton retour
    $wp_customize->add_setting('foyer_retour_url', array(
        'default' => home_url(),
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('foyer_retour_url', array(
        'label' => 'URL - Bouton Retour',
        'section' => 'foyer_section',
        'type' => 'url',
        'description' => 'URL de retour (par défaut: homepage)',
    ));
}
add_action('customize_register', 'foyer_customizer');

/**
 * Fonction helper pour récupérer les URLs des options foyer
 */
function get_foyer_option_url($option) {
    switch ($option) {
        case 'vision':
            return get_theme_mod('foyer_url_vision', '#');
        case 'chiffres':
            return get_theme_mod('foyer_url_chiffres', '#');
        case 'rapport':
            return get_theme_mod('foyer_url_rapport', '#');
        case 'communiques':
            return get_theme_mod('foyer_url_communiques', '#');
        case 'conseil':
            return get_theme_mod('foyer_url_conseil', '#');
        case 'option6':
            return get_theme_mod('foyer_url_option6', '#');
        default:
            return '#';
    }
}

/**
 * Support pour les images uploadées - foyer
 */
function foyer_theme_support() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'foyer_theme_support');


/**
 * Configuration WordPress Customizer pour Page Pannes
 * À ajouter dans functions.php
 */

// Customizer pour la page Pannes
function pannes_customizer($wp_customize) {
    
    // Section principale
    $wp_customize->add_section('pannes_section', array(
        'title' => 'Page Pannes - Configuration',
        'description' => 'Configuration de la page des pannes et interventions',
        'priority' => 140,
    ));

    // --- HEADER PANNES ---
    
    // Icône outils (clé anglaise)
    $wp_customize->add_setting('pannes_tools_icon', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_tools_icon', array(
        'label' => 'Icône - Outils (Header)',
        'section' => 'pannes_section',
        'settings' => 'pannes_tools_icon',
        'description' => 'Icône clé anglaise pour le header (PNG/JPG)',
    )));

    // Titre principal
    $wp_customize->add_setting('pannes_title', array(
        'default' => 'LES PANNES',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_title', array(
        'label' => 'Titre Principal',
        'section' => 'pannes_section',
        'type' => 'text',
        'description' => 'Titre affiché dans le header',
    ));

    // --- PANNE 1: PERSONNALISABLE ---
    
    // Icône Panne 1
    $wp_customize->add_setting('pannes_icon_panne1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_icon_panne1', array(
        'label' => 'Icône - Position 1 (Haut Gauche)',
        'section' => 'pannes_section',
        'settings' => 'pannes_icon_panne1',
        'description' => 'Upload votre image pour la position 1 (PNG/JPG)',
    )));

    // Texte Panne 1
    $wp_customize->add_setting('pannes_text_panne1', array(
        'default' => 'CHAUFFAGE',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_text_panne1', array(
        'label' => 'Texte - Position 1',
        'section' => 'pannes_section',
        'type' => 'text',
        'description' => 'Nom affiché sous l\'icône position 1',
    ));

    // URL Panne 1
    $wp_customize->add_setting('pannes_url_panne1', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pannes_url_panne1', array(
        'label' => 'URL - Position 1',
        'section' => 'pannes_section',
        'type' => 'url',
        'description' => 'Lien de redirection position 1',
    ));

    // --- PANNE 2: PERSONNALISABLE ---
    
    // Icône Panne 2
    $wp_customize->add_setting('pannes_icon_panne2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_icon_panne2', array(
        'label' => 'Icône - Position 2 (Haut Droite)',
        'section' => 'pannes_section',
        'settings' => 'pannes_icon_panne2',
        'description' => 'Upload votre image pour la position 2 (PNG/JPG)',
    )));

    // Texte Panne 2
    $wp_customize->add_setting('pannes_text_panne2', array(
        'default' => 'ASCENSEUR',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_text_panne2', array(
        'label' => 'Texte - Position 2',
        'section' => 'pannes_section',
        'type' => 'text',
        'description' => 'Nom affiché sous l\'icône position 2',
    ));

    // URL Panne 2
    $wp_customize->add_setting('pannes_url_panne2', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pannes_url_panne2', array(
        'label' => 'URL - Position 2',
        'section' => 'pannes_section',
        'type' => 'url',
        'description' => 'Lien de redirection position 2',
    ));

    // --- PANNE 3: PERSONNALISABLE ---
    
    // Icône Panne 3
    $wp_customize->add_setting('pannes_icon_panne3', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_icon_panne3', array(
        'label' => 'Icône - Position 3 (Bas Gauche)',
        'section' => 'pannes_section',
        'settings' => 'pannes_icon_panne3',
        'description' => 'Upload votre image pour la position 3 (PNG/JPG)',
    )));

    // Texte Panne 3
    $wp_customize->add_setting('pannes_text_panne3', array(
        'default' => 'TÉLÉVISION',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_text_panne3', array(
        'label' => 'Texte - Position 3',
        'section' => 'pannes_section',
        'type' => 'text',
        'description' => 'Nom affiché sous l\'icône position 3',
    ));

    // URL Panne 3
    $wp_customize->add_setting('pannes_url_panne3', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pannes_url_panne3', array(
        'label' => 'URL - Position 3',
        'section' => 'pannes_section',
        'type' => 'url',
        'description' => 'Lien de redirection position 3',
    ));

    // --- PANNE 4: PERSONNALISABLE ---
    
    // Icône Panne 4
    $wp_customize->add_setting('pannes_icon_panne4', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_icon_panne4', array(
        'label' => 'Icône - Position 4 (Bas Droite)',
        'section' => 'pannes_section',
        'settings' => 'pannes_icon_panne4',
        'description' => 'Upload votre image pour la position 4 (PNG/JPG)',
    )));

    // Texte Panne 4
    $wp_customize->add_setting('pannes_text_panne4', array(
        'default' => 'INTERNET',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_text_panne4', array(
        'label' => 'Texte - Position 4',
        'section' => 'pannes_section',
        'type' => 'text',
        'description' => 'Nom affiché sous l\'icône position 4',
    ));

    // URL Panne 4
    $wp_customize->add_setting('pannes_url_panne4', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pannes_url_panne4', array(
        'label' => 'URL - Position 4',
        'section' => 'pannes_section',
        'type' => 'url',
        'description' => 'Lien de redirection position 4',
    ));

    // --- BOUTON RETOUR ---
    
    // Texte du bouton retour
    $wp_customize->add_setting('pannes_retour_text', array(
        'default' => 'RETOUR AUX QUARTIERS',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('pannes_retour_text', array(
        'label' => 'Texte - Bouton Retour',
        'section' => 'pannes_section',
        'type' => 'text',
    ));

    // URL du bouton retour
    $wp_customize->add_setting('pannes_retour_url', array(
        'default' => home_url(),
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('pannes_retour_url', array(
        'label' => 'URL - Bouton Retour',
        'section' => 'pannes_section',
        'type' => 'url',
        'description' => 'URL de retour (par défaut: homepage)',
    ));
}
add_action('customize_register', 'pannes_customizer');

/**
 * Fonction helper pour récupérer les URLs des pannes
 */
function get_panne_option_url($panne) {
    switch ($panne) {
        case 'panne1':
            return get_theme_mod('pannes_url_panne1', '#');
        case 'panne2':
            return get_theme_mod('pannes_url_panne2', '#');
        case 'panne3':
            return get_theme_mod('pannes_url_panne3', '#');
        case 'panne4':
            return get_theme_mod('pannes_url_panne4', '#');
        default:
            return '#';
    }
}

/**
 * Support pour les images uploadées - pannes
 */
function pannes_theme_support() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'pannes_theme_support');


/**
 * Système Pannes par Quartier - Configuration WordPress
 * À ajouter dans functions.php
 */

// Liste des quartiers disponibles
function get_quartiers_pannes_list() {
    // Récupère la liste depuis la page quartiers ou définit une liste par défaut
    $quartiers = get_quartiers_list(); // Réutilise la fonction existante
    
    if (empty($quartiers)) {
        // Liste par défaut si pas de quartiers configurés
        $quartiers = array('prins', 'peterbos', 'rauter', 'la-roue', 'square-albert', 'lennik', 'bon-air', 'goujons', 'dauphinelles');
    } else {
        // Convertit en slugs (minuscules, espaces en tirets)
        $quartiers = array_map(function($quartier) {
            return strtolower(str_replace(' ', '-', $quartier));
        }, $quartiers);
    }
    
    return $quartiers;
}

// Customizer pour les pannes par quartier
function pannes_quartiers_customizer($wp_customize) {
    
    // Section globale (paramètres par défaut)
    $wp_customize->add_section('pannes_global_section', array(
        'title' => 'Pannes - Paramètres Globaux',
        'description' => 'Paramètres par défaut pour toutes les pages pannes',
        'priority' => 140,
    ));

    // --- PARAMÈTRES GLOBAUX ---
    
    // Icône outils globale
    $wp_customize->add_setting('pannes_tools_icon', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pannes_tools_icon', array(
        'label' => 'Icône Outils (Par défaut)',
        'section' => 'pannes_global_section',
        'settings' => 'pannes_tools_icon',
        'description' => 'Icône utilisée si pas d\'icône spécifique au quartier',
    )));

    // Paramètres globaux pour les 4 positions
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("pannes_icon_panne{$i}", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "pannes_icon_panne{$i}", array(
            'label' => "Image Position {$i} (Par défaut)",
            'section' => 'pannes_global_section',
            'settings' => "pannes_icon_panne{$i}",
        )));

        $wp_customize->add_setting("pannes_text_panne{$i}", array(
            'default' => $i == 1 ? 'CHAUFFAGE' : ($i == 2 ? 'ASCENSEUR' : ($i == 3 ? 'TÉLÉVISION' : 'INTERNET')),
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("pannes_text_panne{$i}", array(
            'label' => "Nom Position {$i} (Par défaut)",
            'section' => 'pannes_global_section',
            'type' => 'text',
        ));

        $wp_customize->add_setting("pannes_telephone_panne{$i}", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("pannes_telephone_panne{$i}", array(
            'label' => "Téléphone Position {$i} (Par défaut)",
            'section' => 'pannes_global_section',
            'type' => 'tel',
            'description' => 'Ex: +32123456789 ou 123456789',
        ));
    }

    // --- SECTIONS PAR QUARTIER ---
    
    $quartiers = get_quartiers_pannes_list();
    
    foreach ($quartiers as $quartier) {
        $quartier_display = ucfirst(str_replace('-', ' ', $quartier));
        
        // Section pour ce quartier
        $wp_customize->add_section("pannes_{$quartier}_section", array(
            'title' => "Pannes - {$quartier_display}",
            'description' => "Configuration spécifique pour {$quartier_display}",
            'priority' => 150,
        ));

        // Titre du quartier
        $wp_customize->add_setting("pannes_{$quartier}_title", array(
            'default' => "PANNES<br>{$quartier_display}",
            'sanitize_callback' => 'wp_kses_post',
        ));
        $wp_customize->add_control("pannes_{$quartier}_title", array(
            'label' => 'Titre Page',
            'section' => "pannes_{$quartier}_section",
            'type' => 'text',
            'description' => 'Utilisez <br> pour une nouvelle ligne',
        ));

        // Icône outils spécifique
        $wp_customize->add_setting("pannes_{$quartier}_tools_icon", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "pannes_{$quartier}_tools_icon", array(
            'label' => 'Icône Outils (Spécifique)',
            'section' => "pannes_{$quartier}_section",
            'settings' => "pannes_{$quartier}_tools_icon",
            'description' => 'Laissez vide pour utiliser l\'icône globale',
        )));

        // 4 pannes spécifiques au quartier
        for ($i = 1; $i <= 4; $i++) {
            // Image
            $wp_customize->add_setting("pannes_{$quartier}_icon_panne{$i}", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "pannes_{$quartier}_icon_panne{$i}", array(
                'label' => "Image Position {$i}",
                'section' => "pannes_{$quartier}_section",
                'settings' => "pannes_{$quartier}_icon_panne{$i}",
                'description' => 'Laissez vide pour utiliser l\'image globale',
            )));

            // Texte
            $wp_customize->add_setting("pannes_{$quartier}_text_panne{$i}", array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control("pannes_{$quartier}_text_panne{$i}", array(
                'label' => "Nom Position {$i}",
                'section' => "pannes_{$quartier}_section",
                'type' => 'text',
                'description' => 'Laissez vide pour utiliser le nom global',
            ));

            // URL
            $wp_customize->add_setting("pannes_{$quartier}_url_panne{$i}", array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
            ));
            $wp_customize->add_control("pannes_{$quartier}_url_panne{$i}", array(
                'label' => "URL Position {$i}",
                'section' => "pannes_{$quartier}_section",
                'type' => 'url',
                'description' => "Lien pour cette panne dans {$quartier_display}",
            ));

            // Téléphone
            $wp_customize->add_setting("pannes_{$quartier}_telephone_panne{$i}", array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control("pannes_{$quartier}_telephone_panne{$i}", array(
                'label' => "Téléphone Position {$i}",
                'section' => "pannes_{$quartier}_section",
                'type' => 'tel',
                'description' => "Numéro à appeler (Ex: +32123456789). Laissez vide pour utiliser l'URL.",
            ));
        }

        // Bouton retour
        $wp_customize->add_setting("pannes_{$quartier}_retour_text", array(
            'default' => 'RETOUR AUX QUARTIERS',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("pannes_{$quartier}_retour_text", array(
            'label' => 'Texte Bouton Retour',
            'section' => "pannes_{$quartier}_section",
            'type' => 'text',
        ));

        $wp_customize->add_setting("pannes_{$quartier}_retour_url", array(
            'default' => '/quartiers',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("pannes_{$quartier}_retour_url", array(
            'label' => 'URL Bouton Retour',
            'section' => "pannes_{$quartier}_section",
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'pannes_quartiers_customizer');

/**
 * Fonction helper pour récupérer les URLs des pannes par quartier
 */
function get_quartier_panne_url($quartier, $panne) {
    $url = get_theme_mod("pannes_{$quartier}_url_{$panne}", '');
    
    // Si pas d'URL spécifique, utiliser un pattern par défaut
    if (empty($url)) {
        $url = "/formulaire-panne?quartier={$quartier}&type={$panne}";
    }
    
    return $url;
}

/**
 * Fonction helper pour récupérer les numéros de téléphone par quartier et panne
 */
function get_quartier_panne_telephone($quartier, $panne) {
    $telephone = get_theme_mod("pannes_{$quartier}_telephone_{$panne}", '');
    
    // Si pas de téléphone spécifique, utiliser le téléphone global
    if (empty($telephone)) {
        $telephone = get_theme_mod("pannes_telephone_{$panne}", '');
    }
    
    return $telephone;
}

/**
 * Fonction pour créer automatiquement les pages pannes quartiers
 */
function create_pannes_quartier_pages() {
    // À utiliser une seule fois pour créer toutes les pages automatiquement
    $quartiers = get_quartiers_pannes_list();
    
    foreach ($quartiers as $quartier) {
        $quartier_display = ucfirst(str_replace('-', ' ', $quartier));
        $page_title = "Pannes {$quartier_display}";
        $page_slug = "pannes-{$quartier}";
        
        // Vérifier si la page existe déjà
        $existing_page = get_page_by_path($page_slug);
        
        if (!$existing_page) {
            // Créer la page
            $page_data = array(
                'post_title' => $page_title,
                'post_name' => $page_slug,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page',
                'page_template' => 'page-pannes-quartier.php'
            );
            
            wp_insert_post($page_data);
        }
    }
}

// Décommente cette ligne une seule fois pour créer toutes les pages automatiquement
// add_action('init', 'create_pannes_quartier_pages');

/**
 * Support thème
 */
function pannes_quartiers_theme_support() {
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'pannes_quartiers_theme_support');