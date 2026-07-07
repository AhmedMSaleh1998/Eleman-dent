<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول — لوحة تحكم الإيمان دنتال</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background: radial-gradient(1100px 600px at 85% -10%, #a01320 0%, transparent 55%),
                radial-gradient(900px 700px at -10% 110%, #8c1019 0%, transparent 50%),
                linear-gradient(135deg, #4a060c 0%, #6b0b0c 45%, #38040a 100%);
            position: relative;
            overflow: hidden;
        }

        /* أشكال زخرفية خفيفة زي هوية الموقع */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: 0.08;
            background: #fff;
        }

        body::before {
            width: 420px;
            height: 420px;
            top: -160px;
            inset-inline-start: -120px;
        }

        body::after {
            width: 300px;
            height: 300px;
            bottom: -120px;
            inset-inline-end: -80px;
        }

        .login-card {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 430px;
            background: rgba(255, 255, 255, 0.97);
            border-radius: 22px;
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.45);
            padding: 42px 38px 34px;
            animation: rise 0.5s ease both;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .login-brand__icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 14px;
            border-radius: 20px;
            background: linear-gradient(135deg, #8c1019, #5d080f);
            display: grid;
            place-items: center;
            box-shadow: 0 12px 26px rgba(107, 11, 12, 0.4);
        }

        .login-brand__icon svg {
            width: 38px;
            height: 38px;
            fill: #fff;
        }

        .login-brand h1 {
            font-size: 21px;
            font-weight: 800;
            color: #2d1416;
        }

        .login-brand p {
            margin-top: 4px;
            font-size: 13px;
            color: #8a7376;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            font-size: 13.5px;
            font-weight: 700;
            color: #4a2c30;
            margin-bottom: 7px;
        }

        .field__wrap {
            position: relative;
        }

        .field__wrap svg {
            position: absolute;
            inset-inline-start: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 17px;
            height: 17px;
            fill: #b09598;
            pointer-events: none;
        }

        .field input {
            width: 100%;
            padding: 13px 16px;
            padding-inline-start: 42px;
            border: 1.5px solid #e8dcdd;
            border-radius: 12px;
            background: #fbf8f8;
            font-family: inherit;
            font-size: 14.5px;
            color: #2d1416;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
            direction: ltr;
            text-align: left;
        }

        .field input:focus {
            outline: none;
            border-color: #8c1019;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(140, 16, 25, 0.12);
        }

        .field input.is-invalid {
            border-color: #d33131;
        }

        .field .error {
            display: block;
            margin-top: 6px;
            font-size: 12.5px;
            font-weight: 600;
            color: #d33131;
        }

        .toggle-pass {
            position: absolute;
            inset-inline-end: 12px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            padding: 4px;
            line-height: 0;
        }

        .toggle-pass svg {
            position: static;
            transform: none;
            width: 18px;
            height: 18px;
            fill: #b09598;
            transition: fill 0.2s;
        }

        .toggle-pass:hover svg {
            fill: #8c1019;
        }

        .login-btn {
            width: 100%;
            margin-top: 6px;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #8c1019, #6b0b0c);
            color: #fff;
            font-family: inherit;
            font-size: 15.5px;
            font-weight: 800;
            letter-spacing: 0.3px;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.2s, filter 0.2s;
            box-shadow: 0 10px 22px rgba(107, 11, 12, 0.35);
        }

        .login-btn:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 14px 28px rgba(107, 11, 12, 0.45);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-foot {
            margin-top: 22px;
            text-align: center;
            font-size: 12px;
            color: #a68e91;
        }

        .alert-danger-box {
            background: #fdeaea;
            border: 1px solid #f5c6cb;
            color: #b02a37;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 18px;
            text-align: center;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 22px 26px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="login-brand">
            <div class="login-brand__icon">
                {{-- أيقونة سنّة --}}
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C9.5 2 8.7 3.2 7 3.2 5 3.2 3 4.8 3 7.5c0 2.2.8 3.4 1.4 4.9.5 1.2.8 2.8 1 4.6.2 1.8.5 5 2.1 5 1.9 0 1.3-3.7 2.4-5.6.4-.8 1-1.3 2.1-1.3s1.7.5 2.1 1.3c1.1 1.9.5 5.6 2.4 5.6 1.6 0 1.9-3.2 2.1-5 .2-1.8.5-3.4 1-4.6.6-1.5 1.4-2.7 1.4-4.9C21 4.8 19 3.2 17 3.2c-1.7 0-2.5-1.2-5-1.2z" />
                </svg>
            </div>
            <h1>لوحة تحكم الإيمان دنتال</h1>
            <p>سجّل دخولك لإدارة الموقع والمنتجات</p>
        </div>

        @if ($errors->any())
            <div class="alert-danger-box">
                البيانات المدخلة غير صحيحة، برجاء المحاولة مرة أخرى
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label for="email">البريد الإلكتروني</label>
                <div class="field__wrap">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.2-8 5-8-5V6l8 5 8-5v2.2z" />
                    </svg>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror" placeholder="admin@example.com" required
                        autocomplete="email" autofocus>
                </div>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="password">كلمة المرور</label>
                <div class="field__wrap">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 8h-1V6a5 5 0 0 0-10 0v2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V10a2 2 0 0 0-2-2zm-9-2a3 3 0 0 1 6 0v2H9V6zm4 10.7V18h-2v-1.3a2 2 0 1 1 2 0z" />
                    </svg>
                    <input id="password" type="password" name="password"
                        class="@error('password') is-invalid @enderror" placeholder="••••••••" required
                        autocomplete="current-password">
                    <button type="button" class="toggle-pass" onclick="togglePassword()" aria-label="إظهار كلمة المرور">
                        <svg id="eye-icon" viewBox="0 0 24 24">
                            <path d="M12 5c-5 0-9.3 3.1-11 7.5C2.7 16.9 7 20 12 20s9.3-3.1 11-7.5C21.3 8.1 17 5 12 5zm0 12.5a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="login-btn">تسجيل الدخول</button>
        </form>

        <div class="login-foot">© {{ date('Y') }} El Eman Dent — جميع الحقوق محفوظة</div>
    </div>

    <script>
        function togglePassword() {
            var input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>

</html>
