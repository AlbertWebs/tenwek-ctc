import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export function initParallax(reduced, scrollTriggerOk) {
    if (reduced || !scrollTriggerOk) return;

    document.querySelectorAll('[data-ctc-parallax]').forEach((wrap) => {
        const amt = parseFloat(wrap.dataset.ctcParallax || '0.12', 10);
        const target = wrap.querySelector('img, video') || wrap;

        gsap.fromTo(
            target,
            { y: -36 * amt },
            {
                y: 36 * amt,
                ease: 'none',
                scrollTrigger: {
                    trigger: wrap,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 0.65,
                },
            },
        );
    });
}
