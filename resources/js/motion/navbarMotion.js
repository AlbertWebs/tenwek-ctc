const SCROLL_CLASS = 'ctc-navbar--scrolled';

export function initNavbarMotion(lenis, reduced) {
    const navbar = document.querySelector('.ctc-navbar');
    if (!navbar) return;

    const update = () => {
        const y = lenis ? lenis.scroll : window.scrollY;
        navbar.classList.toggle(SCROLL_CLASS, y > 12);
    };

    update();

    if (reduced) {
        window.addEventListener('scroll', update, { passive: true });
        return;
    }

    if (lenis) {
        lenis.on('scroll', update);
    } else {
        window.addEventListener('scroll', update, { passive: true });
    }
}
