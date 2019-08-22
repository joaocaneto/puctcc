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

<form method="post" action="{{ route('fornecedores.create') }}">
    <div id="productDescription" class="mt-4 mb-4 card">
        <div class="align-items-center card-header font-weight-bold">Produto</div>
        <div class="card-body">
            <img class="card-img-top" src="{{ url('/images/produtos/produto'.$produtos[0]->idProduto.'.jpg') }}" alt="">
            <h5 class="card-title font-weight-bold mt-4">{{ $produtos[0]->nomeProduto }}</h5>
            <p class="card-text">{{ $produtos[0]->descProduto }}</p>
            <p class="card-text font-weight-bold h5">Preço: R$ {{ number_format($produtos[0]->preco, 2, ',', '.') }}</p>

            @if (empty($fornecedores))
            
            <p class="card-text mt-4 alert alert-danger">Desculpe. Produto indisponível no estoque dos nossos fornecedores.</p>
            
            @else

            <p class="card-text mt-4">Escolha o fornecedor do produto:</p>

            @foreach ($fornecedores as $fornecedor)
            <div class="custom-control custom-radio">
                <input type="radio" id="fornecedor_{{ $fornecedor['idFornecedor'] }}" name="fornecedor"
                    class="custom-control-input" checked>
                <label class="custom-control-label"
                    for="fornecedor_{{ $fornecedor['idFornecedor'] }}">{{ $fornecedor['nomeFornecedor'] }}</label>
            </div>
            @endforeach

            <button class="btn btn-success float-right">Colocar no Carrinho</button>

            @endif
        </div>
    </div>
</form>

@endsection