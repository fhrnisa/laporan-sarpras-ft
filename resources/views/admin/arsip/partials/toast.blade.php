<div id="toast"
     role="status"
     aria-live="polite"
     class="fixed top-20 left-1/2 -translate-x-1/2 z-50 hidden pointer-events-none">
    <div id="toastInner" 
         class="flex items-center gap-3 px-6 py-4 rounded-lg border shadow-lg min-w-[320px] max-w-md transform -translate-y-10 opacity-0 transition-all duration-300 ease-out pointer-events-auto">
        <div id="toastIcon" class="w-10 h-10 flex items-center justify-center rounded-full shrink-0">
            <!-- Icon akan diisi via JS -->
        </div>
        <span id="toastMessage" class="text-base font-medium grow text-center"></span>
    </div>
</div>
