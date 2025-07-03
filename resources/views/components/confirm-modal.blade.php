@props(['title' => 'Konfirmasi Penghapusan', 'confirmText' => 'Ya, Hapus'])

<div x-show="showModal" 
     style="display: none;" 
     x-on:keydown.escape.window="showModal = false" 
     class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6"
>
    <!-- Backdrop -->
    <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-black/70 backdrop-blur-md"></div>

    <!-- Panel Modal -->
    <div x-show="showModal" 
         x-transition 
         x-on:click.outside="showModal = false" 
         class="relative w-full max-w-md bg-gray-900/80 backdrop-blur-xl border border-white/20 rounded-2xl shadow-2xl"
    >
        <div class="p-8 text-center text-white">
            <x-lucide-alert-triangle class="w-16 h-16 mx-auto mb-5 text-yellow-400"/>
            <h3 class="mb-2 text-2xl font-bold">{{ $title }}</h3>
            <div class="text-gray-300">
                {{ $slot }}
            </div>
        </div>
        <div class="flex justify-center items-center space-x-4 p-6 bg-black/20 rounded-b-2xl">
            <button x-on:click="showModal = false" type="button" class="py-2 px-5 rounded-lg text-sm font-medium text-white bg-gray-600 hover:bg-gray-500 transition-colors duration-300">
                Batal
            </button>
            <form x-bind:action="deleteUrl" method="POST" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="py-2 px-5 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition-colors duration-300">
                    {{ $confirmText }}
                </button>
            </form>
        </div>
    </div>
</div> 