<x-app-layout>
    @section('title', 'Register')

    <div class="flex items-center justify-center min-h-screen py-12">
        <div class="w-full max-w-md">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 p-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-white">REGISTER</h2>
                    <p class="mt-2 text-sm text-gray-300">Buat akun baru untuk menggunakan hak pilih Anda.</p>
                </div>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-red-500/20 border border-red-500/30 text-red-300 p-4 rounded-lg mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <x-lucide-user-round class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                                placeholder="Masukkan nama lengkap Anda"
                                class="w-full pl-10 pr-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <div class="relative">
                            <x-lucide-mail class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                                placeholder="Masukkan email Anda"
                                class="w-full pl-10 pr-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Password -->
                    <div x-data="{ 
                        show: false, 
                        password: '',
                        strength: { score: 0, text: '', color: '', width: '' } ,
                        checkStrength() {
                            let score = 0;
                            if (this.password.length >= 8) score++;
                            if (/(?=.*[a-z])/.test(this.password)) score++;
                            if (/(?=.*[A-Z])/.test(this.password)) score++;
                            
                            this.strength.score = score;
                            switch(score) {
                                case 0:
                                    this.strength.text = 'Sangat Lemah';
                                    this.strength.color = 'bg-red-500';
                                    this.strength.width = 'w-[10%]';
                                    break;
                                case 1:
                                    this.strength.text = 'Lemah';
                                    this.strength.color = 'bg-orange-500';
                                    this.strength.width = 'w-1/3';
                                    break;
                                case 2:
                                    this.strength.text = 'Sedang';
                                    this.strength.color = 'bg-yellow-500';
                                    this.strength.width = 'w-2/3';
                                    break;
                                case 3:
                                    this.strength.text = 'Kuat';
                                    this.strength.color = 'bg-green-500';
                                    this.strength.width = 'w-full';
                                    break;
                            }
                        }
                    }">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <x-lucide-lock class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="new-password"
                                placeholder="Buat password minimal 8 karakter"
                                x-model="password" @input="checkStrength()"
                                class="w-full pl-10 pr-10 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">
                                <x-lucide-eye x-show="!show" class="w-5 h-5"/>
                                <x-lucide-eye-off x-show="show" class="w-5 h-5" style="display: none;"/>
                            </button>
                        </div>
                        <div class="mt-2" x-show="password.length > 0">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-xs font-medium text-gray-300" x-text="strength.text"></span>
                            </div>
                            <div class="w-full bg-gray-600 rounded-full h-1.5">
                                <div class="h-1.5 rounded-full transition-all duration-300" :class="[strength.color, strength.width]"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <x-lucide-lock-keyhole class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="password_confirmation" :type="show ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password"
                                placeholder="Ulangi password di atas"
                                class="w-full pl-10 pr-10 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">
                                <x-lucide-eye x-show="!show" class="w-5 h-5"/>
                                <x-lucide-eye-off x-show="show" class="w-5 h-5" style="display: none;"/>
                            </button>
                        </div>
                    </div>

                    <div class="flex flex-col items-center justify-end pt-4 space-y-4">
                        <button type="submit" class="w-full flex items-center justify-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500 transition-colors duration-300">
                            <x-lucide-user-plus class="w-5 h-5 mr-2 -ml-1"/>
                            Daftar
                        </button>
                        <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('login') }}">
                            Sudah punya akun? Masuk
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
