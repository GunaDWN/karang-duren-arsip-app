<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl">
            <div class="text-center">
                <h2 class="mt-6 text-3xl font-bold text-gray-900">
                    Karang Duren Arsip App
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Lupa password?
                </p>
            </div>

            <div class="mt-8 text-sm text-gray-600">
                {{ __('Lupa password? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link reset password yang memungkinkan Anda untuk membuat yang baru.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="mt-8">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700 mb-1" />
                    <x-text-input 
                        id="email" 
                        class="block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" 
                        type="email" 
                        name="email" 
                        :value="old('email')" 
                        required 
                        autofocus 
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600 text-sm" />
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Kirim Link Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
            
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    &copy; {{ date('Y') }} Karang Duren Arsip App. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
