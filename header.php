<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    
    <!-- Preconnect pour les performances -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <!-- Meta SEO -->
    <?php if (is_home() || is_front_page()): ?>
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <meta property="og:title" content="<?php bloginfo('name'); ?>">
        <meta property="og:description" content="<?php bloginfo('description'); ?>">
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo home_url(); ?>">
    <?php endif; ?>
    
    <!-- Favicon -->
    <?php 
    $favicon = get_theme_mod('footer_logo');
    if ($favicon): 
    ?>
        <link rel="icon" type="image/png" href="<?php echo esc_url($favicon); ?>">
    <?php endif; ?>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Skip link pour l'accessibilité -->
    <a class="skip-link screen-reader-text" href="#main">
        <?php _e('Aller au contenu principal', 'foyer-theme'); ?>
    </a>
