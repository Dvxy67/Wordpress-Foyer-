/**
 * Foyer Slider - Gestion du slider tactile mobile-first
 * Version 1.1 - Amélioration du swipe
 */

class FoyerSlider {
    constructor(container) {
        this.container = container;
        this.wrapper = container.querySelector('#sliderWrapper');
        this.dots = container.querySelectorAll('.dot');
        this.slides = container.querySelectorAll('.slide');
        
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.slideWidth = 100 / this.totalSlides;
        
        // Variables pour le touch
        this.startX = 0;
        this.currentX = 0;
        this.isDragging = false;
        this.startTime = 0;
        
        // Seuils pour la détection de swipe - AMÉLIORÉS
        this.minSwipeDistance = 30; // Réduit de 50 à 30 pour plus de sensibilité
        this.maxSwipeTime = 500; // Augmenté de 300 à 500 pour plus de tolérance
        this.velocityThreshold = 0.3; // Nouveau : seuil de vélocité
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.updateSlider();
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
        window.addEventListener('resize', this.debounce(this.handleResize.bind(this), 250));
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
        
        // Retirer la transition pendant le drag
        this.wrapper.style.transition = 'none';
        
        // Ajouter une classe pour le feedback visuel
        this.wrapper.classList.add('dragging');
    }
    
    moveTouch(clientX) {
        if (!this.isDragging) return;
        
        this.currentX = clientX;
        const diffX = this.currentX - this.startX;
        const currentTranslate = -(this.currentSlide * this.slideWidth);
        
        // Amélioration : limiter le déplacement aux bornes avec un effet de resistance
        let newTranslate = currentTranslate + (diffX / this.container.offsetWidth * 100);
        
        // Effet de resistance aux bords
        if (this.currentSlide === 0 && diffX > 0) {
            newTranslate = currentTranslate + (diffX / this.container.offsetWidth * 100 * 0.3);
        } else if (this.currentSlide === this.totalSlides - 1 && diffX < 0) {
            newTranslate = currentTranslate + (diffX / this.container.offsetWidth * 100 * 0.3);
        }
        
        this.wrapper.style.transform = `translateX(${newTranslate}%)`;
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
        
        // Remettre la transition avec un easing plus naturel
        this.wrapper.style.transition = 'transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        
        // Déterminer s'il faut changer de slide - LOGIQUE AMÉLIORÉE
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
        const translateX = -(this.currentSlide * this.slideWidth);
        this.wrapper.style.transform = `translateX(${translateX}%)`;
        
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
    
    // Resize handler
    handleResize() {
        this.updateSlider();
    }
    
    // Auto-play (optionnel)
    startAutoPlay(interval = 5000) {
        this.stopAutoPlay(); // Arrêter l'auto-play existant
        
        this.autoPlayInterval = setInterval(() => {
            if (this.currentSlide < this.totalSlides - 1) {
                this.nextSlide();
            } else {
                this.goToSlide(0); // Retour au début
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

// Styles additionnels pour les améliorations
const style = document.createElement('style');
style.textContent = `
    .animate-in {
        animation: slideIn 0.6s ease-out;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Style pour le dragging */
    .slider-wrapper.dragging {
        cursor: grabbing;
        cursor: -webkit-grabbing;
    }
    
    /* Classe pour masquer visuellement mais garder accessible */
    .sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        white-space: nowrap;
        border: 0;
    }
    
    /* Amélioration du curseur */
    .slider-wrapper {
        cursor: grab;
        cursor: -webkit-grab;
    }
`;
document.head.appendChild(style);