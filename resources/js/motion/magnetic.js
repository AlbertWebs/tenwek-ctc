/**
 * Subtle magnetic pull for primary CTAs (pointer move, GPU transform).
 */
export function initMagnetic(reduced) {
    if (reduced || window.matchMedia('(pointer: coarse)').matches) return;

    document.querySelectorAll('.ctc-magnetic').forEach((el) => {
        const strength = parseFloat(el.dataset.ctcMagnetic || '0.22', 10);
        let raf = 0;
        let bx = 0;
        let by = 0;
        let tx = 0;
        let ty = 0;

        const tick = () => {
            raf = 0;
            bx += (tx - bx) * 0.14;
            by += (ty - by) * 0.14;
            el.style.transform = `translate3d(${bx}px, ${by}px, 0)`;
            if (Math.abs(tx - bx) > 0.05 || Math.abs(ty - by) > 0.05) {
                raf = requestAnimationFrame(tick);
            }
        };

        el.addEventListener(
            'pointermove',
            (e) => {
                const r = el.getBoundingClientRect();
                const cx = r.left + r.width / 2;
                const cy = r.top + r.height / 2;
                tx = (e.clientX - cx) * strength;
                ty = (e.clientY - cy) * strength;
                if (!raf) raf = requestAnimationFrame(tick);
            },
            { passive: true },
        );

        el.addEventListener(
            'pointerleave',
            () => {
                tx = 0;
                ty = 0;
                if (!raf) raf = requestAnimationFrame(tick);
            },
            { passive: true },
        );
    });
}
