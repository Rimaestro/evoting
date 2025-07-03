<x-app-layout>
    @section('title', 'Dashboard Admin')

    <div x-data="{ showModal: false, deleteUrl: '' }" class="container mx-auto px-4 py-12">
        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-blue-700 shadow-lg ring-4 ring-indigo-400/30 p-4">
                    <x-lucide-shield class="w-10 h-10 text-white drop-shadow-lg"/>
                </span>
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg flex items-center gap-2">
                        Admin Dashboard
                    </h1>
                    <p class="text-lg text-gray-300 mt-2">Manajemen Sistem e-Voting</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 py-2 px-6 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 transition-colors duration-300">
                    <x-lucide-log-out class="w-5 h-5 mr-1"/> Logout
                </button>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-500/20 border border-green-500/30 text-green-300 p-4 rounded-lg mb-8">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-500/20 border border-red-500/30 text-red-300 p-4 rounded-lg mb-8">
                {{ session('error') }}
            </div>
        @endif

        <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="relative group bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border-2 border-cyan-400/40 hover:border-cyan-500/80 transition-all duration-300 overflow-hidden">
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center justify-center rounded-full bg-cyan-500/80 p-2 shadow-lg">
                        <x-lucide-users class="w-6 h-6 text-white"/>
                    </span>
                </div>
                <h3 class="text-gray-300 text-lg font-semibold flex items-center gap-2">Total Pemilih</h3>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $totalPemilih }}</p>
            </div>
            <div class="relative group bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border-2 border-green-400/40 hover:border-green-500/80 transition-all duration-300 overflow-hidden">
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center justify-center rounded-full bg-green-500/80 p-2 shadow-lg">
                        <x-lucide-check-circle class="w-6 h-6 text-white"/>
                    </span>
                </div>
                <h3 class="text-gray-300 text-lg font-semibold flex items-center gap-2">Sudah Memilih</h3>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $sudahMemilih }}</p>
            </div>
            <div class="relative group bg-white/10 backdrop-blur-lg rounded-2xl p-6 shadow-2xl border-2 border-purple-400/40 hover:border-purple-500/80 transition-all duration-300 overflow-hidden">
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center justify-center rounded-full bg-purple-500/80 p-2 shadow-lg">
                        <x-lucide-award class="w-6 h-6 text-white"/>
                    </span>
                </div>
                <h3 class="text-gray-300 text-lg font-semibold flex items-center gap-2">Total Kandidat</h3>
                <p class="text-4xl font-extrabold text-white mt-2">{{ $totalKandidat }}</p>
            </div>
        </div>

        <!-- TOMBOL NAVIGASI -->
        <div class="flex flex-col md:flex-row gap-4 mb-10">
            <a href="{{ route('hasil.voting') }}" class="flex-1 group inline-flex items-center justify-center py-5 px-8 rounded-2xl text-lg font-semibold text-white bg-gradient-to-r from-green-600 to-cyan-600 hover:from-green-700 hover:to-cyan-700 shadow-xl border-2 border-white/20 hover:border-green-400 transition-all duration-300 gap-3">
                <x-lucide-bar-chart-3 class="w-6 h-6"/>
                Lihat Hasil Voting
            </a>
            <a href="{{ route('kandidat.index') }}" class="flex-1 group inline-flex items-center justify-center py-5 px-8 rounded-2xl text-lg font-semibold text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 shadow-xl border-2 border-white/20 hover:border-blue-400 transition-all duration-300 gap-3">
                <x-lucide-users class="w-6 h-6"/>
                Manajemen Kandidat
            </a>
        </div>

        <!-- TABEL DATA PEMILIH -->
        <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 p-6 overflow-x-auto">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
                <x-lucide-list-check class="w-6 h-6 text-cyan-400"/> Data Pemilih Terdaftar
            </h2>
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-xs text-white uppercase bg-white/5 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Pemilih</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Status Validasi</th>
                        <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemilih as $p)
                    <tr class="border-b border-white/10 hover:bg-white/5 transition-colors">
                        <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">{{ $p->name }}</th>
                        <td class="px-6 py-4">{{ $p->email }}</td>
                        <td class="px-6 py-4">
                            @if ($p->is_validated)
                                <span class="relative inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300">
                                    <span class="mr-1"><x-lucide-badge-check class="w-4 h-4 inline"/></span> Tervalidasi
                                </span>
                            @else
                                <span class="relative inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-500/20 text-yellow-300">
                                    <span class="mr-1"><x-lucide-clock class="w-4 h-4 inline animate-ping"/></span> Menunggu
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right flex items-center justify-end space-x-2">
                            @if (!$p->is_validated)
                                <form action="{{ route('pemilih.validate', $p->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Validasi Pemilih" class="p-2 rounded-full bg-green-500/20 hover:bg-green-500/40 text-green-300 transition-colors duration-200" data-tooltip="Validasi">
                                        <x-lucide-check-circle class="w-5 h-5"/>
                                    </button>
                                </form>
                            @endif
                            <button @click.prevent="deleteUrl = '{{ route('pemilih.destroy', $p->id) }}'; showModal = true" title="Hapus Pemilih" class="p-2 rounded-full bg-red-500/20 hover:bg-red-500/40 text-red-400 transition-colors duration-200" data-tooltip="Hapus">
                                <x-lucide-trash-2 class="w-5 h-5"/>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                            Belum ada pemilih yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <x-confirm-modal>
            Apakah Anda yakin ingin menghapus data pemilih ini? Tindakan ini tidak dapat dibatalkan.
        </x-confirm-modal>
    </div>
</x-app-layout> 