import gsap from 'gsap';
import SplitType from 'split-type';
import { CTC_EASE, CTC_DURATION } from './config.js';

function readCarouselPayload() {
    const el = document.getElementById('ctc-hero-carousel-data');
    if (!el?.textContent) return null;
    try {
        return JSON.parse(el.textContent);
    } catch {
        return null;
    }
}

function initHeroCarousel(slides, bgNodes, ui, reduced) {
    if (!slides?.length || !bgNodes.length) {
        return false;
    }

    const { title, subtitle, description, ctas } = ui;
    const initialTitleHtml = title?.innerHTML ?? '';
    const initialSubtitle = subtitle?.textContent?.trim() ?? '';
    const initialDescription = description?.textContent?.trim() ?? '';

    const dots = document.querySelectorAll('[data-ctc-hero-dot]');

    let index = 0;
    let timer = null;
    const intervalMs = 6200;

    const killKen = () => {
        bgNodes.forEach((node) => gsap.killTweensOf(node));
    };

    const runKen = (node) => {
        if (!node || reduced) return;
        gsap.fromTo(
            node,
            { scale: 1.02 },
            { scale: 1.09, duration: 16, ease: 'none' },
        );
    };

    const syncDots = () => {
        dots.forEach((d, i) => {
            d.classList.toggle('ctc-hero-dot--active', i === index);
            d.setAttribute('aria-current', i === index ? 'true' : 'false');
        });
    };

    const goTo = (nextIndex) => {
        index = nextIndex;
        const s = slides[index] || {};

        bgNodes.forEach((node, idx) => {
            const active = idx === index;
            gsap.to(node, {
                opacity: active ? 1 : 0,
                duration: 1.15,
                ease: 'power2.inOut',
            });
        });

        killKen();
        runKen(bgNodes[index]);

        if (title) {
            if (s.title) title.textContent = s.title;
            else title.innerHTML = initialTitleHtml;
        }
        if (subtitle) subtitle.textContent = s.subtitle || initialSubtitle;
        if (description) description.textContent = initialDescription;

        if (ctas.length && s.cta_url && s.cta_label) {
            ctas[0].href = s.cta_url;
            ctas[0].textContent = s.cta_label;
        }

        syncDots();
    };

    const tick = () => {
        goTo((index + 1) % slides.length);
    };

    const start = () => {
        if (reduced) return;
        if (timer) return;
        timer = window.setInterval(tick, intervalMs);
    };

    const stop = () => {
        if (!timer) return;
        window.clearInterval(timer);
        timer = null;
    };

    goTo(0);
    start();

    document.addEventListener(
        'visibilitychange',
        () => {
            if (document.hidden) stop();
            else start();
        },
        { passive: true },
    );

    const hero = document.querySelector('[data-ctc-hero]');
    if (hero && !reduced) {
        let sx = 0;
        hero.addEventListener(
            'touchstart',
            (e) => {
                sx = e.changedTouches[0].clientX;
            },
            { passive: true },
        );
        hero.addEventListener(
            'touchend',
            (e) => {
                const dx = e.changedTouches[0].clientX - sx;
                if (Math.abs(dx) < 50) return;
                stop();
                goTo(dx < 0 ? (index + 1) % slides.length : (index - 1 + slides.length) % slides.length);
                start();
            },
            { passive: true },
        );
    }

    dots.forEach((d, i) => {
        d.addEventListener('click', () => {
            stop();
            goTo(i);
            start();
        });
    });

    return true;
}

export function initHeroMotion(reduced, scrollTriggerOk) {
    const hero = document.querySelector('[data-ctc-hero]');
    if (!hero) return;

    const media = hero.querySelector('[data-ctc-hero-media]');
    const title = document.getElementById('ctc-hero-title');
    const subtitle = document.getElementById('ctc-hero-subtitle');
    const description = document.getElementById('ctc-hero-description');
    const ctasWrap = document.getElementById('ctc-hero-ctas');
    const ctas = ctasWrap ? Array.from(ctasWrap.querySelectorAll('[data-cta="1"]')) : [];
    const indicator = document.querySelector('[data-ctc-hero-scroll-indicator]');

    const carouselSlides = readCarouselPayload();
    const bgSlides = Array.from(hero.querySelectorAll('.ctc-hero-slide'));
    const hasCarousel = initHeroCarousel(
        carouselSlides,
        bgSlides,
        { title, subtitle, description, ctas },
        reduced,
    );

    if (!hasCarousel && media && !reduced && scrollTriggerOk) {
        gsap.fromTo(
            media,
            { scale: 1 },
            {
                scale: 1.07,
                ease: 'none',
                scrollTrigger: {
                    trigger: hero,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 0.75,
                },
            },
        );
    }

    if (reduced) return;

    const tl = gsap.timeline({ defaults: { ease: CTC_EASE.out } });

    if (!hasCarousel && title?.textContent?.trim()) {
        const split = new SplitType(title, { types: 'lines' });
        if (split.lines?.length) {
            gsap.set(split.lines, { opacity: 0, yPercent: 108 });
            tl.to(split.lines, { opacity: 1, yPercent: 0, duration: CTC_DURATION.hero, stagger: 0.12 }, 0);
        }
    } else if (hasCarousel && title) {
        gsap.set(title, { opacity: 0, y: 24 });
        tl.to(title, { opacity: 1, y: 0, duration: CTC_DURATION.hero }, 0);
    }

    if (subtitle) {
        gsap.set(subtitle, { opacity: 0, y: 18 });
        tl.to(subtitle, { opacity: 1, y: 0, duration: 0.75 }, 0.35);
    }

    if (description) {
        gsap.set(description, { opacity: 0, y: 16 });
        tl.to(description, { opacity: 1, y: 0, duration: 0.8 }, 0.5);
    }

    if (ctas.length) {
        gsap.set(ctas, { opacity: 0, y: 14 });
        tl.to(ctas, { opacity: 1, y: 0, duration: 0.65, stagger: 0.1 }, 0.62);
    }

    if (indicator) {
        gsap.set(indicator, { opacity: 0, y: 8 });
        tl.to(indicator, { opacity: 1, y: 0, duration: 0.55 }, 0.85);
        const chev = indicator.querySelector('.ctc-hero-scroll-indicator__chev');
        if (chev) {
            gsap.to(chev, {
                y: 5,
                repeat: -1,
                yoyo: true,
                duration: 1.45,
                ease: 'power1.inOut',
            });
        }
    }

}
