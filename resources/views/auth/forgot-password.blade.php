<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('forgot_password') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Nunito", sans-serif;
        }

        .card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 1px solid #e5e7eb;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 22px;
        }

        p {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            margin-bottom: 12px;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #4a90e2;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .status {
            background: #ecfdf5;
            color: #065f46;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            background: #fef2f2;
            color: #991b1b;
            padding: 10px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        .back {
            margin-top: 15px;
            text-align: center;
        }

        .back a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="card">

    <h2>{{ __('forgot_password') }}</h2>
    <p>{{ __('enter_email_to_reset') }}</p>

    {{-- رسالة نجاح --}}
    @if (session('status'))
        <div class="status">
            {{ session('status') }}
        </div>
    @endif

    {{-- رسالة خطأ --}}
    @if ($errors->any())
        <div class="error">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <input
            type="email"
            name="email"
            placeholder="{{ __('messages.email') }}"
            value="{{ old('email') }}"
            required
        >

        <button type="submit">
            {{ __('send_reset_link') }}
        </button>
    </form>

    <div class="back">
        <a href="{{ route('login') }}">
            ← {{ __('back_to_login') }}
        </a>
    </div>

</div>

</body>
</html>
