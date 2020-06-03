<!doctype html>
<html lang="pt-br">
<head>
    <link rel="shortcut icon" type="image/ico" href="favicon.ico"/>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Righteous&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/982d993f59.js" crossorigin="anonymous"></script>
    <title>The Social Network</title>
</head>
<body>
<style>
    body{
        overflow-x: hidden;

    }
    #main {
        transition: margin-left .5s;
        z-index: 1;
        margin-top: 20px;
    }
    #open{
        background-color: #004d40;
        width:fit-content;
        margin-top: 250px;
        padding: 10px;
        position: fixed;
        z-index: 2;

    }
    #open span{
        font-size:15px;
        cursor:pointer;
        margin: 10px;
    }
</style>

    @include('templates.partes.nav')
<div id="open">
    <span onclick="openNav()">&#9776;</span>
</div>
    <div id="main" class="container">
        @include('templates.partes.alerts')
        @yield('conteudo')
    </div>
    @include('templates.partes.footer')
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>
