<x-guest-layout>
    <x-authentication-card>


        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <span style="font-weight: 600; line-height: 36px; font-size: 24px; color: #C07CA5;">Register</span>

            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <div>
                <x-input-auth id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap" />
            </div>

            <div class="mt-4">
                <x-input-auth id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="Email" />
            </div>

            <div class=" mt-4">
                <x-input-auth id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
            </div>

            <div class="mt-4">
                <x-input-auth id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <x-label for="terms">
                    <div class="flex items-center">
                        <x-checkbox name="terms" id="terms" required />

                        <div class="ms-2" style="font-size: 13px">
                            {!! __('Saya menyetujui Perjanjian Pengguna dan Kebijakan Privasi yang Berlaku', [
                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </div>
                    </div>
                </x-label>
            </div>
            @endif

            <div class="flex items-center justify-center mt-5" style="margin-bottom: 35px">
                <x-button-login class="ms-4">
                    {{ __('Daftar') }}
                </x-button-login>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
