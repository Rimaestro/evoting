<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="w-full max-w-4xl mx-auto">
            
            <div class="mb-8">
                <a href="{{ url()->previous() }}" class="inline-block py-2 px-5 border border-gray-500 rounded-lg text-sm font-medium text-white hover:bg-gray-700 transition-colors duration-300">
                    &larr; Kembali
                </a>
            </div>

            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
                <div class="relative">
                    <img class="w-full h-64 object-cover" src="{{ asset('storage/foto_kandidat/' . $kandidat->foto) }}" alt="Foto {{ $kandidat->nama_ketua }}">
                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-4xl font-bold rounded-bl-2xl px-6 py-3">
                        {{ $kandidat->nomor_urut }}
                    </div>
                </div>
                <div class="p-8">
                    <h1 class="text-4xl font-bold text-white">{{ $kandidat->nama_ketua }} & {{ $kandidat->nama_wakil }}</h1>
                    <p class="text-lg text-gray-300 mb-8">Calon Ketua & Wakil</p>
                    
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-2xl font-semibold text-white mb-3 border-b-2 border-blue-500 pb-2">Visi</h2>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $kandidat->visi }}
                            </p>
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold text-white mb-3 border-b-2 border-blue-500 pb-2">Misi</h2>
                            <div class="prose prose-invert text-gray-300 max-w-none">
                                {!! nl2br(e($kandidat->misi)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 