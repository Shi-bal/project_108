<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css'); }}">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/@phosphor-icons/web@2.1.1/src/bold/style.css"/>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>UP TREND</title>
    </head>

<x-guest-layout>

    <div class="flex flex-col w-full md:w-1/2 xl:w-2/5 2xl:w-2/5 3xl:w-1/3 mx-auto p-8 md:p-10 2xl:p-12 3xl:p-14 mt-20 rounded-2xl shadow-xl">
        <div class="flex flex-row gap-3 pb-4">
            <div class="flex justify-center w-full">
                <img class="invert" src="{{ asset('logos/uptrendnobg.png') }}" width="50" alt="Logo">
            </div>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="flex flex-col">
            @csrf
            <div class="pb-2">
                <label for="name" class="block mb-2 text-sm font-medium text-[#111827]">Name</label>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center p-1 pl-3"><i class="ph-bold ph-user"></i></span>
                    <input type="text" name="name" id="name" class="pl-12 mb-2 bg-gray-50 text-gray-600 border border-gray-300 sm:text-sm rounded-lg focus:ring-1 focus:ring-gray-400 block w-full p-2.5" placeholder="Your Name" required autofocus autocomplete="name" maxlength="50" pattern="[A-Za-z0-9 ]+">
                </div>
            </div>
            
            <div class="pb-2">
                <label for="email" class="block mb-2 text-sm font-medium text-[#111827]">Email</label>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center p-1 pl-3"><i class="ph-bold ph-envelope-simple"></i></span>
                    <input type="email" name="email" id="email" class="pl-12 mb-2 bg-gray-50 text-gray-600 border border-gray-300 sm:text-sm rounded-lg focus:ring-1 focus:ring-gray-400 block w-full p-2.5" placeholder="Email Address" required autocomplete="username" maxlength="40" pattern="[A-Za-z0-9@.]+">
                </div>
            </div>

            <div class="pb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-[#111827]">Password</label>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center p-1 pl-3"><i class="ph-bold ph-key"></i></span>
                    <input type="password" name="password" id="password" class="pl-12 mb-2 bg-gray-50 text-gray-600 border border-gray-300 sm:text-sm rounded-lg focus:ring-1 focus:ring-gray-400 block w-full p-2.5" placeholder="••••••••••" required autocomplete="new-password" maxlength="25" pattern="[A-Za-z0-9]+">
                </div>
            </div>

            <div class="pb-6">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-[#111827]">Confirm Password</label>
                <div class="relative text-gray-400">
                    <span class="absolute inset-y-0 left-0 flex items-center p-1 pl-3"><i class="ph-bold ph-key"></i></span>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="pl-12 mb-2 bg-gray-50 text-gray-600 border border-gray-300 sm:text-sm rounded-lg focus:ring-1 focus:ring-gray-400 block w-full p-2.5" placeholder="••••••••••" required autocomplete="new-password" maxlength="25" pattern="[A-Za-z0-9]+">
                </div>
                <p id="password-error" class="text-red-500 text-sm mt-2 hidden">Passwords do not match</p>
                <p id="password-requirements" class="text-red-500 text-sm mt-2 hidden">Password must be at least 8 characters long and include a number</p>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <div class="flex items-center">
                    <input type="checkbox" name="terms" id="terms" class="form-checkbox">
                    <label for="terms" class="ms-2 text-sm text-gray-600">I agree to the <a href="{{ route('terms.show') }}" class="underline hover:text-gray-900">Terms of Service</a> and <a href="{{ route('policy.show') }}" class="underline hover:text-gray-900">Privacy Policy</a></label>
                </div>
            </div>
            @endif

            <button type="submit" class="w-full text-white bg-black focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-6">Sign Up</button>
            
            <div class="flex justify-center">
                <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-900 hover:underline">Already have an account? Login</a>
            </div>
        </form>

        <!-- OR separator -->
        <div class="relative flex py-8 items-center">
            <div class="flex-grow border-t border-gray-200"></div> 
            <span class="flex-shrink mx-4 font-medium text-gray-500">OR</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Social Logins -->
        <form>
            <div class="flex gap-2 justify-center">
                <a href="{{ route('auth.google') }}" class="flex items-center gap-2 bg-black py-2 px-4 rounded-md text-gray-200">
                    <i class="ph-bold ph-google-logo"></i>
                    <span>Google</span>
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');
        const form = password.closest('form');
        const passwordError = document.getElementById('password-error');
        const passwordRequirements = document.getElementById('password-requirements');

        form.addEventListener('submit', function (event) {
            let valid = true;

            if (password.value !== passwordConfirmation.value) {
                event.preventDefault();
                passwordError.classList.remove('hidden');
                valid = false;
            } else {
                passwordError.classList.add('hidden');
            }

            const passwordPattern = /^(?=.*[0-9]).{8,}$/;
            if (!passwordPattern.test(password.value)) {
                event.preventDefault();
                passwordRequirements.classList.remove('hidden');
                valid = false;
            } else {
                passwordRequirements.classList.add('hidden');
            }

            return valid;
        });
    });
</script>