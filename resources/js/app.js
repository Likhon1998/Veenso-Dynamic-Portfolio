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

document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initHeaderScrollState();
    initMobileNav();
    initServicesDropdown();
});
