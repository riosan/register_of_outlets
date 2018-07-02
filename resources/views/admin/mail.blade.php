<!doctype html>
<html lang="en">


<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="MobileOptimized" content="width">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
      <title>Почта</title>
</head>

<body>

@include('admin.templates.body')

@include('admin.templates.menu')

@include('admin.templates.form')


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/adfunc.js"></script>
<div class="response_status" align="center"></div>

<script>
    editUserData();

</script>


</body>
</html>




