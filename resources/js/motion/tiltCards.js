/**
 * Very subtle 3D tilt on cards (public site only); disabled for coarse pointers and reduced motion.
 */
export function initTiltCards(reduced) {
    if (reduced || window.matchMedia('(pointer: coarse)').matches) return;

    document.querySelectorAll('.ctc-card-tilt').forEach((card) => {
        const max = 4;
        let raf = 0;
        let rx = 0;
        let ry = 0;
        let tx = 0;
        let ty = 0;

        const smooth = () => {
            raf = 0;
            rx += (tx - rx) * 0.12;
            ry += (ty - ry) * 0.12;
            card.style.transform = `perspective(900px) rotateX(${rx}deg) rotateY(${ry}deg) translateZ(0)`;
            if (Math.abs(tx - rx) > 0.02 || Math.abs(ty - ry) > 0.02) {
                raf = requestAnimationFrame(smooth);
            }
        };

        card.addEventListener(
            'pointermove',
            (e) => {
                const r = card.getBoundingClientRect();
                const px = (e.clientX - r.left) / r.width - 0.5;
                const py = (e.clientY - r.top) / r.height - 0.5;
                ty = -px * max;
                tx = py * max;
                if (!raf) raf = requestAnimationFrame(smooth);
            },
            { passive: true },
        );

        card.addEventListener(
            'pointerleave',
            () => {
                tx = 0;
                ty = 0;
                if (!raf) raf = requestAnimationFrame(smooth);
            },
            { passive: true },
        );
    });
}
