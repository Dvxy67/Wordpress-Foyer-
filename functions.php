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
 * Fonction pour récupérer les images avec fallback
 */
function get_foyer_image($type, $fallback = '') {
    $image = get_theme_mod($type . '_image', $fallback);
    if (empty($image) && !empty($fallback)) {
        return get_template_directory_uri() . '/assets/images/' . $fallback;
    }
    return $image;
}

/**
 * Fonction pour récupérer les liens
 */
function get_foyer_link($type, $fallback = '#') {
    return get_theme_mod($type . '_link', $fallback);
}

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
 * Customizer pour les images de la page Services Habitants
 */
function habitants_services_customize_register($wp_customize) {
    
    // Section pour les services habitants
    $wp_customize->add_section('habitants_services_section', array(
        'title'    => 'Services Habitants - Images',
        'priority' => 30,
        'description' => 'Gérez les images des 8 services pour la page habitants'
    ));

    // LES PANNES
    $wp_customize->add_setting('habitants_image_pannes', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_pannes', array(
        'label'    => 'Image - Les Pannes',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_pannes'
    )));

    // LE CONCIERGE
    $wp_customize->add_setting('habitants_image_concierge', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_concierge', array(
        'label'    => 'Image - Le Concierge',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_concierge'
    )));

    // LES POMPIERS
    $wp_customize->add_setting('habitants_image_pompiers', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_pompiers', array(
        'label'    => 'Image - Les Pompiers',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_pompiers'
    )));

    // BRUXELLES PROPRETÉ
    $wp_customize->add_setting('habitants_image_proprete', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_proprete', array(
        'label'    => 'Image - Bruxelles Propreté',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_proprete'
    )));

    // L'ASSISTANT SOCIAL
    $wp_customize->add_setting('habitants_image_assistant', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_assistant', array(
        'label'    => 'Image - Assistant Social',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_assistant'
    )));

    // LE RÈGLEMENT
    $wp_customize->add_setting('habitants_image_reglement', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_reglement', array(
        'label'    => 'Image - Le Règlement',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_reglement'
    )));

    // AIDE PSYCHOLOGIQUE
    $wp_customize->add_setting('habitants_image_psychologique', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_psychologique', array(
        'label'    => 'Image - Aide Psychologique',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_psychologique'
    )));

    // L'ENTRETIEN DU LOGEMENT
    $wp_customize->add_setting('habitants_image_entretien', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'habitants_image_entretien', array(
        'label'    => 'Image - Entretien du Logement',
        'section'  => 'habitants_services_section',
        'settings' => 'habitants_image_entretien'
    )));
}
add_action('customize_register', 'habitants_services_customize_register');

/**
 * Customizer pour la page Quartiers
 */
function quartiers_customize_register($wp_customize) {
    
    // Section quartiers
    $wp_customize->add_section('quartiers_section', array(
        'title'    => 'Page Quartiers - Configuration',
        'priority' => 32,
        'description' => 'Configurez l\'image d\'immeuble et les quartiers'
    ));

    // Image d'immeuble
    $wp_customize->add_setting('quartiers_image_immeuble', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'quartiers_image_immeuble', array(
        'label'    => 'Image - Immeuble',
        'section'  => 'quartiers_section',
        'settings' => 'quartiers_image_immeuble'
    )));

    // Quartier en évidence
    $wp_customize->add_setting('quartiers_quartier_actuel', array(
        'default'   => 'PETERBOS',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('quartiers_quartier_actuel', array(
        'label'    => 'Quartier en évidence (fond bleu)',
        'section'  => 'quartiers_section',
        'settings' => 'quartiers_quartier_actuel',
        'type'     => 'text'
    ));

    // Liste des quartiers
    $wp_customize->add_setting('quartiers_liste_quartiers', array(
        'default'   => "PRINS\nPETERBOS\nRAUTER\nLA ROUE\nSQUARE ALBERT\nLENNIK\nBON AIR\nGOUJONS\nDAUPHINELLES",
        'sanitize_callback' => 'wp_kses_post'
    ));
    $wp_customize->add_control('quartiers_liste_quartiers', array(
        'label'    => 'Liste des quartiers (un par ligne)',
        'section'  => 'quartiers_section',
        'settings' => 'quartiers_liste_quartiers',
        'type'     => 'textarea'
    ));
}
add_action('customize_register', 'quartiers_customize_register');

/**
 * Fonction helper pour récupérer la liste des quartiers
 */
function get_quartiers_list() {
    $quartiers_text = get_theme_mod('quartiers_liste_quartiers', "PRINS\nPETERBOS\nRAUTER\nLA ROUE\nSQUARE ALBERT\nLENNIK\nBON AIR\nGOUJONS\nDAUPHINELLES");
    $quartiers = explode("\n", $quartiers_text);
    $quartiers = array_map('trim', $quartiers);
    $quartiers = array_filter($quartiers);
    return $quartiers;
}

/**
 * Fonction helper pour vérifier le quartier en évidence
 */
function is_quartier_actuel($quartier) {
    $quartier_actuel = get_theme_mod('quartiers_quartier_actuel', 'PETERBOS');
    return strtoupper(trim($quartier)) === strtoupper(trim($quartier_actuel));
}

<?php
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

?>