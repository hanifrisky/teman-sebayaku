<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-xl font-bold text-white">Selamat Datang Kembali</h2>
        <p class="text-sm text-blue-200/60 mt-1">Silakan masuk menggunakan akun Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-200 mb-1.5">Alamat Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                   placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-blue-200">Kata Sandi</label>
                <!-- @if (Route::has('password.request'))
                    <a class="text-xs text-blue-400 hover:text-blue-300 transition-colors" href="{{ route('password.request') }}">
                        Lupa sandi?
                    </a>
                @endif -->
            </div>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   class="block w-full bg-white/5 border border-white/10 text-white focus:border-blue-500 focus:ring-blue-500 rounded-xl px-4 py-2.5 transition-all duration-300 text-sm placeholder-slate-400"
                   placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="rounded bg-white/5 border-white/10 text-blue-600 focus:ring-blue-500 focus:ring-offset-slate-900 focus:ring-2">
                <span class="ms-2 text-xs text-blue-200/80">Ingat saya</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all duration-300 text-sm">
                Masuk ke Dashboard
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-xs text-blue-200/50">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-semibold transition-colors">Daftar sekarang</a></p>
        </div>
    </form>
</x-guest-layout>
