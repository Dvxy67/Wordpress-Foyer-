/**
 * Foyer Slider - Gestion du slider tactile mobile-first
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
        
        // Seuils pour la détection de swipe
        this.minSwipeDistance = 50;
        this.maxSwipeTime = 300;
        
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
    }
    
    moveTouch(clientX) {
        if (!this.isDragging) return;
        
        this.currentX = clientX;
        const diffX = this.currentX - this.startX;
        const currentTranslate = -(this.currentSlide * this.slideWidth);
        const newTranslate = currentTranslate + (diffX / this.container.offsetWidth * 100);
        
        this.wrapper.style.transform = `translateX(${newTranslate}%)`;
    }
    
    endTouch() {
        if (!this.isDragging) return;
        
        this.isDragging = false;
        const diffX = this.currentX - this.startX;
        const diffTime = Date.now() - this.startTime;
        
        // Remettre la transition
        this.wrapper.style.transition = 'transform 0.3s ease-out';
        
        // Déterminer s'il faut changer de slide
        const shouldSwipe = Math.abs(diffX) > this.minSwipeDistance && diffTime < this.maxSwipeTime;
        
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
        }
    }
    
    previousSlide() {
        if (this.currentSlide > 0) {
            this.currentSlide--;
            this.updateSlider();
        }
    }
    
    goToSlide(index) {
        if (index >= 0 && index < this.totalSlides) {
            this.currentSlide = index;
            this.updateSlider();
        }
    }
    
    // Mise à jour du slider
    updateSlider() {
        const translateX = -(this.currentSlide * this.slideWidth);
        this.wrapper.style.transform = `translateX(${translateX}%)`;
        
        // Mettre à jour les dots
        this.dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
        });
        
        // Accessibilité
        this.slides.forEach((slide, index) => {
            const isActive = index === this.currentSlide;
            slide.setAttribute('aria-hidden', !isActive);
            if (isActive) {
                slide.querySelector('.card').focus();
            }
        });
    }
    
    // Keyboard navigation
    handleKeyDown(e) {
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
        new FoyerSlider(sliderContainer);
        
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

// Style pour l'animation d'entrée
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
`;
document.head.appendChild(style);
