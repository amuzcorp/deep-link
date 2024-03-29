<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'AMUZ') }}</title>
    <link href="{{ asset('/assets/css/notosans_kr.css') }}" rel="stylesheet" />
    <style>
        body,html{
            height:100%;
            background:#eee;
        }
        .container {
            text-align:center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div>
        @yield('content')
    </div>
</div>
</body>
</html>
