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
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap');

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

        /* ── TRAIT BLEU ──────────────────────────────────────── */
        .legal-topbar {
            height: 3px;
            background: #6b92ff;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        /* ── NAVIGATION ──────────────────────────────────────── */
        .legal-nav {
            padding: 20px 28px 0;
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

        /* ── EN-TÊTE ─────────────────────────────────────────── */
        .legal-header {
            padding: 40px 28px 36px;
            border-bottom: 1px solid #f0f0f0;
            max-width: 720px;
        }

        .legal-header__title {
            font-size: 32px;
            font-weight: 300;
            color: #111;
            letter-spacing: -0.5px;
            line-height: 1.15;
        }

        /* ── CONTENU ─────────────────────────────────────────── */
        .legal-body {
            max-width: 720px;
            padding: 40px 28px 80px;
        }

        .legal-body h2 {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #aaa;
            margin: 40px 0 14px;
        }

        .legal-body h2:first-child {
            margin-top: 0;
        }

        .legal-body p {
            font-size: 15px;
            font-weight: 300;
            line-height: 1.85;
            color: #444;
            margin-bottom: 16px;
        }

        .legal-body ul,
        .legal-body ol {
            font-size: 15px;
            font-weight: 300;
            line-height: 1.85;
            color: #444;
            margin: 0 0 16px 18px;
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

        /* ── DESKTOP ─────────────────────────────────────────── */
        @media (min-width: 600px) {
            .legal-nav {
                padding: 28px 56px 0;
            }

            .legal-header {
                padding: 56px 56px 44px;
                max-width: 760px;
            }

            .legal-header__title {
                font-size: 44px;
                letter-spacing: -1px;
            }

            .legal-body {
                max-width: 760px;
                padding: 48px 56px 100px;
            }

            .legal-body h2 {
                font-size: 12px;
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
