<x-guest-layout>
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden dark:bg-gray-800">
            <div class="bg-sheila-primary py-4 px-6">
                <h2 class="text-white text-xl font-semibold">Welcome back to Sheila</h2>
            </div>

            <div class="p-6">
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" class="dark:text-gray-300" />
                        <x-text-input id="email" class="block mt-1 w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                      type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" class="dark:text-gray-300" />
                        <x-text-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600"
                                      type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mb-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sheila-primary shadow-sm focus:ring-sheila-primary dark:bg-gray-700 dark:border-gray-600" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-sheila-primary hover:underline dark:text-sheila-primary-light" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="btn-primary bg-sheila-primary hover:bg-sheila-primary-dark dark:bg-sheila-primary-dark dark:hover:bg-sheila-primary">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-sheila-primary hover:underline dark:text-sheila-primary-light">
                            {{ __('Register') }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
