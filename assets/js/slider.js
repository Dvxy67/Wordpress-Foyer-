class FoyerSlider {
    constructor(container) {
        this.container = container;
        this.wrapper = container.querySelector('#sliderWrapper');
        this.dots = container.querySelectorAll('.dot');
        this.slides = container.querySelectorAll('.slide');

        this.currentSlide = 0;
        this.totalSlides = this.slides.length;
        this.previousPositions = new Map();

        // Variables drag
        this.startX = 0;
        this.startY = 0;
        this.currentX = 0;
        this.isDragging = false;
        this.hasMoved = false;
        this.startTime = 0;

        // FIX CENTRAGE : stocker l'ID du rAF pour pouvoir l'annuler
        this.ticking = false;
        this.rafId = null;

        this.clickPrevented = false;

        this.minSwipeDistance = 18;
        this.maxSwipeTime = 500;
        this.velocityThreshold = 0.18;
        this.dragThreshold = 8;

        this.isDesktop = window.innerWidth >= 1024;

        // Fallback statique utilisé seulement si la mesure DOM échoue
        this.slideOffset = this.calculateSlideOffsetFallback();
        this.cachedPositions = {
            active: 0,
            previous: -this.slideOffset,
            next: this.slideOffset
        };

        this.init();
    }

    // FIX GAP : mesure l'offset réel depuis la position CSS des slides.
    // Appelé dans init() AVANT updateSlider() pour lire les positions nth-child pures.
    // getBoundingClientRect() reflète le calc() CSS exact, y compris les unités vh.
    // → Aucune conversion window.innerHeight/vh, aucun drift possible.
    measureOffsetFromCSS() {
        // slides[0] = carte 1 (centrée par CSS), slides[2] = carte 3 (à droite par CSS)
        const activeRect  = this.slides[0].getBoundingClientRect();
        const nextRect    = this.slides[2].getBoundingClientRect();

        const activeCenter = activeRect.left  + activeRect.width  / 2;
        const nextCenter   = nextRect.left    + nextRect.width    / 2;

        const offset = Math.round(Math.abs(nextCenter - activeCenter));

        // Si la mesure est cohérente (> 100px), on l'utilise ; sinon fallback
        return offset > 100 ? offset : null;
    }

    // Fallback purement statique, utilisé seulement si mesure DOM échoue
    calculateSlideOffsetFallback() {
        const w = window.innerWidth;
        if (w >= 768)             return Math.round(0.9 * w - 50);
        if (w >= 360 && w < 375) return Math.round(0.14 * window.innerHeight + 0.53 * w);
        return Math.round(0.16 * window.innerHeight + 0.56 * w);
    }

    init() {
        this.setupEventListeners();

        if (!this.isDesktop) {
            // FIX GAP : mesurer l'offset depuis le CSS avant de toucher aux inline styles
            const measured = this.measureOffsetFromCSS();
            if (measured) {
                this.slideOffset = measured;
                this.cachedPositions = {
                    active: 0,
                    previous: -this.slideOffset,
                    next: this.slideOffset
                };
            }
            this.updateSlider();
        }
    }

    setupEventListeners() {
        if (this.isDesktop) return;

        // passive: true sur touchstart → le click synthétique sur les <a> reste intact
        this.wrapper.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: true });
        this.wrapper.addEventListener('touchmove',  this.handleTouchMove.bind(this),  { passive: false });
        this.wrapper.addEventListener('touchend',   this.handleTouchEnd.bind(this),   { passive: true });

        this.wrapper.addEventListener('mousedown',   this.handleMouseStart.bind(this));
        this.wrapper.addEventListener('mousemove',   this.handleMouseMove.bind(this));
        this.wrapper.addEventListener('mouseup',     this.handleMouseEnd.bind(this));
        this.wrapper.addEventListener('mouseleave',  this.handleMouseEnd.bind(this));

        this.wrapper.addEventListener('selectstart', (e) => e.preventDefault());
        this.wrapper.addEventListener('contextmenu', (e) => e.preventDefault());

        // Bloquer le click synthétique sur les cartes SEULEMENT après un vrai swipe
        this.slides.forEach(slide => {
            const card = slide.querySelector('.card');
            if (card) {
                card.addEventListener('click', (e) => {
                    if (this.clickPrevented) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                });
            }
        });

        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        document.addEventListener('keydown', this.handleKeyDown.bind(this));

        window.addEventListener('resize', this.debounce(() => {
            const wasDesktop = this.isDesktop;
            this.isDesktop = window.innerWidth >= 1024;

            if (wasDesktop !== this.isDesktop) {
                location.reload();
                return;
            }

            if (!this.isDesktop) {
                // Après resize, les slides ont leurs styles inline → recalculer depuis fallback
                // (la mesure DOM ne serait pas fiable car les inline styles ont déjà été posés)
                this.slideOffset = this.calculateSlideOffsetFallback();
                this.cachedPositions = {
                    active: 0,
                    previous: -this.slideOffset,
                    next: this.slideOffset
                };
                this.updateSlider();
            }
        }, 250));
    }

    handleTouchStart(e) {
        this.startY = e.touches[0].clientY;
        this.startTouch(e.touches[0].clientX);
    }

    handleTouchMove(e) {
        if (!this.hasMoved) {
            const diffX = Math.abs(e.touches[0].clientX - this.startX);
            const diffY = Math.abs(e.touches[0].clientY - this.startY);

            if (diffY > diffX && diffY > this.dragThreshold) {
                // Mouvement vertical → laisser le scroll natif
                this.hasMoved = true;
                return;
            }

            if (diffX > this.dragThreshold) {
                // Seuil horizontal dépassé → swipe confirmé
                this.isDragging = true;
                this.hasMoved = true;
                this._disableTransitions();
                this.wrapper.classList.add('dragging');
            }
        }

        if (!this.isDragging) return;

        if (e.cancelable) e.preventDefault();
        this.moveTouch(e.touches[0].clientX);
    }

    handleTouchEnd(e) {
        this.endTouch();
    }

    handleMouseStart(e) {
        e.preventDefault();
        this.startY = e.clientY;
        this.startTouch(e.clientX);
        this.isDragging = true;
        this.hasMoved = true;
        this._disableTransitions();
        this.wrapper.classList.add('dragging');
    }

    handleMouseMove(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        this.moveTouch(e.clientX);
    }

    handleMouseEnd(e) {
        this.endTouch();
    }

    // Désactiver les transitions sur les 3 slides visibles (DRY)
    _disableTransitions() {
        const prevIdx = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIdx = (this.currentSlide + 1) % this.totalSlides;
        [this.currentSlide, prevIdx, nextIdx].forEach(idx => {
            this.slides[idx].style.transition = 'none';
            this.slides[idx].style.willChange = 'transform';
        });
    }

    startTouch(clientX) {
        this.startX = clientX;
        this.currentX = clientX;
        this.isDragging = false;
        this.hasMoved = false;
        this.startTime = Date.now();
    }

    moveTouch(clientX) {
        if (!this.isDragging) return;
        this.currentX = clientX;

        if (!this.ticking) {
            this.ticking = true;
            // FIX CENTRAGE : stocker l'ID pour pouvoir annuler ce rAF dans endTouch()
            this.rafId = requestAnimationFrame(() => {
                this.updateDragPosition();
                this.ticking = false;
                this.rafId = null;
            });
        }
    }

    updateDragPosition() {
        // FIX CENTRAGE : sortir immédiatement si le swipe est terminé
        // (ce rAF peut s'exécuter APRÈS endTouch() — sans cette garde, il écrase le snap)
        if (!this.isDragging) {
            this.ticking = false;
            return;
        }

        const diffX = this.currentX - this.startX;

        // Résistance rubber band aux bords
        const resistance = 0.3;
        let dampedDiff = diffX;
        const maxDrag = this.slideOffset * 1.2;
        if (Math.abs(diffX) > maxDrag) {
            const excess = Math.abs(diffX) - maxDrag;
            const sign = diffX > 0 ? 1 : -1;
            dampedDiff = sign * (maxDrag + excess * resistance);
        }

        const prevIdx = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIdx = (this.currentSlide + 1) % this.totalSlides;

        this.slides.forEach((slide, index) => {
            let base;
            if (index === this.currentSlide) {
                base = 0;                              // carte active : centrée
            } else if (index === prevIdx) {
                base = -this.slideOffset;              // précédente : à gauche
            } else if (index === nextIdx) {
                base = this.slideOffset;               // suivante : à droite
            } else {
                base = -300 * window.innerWidth / 100; // hors écran
            }

            // style.transform direct (pas cssText +=)
            slide.style.transform = `translateX(calc(-50% + ${base + dampedDiff}px)) translateZ(0)`;
        });
    }

    endTouch() {
        if (!this.hasMoved) return; // tap pur → laisser le click se déclencher normalement

        if (!this.isDragging) {
            this.hasMoved = false;
            return; // mouvement insuffisant, pas de swipe
        }

        // FIX CENTRAGE : annuler immédiatement tout rAF en attente
        // pour qu'il ne réécrive pas la position après le snap
        if (this.rafId !== null) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }
        this.ticking = false;

        this.isDragging = false;
        this.hasMoved = false;

        const diffX    = this.currentX - this.startX;
        const diffTime = Date.now() - this.startTime;
        const velocity = Math.abs(diffX) / diffTime;

        this.wrapper.classList.remove('dragging');

        const prevIdx = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIdx = (this.currentSlide + 1) % this.totalSlides;

        // Réactiver la transition AVANT updateSlider() → snap animé immédiatement
        [this.currentSlide, prevIdx, nextIdx].forEach(idx => {
            this.slides[idx].style.transition = 'transform 0.28s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
            setTimeout(() => { this.slides[idx].style.willChange = 'auto'; }, 300);
        });

        const shouldSwipe =
            (Math.abs(diffX) > this.minSwipeDistance && diffTime < this.maxSwipeTime) ||
            velocity > this.velocityThreshold;

        if (shouldSwipe) {
            // Bloquer le click synthétique post-touchend pendant 400ms
            this.clickPrevented = true;
            setTimeout(() => { this.clickPrevented = false; }, 400);

            if (diffX > 0) {
                this.previousSlide();
            } else {
                this.nextSlide();
            }
        } else {
            // Distance insuffisante → revenir à la carte actuelle
            this.updateSlider();
        }
    }

    nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
        this.updateSlider();
        this.announceSlideChange();
    }

    previousSlide() {
        this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
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
        const prevIdx = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
        const nextIdx = (this.currentSlide + 1) % this.totalSlides;

        const newPositions = new Map([
            [this.currentSlide, 'active'],
            [prevIdx, 'previous'],
            [nextIdx, 'next']
        ]);

        this.slides.forEach((slide, index) => {
            slide.classList.remove('slide-active', 'slide-previous', 'slide-next', 'slide-hidden');

            const oldPos = this.previousPositions.get(index);
            const newPos = newPositions.get(index);

            const isTeleporting =
                (oldPos === 'previous' && newPos === 'next') ||
                (oldPos === 'next'     && newPos === 'previous');

            if (isTeleporting) {
                // Repositionnement invisible : masquer → déplacer → réapparaître
                slide.style.transition = 'none';
                slide.style.opacity    = '0';

                if (index === this.currentSlide) {
                    slide.classList.add('slide-active');
                    slide.style.transform = 'translateX(-50%) translateZ(0)';
                    slide.style.zIndex    = '10';
                } else if (index === prevIdx) {
                    slide.classList.add('slide-previous');
                    slide.style.transform = `translateX(calc(-50% - ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.zIndex    = '5';
                } else if (index === nextIdx) {
                    slide.classList.add('slide-next');
                    slide.style.transform = `translateX(calc(-50% + ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.zIndex    = '5';
                }

                setTimeout(() => {
                    slide.style.transition = 'opacity 0.2s ease-in-out, transform 0.28s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    slide.style.opacity    = '1';
                }, 50);

            } else {
                if (index === this.currentSlide) {
                    slide.classList.add('slide-active');
                    slide.style.transform = 'translateX(-50%) translateZ(0)';
                    slide.style.opacity   = '1';
                    slide.style.zIndex    = '10';
                } else if (index === prevIdx) {
                    slide.classList.add('slide-previous');
                    slide.style.transform = `translateX(calc(-50% - ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.opacity   = '1';
                    slide.style.zIndex    = '5';
                } else if (index === nextIdx) {
                    slide.classList.add('slide-next');
                    slide.style.transform = `translateX(calc(-50% + ${this.slideOffset}px)) translateZ(0)`;
                    slide.style.opacity   = '1';
                    slide.style.zIndex    = '5';
                } else {
                    slide.classList.add('slide-hidden');
                    slide.style.transform = 'translateX(-300vw) translateZ(0)';
                    slide.style.opacity   = '0';
                    slide.style.zIndex    = '1';
                }
            }
        });

        this.previousPositions = new Map(newPositions);

        // Synchroniser les dots
        this.dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === this.currentSlide);
            dot.setAttribute('aria-label',
                `Aller au slide ${index + 1}${index === this.currentSlide ? ' (actuel)' : ''}`);
        });

        // Accessibilité
        this.slides.forEach((slide, index) => {
            const isActive = index === this.currentSlide;
            slide.setAttribute('aria-hidden', !isActive);
            const card = slide.querySelector('.card');
            if (card) card.setAttribute('tabindex', isActive ? '0' : '-1');
        });
    }

    announceSlideChange() {
        const el = document.createElement('div');
        el.setAttribute('aria-live', 'polite');
        el.setAttribute('aria-atomic', 'true');
        el.className = 'sr-only';
        el.textContent = `Slide ${this.currentSlide + 1} sur ${this.totalSlides}`;
        document.body.appendChild(el);
        setTimeout(() => document.body.removeChild(el), 1000);
    }

    handleKeyDown(e) {
        if (!this.container.contains(document.activeElement)) return;
        switch (e.key) {
            case 'ArrowLeft':  e.preventDefault(); this.previousSlide(); break;
            case 'ArrowRight': e.preventDefault(); this.nextSlide();     break;
            case 'Home':       e.preventDefault(); this.goToSlide(0);    break;
            case 'End':        e.preventDefault(); this.goToSlide(this.totalSlides - 1); break;
        }
    }

    startAutoPlay(interval = 5000) {
        this.stopAutoPlay();
        this.autoPlayInterval = setInterval(() => this.nextSlide(), interval);
    }

    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }

    debounce(func, wait) {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => { clearTimeout(timeout); func(...args); }, wait);
        };
    }
}

// Initialisation
document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.getElementById('cardSlider');

    if (sliderContainer) {
        const slider = new FoyerSlider(sliderContainer);

        sliderContainer.querySelectorAll('img[src]').forEach(img => {
            if (!img.complete) {
                img.addEventListener('load', function () { this.style.opacity = '1'; });
            }
        });

        window.foyerSlider = slider;
    }

    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('focus', function () {
            this.style.outline      = '3px solid rgba(255, 255, 255, 0.8)';
            this.style.outlineOffset = '2px';
        });
        card.addEventListener('blur', function () {
            this.style.outline = 'none';
        });
    });

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => entries.forEach(e => e.isIntersecting && e.target.classList.add('animate-in')),
            { threshold: 0.1 }
        );
        document.querySelectorAll('.card').forEach(card => observer.observe(card));
    }
});