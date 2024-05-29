<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <title>@yield('titulo')</title>





    <!-- Custom styles for this template-->
    <link href="{{ asset('petsLayout') }}/css/sass/style.css" rel="stylesheet">
    <!------------------------------------>
    <!------------------------------------>
    <!------------------------------------>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <!------------------------------------>
    <!------------------------------------>
    <!------------------------------------>
</head>



<body id="wrapper">

        <header><h1 class="h3 mb-4 text-gray-800">@yield('titulo')</h1></header>
        <nav>@yield('menu')</nav>
        <main>@yield('conteudo')</main>
        <footer>Rodape</footer>

</body>
<!--<script src="{{ asset('petsLayout') }}/vendor/jquery/jquery.min.js"></script>-->



<!--<script src="https://cdn.tailwindcss.com"></script>-->
</body>

</html>
