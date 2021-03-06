<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '首页')-新的开始</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
@include('index.layouts._header')
<div class="container">
    <div class="offset-md-1 col-md-10">
        @include('index.shared._messages')
        @yield('content')
        @include('index.layouts._footer')
    </div>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>