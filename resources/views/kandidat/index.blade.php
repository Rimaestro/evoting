<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-cyan-600 shadow-lg ring-4 ring-blue-400/30 p-4">
                    <x-lucide-users class="w-10 h-10 text-white drop-shadow-lg"/>
                </span>
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg flex items-center gap-2">
                        Profil Pasangan Calon
                    </h1>
                    <p class="text-lg text-gray-300 mt-2">Kenali lebih dekat visi dan misi setiap kandidat.</p>
                    <span class="inline-block mt-2 bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-sm font-bold px-4 py-1 rounded-full shadow border-2 border-white/20">{{ count($kandidat) }} Kandidat</span>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('kandidat.create') }}" class="inline-flex items-center py-3 px-6 rounded-xl text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 shadow-xl border-2 border-white/20 hover:border-blue-400 transition-all duration-300 gap-2">
                    <x-lucide-user-plus class="w-5 h-5"/>
                    Tambah Kandidat
                </a>
                <a href="{{ route('dashboard.admin') }}" class="inline-flex items-center py-3 px-6 rounded-xl text-base font-semibold text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-blue-700 hover:to-blue-900 shadow-xl border-2 border-white/20 hover:border-blue-400 transition-all duration-300 gap-2">
                    <x-lucide-arrow-left class="w-5 h-5"/>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500/30 text-green-300 p-4 rounded-lg mb-8">
                {{ session('success') }}
            </div>
        @endif

        <div x-data="{ showModal: false, deleteUrl: '' }" class="space-y-12">
            @forelse ($kandidat as $k)
            @php
                $badgeColors = [
                    1 => 'from-blue-500 to-cyan-400 ring-blue-400/80',
                    2 => 'from-green-500 to-lime-400 ring-green-400/80',
                    3 => 'from-purple-500 to-pink-400 ring-purple-400/80',
                    4 => 'from-orange-500 to-yellow-400 ring-orange-400/80',
                ];
                $color = $badgeColors[$k->nomor_urut % 4 + 1] ?? 'from-gray-500 to-gray-400 ring-gray-400/80';
            @endphp
            <div class="relative bg-white/10 backdrop-blur-2xl rounded-2xl shadow-2xl border-2 border-white/30 overflow-hidden p-0 md:p-0 transition-transform hover:scale-[1.015] hover:shadow-2xl duration-300">
                <!-- BADGE NOMOR URUT -->
                <div class="absolute top-6 left-6 z-20">
                    <span class="inline-flex items-center justify-center px-5 py-2 rounded-full text-2xl font-bold shadow-lg bg-gradient-to-r {{ $color }} text-white ring-4 {{ $color }}">
                        {{ $k->nomor_urut }}
                    </span>
                </div>
                <div class="md:flex items-stretch">
                    <!-- FOTO KANDIDAT -->
                    <div class="md:w-1/3 flex items-center justify-center p-8">
                        <div class="relative">
                            <img class="w-44 h-44 rounded-full object-cover border-4 border-white/30 shadow-lg ring-4 {{ $color }} transition-shadow duration-300 hover:scale-105" src="{{ route('kandidat.foto', ['filename' => $k->foto]) }}" alt="Foto {{ $k->nama_ketua }}" loading="lazy">
                        </div>
                    </div>
                    <!-- INFO KANDIDAT -->
                    <div class="md:w-2/3 p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <h2 class="text-3xl font-extrabold text-white">{{ $k->nama_ketua }} & {{ $k->nama_wakil }}</h2>
                                <!-- Contoh badge status, bisa dinamis -->
                                {{-- <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300 ml-2"><x-lucide-badge-check class="w-4 h-4 mr-1"/> Tervalidasi</span> --}}
                            </div>
                            <p class="text-md text-gray-300 mb-6">Calon Ketua & Wakil</p>
                            <div class="space-y-6">
                                <div>
                                    <h4 class="text-xl font-semibold text-white mb-2 flex items-center gap-2"><x-lucide-eye class="w-5 h-5 text-cyan-400"/> Visi</h4>
                                    <p class="text-gray-300">{{ $k->visi }}</p>
                                </div>
                                <div>
                                    <h4 class="text-xl font-semibold text-white mb-2 flex items-center gap-2"><x-lucide-list class="w-5 h-5 text-blue-400"/> Misi</h4>
                                    <ul class="list-disc list-inside space-y-1 text-gray-300">
                                        @foreach (explode("\n", $k->misi) as $misi)
                                            @if (trim($misi) !== '')
                                            <li class="flex items-start gap-2"><x-lucide-check class="w-4 h-4 text-green-400 mt-1"/> <span>{{ $misi }}</span></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Tombol aksi -->
                        <div class="flex items-center justify-end gap-2 mt-8">
                            <button @click.prevent="deleteUrl = '{{ route('kandidat.destroy', $k->id) }}'; showModal = true" type="button" class="inline-flex items-center justify-center py-2 px-5 rounded-lg text-base font-semibold text-red-400 bg-red-500/10 hover:bg-red-500/30 hover:text-red-300 transition-colors duration-300 gap-2" title="Hapus Kandidat">
                                <x-lucide-trash-2 class="w-5 h-5"/>
                                Hapus Kandidat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-500 py-16 bg-white/5 rounded-2xl">
                <p class="text-2xl">Belum ada kandidat yang terdaftar.</p>
            </div>
            @endforelse

            <!-- Modal Konfirmasi Hapus -->
            <x-confirm-modal>
                Apakah Anda yakin ingin menghapus data kandidat ini? Tindakan ini tidak dapat dibatalkan.
            </x-confirm-modal>
        </div>
    </div>
</x-app-layout> 