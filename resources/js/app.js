import './bootstrap';
<<<<<<< HEAD
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import focus from '@alpinejs/focus';

Alpine.plugin(collapse);
Alpine.plugin(focus);

window.Alpine = Alpine;

Alpine.start();

// Auto hide flash messages after 5s
document.addEventListener('DOMContentLoaded', () => {
    // Show loading on form submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', (e) => {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            }
        });
    });

    // Auto-submit filter forms on select change
    document.querySelectorAll('[data-auto-submit]').forEach(el => {
        el.addEventListener('change', () => el.closest('form').submit());
    });
});

// Tailwind dark mode
if (localStorage.getItem('darkMode') === 'true' ||
    (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    document.documentElement.classList.add('dark');
}
=======
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
>>>>>>> fdf64b54617ff63720d6ee480331d892c4043616
