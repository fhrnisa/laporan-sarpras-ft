import { TOAST_STYLES } from '../config/constants.js';

export function showToast(message, type = 'success', duration = 3000) {
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');
    const toastInner = document.getElementById('toastInner');

    if (!toast || !toastMessage || !toastIcon || !toastInner) {
        console.error('Toast elements not found');
        return;
    }

    // Clear previous timer
    if (window.toastTimer) {
        clearTimeout(window.toastTimer);
    }

    const style = TOAST_STYLES[type] || TOAST_STYLES.success;

    // Reset classes dengan animasi
    toastInner.className = 'flex items-center gap-3 px-6 py-4 rounded-lg border shadow-lg min-w-[300px] max-w-[500px] transition-all duration-300 ease-out transform translate-y-[-20px] opacity-0';
    toastIcon.className = 'w-10 h-10 flex items-center justify-center rounded-full shrink-0';
    toastMessage.className = 'text-base font-medium grow';

    // Apply styles
    toastInner.classList.add(style.bg, style.border);
    toastIcon.classList.add(style.iconBg, style.iconColor);
    toastMessage.classList.add(style.text);

    // Set content
    toastMessage.textContent = message;
    toastIcon.innerHTML = style.icon;

    // Show toast with animation
    toast.classList.remove('hidden');
    
    // Trigger animation
    setTimeout(() => {
        toastInner.classList.remove('translate-y-[-20px]', 'opacity-0');
        toastInner.classList.add('translate-y-0', 'opacity-100');
    }, 10);

    // Auto hide with animation
    window.toastTimer = setTimeout(() => {
        toastInner.classList.remove('translate-y-0', 'opacity-100');
        toastInner.classList.add('translate-y-[-20px]', 'opacity-0');
        
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);
    }, duration);
}