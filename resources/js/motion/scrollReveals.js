import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { CTC_EASE, CTC_DURATION } from './config.js';

const PRESETS = {
    'fade-up': { from: { y: 32, opacity: 0 } },
    'fade-in': { from: { opacity: 0 } },
    'slide-left': { from: { x: 40, opacity: 0 } },
    'slide-right': { from: { x: -40, opacity: 0 } },
    'scale-in': { from: { scale: 0.96, opacity: 0 } },
    'blur-reveal': {
        from: { opacity: 0, filter: 'blur(12px)' },
        to: { filter: 'blur(0px)' },
    },
    'mask-reveal': {
        from: { clipPath: 'inset(2% 2% 8% 2%)', opacity: 0.85 },
        to: { clipPath: 'inset(0% 0% 0% 0%)', opacity: 1 },
    },
};

function ioFallbackAnimate(el, presetKey, duration, delay) {
    const preset = PRESETS[presetKey] || PRESETS['fade-up'];
    const from = { ...preset.from };
    const to = {
        opacity: 1,
        x: 0,
        y: 0,
        scale: 1,
        filter: 'none',
        clipPath: 'inset(0% 0% 0% 0%)',
        ...(preset.to || {}),
    };
    const io = new IntersectionObserver(
        (entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                observer.unobserve(entry.target);
                gsap.fromTo(entry.target, from, {
                    ...to,
                    duration,
                    delay,
                    ease: CTC_EASE.out,
                });
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -8% 0px' },
    );
    io.observe(el);
}

/**
 * @param {boolean} reduced
 * @param {boolean} scrollTriggerOk
 */
export function initScrollReveals(reduced, scrollTriggerOk) {
    if (reduced) return;

    const useSt = scrollTriggerOk && typeof ScrollTrigger !== 'undefined';

    document.querySelectorAll('[data-ctc-reveal]').forEach((el) => {
        const type = el.dataset.ctcReveal || 'fade-up';
        const delay = parseFloat(el.dataset.ctcRevealDelay || '0', 10);
        const duration = parseFloat(el.dataset.ctcRevealDuration || String(CTC_DURATION.reveal), 10);
        const preset = PRESETS[type] || PRESETS['fade-up'];
        const from = { ...preset.from };
        const to = {
            opacity: 1,
            x: 0,
            y: 0,
            scale: 1,
            filter: 'blur(0px)',
            clipPath: 'inset(0% 0% 0% 0%)',
            ...(preset.to || {}),
        };

        if (type === 'blur-reveal') {
            el.style.willChange = 'filter, opacity';
        }

        if (useSt) {
            gsap.fromTo(el, from, {
                ...to,
                duration,
                delay,
                ease: CTC_EASE.out,
                scrollTrigger: {
                    trigger: el,
                    start: 'top 88%',
                    once: true,
                },
                onComplete: () => {
                    el.style.removeProperty('will-change');
                },
            });
        } else {
            ioFallbackAnimate(el, type, duration, delay);
        }
    });

    document.querySelectorAll('[data-ctc-stagger]').forEach((parent) => {
        const children = parent.querySelectorAll(':scope > *');
        if (!children.length) return;

        const type = parent.dataset.ctcStaggerReveal || 'fade-up';
        const stagger = parseFloat(parent.dataset.ctcStagger || '0.09', 10);
        const preset = PRESETS[type] || PRESETS['fade-up'];
        const from = { ...preset.from };

        const to = {
            opacity: 1,
            x: 0,
            y: 0,
            scale: 1,
            filter: 'blur(0px)',
            clipPath: 'inset(0% 0% 0% 0%)',
        };

        // IntersectionObserver (not ScrollTrigger): Lenis-smooth scroll can miss ST enter
        // callbacks for lower-page grids (team, news), leaving children stuck pre-tween.
        const io = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    observer.unobserve(entry.target);
                    gsap.fromTo(
                        children,
                        {
                            ...from,
                            opacity: from.opacity ?? 0,
                        },
                        {
                            ...to,
                            duration: 0.78,
                            stagger,
                            ease: CTC_EASE.out,
                        },
                    );
                });
            },
            { threshold: 0, rootMargin: '0px 0px 8% 0px' },
        );
        io.observe(parent);
    });
}
