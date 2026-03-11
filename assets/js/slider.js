
class FoyerSlider {
    constructor(container) {
        this.container = container;
        this.wrapper = container.querySelector('#sliderWrapper');
        this.dots = container.querySelectorAll('.dot');
        this.slides = container.querySelectorAll('.slide');
        
        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        
        // Tracker les positions précédentes des slides
        this.previousPositions = new Map();
        
        // Variables pour le touch
        this.startX = 0;
        this.currentX = 0;
        this.isDragging = false;
        this.startTime = 0;
        this.initialTransform = null;
        
        this.ticking = false;
        
        this.minSwipeDistance = 30; // Réduit de 40px à 30px
        this.maxSwipeTime = 500;
        this.velocityThreshold = 0.3;
        
        // Distance entre les slides
        this.slideOffset = this.calculateSlideOffset();
        
        this.cachedPositions = {
            active: 0,
            previous: -this.slideOffset,
            next: this.slideOffset
        };
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.updateSlider();
    }
    
    // Calcul dynamique de l'offset
    calculateSlideOffset() {
        const screenWidth = window.innerWidth;
        
        if (screenWidth < 768) {
            return 320; // Mobile : 300px carte + 20px espace
        } else if (screenWidth < 1024) {
            return 470; // Tablette : 440px carte + 30px espace
        } else if (screenWidth < 1440) {
            return 580; // Desktop : 540px carte + 40px espace
        } else {
            return 680; // Large desktop : 540px carte + 140px espace
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
            //  NOUVEAU : Mettre à jour le cache
            this.cachedPositions = {
                active: 0,
                previous: -this.slideOffset,
                next: this.slideOffset
            };
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
        
        // OPTIMISÉ : Ne désactiver la transition que sur les slides visibles
        const previousIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        const visibleIndices = [this.currentSlide, previousIndex, nextIndex];
        
        visibleIndices.forEach(idx => {
            this.slides[idx].style.transition = 'none';
        });
        
        // Ajouter une classe pour le feedback visuel
        this.wrapper.classList.add('dragging');
    }
    
    //  NOUVEAU : Méthode optimisée avec requestAnimationFrame
    moveTouch(clientX) {
        if (!this.isDragging) return;
        
        // Stocker la position actuelle
        this.currentX = clientX;
        
        // Throttler avec requestAnimationFrame (synchronise avec l'écran à 60fps)
        if (!this.ticking) {
            requestAnimationFrame(() => {
                this.updateDragPosition();
                this.ticking = false;
            });
            this.ticking = true;
        }
    }
    
    //  NOUVEAU : Calculs de position séparés dans leur propre méthode
    updateDragPosition() {
        const diffX = this.currentX - this.startX;
        
        // Calcul circulaire : Position des cartes adjacentes pendant le drag
        const previousIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        
        //  OPTIMISÉ : Utiliser le cache pour les positions de base
        this.slides.forEach((slide, index) => {
            let baseOffset;
            
            if (index === this.currentSlide) {
                baseOffset = this.cachedPositions.active; // 0
            } else if (index === previousIndex) {
                baseOffset = this.cachedPositions.previous; // -slideOffset
            } else if (index === nextIndex) {
                baseOffset = this.cachedPositions.next; // +slideOffset
            } else {
                // Cartes cachées (ne devrait pas arriver avec 3 slides)
                baseOffset = -300 * window.innerWidth / 100;
            }
            
            const newOffset = baseOffset + diffX;
            
            //  OPTIMISÉ : Utiliser translateZ(0) pour forcer GPU
            slide.style.transform = `translateX(calc(-50% + ${newOffset}px)) translateZ(0)`;
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
        
        //  OPTIMISÉ : Remettre la transition uniquement sur les slides visibles
        const previousIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        const visibleIndices = [this.currentSlide, previousIndex, nextIndex];
        
        visibleIndices.forEach(idx => {
            //  Transition plus rapide (0.35s au lieu de 0.4s)
            this.slides[idx].style.transition = 'transform 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        });
        
        // Déterminer s'il faut changer de slide
        const shouldSwipeByDistance = Math.abs(diffX) > this.minSwipeDistance;
        const shouldSwipeByVelocity = velocity > this.velocityThreshold;
        const shouldSwipeByTime = diffTime < this.maxSwipeTime;
        
        const shouldSwipe = (shouldSwipeByDistance && shouldSwipeByTime) || shouldSwipeByVelocity;
        
        // Swipe dans les deux sens TOUJOURS (loop infini)
        if (shouldSwipe) {
            if (diffX > 0) {
                // Swipe vers la droite - slide précédent
                this.previousSlide();
            } else if (diffX < 0) {
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
    
    // Navigation avec LOOP INFINI
    nextSlide() {
        this.currentSlide++;
        
        // Si on dépasse la fin, on revient au début ♾️
        if (this.currentSlide >= this.totalSlides) {
            this.currentSlide = 0;
        }
        
        this.updateSlider();
        this.announceSlideChange();
    }
    
    previousSlide() {
        this.currentSlide--;
        
        // Si on passe avant le début, on va à la fin ♾️
        if (this.currentSlide < 0) {
            this.currentSlide = this.totalSlides - 1;
        }
        
        this.updateSlider();
        this.announceSlideChange();
    }
    
    goToSlide(index) {
        if (index < 0 || index >= this.totalSlides) return;
        
        this.currentSlide = index;
        this.updateSlider();
        this.announceSlideChange();
    }
    
    updateSlider() {
        // Calculer les indices circulaires
        const previousIndex = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIndex = (this.currentSlide + 1) % this.totalSlides;
        
        // Créer une map des nouvelles positions
        const newPositions = new Map();
        newPositions.set(this.currentSlide, 'active');
        newPositions.set(previousIndex, 'previous');
        newPositions.set(nextIndex, 'next');
        
        this.slides.forEach((slide, index) => {
            // Supprimer toutes les classes d'état
            slide.classList.remove('slide-active', 'slide-previous', 'slide-next', 'slide-hidden');
            
            const oldPosition = this.previousPositions.get(index);
            const newPosition = newPositions.get(index);
            
            // DÉTECTION : Cette carte fait un grand saut ?
            const isTeleporting = 
                (oldPosition === 'previous' && newPosition === 'next') ||
                (oldPosition === 'next' && newPosition === 'previous');
            
            if (isTeleporting) {
                // ✨ SOLUTION : Disparition instantanée + repositionnement + réapparition
                
                // 1. Désactiver la transition et cacher la carte
                slide.style.transition = 'none';
                slide.style.opacity = '0';
                
                // 2. Appliquer la nouvelle position immédiatement
                if (index === this.currentSlide) {
                    slide.classList.add('slide-active');
                    slide.style.transform = 'translateX(-50%) translateZ(0)';
                    slide.style.zIndex = '10';
                } else if (index === previousIndex) {
                    slide.classList.add('slide-previous');
                    slide.style.transform = `translateX(calc(-50% - ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.zIndex = '5';
                } else if (index === nextIndex) {
                    slide.classList.add('slide-next');
                    slide.style.transform = `translateX(calc(-50% + ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.zIndex = '5';
                }
                
                // 3. Réapparaître après un court délai
                setTimeout(() => {
                    //  Transition optimisée (0.35s)
                    slide.style.transition = 'opacity 0.2s ease-in-out, transform 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    slide.style.opacity = '1';
                }, 50);
                
            } else {
                // Comportement normal pour les cartes qui ne se téléportent pas
                
                if (index === this.currentSlide) {
                    slide.classList.add('slide-active');
                    slide.style.transform = 'translateX(-50%) translateZ(0)';
                    slide.style.opacity = '1';
                    slide.style.zIndex = '10';
                } else if (index === previousIndex) {
                    slide.classList.add('slide-previous');
                    slide.style.transform = `translateX(calc(-50% - ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.opacity = '1';
                    slide.style.zIndex = '5';
                } else if (index === nextIndex) {
                    slide.classList.add('slide-next');
                    slide.style.transform = `translateX(calc(-50% + ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.opacity = '1';
                    slide.style.zIndex = '5';
                } else {
                    // Slides cachées
                    slide.classList.add('slide-hidden');
                    slide.style.transform = `translateX(-300vw) translateZ(0)`;
                    slide.style.opacity = '0';
                    slide.style.zIndex = '1';
                }
            }
        });
        
        // ✨ Sauvegarder les positions actuelles pour la prochaine fois
        this.previousPositions = new Map(newPositions);
        
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
            this.nextSlide(); // ✨ Avec le loop infini, ça boucle automatiquement !
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
        
        console.log('Slider OPTIMISÉ initialisé !');
        console.log('requestAnimationFrame activé pour 60fps constant');
        console.log('Seuil de swipe réduit à 30px (plus réactif)');
        console.log(' Transition accélérée à 0.35s');
        
        // Optionnel : démarrer l'auto-play après 3 secondes d'inactivité
        // Décommente ces lignes si tu veux l'auto-play :
        /*
        setTimeout(() => slider.startAutoPlay(4000), 3000);
        
        // Arrêter l'auto-play sur interaction
        sliderContainer.addEventListener('touchstart', () => slider.stopAutoPlay());
        sliderContainer.addEventListener('mousedown', () => slider.stopAutoPlay());
        */
        
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