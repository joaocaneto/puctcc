<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
    <link rel="stylesheet" href="{{ url('fontawesome-free-5.9.0-web/css/all.css') }}">
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>

    <title>MultiTools - Loja Virtual de Ferramentas</title>

</head>

<body style="padding-top: 56px; background-color: aliceblue;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- <a class="navbar-brand" href="#">Start Bootstrap</a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                @yield('menuSuperior')

            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-3 text-center">

                <h1 class="my-4"><i class="fas fa-tools mr-2"></i><strong>MultiTools</strong></h1>

                @yield('menuLateral')

            </div>

            <div class="col-lg-9">

                @yield('conteudo')

            </div>

        </div>

    </div>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; MultiTools - Loja Virtual de Ferramentas</p>
        </div>

    </footer>
</body>

</html>
