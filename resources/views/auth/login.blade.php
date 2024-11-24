<x-guest-layout>
    <x-authentication-card>


        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <span style="font-weight: 600; line-height: 36px; font-size: 24px; color: #C07CA5;">LOGIN</span>

            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <div class="mt-5">
                <x-input-auth id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder='Email' />
            </div>

            <div class="mt-4">
                <x-input-auth id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
            </div>

            <div class="flex justify-between">
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox-auth id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Ingat Saya') }}</span>
                    </label>
                </div>
                <div class="block mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Lupa kata sandi?') }}
                    </a>
                    @endif
                </div>
            </div>


            <div class="flex items-center justify-center mt-5" style="margin-bottom: 20px">

                <x-button-login class="ms-4">
                    {{ __('Login') }}
                </x-button-login>
            </div>
            <div class="flex items-center justify-start mt-5" style="margin-bottom: 5px">
                <a href="/">
                    <svg width="38" height="32" viewBox="0 0 38 32" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <rect width="38" height="32" fill="url(#pattern0_17_57)" />
                        <defs>
                            <pattern id="pattern0_17_57" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_17_57" transform="matrix(0.00896552 0 0 0.01 0.0517241 0)" />
                            </pattern>
                            <image id="image0_17_57" width="100" height="100" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAAAsTAAALEwEAmpwYAAABCUlEQVR4nO3csUrEQBSF4XvyCm5ns2+tla+0/Vjso0QEBTtTxaN+H9wuxZCfgYEwmQEAAAAAAAAAAIDvbTNzOfAcJ8jMPM/MfWau3nhHjP1jRCmKsYvSF2MXpS/GLsq5p6mXAzE+53VmHk9c37+Sgzvj69xm5uGnF/4XRYweEaNHxOgRMXpEjB4Ro0fE6BExekSMHhGjR8ToETF6iFFEjCJiFBGjiBhFxCgM8uTTaxdRColSSJRCohQSpVCcvvpElD4RpU9E6RNR+kSUPhGlT0TpE1H6RJQ+EaVPROkTUfpsrkX/3p2y3FHvibLE6ImyxOiJssToibLE6LH5xR8AAAAAAAAAAADv3gDRQSeBJYNjcgAAAABJRU5ErkJggg==" />
                        </defs>
                    </svg>
                </a>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
