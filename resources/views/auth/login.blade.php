<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.login') }} - Nomo</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Nunito", sans-serif;
            background: linear-gradient(180deg, #F7F9FC, #EEF3FF);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            padding: 34px;
            border-radius: 20px;
            box-shadow: 0 16px 40px rgba(74, 144, 226, 0.18);
            width: 360px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* شريط هوية */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #4A90E2, #7B61FF);
        }

        h2 {
            margin-bottom: 22px;
            font-weight: 800;
            background: linear-gradient(90deg, #4A90E2, #7B61FF);
            -webkit-background-clip: text;
            color: transparent;
        }

        input {
            width: 100%;
            height: 48px;
            padding: 0 14px;
            margin-bottom: 14px;
            border-radius: 12px;
            border: 1px solid #D1D5DB;
            font-size: 15px;
            box-sizing: border-box;
            transition: 0.25s;
        }

        input:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15);
        }

        .btn {
            width: 100%;
            height: 48px;
            margin: 18px 0;
            border: none;
            border-radius: 12px;
            background: linear-gradient(90deg, #4A90E2, #7B61FF);
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 22px rgba(123, 97, 255, 0.35);
        }

        .link {
            display: inline-block;
            margin-top: 10px;
            color: #4A90E2;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .link:hover {
            text-decoration: underline;
        }

        .errors {
            color: #E11D48;
            font-size: 14px;
            margin-bottom: 14px;
        }

        .lang a {
            margin: 0 6px;
            font-size: 13px;
            color: #7B61FF;
            text-decoration: none;
            font-weight: 600;
        }

        .lang a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="card">

        <h2>{{ __('messages.login') }}</h2>

        @if($errors->any())
            <div class="errors">
                {!! implode('<br>', $errors->all()) !!}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email"
                   placeholder="{{ __('messages.email') }}"
                   value="{{ old('email') }}" required>

            <input type="password" name="password"
                   placeholder="{{ __('messages.password') }}" required>

            <div style="display:flex;justify-content:space-between;align-items:center;font-size:14px;margin:8px 0">
                <label style="display:flex;align-items:center;gap:6px;white-space:nowrap;color:#374151">
                    <input type="checkbox" name="remember" style="width:14px;height:18px">
                    {{ __('remember me') }}
                </label>

                <a href="{{ route('password.request') }}" class="link">
                    {{ __('forgot password') }}
                </a>
            </div>

            <button type="submit" class="btn">
                {{ __('messages.login') }}
            </button>
        </form>

        <a href="{{ route('register') }}" class="link">
            {{ __('messages.create_account') }}
        </a>

        <div class="lang" style="margin-top:14px">
            <a href="{{ route('lang.switch', 'ar') }}">العربية</a>
            <a href="{{ route('lang.switch', 'tr') }}">Türkçe</a>
            <a href="{{ route('lang.switch', 'en') }}">English</a>
        </div>
    </div>

</body>
</html>
