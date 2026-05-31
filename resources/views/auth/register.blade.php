<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ __('create_account') }}Nomo</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body{margin:0;padding:0;font-family:"Nunito",sans-serif;background:#f5f7fa;display:flex;justify-content:center;align-items:center;height:100vh;}
        .card{background:#fff;padding:24px;border-radius:12px;width:380px;box-shadow:0 6px 18px rgba(0,0,0,0.06);text-align:center;}
        input{width:100%;padding:10px;margin:8px 0;border-radius:8px;border:1px solid #ccc;}
        .btn{width:100%;padding:12px;margin-top:12px;border:none;border-radius:10px;background:#50c878;color:#fff;cursor:pointer;}
        .errors{color:#c0392b;font-size:14px;margin-bottom:8px;}
    </style>
</head>
<body>
    <div class="card">
        <h2>{{ __('create_account') }}</h2>

        @if($errors->any())
            <div class="errors">
                {!! implode('<br>', $errors->all()) !!}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
            <input type="email" name="email" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="{{ __('messages.password') }}" required>
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button type="submit" class="btn">{{ __('messages.create_account') }}</button>
        </form>

        <p style="margin-top:10px"><a href="{{ route('login') }}">{{ __('messages.login') }}</a></p>
    </div>
</body>
</html>
