import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const setTopbarVisibility = () => {
        // Hide the top header strip once the user starts scrolling.
        document.body.classList.toggle('ctc-topbar-hidden', window.scrollY > 24);
    };

    setTopbarVisibility();
    window.addEventListener('scroll', setTopbarVisibility, { passive: true });

    const formatWithCommas = (n) => n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    const animateCount = (el, target, { durationMs = 1200, suffix = '', prefix = '', useCommas = true } = {}) => {
        const start = 0;
        const startTime = performance.now();

        const tick = (now) => {
            const t = Math.min(1, (now - startTime) / durationMs);
            const eased = 1 - Math.pow(1 - t, 3); // easeOutCubic
            const value = Math.round(start + (target - start) * eased);

            const text = (useCommas ? formatWithCommas(value) : String(value));
            el.textContent = `${prefix}${text}${suffix}`;

            if (t < 1) requestAnimationFrame(tick);
        };

        requestAnimationFrame(tick);
    };

    const initStatsCountUp = () => {
        const section = document.getElementById('home-stats');
        if (!section) return;

        const values = Array.from(section.querySelectorAll('.ctc-stat-value'));
        if (!values.length) return;

        values.forEach((el) => {
            const raw = (el.textContent || '').trim();
            const suffixMatch = raw.match(/[+%]$/);
            const suffix = suffixMatch ? suffixMatch[0] : '';
            const prefixMatch = raw.match(/^\D+/);
            const prefix = prefixMatch ? prefixMatch[0].trim() : '';

            const digits = raw.replace(/[^\d]/g, '');
            const target = digits ? parseInt(digits, 10) : 0;

            el.dataset.ctcTarget = String(target);
            el.dataset.ctcSuffix = suffix;
            el.dataset.ctcPrefix = prefix && prefix !== '+' ? prefix : '';
            el.textContent = `${el.dataset.ctcPrefix || ''}0${suffix}`;
        });

        let ran = false;
        const run = () => {
            if (ran) return;
            ran = true;

            values.forEach((el) => {
                const target = parseInt(el.dataset.ctcTarget || '0', 10);
                const suffix = el.dataset.ctcSuffix || '';
                const prefix = el.dataset.ctcPrefix || '';
                animateCount(el, target, { durationMs: 1200, suffix, prefix, useCommas: true });
            });
        };

        if (!('IntersectionObserver' in window)) {
            run();
            return;
        }

        const io = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    run();
                    io.disconnect();
                }
            });
        }, { threshold: 0.35 });

        io.observe(section);
    };

    initStatsCountUp();
});
