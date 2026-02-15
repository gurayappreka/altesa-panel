import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Mobile menu toggle
document.addEventListener('alpine:init', () => {
    Alpine.data('sidebar', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        }
    }));

    Alpine.data('dropdown', () => ({
        open: false,
        toggle() {
            this.open = !this.open;
        },
        close() {
            this.open = false;
        }
    }));

    Alpine.data('modal', () => ({
        open: false,
        show() {
            this.open = true;
        },
        hide() {
            this.open = false;
        }
    }));
});
