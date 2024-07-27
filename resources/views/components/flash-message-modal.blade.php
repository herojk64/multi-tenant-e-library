<div x-data="{ showModal: false, message: '', type: '' }"
     x-init="
        @if(session('model-success'))
            showModal = true;
            message = '{{ session('model-success') }}';
            type = 'success';
        @elseif(session('model-error'))
            showModal = true;
            message = '{{ session('model-error') }}';
            type = 'error';
        @elseif(session('model-warning'))
            showModal = true;
            message = '{{ session('model-warning') }}';
            type = 'warning';
        @endif
     "
     x-show="showModal"
     class="fixed inset-0 flex items-end justify-start translate-x-5 -translate-y-5 z-50">
    <div class="py-2 px-4 rounded shadow-lg flex items-center justify-between border bg-opacity-60" x-bind:class="{
        'border-light-1-500 bg-success text-primary': type === 'success',
        'border-red-500 bg-red': type === 'error',
        'border-warning-500 bg-warning': type === 'warning'
    }"
    style="min-width:200px;"
    >
        <div class="me-4">
            @if(session('model-success'))
                <x-heroicon-c-check-circle class="h-5 w-5 text-primary-200"></x-heroicon-c-check-circle>
            @elseif(session('model-error'))
                <x-heroicon-c-exclamation-circle class="h-5 w-5 text-warning"></x-heroicon-c-exclamation-circle>
            @elseif(session('model-warning'))
                showModal = true;
                message = '{{ session('model-warning') }}';
                type = 'warning';
            @endif

        </div>
        <div x-text="message" class="text-lg"></div>
        <button @click="showModal = false" class="ms-5">
            <x-heroicon-c-x-mark class="h-5 w-5 border rounded-full" x-bind:class="{
            'border-red text-red': type === 'success',
        'border-red-500 bg-red': type === 'error',
        'border-warning-500 bg-warning': type === 'warning'
            }"/>
        </button>
    </div>
</div>
