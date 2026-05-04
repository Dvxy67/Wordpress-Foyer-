<?php
/*
Template Name: Page Légale
*/
get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php the_title(); ?> — <?php bloginfo('name'); ?></title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: 'Rubik', sans-serif;
            background: #ffffff;
            color: #111;
            overflow-x: hidden;
        }

        /* ── TRAIT BLEU ── */
        .legal-topbar {
            height: 4px;
            background: #6b92ff;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* ── WRAPPER centré ── */
        .legal-nav,
        .legal-header,
        .legal-body {
            max-width: 680px;
            margin: 0 auto;
            padding-left: 24px;
            padding-right: 24px;
        }

        /* ── NAVIGATION ── */
        .legal-nav {
            padding-top: 24px;
            padding-bottom: 0;
        }

        .legal-nav__back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: #aaa;
            font-size: 12px;
            font-weight: 400;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            -webkit-tap-highlight-color: transparent;
            transition: color 0.15s ease;
        }

        .legal-nav__back:hover {
            color: #6b92ff;
        }

        /* ── EN-TÊTE ── */
        .legal-header {
            padding-top: 48px;
            padding-bottom: 32px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
        }

        .legal-header__title {
            font-size: 30px;
            font-weight: 400;
            color: #111;
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        /* ── CONTENU ── */
        .legal-body {
            padding-top: 40px;
            padding-bottom: 80px;
        }

        .legal-body h2 {
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: #6b92ff;
            margin: 36px 0 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e8eeff;
        }

        .legal-body h2:first-child {
            margin-top: 0;
        }

        .legal-body p {
            font-size: 15px;
            font-weight: 300;
            line-height: 1.85;
            color: #444;
            margin-bottom: 14px;
            text-align: justify;
            hyphens: auto;
        }

        .legal-body ul,
        .legal-body ol {
            font-size: 15px;
            font-weight: 300;
            line-height: 1.85;
            color: #444;
            margin: 0 0 14px 20px;
            text-align: left;
        }

        .legal-body li {
            margin-bottom: 6px;
        }

        .legal-body a {
            color: #6b92ff;
            text-decoration: underline;
            text-decoration-thickness: 1px;
            text-underline-offset: 3px;
        }

        /* ── DESKTOP ── */
        @media (min-width: 600px) {
            .legal-nav,
            .legal-header,
            .legal-body {
                max-width: 720px;
            }

            .legal-header__title {
                font-size: 42px;
                letter-spacing: -0.8px;
            }

            .legal-body p,
            .legal-body ul,
            .legal-body ol {
                font-size: 16px;
            }
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="legal-topbar"></div>

    <nav class="legal-nav">
        <a href="<?php echo esc_url( wp_get_referer() ?: home_url() ); ?>"
           onclick="if(document.referrer) { history.back(); return false; }"
           class="legal-nav__back"
           aria-label="Retour">
            &#8592; Retour
        </a>
    </nav>

    <header class="legal-header">
        <h1 class="legal-header__title"><?php the_title(); ?></h1>
    </header>

    <main class="legal-body">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                echo wpautop( get_the_content() );
            endwhile;
        endif;
        ?>
    </main>

<?php get_footer(); ?>
