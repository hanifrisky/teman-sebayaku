<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-white">Buat Akun Konseli</h2>
        <p class="text-sm text-blue-200/60 mt-1">Daftar sekarang untuk memulai bimbingan</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-blue-200 mb-1.5">Nama Lengkap</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                   placeholder="Nama lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-200 mb-1.5">Alamat Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                   placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-blue-200 mb-1.5">Kata Sandi</label>
            <div class="relative" x-data="{ show: false }">
                <input id="password" 
                       :type="show ? 'text' : 'password'" 
                       name="password" 
                       required 
                       autocomplete="new-password"
                       class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl pl-4 pr-12 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                       placeholder="••••••••" />
                <button type="button" 
                        @click="show = !show" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-200/50 hover:text-white transition-colors focus:outline-none p-1.5"
                        title="Tampilkan/Sembunyikan Kata Sandi">
                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-blue-200 mb-1.5">Konfirmasi Kata Sandi</label>
            <div class="relative" x-data="{ show: false }">
                <input id="password_confirmation" 
                       :type="show ? 'text' : 'password'" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password"
                       class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl pl-4 pr-12 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                       placeholder="••••••••" />
                <button type="button" 
                        @click="show = !show" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-200/50 hover:text-white transition-colors focus:outline-none p-1.5"
                        title="Tampilkan/Sembunyikan Kata Sandi">
                    <svg x-show="!show" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="show" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.025 10.025 0 014.132-5.4M9.69 9.69a3 3 0 004.62 4.62M4.93 4.93l14.14 14.14" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all duration-300 text-sm">
                Daftar & Masuk
            </button>
        </div>

        <div class="text-center mt-4">
            <p class="text-xs text-blue-200/50">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
