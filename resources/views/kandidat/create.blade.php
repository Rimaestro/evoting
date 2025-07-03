<x-app-layout>
    <div class="container mx-auto px-4 py-12">
        <div class="w-full max-w-4xl mx-auto">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 p-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-white">Form Pendaftaran Kandidat</h2>
                    <p class="mt-2 text-sm text-gray-300">Isi detail di bawah untuk menambahkan pasangan calon baru.</p>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/30 text-red-300 p-4 rounded-lg mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('kandidat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Ketua --}}
                        <div>
                            <label for="nama_ketua" class="block text-sm font-medium text-gray-300 mb-2">Nama Ketua</label>
                            <input type="text" name="nama_ketua" id="nama_ketua" required value="{{ old('nama_ketua') }}"
                                class="w-full px-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                        </div>
                        
                        {{-- Nama Wakil --}}
                        <div>
                            <label for="nama_wakil" class="block text-sm font-medium text-gray-300 mb-2">Nama Wakil</label>
                            <input type="text" name="nama_wakil" id="nama_wakil" required value="{{ old('nama_wakil') }}"
                                class="w-full px-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                        </div>
                    </div>

                    <div>
                        <label for="nomor_urut" class="block text-sm font-medium text-gray-300 mb-2">Nomor Urut</label>
                        <input type="number" name="nomor_urut" id="nomor_urut" required value="{{ old('nomor_urut') }}"
                            class="w-full px-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                    </div>

                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-300 mb-2">Foto Pasangan Calon</label>
                        <input type="file" name="foto" id="foto"
                            class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-300 hover:file:bg-blue-500/30">
                    </div>

                    <div>
                        <label for="visi" class="block text-sm font-medium text-gray-300 mb-2">Visi</label>
                        <textarea name="visi" id="visi" rows="4" required
                                class="w-full px-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400"></textarea>
                    </div>
                    
                    <div>
                        <label for="misi" class="block text-sm font-medium text-gray-300 mb-2">Misi</label>
                        <textarea name="misi" id="misi" rows="6" required
                                class="w-full px-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400"></textarea>
                    </div>

                    <div class="flex justify-end pt-4 space-x-4">
                        <a href="{{ route('dashboard.admin') }}" class="py-2 px-6 border border-gray-500 rounded-lg text-sm font-medium text-gray-300 hover:bg-gray-700 transition-colors duration-300">
                            Batal
                        </a>
                        <button type="submit"
                                class="py-2 px-6 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500 transition-colors duration-300">
                            Simpan Kandidat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 