<div x-data="{
        show: false,
        formId: null,
        title: 'Are you sure?',
        message: 'You won\'t be able to revert this!'
    }"
    @open-delete-modal.window="
        formId = $event.detail.formId;
        title = $event.detail.title || 'Are you sure?';
        message = $event.detail.message || 'You won\'t be able to revert this!';
        show = true;
    "
    x-show="show"
    x-cloak
    class="fixed inset-0 z-[10001] flex items-center justify-center p-4"
    style="display: none;">

    {{-- Backdrop --}}
    <div x-show="show"
         x-transition:enter="transition-opacity ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="show = false"
         class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>

    {{-- Modal --}}
    <div x-show="show"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md overflow-hidden">

        <div class="p-6 text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mb-4">
                <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
            </div>

            {{-- Title --}}
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2" x-text="title"></h3>

            {{-- Message --}}
            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
        </div>

        {{-- Actions --}}
        <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4 flex items-center justify-end gap-3">
            <button @click="show = false" type="button" class="btn-outline">
                <i class="fas fa-times"></i> Cancel
            </button>
            <button @click="document.getElementById(formId).submit(); show = false" type="button" class="btn-danger">
                <i class="fas fa-trash"></i> Yes, Delete!
            </button>
        </div>
    </div>
</div>
