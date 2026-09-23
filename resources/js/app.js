import './bootstrap';

function initScrollReveal() {
    const targets = document.querySelectorAll('.reveal');

    if (!targets.length) return;

    const show = (el) => el.classList.add('is-visible');

    if (!('IntersectionObserver' in window)) {
        targets.forEach(show);
        return;
    }

    const isOnScreen = (el) => {
        const rect = el.getBoundingClientRect();
        return rect.bottom > 0 && rect.top < window.innerHeight + 80;
    };

    // Failsafe: never leave content invisible if observer never fires
    const failsafe = setTimeout(() => {
        targets.forEach(show);
    }, 1800);

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting || entry.intersectionRatio > 0) {
                    const delay = entry.target.dataset.revealDelay || 0;
                    setTimeout(() => show(entry.target), Number(delay));
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.01, rootMargin: '80px 0px 80px 0px' }
    );

    targets.forEach((el) => {
        if (isOnScreen(el)) {
            show(el);
            return;
        }
        observer.observe(el);
    });

    window.addEventListener('load', () => {
        targets.forEach((el) => {
            if (isOnScreen(el)) {
                show(el);
                observer.unobserve(el);
            }
        });
    }, { once: true });

    // Keep failsafe as last resort; only clear once every target is visible
    const watch = setInterval(() => {
        const pending = [...targets].filter((el) => !el.classList.contains('is-visible'));
        if (!pending.length) {
            clearTimeout(failsafe);
            clearInterval(watch);
        }
    }, 400);
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

    const mobileToggle = menu.querySelector('[data-mobile-services-toggle]');
    const mobilePanel = menu.querySelector('[data-mobile-services-panel]');
    const mobileChevron = menu.querySelector('[data-mobile-services-chevron]');
    if (mobileToggle && mobilePanel) {
        mobileToggle.addEventListener('click', () => {
            const open = mobilePanel.classList.toggle('hidden') === false;
            mobileToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            if (mobileChevron) {
                mobileChevron.classList.toggle('rotate-180', open);
            }
        });
    }
}

function initServicesDropdown() {
    const dropdown = document.querySelector('[data-nav-dropdown]');
    if (!dropdown) return;

    const trigger = dropdown.querySelector('[data-nav-dropdown-trigger]');
    const panel = dropdown.querySelector('[data-nav-dropdown-panel]');
    if (!trigger || !panel) return;

    let lockedOpen = false;
    let closeTimer = null;

    const open = (lock = false) => {
        if (closeTimer) {
            clearTimeout(closeTimer);
            closeTimer = null;
        }
        panel.classList.remove('hidden');
        trigger.setAttribute('aria-expanded', 'true');
        if (lock) lockedOpen = true;
    };

    const close = (force = false) => {
        if (lockedOpen && !force) return;
        panel.classList.add('hidden');
        trigger.setAttribute('aria-expanded', 'false');
        lockedOpen = false;
    };

    const scheduleClose = () => {
        if (lockedOpen) return;
        closeTimer = setTimeout(() => close(false), 150);
    };

    trigger.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();
        if (panel.classList.contains('hidden')) {
            open(true);
        } else {
            close(true);
        }
    });

    dropdown.addEventListener('mouseenter', () => open(false));
    dropdown.addEventListener('mouseleave', scheduleClose);

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => close(true));
    });

    document.addEventListener('click', (event) => {
        if (!dropdown.contains(event.target)) {
            close(true);
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') close(true);
    });
}

function initWhyServiceHeadings() {
    const section = document.querySelector('[data-why-services]');
    if (!section) return;

    const cards = section.querySelectorAll('[data-why-service-card]');
    if (!cards.length) return;

    const prepareHeading = (titleEl) => {
        if (!titleEl || titleEl.dataset.prepared === '1') return;
        const text = titleEl.textContent.trim();
        if (!text) return;

        titleEl.dataset.prepared = '1';
        titleEl.setAttribute('aria-label', text);
        titleEl.textContent = '';

        text.split(/\s+/).filter(Boolean).forEach((chunk) => {
            const word = document.createElement('span');
            word.className = 'why-service-card__word';
            word.textContent = chunk;
            titleEl.appendChild(word);
        });
    };

    cards.forEach((card) => {
        prepareHeading(card.querySelector('[data-animate-heading]'));
    });

    const activate = (card) => {
        card.classList.add('is-inview');
        const words = card.querySelectorAll('.why-service-card__word');
        words.forEach((word, i) => {
            word.style.transitionDelay = `${i * 45}ms`;
        });
    };

    if (!('IntersectionObserver' in window)) {
        cards.forEach(activate);
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                activate(entry.target);
                observer.unobserve(entry.target);
            });
        },
        { threshold: 0.2, rootMargin: '0px 0px -40px 0px' }
    );

    cards.forEach((card) => observer.observe(card));
}

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initHeaderScrollState();
    initMobileNav();
    initServicesDropdown();
    initWhyServiceHeadings();
});
