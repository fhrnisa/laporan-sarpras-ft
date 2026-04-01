export const TOAST_STYLES = {
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