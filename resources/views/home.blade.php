@extends('layout')

@section('menuSuperior')
<ul class="navbar-nav ml-auto align-items-center">
    @auth
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

            <a class="dropdown-item" href="/fornecedores">Listar Fornecedores</a>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                Sair
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
    @endauth
    @guest
    <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>    
    @endguest
    <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Sobre</a>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>Serviços<span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/fornecedores/create">Cadastro de Fornecedores</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contato</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('carrinho.visualizar')}}">
            <i class="active nav-link fas fa-2x fa-shopping-cart">
                {{-- <span class="h5 align-bottom font-weight-bold"></span></i> --}}
            </i>
        </a>
    </li>
</ul>
@endsection

@section('menuLateral')
<div class="list-group">
    <a href="/categoria/1" class="list-group-item">Ferramentas Elétricas</a>
    <a href="/categoria/2" class="list-group-item">Ferramentas de Limpeza</a>
    <a href="/categoria/3" class="list-group-item">Ferramentas Pneumáticas</a>
</div>
@endsection

@section('conteudo')
<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img class="d-block img-fluid" src="{{ url('/images/img01.png') }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="{{ url('/images/img02.png') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block img-fluid" src="{{ url('/images/img03.png') }}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="row">

    @foreach ($produtos as $produto)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="/produtos/{{ $produto->idProduto }}"><img class="card-img-top"
                    src="{{ url('/images/produtos/produto'.$produto->idProduto.'.jpg') }}" alt=""></a>
            <div class="card-body">
                <h5 class="card-title">
                    <a href="/produtos/{{ $produto->idProduto }}">{{ $produto->nomeProduto }}</a>
                </h5>
                <h5>R$ {{ number_format($produto->preco, 2, ',', '.') }}</h5>
                <p class="card-text">{{ str_limit($produto->descProduto , 200) }}</p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Avaliação &#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection