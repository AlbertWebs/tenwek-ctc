import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import SplitType from 'split-type';
import { CTC_EASE } from './config.js';

/**
 * Editorial split reveals for headings marked with data-ctc-split="lines"|"words".
 * Skips elements inside [data-ctc-hero] (handled by hero entrance).
 */
export function initSplitHeadings(reduced, scrollTriggerOk) {
    if (reduced) return;

    const useSt = scrollTriggerOk && typeof ScrollTrigger !== 'undefined';

    document.querySelectorAll('[data-ctc-split]').forEach((el) => {
        if (el.closest('[data-ctc-hero]')) return;

        const mode = el.dataset.ctcSplit === 'words' ? 'words' : 'lines';
        const split = new SplitType(el, { types: mode });
        const targets = mode === 'words' ? split.words : split.lines;
        if (!targets?.length) return;

        gsap.set(targets, { opacity: 0, y: 22 });

        const tween = {
            opacity: 1,
            y: 0,
            duration: 0.82,
            stagger: 0.055,
            ease: CTC_EASE.out,
        };

        if (useSt) {
            gsap.to(targets, {
                ...tween,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 90%',
                    once: true,
                },
            });
        } else {
            const io = new IntersectionObserver(
                (entries, observer) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        observer.unobserve(entry.target);
                        gsap.to(targets, tween);
                    });
                },
                { threshold: 0.15 },
            );
            io.observe(el);
        }
    });
}
