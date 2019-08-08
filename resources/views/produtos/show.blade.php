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
    <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Sobre</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Serviços</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contato</a>
    </li>
    <li class="nav-item">
        <a href="/"><i class="active nav-link fas fa-2x fa-shopping-cart">
            <span class="h5 align-bottom font-weight-bold">00</span></i>
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



<div id="productDescription" class="mt-4 mb-4 card">
    <div class="align-items-center card-header font-weight-bold">Produto</div>
    <div class="card-body">
        <img class="card-img-top" src="{{ url('/images/produtos/produto'.$produtos[0]->idProduto.'.jpg') }}" alt="">
        <h5 class="card-title font-weight-bold mt-4">{{ $produtos[0]->nomeProduto }}</h5>
        <p class="card-text">{{ $produtos[0]->descProduto }}</p>
        <p class="card-text font-weight-bold h5">Preço: R$ {{ number_format($produtos[0]->preco, 2, ',', '.') }}</p>
        <a href="#" class="btn btn-success float-right">Comprar agora</a>
    </div>
</div>


@endsection
