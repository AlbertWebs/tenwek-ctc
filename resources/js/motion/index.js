import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { prefersReducedMotion } from './prefersReducedMotion.js';
import { createLenisForGsap } from './lenisFactory.js';
import { initPageEnter } from './pageEnter.js';
import { initScrollReveals } from './scrollReveals.js';
import { initSplitHeadings } from './splitHeadings.js';
import { initParallax } from './parallax.js';
import { initHeroMotion } from './hero.js';
import { initMagnetic } from './magnetic.js';
import { initServicesScrollSpy } from './servicesScrollSpy.js';
import { initNavbarMotion } from './navbarMotion.js';
import { initTimelineLine } from './timelineLine.js';
import { initTiltCards } from './tiltCards.js';

/**
 * @returns {{ lenis: import('lenis').default | null, getScrollY: () => number }}
 */
export function initCtcMotion() {
    const isAdmin = document.body?.dataset?.ctcSite === 'admin';
    const reduced = prefersReducedMotion();

    if (isAdmin) {
        return {
            lenis: null,
            getScrollY: () => window.scrollY,
        };
    }

    const isNewsPlayful = document.body.classList.contains('ctc-news-playful');
    if (isNewsPlayful) {
        const mainEl = document.getElementById('ctc-main');
        if (mainEl) mainEl.style.opacity = '1';
        return {
            lenis: null,
            getScrollY: () => window.scrollY,
        };
    }

    gsap.registerPlugin(ScrollTrigger);

    const main = document.getElementById('ctc-main');
    const scrollTriggerOk = !reduced;

    let lenis = null;
    if (!reduced) {
        lenis = createLenisForGsap(gsap, ScrollTrigger);
    }

    initPageEnter(main, reduced);
    initHeroMotion(reduced, scrollTriggerOk);
    initScrollReveals(reduced, scrollTriggerOk);
    initSplitHeadings(reduced, scrollTriggerOk);
    initParallax(reduced, scrollTriggerOk);
    initMagnetic(reduced);
    initServicesScrollSpy(reduced, lenis);
    initNavbarMotion(lenis, reduced);
    initTimelineLine(reduced, scrollTriggerOk);
    initTiltCards(reduced);

    const getScrollY = () => (lenis ? lenis.scroll : window.scrollY);

    const refreshSt = () => ScrollTrigger.refresh();
    window.addEventListener('load', () => {
        refreshSt();
        requestAnimationFrame(() => {
            refreshSt();
            setTimeout(refreshSt, 120);
        });
    }, { once: true });

    return { lenis, getScrollY };
}
