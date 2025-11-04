/**
 * GERLEN MASCARENHAS - FISIOTERAPIA
 * Main JavaScript - Professional Edition
 */

document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('site-header');
    const btnMenu = document.getElementById('btn-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    if (btnMenu && mobileMenu) {
        btnMenu.addEventListener('click', function () {
            const isOpen = btnMenu.getAttribute('aria-expanded') === 'true';
            btnMenu.setAttribute('aria-expanded', String(!isOpen));
            mobileMenu.classList.toggle('hidden');
            mobileMenu.setAttribute('aria-hidden', String(isOpen));
        });
    }

    const onScroll = function () {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const href = anchor.getAttribute('href');
            if (href.length > 1) {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
            
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                btnMenu.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
            }
        });
    });

    (function observeHeroOnce() {
        const hero = document.getElementById('hero');
        const gerlenImg = document.querySelector('.hero-gerlen');

        if (!hero) return;

        if ('IntersectionObserver' in window) {
            const io = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        hero.classList.add('hero-animate');
                        if (gerlenImg) gerlenImg.classList.add('visible');
                        obs.unobserve(hero);
                    }
                });
            }, { threshold: 0.15 });

            io.observe(hero);
        } else {
            setTimeout(function () {
                hero.classList.add('hero-animate');
                if (gerlenImg) gerlenImg.classList.add('visible');
            }, 180);
        }
    })();

    function setupDoresAnimation() {
        const doresSection = document.getElementById('dores');
        if (!doresSection) return;

        const title = doresSection.querySelector('h2');
        const subtitle = doresSection.querySelector('p');
        const cards = doresSection.querySelectorAll('.bg-emerald-50');

        title.classList.add('dores-title');
        subtitle.classList.add('dores-subtitle');
        cards.forEach(card => card.classList.add('dores-card'));

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    title.classList.add('animate');
                    subtitle.classList.add('animate');
                    cards.forEach(card => card.classList.add('animate'));
                    obs.unobserve(entry.target);
                }
            });
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        });

        observer.observe(doresSection);
    }

    setupDoresAnimation();

    function setupTestimonialsCarousel() {
        const testimonialsGrid = document.querySelector('.testimonials-grid');
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        
        if (!testimonialsGrid || testimonialCards.length === 0) return;
        
        let currentIndex = 0;
        let autoScrollInterval;
        let isUserInteracting = false;
        
        function scrollToCard(index) {
            if (window.innerWidth <= 820) {
                const card = testimonialCards[index];
                if (card) {
                    const containerWidth = testimonialsGrid.offsetWidth;
                    const cardLeft = card.offsetLeft;
                    const cardWidth = card.offsetWidth;
                    const scrollPosition = cardLeft - (containerWidth / 2) + (cardWidth / 2);
                    
                    testimonialsGrid.scrollTo({
                        left: scrollPosition,
                        behavior: 'smooth'
                    });
                }
            }
        }
        
        function startAutoScroll() {
            if (window.innerWidth <= 820 && !isUserInteracting) {
                autoScrollInterval = setInterval(() => {
                    if (!isUserInteracting) {
                        currentIndex = (currentIndex + 1) % testimonialCards.length;
                        scrollToCard(currentIndex);
                    }
                }, 5000);
            }
        }
        
        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        }
        
        function resetInactivity() {
            clearTimeout(inactivityTimer);
            inactivityTimer = setTimeout(() => {
                isUserInteracting = false;
                if (window.innerWidth <= 820) {
                    startAutoScroll();
                }
            }, 3000);
        }
        
        testimonialsGrid.addEventListener('touchstart', () => {
            isUserInteracting = true;
            stopAutoScroll();
        });
        
        testimonialsGrid.addEventListener('mousedown', () => {
            isUserInteracting = true;
            stopAutoScroll();
        });
        
        testimonialsGrid.addEventListener('scroll', () => {
            isUserInteracting = true;
            stopAutoScroll();
        });
        
        let inactivityTimer;
        testimonialsGrid.addEventListener('touchend', resetInactivity);
        testimonialsGrid.addEventListener('mouseup', resetInactivity);
        testimonialsGrid.addEventListener('scrollend', resetInactivity);
        
        let scrollTimeout;
        testimonialsGrid.addEventListener('scroll', () => {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                if (isUserInteracting) {
                    resetInactivity();
                }
            }, 150);
        });
        
        startAutoScroll();
        
        window.addEventListener('resize', () => {
            stopAutoScroll();
            if (window.innerWidth <= 820) {
                startAutoScroll();
            }
        });
    }
    
    setupTestimonialsCarousel();
});
