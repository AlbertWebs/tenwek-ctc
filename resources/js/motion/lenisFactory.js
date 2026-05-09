import Lenis from 'lenis';

/**
 * Lenis + GSAP ScrollTrigger. Do not use autoRaf on Lenis when driving raf via gsap.ticker.
 * @param {import('gsap').default} gsap
 * @param {import('gsap/ScrollTrigger').ScrollTrigger} ScrollTrigger
 */
export function createLenisForGsap(gsap, ScrollTrigger) {
    const lenis = new Lenis({
        duration: 1.12,
        easing: (t) => Math.min(1, 1.001 - 2 ** (-10 * t)),
        smoothWheel: true,
        anchors: true,
        wheelMultiplier: 0.88,
        touchMultiplier: 1.05,
        lerp: 0.09,
    });

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000);
    });
    gsap.ticker.lagSmoothing(0);

    return lenis;
}
