

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Форма авторизации</title>
    <script src="js/jquery.min.js"></script>
    <script src="js/adfunc.js"></script>

    <link rel="stylesheet" href="css/admin/reset.css">
    <link rel="stylesheet" href="css/admin/animate.css">
    <link rel="stylesheet" href="css/admin/styles.css">
</head>
<body>

<div id="container">
    <form action="" id="form" method="post">
        <label for="name">Логин:</label>
        <input type="name" name="login" id="login" onkeyup="check();" placeholder="Введите логин">
        <label for="username">Пароль:</label>
        {{--<p><a href="#">Забыли пароль?</a></p>--}}
        <input type="password" name="password" id="password" onkeyup="check();" placeholder="Введите пароль">
        <div id="lower">
            <input type="checkbox"><label class="check" for="checkbox">Запомнить меня</label>
            <input type="button" class="send" id="button" value="Войти" onclick="sendData()" disabled>
        </div>
    </form>
</div>
</body>
</html>


