
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="login-box">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 error-message" />
            </div>

            <!-- Password -->
            <div class="form-group mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 error-message" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ml-3">
                    {{ __('Log in') }}
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

    .login-box {
        background: #121212; /* Dark background for the box */
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.6);
        width: 350px;
        text-align: center;
        position: relative;
    }

    .login-box h2 {
        color: white;
        font-size: 1.5rem;
        margin-bottom: 40px;
    }

    .form-group {
        position: relative;
        margin-bottom: 30px;
    }

    .form-group label {
        color: white;
        font-size: 14px;
        position: absolute;
        top: -20px;
        left: 0;
        transition: 0.3s;
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

    .form-actions {
        margin-top: 20px;
    }

    .form-actions a {
        color: white;
        text-decoration: none;
        font-size: 14px;
        margin-right: 30px;
        transition: 0.3s;
    }

    .form-actions a:hover {
        color: #007bff;
    }

    .btn {
        padding: 10px 20px;
        background-color: #007bff; /* Button color */
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    /* Neon border effect */
    .login-box:before {
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

    /* Style the 'Remember me' text */
    .inline-flex.items-center span {
        color: white;
    }

    /* Style error messages (for example: 'These credentials do not match our records.') */
    .error-message {
        color: #fff; /* White color for error messages */
        font-size: 0.875rem; /* Slightly smaller font for error messages */
        margin-top: 8px;
    }

</style>
