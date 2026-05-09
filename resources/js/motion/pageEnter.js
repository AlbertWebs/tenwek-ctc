import gsap from 'gsap';

/**
 * Soft fade-in after full page load (MPA). Avoids flash of unstyled motion.
 */
export function initPageEnter(mainEl, reduced) {
    if (!mainEl) return;
    if (reduced) {
        mainEl.style.opacity = '1';
        return;
    }
    gsap.fromTo(
        mainEl,
        { opacity: 0 },
        {
            opacity: 1,
            duration: 0.48,
            ease: 'power2.out',
            delay: 0.04,
            clearProps: 'opacity',
        },
    );
}
