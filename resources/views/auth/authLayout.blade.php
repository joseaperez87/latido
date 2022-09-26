<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi">
    <title>Latido.ru - @yield('title')</title>
    <link rel="canonical" href="https://latido.ru/">
    <meta property="og:image" content="{{ asset('assets/images/logo-short-sm.png') }}" />
    <meta property="og:url" content="https://latido.ru" />
    <link rel="icon" href="{{ asset('assets/images/logo-short-sm.png') }}" sizes="any">
    @vite('resources/css/app.css')
</head>
<body>
<div id="app">
</div>
@yield('custom_script')
@vite('resources/js/app.js')
</body>
</html>
