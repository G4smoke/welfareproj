<div class="register-box">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 error-message" />
        </div>

        <!-- Email Address -->
        <div class="form-group mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 error-message" />
        </div>
        
        <!-- Phone Number -->
        <div class="form-group mt-4">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="Phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2 error-message" />
        </div>

        <!-- Password -->
        <div class="form-group mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 error-message" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error-message" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>

<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #1a1a2e; /* Black-blue background */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .register-box {
        background: #121212; /* Dark background for the box */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        width: 350px;
        text-align: center;
        position: relative;
    }

    .form-group {
        position: relative;
        margin-bottom: 30px;
    }

    /* Input field styling */
    .form-group input {
        width: 100%;
        padding: 10px;
        background-color: rgba(255, 255, 255, 0.1); /* Light background to make input stand out */
        border: 2px solid #007bff; /* Blue border */
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
    }

    .form-group input:focus {
        border-color: #00c6ff; /* Bright blue when focused */
        outline: none;
    }

    .form-group input::placeholder {
        color: rgba(255, 255, 255, 0.7); /* Lighter placeholder color */
    }

    /* Neon border effect */
    .register-box:before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #00c6ff, #0072ff, #007bff, #ff00ff);
        z-index: -1;
        filter: blur(10px);
        border-radius: 15px;
    }

    /* Style error messages (for example: form validation errors) */
    .error-message {
        color: #fff; /* White color for error messages */
        font-size: 0.875rem; /* Slightly smaller font for error messages */
        margin-top: 8px;
    }
</style>
