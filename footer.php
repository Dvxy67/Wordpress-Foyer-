<?php
/**
 * Footer template — Foyer Anderlechtois
 * Appelé via get_footer() dans chaque template de page.
 */

// Récupère les liens légaux depuis le Customizer (avec fallback #)
$link_mentions    = get_theme_mod( 'foyer_footer_mentions',    '#' );
$link_politique   = get_theme_mod( 'foyer_footer_politique',   '#' );
$link_rgpd        = get_theme_mod( 'foyer_footer_rgpd',        '#' );
$link_cookies     = get_theme_mod( 'foyer_footer_cookies',     '#' );
$link_accessib    = get_theme_mod( 'foyer_footer_accessib',    '#' );
?>

<footer class="foyer-footer">
    <nav class="foyer-footer__links" aria-label="Liens légaux">
        <a href="<?php echo esc_url( $link_mentions ); ?>">Mentions légales</a>
        <span aria-hidden="true">/</span>
        <a href="<?php echo esc_url( $link_politique ); ?>">Politique de confidentialité</a>
        <span aria-hidden="true">/</span>
        <a href="<?php echo esc_url( $link_rgpd ); ?>">RGPD</a>
        <span aria-hidden="true">/</span>
        <a href="<?php echo esc_url( $link_cookies ); ?>">Gestion des cookies</a>
        <span aria-hidden="true">/</span>
        <a href="<?php echo esc_url( $link_accessib ); ?>">Accessibilité du site</a>
    </nav>

    <address class="foyer-footer__address">
        Le Foyer Anderlechtois – 221 Rue de Birmingham, 1070 Anderlecht &nbsp;|&nbsp; <a href="tel:+3225567730">Tel : 02 556 77 30</a>
    </address>
</footer>

<?php wp_footer(); ?>
</body>
</html>