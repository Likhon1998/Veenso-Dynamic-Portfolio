import './bootstrap';

function initScrollReveal() {
    const targets = document.querySelectorAll('.reveal');

    if (!targets.length) return;

    const show = (el) => el.classList.add('is-visible');

    if (!('IntersectionObserver' in window)) {
        targets.forEach(show);
        return;
    }

    // Failsafe: never leave content invisible if observer never fires
    const failsafe = setTimeout(() => {
        targets.forEach(show);
    }, 2500);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const delay = entry.target.dataset.revealDelay || 0;
                    setTimeout(() => show(entry.target), Number(delay));
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.08, rootMargin: '0px 0px -20px 0px' }
    );

    targets.forEach((el) => observer.observe(el));

    // Clear failsafe once everything above the fold is handled
    window.addEventListener('load', () => {
        clearTimeout(failsafe);
        // Still reveal anything that should already be on screen
        targets.forEach((el) => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight * 0.95) {
                show(el);
            }
        });
    }, { once: true });
}

function initHeaderScrollState() {
    const header = document.querySelector('[data-site-header]');
    if (!header) return;

    const setState = () => {
        header.classList.toggle('is-scrolled', window.scrollY > 12);
    };

    setState();
    window.addEventListener('scroll', setState, { passive: true });
}

function initMobileNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');
    if (!toggle || !menu) return;

    toggle.addEventListener('click', () => {
        const isOpen = menu.classList.toggle('is-open');
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        document.body.classList.toggle('overflow-hidden', isOpen);
    });

    menu.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            menu.classList.remove('is-open');
            toggle.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('overflow-hidden');
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initHeaderScrollState();
    initMobileNav();
});
