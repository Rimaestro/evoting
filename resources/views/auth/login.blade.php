<x-app-layout>
    @section('title', 'Login')

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white/10 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/20 p-8">
                <div class="mb-8 text-center">
                    <h2 class="text-3xl font-bold text-white">LOGIN</h2>
                    <p class="mt-2 text-sm text-gray-300">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-400">
                        {{ session('status') }}
                    </div>
                @endif

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

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <div class="relative">
                            <x-lucide-mail class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                placeholder="Masukkan email Anda"
                                class="w-full pl-10 pr-4 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                        </div>
                    </div>

                    <!-- Password -->
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <div class="relative">
                            <x-lucide-lock class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"/>
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                placeholder="Masukkan password Anda"
                                class="w-full pl-10 pr-10 py-3 text-white bg-black/20 border border-white/20 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none placeholder-gray-400">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-white">
                                <x-lucide-eye x-show="!show" class="w-5 h-5"/>
                                <x-lucide-eye-off x-show="show" class="w-5 h-5" style="display: none;"/>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded bg-gray-900/50 border-gray-500 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ml-2 text-sm text-gray-300">Ingat saya</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col items-center justify-end pt-4 space-y-4">
                        <button type="submit" class="w-full flex items-center justify-center py-3 px-6 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500 transition-colors duration-300">
                            <x-lucide-log-in class="w-5 h-5 mr-2 -ml-1"/>
                            Masuk
                        </button>
                        <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('register') }}">
                            Belum punya akun? Daftar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
