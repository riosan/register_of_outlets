<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    {{--<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" />--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />

</head>
<body>
<div class="container">
    <h1 class="text-center">
        {{ isset($pagetitle) ? $pagetitle : 'Гостевая книга' }}</h1><hr/>
   @yield('content')
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
{{--<script type="text/javascript" src="/js/jquery.min.js"></script>--}}
{{--<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>--}}
</body>
</html>