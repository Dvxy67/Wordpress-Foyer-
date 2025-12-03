/**
 * Foyer Slider - Grandes Cartes - Sans hover, sans transparence
 * Version 3.0
 */

class FoyerSlider {
    constructor(container) {
        this.container = container;
        this.wrapper = container.querySelector('#sliderWrapper');
        this.dots = container.querySelectorAll('.dot');
        this.slides = container.querySelectorAll('.slide');
        
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        
        // Variables pour le touch
        this.startX = 0;
        this.currentX = 0;
        this.isDragging = false;
        this.startTime = 0;
        this.initialTransform = null;
        
        // Seuils pour la détection de swipe
        this.minSwipeDistance = 40;
        this.maxSwipeTime = 500;
        this.velocityThreshold = 0.3;
        
        // Distance entre les slides (ajusté pour les grandes cartes)
        this.slideOffset = this.calculateSlideOffset();
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.updateSlider();
    }
    
    // Calcul dynamique de l'offset - AJUSTÉ POUR GRANDES CARTES
    calculateSlideOffset() {
        const screenWidth = window.innerWidth;
        
        if (screenWidth < 768) {
            return 240; // Mobile - augmenté de 200 à 240
        } else if (screenWidth < 1024) {
            return 380; // Tablette - augmenté de 320 à 380
        } else if (screenWidth < 1440) {
            return 470; // Desktop - augmenté de 400 à 470
        } else {
            return 570; // Large desktop - augmenté de 500 à 570
        }
    }
    
    setupEventListeners() {
        // Touch events pour mobile
        this.wrapper.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: true });
        this.wrapper.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
        this.wrapper.addEventListener('touchend', this.handleTouchEnd.bind(this), { passive: true });
        
        // Mouse events pour desktop
        this.wrapper.addEventListener('mousedown', this.handleMouseStart.bind(this));
        this.wrapper.addEventListener('mousemove', this.handleMouseMove.bind(this));
        this.wrapper.addEventListener('mouseup', this.handleMouseEnd.bind(this));
        this.wrapper.addEventListener('mouseleave', this.handleMouseEnd.bind(this));
        
        // Empêcher la sélection de texte lors du drag
        this.wrapper.addEventListener('selectstart', (e) => e.preventDefault());
        
        // Dots navigation
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', this.handleKeyDown.bind(this));
        
        // Resize handler
        window.addEventListener('resize', this.debounce(() => {
            this.slideOffset = this.calculateSlideOffset();
            this.updateSlider();
        }, 250));
    }
    
    // Touch Events
    handleTouchStart(e) {
        this.startTouch(e.touches[0].clientX);
    }
    
    handleTouchMove(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        this.moveTouch(e.touches[0].clientX);
    }
    
    handleTouchEnd(e) {
        this.endTouch();
    }
    
    // Mouse Events
    handleMouseStart(e) {
        e.preventDefault();
        this.startTouch(e.clientX);
    }
    
    handleMouseMove(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        this.moveTouch(e.clientX);
    }
    
    handleMouseEnd(e) {
        this.endTouch();
    }
    
    // Logique commune touch/mouse
    startTouch(clientX) {
        this.startX = clientX;
        this.currentX = clientX;
        this.isDragging = true;
        this.startTime = Date.now();
        
        // Récupérer la position actuelle
        this.slides.forEach(slide => {
            slide.style.transition = 'none';
        });
        
        // Ajouter une classe pour le feedback visuel
        this.wrapper.classList.add('dragging');
    }
    
    moveTouch(clientX) {
        if (!this.isDragging) return;
        
        this.currentX = clientX;
        const diffX = this.currentX - this.startX;
        
        // Appliquer le déplacement à toutes les slides
        this.slides.forEach((slide, index) => {
            const relativeIndex = index - this.currentSlide;
            let baseOffset;
            
            if (relativeIndex === 0) {
                baseOffset = 0; // Active au centre
            } else if (relativeIndex < 0) {
                baseOffset = -this.slideOffset; // À gauche
            } else {
                baseOffset = this.slideOffset; // À droite
            }
            
            // Ajouter l'effet de résistance aux bords
            let adjustedDiffX = diffX;
            if (this.currentSlide === 0 && diffX > 0) {
                adjustedDiffX = diffX * 0.3; // Résistance au début
            } else if (this.currentSlide === this.totalSlides - 1 && diffX < 0) {
                adjustedDiffX = diffX * 0.3; // Résistance à la fin
            }
            
            const newOffset = baseOffset + adjustedDiffX;
            slide.style.transform = `translateX(calc(-50% + ${newOffset}px))`;
        });
    }
    
    endTouch() {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        const diffX = this.currentX - this.startX;
        const diffTime = Date.now() - this.startTime;
        
        // Calculer la vélocité
        const velocity = Math.abs(diffX) / diffTime;
        
        // Retirer la classe de dragging
        this.wrapper.classList.remove('dragging');
        
        // Remettre la transition
        this.slides.forEach(slide => {
            slide.style.transition = 'transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        });
        
        // Déterminer s'il faut changer de slide
        const shouldSwipeByDistance = Math.abs(diffX) > this.minSwipeDistance;
        const shouldSwipeByVelocity = velocity > this.velocityThreshold;
        const shouldSwipeByTime = diffTime < this.maxSwipeTime;
        
        const shouldSwipe = (shouldSwipeByDistance && shouldSwipeByTime) || shouldSwipeByVelocity;
        
        if (shouldSwipe) {
            if (diffX > 0 && this.currentSlide > 0) {
                // Swipe vers la droite - slide précédent
                this.previousSlide();
            } else if (diffX < 0 && this.currentSlide < this.totalSlides - 1) {
                // Swipe vers la gauche - slide suivant
                this.nextSlide();
            } else {
                // Revenir à la position actuelle
                this.updateSlider();
            }
        } else {
            // Revenir à la position actuelle
            this.updateSlider();
        }
    }
    
    // Navigation
    nextSlide() {
        if (this.currentSlide < this.totalSlides - 1) {
            this.currentSlide++;
            this.updateSlider();
            this.announceSlideChange();
        }
    }
    
    previousSlide() {
        if (this.currentSlide > 0) {
            this.currentSlide--;
            this.updateSlider();
            this.announceSlideChange();
        }
    }
    
    goToSlide(index) {
        if (index >= 0 && index < this.totalSlides && index !== this.currentSlide) {
            this.currentSlide = index;
            this.updateSlider();
            this.announceSlideChange();
        }
    }
    
    // Mise à jour du slider
    updateSlider() {
        this.slides.forEach((slide, index) => {
            const relativeIndex = index - this.currentSlide;
            
            // Supprimer toutes les classes d'état
            slide.classList.remove('slide-active', 'slide-previous', 'slide-next', 'slide-hidden');
            
            if (relativeIndex === 0) {
                // Slide active au centre
                slide.classList.add('slide-active');
                slide.style.transform = 'translateX(-50%)';
                slide.style.opacity = '1';
            } else if (relativeIndex === -1) {
                // Slide précédente (peek à gauche)
                slide.classList.add('slide-previous');
                slide.style.transform = `translateX(calc(-50% - ${this.slideOffset}px))`;
                slide.style.opacity = '1'; // PAS de transparence
            } else if (relativeIndex === 1) {
                // Slide suivante (peek à droite)
                slide.classList.add('slide-next');
                slide.style.transform = `translateX(calc(-50% + ${this.slideOffset}px))`;
                slide.style.opacity = '1'; // PAS de transparence
            } else {
                // Slides cachées
                slide.classList.add('slide-hidden');
                const direction = relativeIndex < 0 ? -1 : 1;
                slide.style.transform = `translateX(${direction * 300}vw)`;
                slide.style.opacity = '0';
            }
        });
        
        // Mettre à jour les dots
        this.dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
            dot.setAttribute('aria-label', `Aller au slide ${index + 1}${index === this.currentSlide ? ' (actuel)' : ''}`);
        });
        
        // Accessibilité
        this.slides.forEach((slide, index) => {
            const isActive = index === this.currentSlide;
            slide.setAttribute('aria-hidden', !isActive);
            const card = slide.querySelector('.card');
            if (card) {
                card.setAttribute('tabindex', isActive ? '0' : '-1');
            }
        });
    }
    
    // Annonce vocale du changement de slide pour l'accessibilité
    announceSlideChange() {
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'polite');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'sr-only';
        announcement.textContent = `Slide ${this.currentSlide + 1} sur ${this.totalSlides}`;
        document.body.appendChild(announcement);
        
        setTimeout(() => {
            document.body.removeChild(announcement);
        }, 1000);
    }
    
    // Keyboard navigation
    handleKeyDown(e) {
        // Vérifier si le focus est sur le slider
        if (!this.container.contains(document.activeElement)) return;
        
        switch(e.key) {
            case 'ArrowLeft':
                e.preventDefault();
                this.previousSlide();
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.nextSlide();
                break;
            case 'Home':
                e.preventDefault();
                this.goToSlide(0);
                break;
            case 'End':
                e.preventDefault();
                this.goToSlide(this.totalSlides - 1);
                break;
        }
    }
    
    // Auto-play (optionnel)
    startAutoPlay(interval = 5000) {
        this.stopAutoPlay();
        
        this.autoPlayInterval = setInterval(() => {
            if (this.currentSlide < this.totalSlides - 1) {
                this.nextSlide();
            } else {
                this.goToSlide(0);
            }
        }, interval);
    }
    
    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }
    
    // Utility: Debounce
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
}

// Initialisation au chargement du DOM
document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.getElementById('cardSlider');
    
    if (sliderContainer) {
        const slider = new FoyerSlider(sliderContainer);
        
        // Optionnel : démarrer l'auto-play après 3 secondes d'inactivité
        // setTimeout(() => slider.startAutoPlay(4000), 3000);
        
        // Arrêter l'auto-play sur interaction
        sliderContainer.addEventListener('touchstart', () => slider.stopAutoPlay());
        sliderContainer.addEventListener('mousedown', () => slider.stopAutoPlay());
        
        // Préchargement des images
        const images = sliderContainer.querySelectorAll('img[src]');
        images.forEach(img => {
            if (!img.complete) {
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
            }
        });
        
        // Exposer l'instance globalement pour debugging
        window.foyerSlider = slider;
    }
    
    // Gestion du focus pour l'accessibilité
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.addEventListener('focus', function() {
            this.style.outline = '3px solid rgba(255, 255, 255, 0.8)';
            this.style.outlineOffset = '2px';
        });
        
        card.addEventListener('blur', function() {
            this.style.outline = 'none';
        });
    });
    
    // Performance: Intersection Observer pour les animations
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, {
            threshold: 0.1
        });
        
        cards.forEach(card => observer.observe(card));
    }
});