<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TravelEase</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: url('/images/background-river.jpg') center/cover fixed no-repeat;
        }

        .auth-wrapper {
            width: 100%;
            max-width: 900px;
            height: 600px;
            display: flex;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        /* Left Panel - Welcome/Toggle Section with Mountain Image (NO overlay) */
        .welcome-panel {
            flex: 1;
            background: url('/images/mountain-traveler.jpg') center/cover no-repeat;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 50px 40px;
            text-align: center;
            position: relative;
        }

        .welcome-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .welcome-message {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 35px;
            font-weight: 300;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            max-width: 350px;
        }

        .welcome-message.login {
            display: block;
        }

        .welcome-message.signup {
            display: none;
        }

        .toggle-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 25px;
            width: 100%;
        }

        .toggle-btn {
            padding: 12px 32px;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: white;
            border-radius: 30px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: white;
            transform: translateY(-2px);
        }

        .toggle-btn.active {
            background: white;
            color: #1e3a8a;
            border-color: white;
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.4);
        }

        /* Right Panel - Form Section (Clean White) */
        .form-panel {
            flex: 1;
            background: rgba(255, 255, 255, 0.98);
            padding: 50px 45px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow-y: auto;
        }

        .form-panel h3 {
            font-size: 28px;
            color: #1e3a8a;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 700;
        }

        .form-container {
            width: 100%;
        }

        .login-form,
        .register-form {
            display: none;
        }

        .login-form.active,
        .register-form.active {
            display: block;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-weight: 600;
            font-size: 13px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 18px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #00bcd4;
            box-shadow: 0 0 0 3px rgba(0, 188, 212, 0.1);
        }

        .form-group.error input,
        .form-group.error select {
            border-color: #dc2626;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form-check input[type="checkbox"] {
            width: auto;
            margin: 0;
        }

        .form-check label {
            margin: 0;
            font-weight: normal;
            font-size: 13px;
        }

        .optional-label {
            color: #6b7280;
            font-size: 11px;
            font-weight: normal;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #00bcd4, #0097a7);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            box-shadow: 0 4px 15px rgba(0, 188, 212, 0.3);
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #0097a7, #00838f);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 188, 212, 0.4);
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
                height: auto;
                max-width: 100%;
                border-radius: 0;
            }

            .welcome-panel {
                padding: 40px 25px;
                min-height: 300px;
            }

            .form-panel {
                padding: 40px 25px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <!-- Left Panel - Welcome Section with Mountain Image -->
        <div class="welcome-panel">
            <div class="welcome-content">
                <!-- Login Welcome Message -->
                <p class="welcome-message login" id="loginMessage">
                    Welcome back, traveler! Sign in to continue your journey and explore amazing destinations around the world.
                </p>

                <!-- Signup Welcome Message -->
                <p class="welcome-message signup" id="signupMessage">
                    Embark on your adventure with TravelEase. Discover breathtaking destinations, plan unforgettable trips, and explore the world with ease. Join thousands of travelers today!
                </p>

                <div class="toggle-container">
                    <button class="toggle-btn active" id="loginToggle" onclick="showLogin()">
                        Login
                    </button>
                    <button class="toggle-btn" id="signupToggle" onclick="showSignup()">
                        Sign Up
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Panel - Form Section (Clean White) -->
        <div class="form-panel">
            <div class="form-container">

                <!-- LOGIN FORM -->
                <div class="login-form active" id="loginForm">
                    <h3>Welcome Back</h3>

                    @if($errors->any() && !old('is_register'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group {{ $errors->has('email') ? 'error' : '' }}">
                            <label for="login_email">📧 Email</label>
                            <input type="email"
                                   id="login_email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'error' : '' }}">
                            <label for="login_password">🔒 Password</label>
                            <input type="password"
                                   id="login_password"
                                   name="password"
                                   placeholder="Enter your password"
                                   required>
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>

                        <button type="submit" class="submit-btn">Login</button>
                    </form>
                </div>

                <!-- REGISTER FORM -->
                <div class="register-form" id="registerForm">
                    <h3>Create Account</h3>

                    @if($errors->any() && old('is_register'))
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" name="is_register" value="1">

                        <div class="form-group">
                            <label for="name">👤 Full Name</label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter your full name"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="register_email">📧 Email</label>
                            <input type="email"
                                   id="register_email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="phone">📱 Phone <span class="optional-label">(Optional)</span></label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Enter phone number">
                        </div>

                        <div class="form-group">
                            <label for="country">🌍 Country <span class="optional-label">(Optional)</span></label>
                            <select id="country" name="country">
                                <option value="">Select country</option>
                                <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                <option value="Other" {{ old('country') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="register_password">🔒 Password</label>
                            <input type="password"
                                   id="register_password"
                                   name="password"
                                   placeholder="Create password (min 8 characters)"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">🔒 Confirm Password</label>
                            <input type="password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm your password"
                                   required>
                        </div>

                        <button type="submit" class="submit-btn">Sign Up</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.add('active');
            document.getElementById('registerForm').classList.remove('active');
            document.getElementById('loginToggle').classList.add('active');
            document.getElementById('signupToggle').classList.remove('active');
            document.getElementById('loginMessage').style.display = 'block';
            document.getElementById('signupMessage').style.display = 'none';
        }

        function showSignup() {
            document.getElementById('loginForm').classList.remove('active');
            document.getElementById('registerForm').classList.add('active');
            document.getElementById('loginToggle').classList.remove('active');
            document.getElementById('signupToggle').classList.add('active');
            document.getElementById('loginMessage').style.display = 'none';
            document.getElementById('signupMessage').style.display = 'block';
        }

        @if(old('is_register'))
            showSignup();
        @endif
    </script>
</body>
</html>
