<?php
/**
 * Template pour les pages
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content">
                    <?php 
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'foyer-theme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>

<style>
.site-main {
    min-height: 100vh;
    background: linear-gradient(135deg, #7B68EE 0%, #6A5ACD 100%);
    padding: 40px 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background: rgba(255, 255, 255, 0.95);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.entry-header {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #FF0000;
}

.entry-title {
    font-size: 2.5rem;
    color: #000;
    font-weight: bold;
    text-transform: uppercase;
}

.entry-content {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #333;
}

.entry-content h2,
.entry-content h3,
.entry-content h4 {
    color: #000;
    margin-top: 30px;
    margin-bottom: 15px;
}

.entry-content a {
    color: #FF0000;
    text-decoration: underline;
}

.entry-content a:hover {
    color: #CC0000;
}

@media (max-width: 768px) {
    .container {
        padding: 20px;
        margin: 0 10px;
    }
    
    .entry-title {
        font-size: 2rem;
    }
}
</style>
