import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

export function initTimelineLine(reduced, scrollTriggerOk) {
    if (reduced || !scrollTriggerOk) return;

    const bar = document.querySelector('[data-ctc-timeline-progress]');
    if (!bar) return;

    const host = bar.closest('[data-ctc-timeline]');
    if (!host) return;

    gsap.fromTo(
        bar,
        { scaleY: 0 },
        {
            scaleY: 1,
            ease: 'none',
            transformOrigin: 'top center',
            scrollTrigger: {
                trigger: host,
                start: 'top 78%',
                end: 'bottom 55%',
                scrub: 0.45,
            },
        },
    );
}
