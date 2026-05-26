<x-guest-layout>
    <div class="mb-4 text-sm text-white">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi, sehingga Anda dapat memilih kata sandi yang baru.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-blue-200 mb-1.5">Alamat Email</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all duration-300 text-sm">
                Kirim tautan
            </button>
        </div>
    </form>
</x-guest-layout>
