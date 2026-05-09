/**
 * Highlights service category pills based on which section is nearest the viewport midline.
 */
export function initServicesScrollSpy(reduced, lenis) {
    if (reduced) return;

    const nav = document.querySelector('[data-ctc-services-nav]');
    if (!nav) return;

    const links = Array.from(nav.querySelectorAll('[data-ctc-spy]'));
    if (!links.length) return;

    const sectionIds = links
        .map((a) => a.getAttribute('data-ctc-spy'))
        .filter(Boolean);

    const sections = sectionIds
        .map((id) => document.getElementById(id))
        .filter(Boolean);

    if (sections.length < 2) return;

    const setActive = (id) => {
        links.forEach((a) => {
            const on = a.getAttribute('data-ctc-spy') === id;
            a.classList.toggle('ctc-services-pill--spy-active', on);
        });
    };

    const syncFromScroll = () => {
        const mid = window.innerHeight * 0.4;
        let best = sectionIds[0];
        let bestDist = Infinity;
        sections.forEach((el) => {
            const r = el.getBoundingClientRect();
            const c = r.top + Math.min(r.height * 0.25, 120);
            const d = Math.abs(c - mid);
            if (d < bestDist) {
                bestDist = d;
                best = el.id;
            }
        });
        if (best) setActive(best);
    };

    let t = 0;
    const debounced = () => {
        if (t) return;
        t = requestAnimationFrame(() => {
            t = 0;
            syncFromScroll();
        });
    };

    if (lenis) {
        lenis.on('scroll', debounced);
    } else {
        window.addEventListener('scroll', debounced, { passive: true });
    }
    window.addEventListener('resize', debounced, { passive: true });
    debounced();
}
