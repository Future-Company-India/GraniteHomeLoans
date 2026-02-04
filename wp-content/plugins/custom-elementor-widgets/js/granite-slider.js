/**
 * Granite Slider JavaScript
 * Version: 1.0.0
 */

(function ($) {
    'use strict';

    class GraniteSlider {
        constructor(sliderId, options = {}) {
            this.slider = document.getElementById(sliderId);

            if (!this.slider) {
                console.error(`Slider element with id "${sliderId}" not found`);
                return;
            }

            this.track = this.slider.querySelector('.slider-track');
            this.slides = Array.from(this.slider.querySelectorAll('.slider-slide'));
            this.currentIndex = 0;
            this.autoplayInterval = null;
            this.isTransitioning = false;

            // Default options
            this.options = {
                autoplay: options.autoplay !== false,
                autoplayDelay: options.autoplayDelay || 4000,
                swipe: options.swipe !== false,
                lightbox: options.lightbox !== false,
                loop: options.loop !== false,
                keyboard: options.keyboard !== false,
                pauseOnHover: options.pauseOnHover !== false,
                ...options
            };

            // Initialize
            this.init();
        }

        init() {
            if (this.slides.length === 0) {
                console.warn('No slides found in slider');
                return;
            }

            // Setup navigation
            this.setupNavigation();

            // Setup dots
            this.setupDots();

            // Setup lightbox
            if (this.options.lightbox) {
                this.setupLightbox();
            }

            // Setup swipe
            if (this.options.swipe) {
                this.setupSwipe();
            }

            // Start autoplay
            if (this.options.autoplay) {
                this.startAutoplay();
            }

            // Keyboard navigation
            if (this.options.keyboard) {
                this.setupKeyboard();
            }

            // Pause on hover
            if (this.options.pauseOnHover) {
                this.setupHoverPause();
            }

            // Update initial state
            this.updateSlider();
        }

        setupNavigation() {
            const prevBtn = this.slider.querySelector('.slider-nav.prev');
            const nextBtn = this.slider.querySelector('.slider-nav.next');

            if (prevBtn) {
                prevBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.prev();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.next();
                });
            }
        }

        setupDots() {
            const dotsContainer = this.slider.querySelector('.slider-dots');
            if (!dotsContainer) return;

            dotsContainer.innerHTML = '';

            this.slides.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = 'slider-dot';
                if (index === 0) dot.classList.add('active');
                dot.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.goTo(index);
                });
                dotsContainer.appendChild(dot);
            });
        }

        setupLightbox() {
            // Check if lightbox already exists
            let lightbox = document.getElementById('graniteSliderLightbox');

            if (!lightbox) {
                // Create lightbox
                lightbox = document.createElement('div');
                lightbox.id = 'graniteSliderLightbox';
                lightbox.className = 'granite-lightbox';
                lightbox.innerHTML = `
                    <div class="lightbox-content">
                        <button class="lightbox-close" aria-label="Close Lightbox">×</button>
                        <button class="lightbox-nav prev" aria-label="Previous Image">‹</button>
                        <button class="lightbox-nav next" aria-label="Next Image">›</button>
                        <img class="lightbox-img" src="" alt="">
                    </div>
                `;
                document.body.appendChild(lightbox);
            }

            const lightboxImg = lightbox.querySelector('.lightbox-img');
            const lightboxClose = lightbox.querySelector('.lightbox-close');
            const lightboxPrev = lightbox.querySelector('.lightbox-nav.prev');
            const lightboxNext = lightbox.querySelector('.lightbox-nav.next');

            // Open lightbox on slide click
            this.slides.forEach((slide, index) => {
                slide.addEventListener('click', () => {
                    this.openLightbox(index);
                });
            });

            // Close lightbox
            lightboxClose.addEventListener('click', () => this.closeLightbox());
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    this.closeLightbox();
                }
            });

            // Lightbox navigation
            lightboxPrev.addEventListener('click', (e) => {
                e.stopPropagation();
                this.prevLightbox();
            });

            lightboxNext.addEventListener('click', (e) => {
                e.stopPropagation();
                this.nextLightbox();
            });

            this.lightbox = lightbox;
            this.lightboxImg = lightboxImg;
        }

        setupSwipe() {
            let startX = 0;
            let moveX = 0;
            let isDragging = false;
            let startTime = 0;

            // Touch events
            this.slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
                startTime = Date.now();
                isDragging = true;
                this.stopAutoplay();
            }, { passive: true });

            this.slider.addEventListener('touchmove', (e) => {
                if (!isDragging) return;
                moveX = e.touches[0].clientX - startX;
            }, { passive: true });

            this.slider.addEventListener('touchend', () => {
                if (!isDragging) return;
                isDragging = false;

                const endTime = Date.now();
                const timeDiff = endTime - startTime;
                const velocity = Math.abs(moveX) / timeDiff;

                // Swipe threshold: 50px or fast swipe
                if (Math.abs(moveX) > 50 || velocity > 0.5) {
                    if (moveX > 0) {
                        this.prev();
                    } else {
                        this.next();
                    }
                }

                moveX = 0;
                if (this.options.autoplay) {
                    this.startAutoplay();
                }
            }, { passive: true });

            // Mouse drag support
            let mouseStartX = 0;
            let mouseMoveX = 0;
            let isMouseDragging = false;

            this.slider.addEventListener('mousedown', (e) => {
                mouseStartX = e.clientX;
                isMouseDragging = true;
                this.slider.style.cursor = 'grabbing';
                this.stopAutoplay();
                e.preventDefault();
            });

            document.addEventListener('mousemove', (e) => {
                if (!isMouseDragging) return;
                mouseMoveX = e.clientX - mouseStartX;
            });

            document.addEventListener('mouseup', () => {
                if (!isMouseDragging) return;
                isMouseDragging = false;
                this.slider.style.cursor = '';

                if (Math.abs(mouseMoveX) > 50) {
                    if (mouseMoveX > 0) {
                        this.prev();
                    } else {
                        this.next();
                    }
                }

                mouseMoveX = 0;
                if (this.options.autoplay) {
                    this.startAutoplay();
                }
            });
        }

        setupKeyboard() {
            document.addEventListener('keydown', (e) => {
                const lightbox = document.getElementById('graniteSliderLightbox');

                // Only handle keyboard if lightbox is open
                if (lightbox && lightbox.classList.contains('active')) {
                    if (e.key === 'ArrowLeft') {
                        e.preventDefault();
                        this.prevLightbox();
                    }
                    if (e.key === 'ArrowRight') {
                        e.preventDefault();
                        this.nextLightbox();
                    }
                    if (e.key === 'Escape') {
                        e.preventDefault();
                        this.closeLightbox();
                    }
                }
            });
        }

        setupHoverPause() {
            this.slider.addEventListener('mouseenter', () => {
                this.stopAutoplay();
            });

            this.slider.addEventListener('mouseleave', () => {
                if (this.options.autoplay) {
                    this.startAutoplay();
                }
            });
        }

        next() {
            if (this.isTransitioning) return;

            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
            this.updateSlider();
        }

        prev() {
            if (this.isTransitioning) return;

            this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            this.updateSlider();
        }

        goTo(index) {
            if (this.isTransitioning || index === this.currentIndex) return;

            this.currentIndex = index;
            this.updateSlider();
        }

        updateSlider() {
            this.isTransitioning = true;

            const offset = -this.currentIndex * 100;
            this.track.style.transform = `translateX(${offset}%)`;

            this.updateDots();
            this.updateCounter();

            // Reset transition flag after animation
            setTimeout(() => {
                this.isTransitioning = false;
            }, 600);
        }

        updateDots() {
            const dots = this.slider.querySelectorAll('.slider-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === this.currentIndex);
            });
        }

        updateCounter() {
            const counter = this.slider.querySelector('.slide-counter');
            if (counter) {
                counter.textContent = `${this.currentIndex + 1}/${this.slides.length}`;
            }
        }

        openLightbox(index) {
            this.currentIndex = index;
            this.stopAutoplay();

            if (!this.lightbox) return;

            this.lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';

            this.updateLightboxImage();
        }

        closeLightbox() {
            if (!this.lightbox) return;

            this.lightbox.classList.remove('active');
            document.body.style.overflow = '';

            if (this.options.autoplay) {
                this.startAutoplay();
            }
        }

        nextLightbox() {
            this.currentIndex = (this.currentIndex + 1) % this.slides.length;
            this.updateLightboxImage();
        }

        prevLightbox() {
            this.currentIndex = (this.currentIndex - 1 + this.slides.length) % this.slides.length;
            this.updateLightboxImage();
        }

        updateLightboxImage() {
            if (!this.lightboxImg) return;

            const currentSlide = this.slides[this.currentIndex];
            const img = currentSlide.querySelector('img');

            if (img) {
                this.lightboxImg.src = img.src;
                this.lightboxImg.alt = img.alt || `Slide ${this.currentIndex + 1}`;
            }
        }

        startAutoplay() {
            this.stopAutoplay();
            this.autoplayInterval = setInterval(() => {
                this.next();
            }, this.options.autoplayDelay);
        }

        stopAutoplay() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        }

        destroy() {
            this.stopAutoplay();

            // Remove event listeners
            // Note: In production, you'd want to store references to bound functions
            // to properly remove event listeners

            // Remove lightbox if it exists
            if (this.lightbox) {
                this.lightbox.remove();
            }
        }
    }

    // Make it globally available
    window.GraniteSlider = GraniteSlider;

    // jQuery plugin wrapper (optional)
    $.fn.graniteSlider = function (options) {
        return this.each(function () {
            if (!$.data(this, 'graniteSlider')) {
                $.data(this, 'graniteSlider', new GraniteSlider(this.id, options));
            }
        });
    };

})(jQuery);
