/*
  Script: controle do header (menu mobile, sombra ao rolar e scroll suave)
  - Toggle do menu mobile (aria-expanded e ocultar/exibir)
  - Adiciona/remover classe 'scrolled' no header para sombra ao rolar
  - Smooth scroll para ancôras internas e fechamento do menu mobile ao clicar
*/
document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('site-header');
    const btnMenu = document.getElementById('btn-menu');
    const mobileMenu = document.getElementById('mobile-menu');

    // Toggle menu mobile
    if (btnMenu && mobileMenu) {
        btnMenu.addEventListener('click', function () {
            const isOpen = btnMenu.getAttribute('aria-expanded') === 'true';
            btnMenu.setAttribute('aria-expanded', String(!isOpen));
            mobileMenu.classList.toggle('hidden');
            mobileMenu.setAttribute('aria-hidden', String(isOpen));
        });
    }

    // Sombra ao rolar
    const onScroll = function () {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Smooth scroll para links âncora e fechamento do menu mobile ao clicar
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
            // fechar menu mobile se estiver aberto
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
                btnMenu.setAttribute('aria-expanded', 'false');
                mobileMenu.setAttribute('aria-hidden', 'true');
            }
        });
    });

    // animação de entrada do hero (aplica classes após DOM carregado e pequenos delays)
    // animar apenas uma vez quando a seção entrar na viewport
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
                        obs.unobserve(hero); // garante execução única
                    }
                });
            }, { threshold: 0.15 });

            io.observe(hero);
        } else {
            // fallback: timeout caso browser não suporte IntersectionObserver
            setTimeout(function () {
                hero.classList.add('hero-animate');
                if (gerlenImg) gerlenImg.classList.add('visible');
            }, 180);
        }
    })();

    // Função para animação da seção de dores
    function setupDoresAnimation() {
        const doresSection = document.getElementById('dores');
        const title = doresSection.querySelector('h2');
        const subtitle = doresSection.querySelector('p');
        const cards = doresSection.querySelectorAll('.bg-emerald-50');

        // Adiciona classes para permitir animação
        title.classList.add('dores-title');
        subtitle.classList.add('dores-subtitle');
        cards.forEach(card => card.classList.add('dores-card'));

        // Configuração do Intersection Observer
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Anima título e subtítulo
                    title.classList.add('animate');
                    subtitle.classList.add('animate');
                    
                    // Anima cada card
                    cards.forEach(card => {
                        card.classList.add('animate');
                    });

                    // Remove o observer após a animação
                    observer.unobserve(entry.target);
                }
            });
        };

        const observer = new IntersectionObserver(observerCallback, observerOptions);
        observer.observe(doresSection);
    }

    setupDoresAnimation();
});