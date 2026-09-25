<div x-data="{
        toasts: [],
        add(message, type = 'info', duration = 4000) {
            const id = Date.now() + Math.random();
            this.toasts.push({ id, message, type });
            setTimeout(() => this.remove(id), duration);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }
    }"
    @toast.window="add($event.detail.message, $event.detail.type, $event.detail.duration)"
    class="fixed top-20 right-4 z-[10000] space-y-2 w-80 max-w-[calc(100vw-2rem)]">

    <template x-for="toast in toasts" :key="toast.id">
        <div x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-x-full"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0 translate-x-full"
             class="flex items-start gap-3 p-4 rounded-lg shadow-lg border-l-4 backdrop-blur-sm"
             :class="{
                 'bg-white dark:bg-gray-800 border-green-500': toast.type === 'success',
                 'bg-white dark:bg-gray-800 border-red-500': toast.type === 'error',
                 'bg-white dark:bg-gray-800 border-yellow-500': toast.type === 'warning',
                 'bg-white dark:bg-gray-800 border-blue-500': toast.type === 'info'
             }">
            <div class="flex-shrink-0">
                <template x-if="toast.type === 'success'">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </template>
                <template x-if="toast.type === 'error'">
                    <i class="fas fa-times-circle text-red-500 text-xl"></i>
                </template>
                <template x-if="toast.type === 'warning'">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                </template>
                <template x-if="toast.type === 'info'">
                    <i class="fas fa-info-circle text-blue-500 text-xl"></i>
                </template>
            </div>
            <p class="flex-1 text-sm text-gray-700 dark:text-gray-300" x-text="toast.message"></p>
            <button @click="remove(toast.id)" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
    </template>
</div>

{{-- Flash Messages → Auto Toast --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: @json(session('success')), type: 'success' }
            }));
        }, 200);
    });
</script>
@endif

@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: @json(session('error')), type: 'error' }
            }));
        }, 200);
    });
</script>
@endif

@if(session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: @json(session('warning')), type: 'warning' }
            }));
        }, 200);
    });
</script>
@endif

@if(session('info'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: @json(session('info')), type: 'info' }
            }));
        }, 200);
    });
</script>
@endif

{{-- Validation Errors --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            window.dispatchEvent(new CustomEvent('toast', {
                detail: { message: @json($errors->first()), type: 'error' }
            }));
        }, 200);
    });
</script>
@endif
