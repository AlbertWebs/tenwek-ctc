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
});
