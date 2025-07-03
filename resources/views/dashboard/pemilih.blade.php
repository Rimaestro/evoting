<x-app-layout>
    @section('title', 'Dashboard Pemilih')

    <div class="container mx-auto px-4 py-12">
        <div class="flex justify-between items-center mb-12">
            <div class="text-center md:text-left">
                <h1 class="text-4xl md:text-5xl font-bold text-white">Pilih Kandidat Anda</h1>
                <p class="text-lg text-gray-300 mt-2">Gunakan suara Anda untuk masa depan yang lebih baik.</p>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-block py-2 px-5 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-300">
                        Logout
                    </button>
                </form>
            </div>
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
        
        @if (!Auth::user()->is_validated)
            <div class="bg-yellow-500/20 border border-yellow-500/30 text-yellow-300 p-4 rounded-lg mb-8 text-center">
                <p><strong>Menunggu Validasi:</strong> Akun Anda sedang dalam proses verifikasi oleh admin. Anda akan dapat memilih setelah akun divalidasi.</p>
            </div>
        @elseif (Auth::user()->has_voted)
            <div class="bg-blue-500/20 border border-blue-500/30 text-blue-300 p-4 rounded-lg mb-8 text-center">
                <p><strong>Terima Kasih:</strong> Anda telah menggunakan hak suara Anda. Hasil akan diumumkan sesuai jadwal.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse ($kandidat as $k)
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                <div class="relative">
                    <img class="w-full h-56 object-cover" src="{{ route('kandidat.foto', ['filename' => $k->foto]) }}" alt="Foto {{ $k->nama_ketua }}">
                    <div class="absolute top-0 right-0 bg-blue-600 text-white text-2xl font-bold rounded-bl-2xl px-4 py-2">
                        {{ $k->nomor_urut }}
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-white">{{ $k->nama_ketua }} & {{ $k->nama_wakil }}</h3>
                    <p class="text-sm text-gray-400">Calon Ketua & Wakil</p>
                    <div class="mt-6 flex items-center justify-between space-x-4">
                        <a href="{{ route('kandidat.show', $k->id) }}" class="w-full text-center py-2 px-4 border border-blue-400 rounded-lg text-sm font-medium text-blue-400 hover:bg-blue-400 hover:text-white transition-colors duration-300">
                            Visi & Misi
                        </a>
                        <form action="{{ route('vote.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="kandidat_id" value="{{ $k->id }}">
                            <button type="submit" 
                                    class="w-full py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white 
                                        {{ Auth::user()->is_validated && !Auth::user()->has_voted ? 'bg-green-600 hover:bg-green-700 focus:ring-green-500' : 'bg-gray-500 cursor-not-allowed' }}"
                                    {{ !Auth::user()->is_validated || Auth::user()->has_voted ? 'disabled' : '' }}>
                                VOTE
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center text-gray-500 py-16">
                <p class="text-2xl">Belum ada kandidat yang terdaftar.</p>
            </div>
            @endforelse

        </div>
    </div>
</x-app-layout> 