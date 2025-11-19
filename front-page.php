<?php
/**
 * Template pour la page d'accueil
 */

get_header(); ?>

<main id="main" class="homepage-container">
    <!-- Section principale avec slider -->
    <section class="slider-section">
        <div class="slider-container" id="cardSlider">
            <!-- Wrapper des slides -->
            <div class="slider-wrapper" id="sliderWrapper">
                
                <!-- Slide 1: Je suis habitant -->
                <div class="slide">
                    <a href="<?php echo esc_url(get_foyer_link('habitant')); ?>" class="card habitant" aria-label="<?php esc_attr_e('Accéder à la section habitant', 'foyer-theme'); ?>">
                        <div class="card-illustration">
                            <?php 
                            $habitant_img = get_foyer_image('habitant', 'habitant-placeholder.png');
                            if ($habitant_img): 
                            ?>
                                <img src="<?php echo esc_url($habitant_img); ?>" 
                                     alt="<?php esc_attr_e('Carte habitant complète', 'foyer-theme'); ?>" 
                                     class="illustration-image"
                                     loading="eager">
                            <?php else: ?>
                                <div class="illustration-placeholder">
                                    <span style="font-size: 48px; margin-bottom: 10px;">👩‍💼📞</span>
                                    <p style="text-align: center; font-size: 14px; color: rgba(0,0,0,0.7);">Carte "Je suis habitant"</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-title">
                            <h2><?php _e('Je suis<br>habitant', 'foyer-theme'); ?></h2>
                        </div>
                    </a>
                </div>
                
                <!-- Slide 2: Je cherche un logement -->
                <div class="slide">
                    <a href="<?php echo esc_url(get_foyer_link('logement')); ?>" class="card logement" aria-label="<?php esc_attr_e('Accéder à la recherche de logement', 'foyer-theme'); ?>">
                        <div class="card-illustration">
                            <?php 
                            $logement_img = get_foyer_image('logement', 'logement-placeholder.png');
                            if ($logement_img): 
                            ?>
                                <img src="<?php echo esc_url($logement_img); ?>" 
                                     alt="<?php esc_attr_e('Carte logement complète', 'foyer-theme'); ?>" 
                                     class="illustration-image"
                                     loading="eager">
                            <?php else: ?>
                                <div class="illustration-placeholder">
                                    <span style="font-size: 48px; margin-bottom: 10px;">🏠🔍</span>
                                    <p style="text-align: center; font-size: 14px; color: rgba(0,0,0,0.7);">Carte "Je cherche un logement"</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-title">
                            <h2><?php _e('Je cherche<br>un logement', 'foyer-theme'); ?></h2>
                        </div>
                    </a>
                </div>
                
                <!-- Slide 3: Je découvre le foyer -->
                <div class="slide">
                    <a href="<?php echo esc_url(get_foyer_link('foyer')); ?>" class="card foyer" aria-label="<?php esc_attr_e('Découvrir le foyer', 'foyer-theme'); ?>">
                        <div class="card-illustration">
                            <?php 
                            $foyer_img = get_foyer_image('foyer', 'foyer-placeholder.png');
                            if ($foyer_img): 
                            ?>
                                <img src="<?php echo esc_url($foyer_img); ?>" 
                                     alt="<?php esc_attr_e('Carte foyer complète', 'foyer-theme'); ?>" 
                                     class="illustration-image"
                                     loading="eager">
                            <?php else: ?>
                                <div class="illustration-placeholder">
                                    <span style="font-size: 48px; margin-bottom: 10px;">🏢🌳</span>
                                    <p style="text-align: center; font-size: 14px; color: rgba(0,0,0,0.7);">Carte "Je découvre le foyer"</p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-title">
                            <h2><?php _e('Je découvre<br>le foyer', 'foyer-theme'); ?></h2>
                        </div>
                    </a>
                </div>
                
            </div>
            
            <!-- Indicateurs de pagination -->
            <div class="slider-dots" role="tablist" aria-label="<?php esc_attr_e('Navigation du carrousel', 'foyer-theme'); ?>">
                <span class="dot active" data-slide="0" role="tab" aria-selected="true" aria-label="<?php esc_attr_e('Slide 1 - Je suis habitant', 'foyer-theme'); ?>"></span>
                <span class="dot" data-slide="1" role="tab" aria-selected="false" aria-label="<?php esc_attr_e('Slide 2 - Je cherche un logement', 'foyer-theme'); ?>"></span>
                <span class="dot" data-slide="2" role="tab" aria-selected="false" aria-label="<?php esc_attr_e('Slide 3 - Je découvre le foyer', 'foyer-theme'); ?>"></span>
            </div>
        </div>
    </section>
    
    <!-- Logo directement sur le fond violet -->
    <div class="bottom-logo">
        <?php 
        $footer_logo = get_foyer_image('footer_logo', 'logo-placeholder.png');
        if ($footer_logo): 
        ?>
            <img src="<?php echo esc_url($footer_logo); ?>" 
                 alt="<?php esc_attr_e('Logo et texte Foyer Ander Lechtois', 'foyer-theme'); ?>">
        <?php else: ?>
            <div class="bottom-logo-placeholder">
                <div class="logo-icon">A</div>
                <div class="logo-text">
                    <?php _e('Foyer<br>Ander<br>Lechtois<br>Ander<br>Lechtse<br>Haard', 'foyer-theme'); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
