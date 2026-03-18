let toastTimer = null;

const TOAST_STYLES = {
        success: {
            bg: 'bg-green-100',
            border: 'border-green-500',
            text: 'text-green-800',
            iconBg: 'bg-green-500',
            iconColor: 'text-white',
            icon: `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            `
        },
        error: {
            bg: 'bg-red-100',
            border: 'border-red-500',
            text: 'text-red-800',
            iconBg: 'bg-red-500',
            iconColor: 'text-white',
            icon: `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            `
        },
        info: {
            bg: 'bg-blue-100',
            border: 'border-blue-500',
            text: 'text-blue-800',
            iconBg: 'bg-blue-500',
            iconColor: 'text-white',
            icon: `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `
        }
    };

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