<x-app-layout>
    @section('title', 'Hasil Voting')

    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-white drop-shadow-lg">Hasil Perolehan Suara</h1>
            <p class="text-lg text-gray-300 mt-2">Berikut adalah hasil real-time dari e-Voting.</p>
            <div class="flex justify-center mt-4">
                <span class="inline-block bg-gradient-to-r from-blue-500 to-cyan-400 text-white text-lg font-bold px-6 py-2 rounded-full shadow-lg border-2 border-white/20">Total Suara Masuk: {{ $totalSuaraMasuk }}</span>
            </div>
        </div>

        <div class="max-w-4xl mx-auto space-y-8">
            @php
                $rank = 1;
            @endphp
            @forelse ($kandidat as $k)
                @php
                    $persentase = ($totalSuaraMasuk > 0) ? ($k->votes_count / $totalSuaraMasuk) * 100 : 0;
                    $badge = $rank == 1 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600 text-yellow-900' : ($rank == 2 ? 'bg-gradient-to-r from-gray-300 to-gray-500 text-gray-900' : 'bg-gradient-to-r from-orange-400 to-orange-600 text-orange-900');
                    $glow = $rank == 1 ? 'ring-4 ring-yellow-400/80' : ($rank == 2 ? 'ring-4 ring-gray-300/80' : 'ring-4 ring-orange-400/80');
                @endphp
                <div class="relative bg-white/20 backdrop-blur-2xl rounded-2xl shadow-2xl border border-white/30 overflow-hidden p-8 transition-transform hover:scale-[1.025] hover:shadow-2xl duration-300">
                    <div class="absolute top-4 left-4 z-20">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-base font-bold shadow-lg {{ $badge }}">
                            @if($rank == 1)
                                🥇
                            @elseif($rank == 2)
                                🥈
                            @elseif($rank == 3)
                                🥉
                            @else
                                #{{ $rank }}
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center space-x-6">
                        <div class="flex-shrink-0 relative">
                            <img class="h-24 w-24 rounded-full object-cover border-4 border-white/30 {{ $glow }} transition-shadow duration-300" src="{{ asset('storage/foto_kandidat/' . $k->foto) }}" alt="Foto Kandidat">
                            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-lg font-bold rounded-full px-4 py-1 border-2 border-white/30 shadow-md">{{ $k->nomor_urut }}</div>
                        </div>
                        <div class="flex-grow">
                            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-2">
                                <h3 class="text-2xl font-bold text-white drop-shadow-sm">{{ $k->nama_ketua }} & {{ $k->nama_wakil }}</h3>
                                <span class="inline-block bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xl font-bold px-4 py-1 rounded-full shadow border border-white/20">{{ $k->votes_count }} Suara</span>
                            </div>
                            <div class="w-full bg-black/30 rounded-full h-7 mt-4 relative overflow-hidden flex items-center">
                                <span class="absolute left-4 text-xs text-white/80 z-10">{{ $k->votes_count }} suara</span>
                                <div class="bg-gradient-to-r from-sky-400 via-blue-500 to-indigo-500 h-7 rounded-full text-right pr-4 text-white font-bold flex items-center transition-all duration-700" style="width: {{ $persentase }}%">
                                    <span class="ml-auto text-sm font-semibold drop-shadow-sm">{{ number_format($persentase, 1) }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $rank++; @endphp
            @empty
                <div class="text-center text-gray-500 py-16 bg-white/5 rounded-2xl">
                    <p class="text-2xl">Belum ada suara yang masuk.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('dashboard.admin') }}" class="inline-flex items-center py-3 px-8 border border-gray-500 rounded-lg text-base font-semibold text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-blue-700 hover:to-blue-900 shadow-lg transition-colors duration-300">
                <x-lucide-arrow-left class="w-5 h-5 mr-2"/> Kembali ke Dashboard
            </a>
        </div>

    </div>
</x-app-layout> 