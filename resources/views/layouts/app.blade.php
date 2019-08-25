<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MultiTools</title>

    <!-- Scripts -->
    <script src="{{ url('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ url('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('fontawesome-free-5.9.0-web/css/all.css') }}">
</head>

<body style="padding-top: 56px; background-color: aliceblue;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm fixed-top">
            <div class="container"><i class="fas fa-2x fa-tools mr-2 text-white"></i>
                <a class="navbar-brand text-white" href="{{ url('/') }}">
                    MultiTools
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse navbar-dark bg-dark" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('register') }}">Cadastre-se</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/fornecedores">Listar Fornecedores</a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sair</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Serviços<span
                                    class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/fornecedores/create">Cadastro de Fornecedores</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contato</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active fas fa-2x fa-shopping-cart"
                                href="{{ route('carrinho.index') }}"></a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
     <main class="py-4">
            @yield('content')
        </main>
</body>

<!-- Footer -->
<footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; MultiTools - Loja Virtual de Ferramentas</p>
        </div>

    </footer>

</html>