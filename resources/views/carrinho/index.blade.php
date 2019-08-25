@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="">
        @if(!empty($mensagem))
        <div class="alert alert-success">{{ $mensagem }}</div>
        @endif

        <div class="mb-4">
            <div class="mb-4">
                <h4>Produtos no carrinho</h4>
                <hr />
                <h5>Pedido: {{ '000001' }}</h5>
            </div>

            @php
            $total = 0;
            @endphp

            @foreach($pedidosAgrupados as $grupoPedidos)
            <div class="">
                <div class="row mb-4 font-weight-bold">
                    <div class="col-md">Produto</div>
                    <div class="">Valor</div>
                </div>

                @php
                $subtotal = 0;
                $quantidade_produto = 0;
                @endphp
                @foreach ($grupoPedidos as $pedido)

                <div class="row mb-4">
                    <div class="col-md">{{ $pedido->nomeProduto }}</div>
                    <div class="">R$ {{  number_format($pedido->preco, 2, ',', '.') }}</div>
                    @php
                    $subtotal += $pedido->preco;
                    $total += $subtotal;
                    @endphp
                </div>

                @endforeach

                <div class="row mb-4 font-weight-bold">Subtotal: R$ {{  number_format($subtotal, 2, ',', '.') }}</div>

            </div>
            @endforeach

            <div class="row mb-4 font-weight-bold">Total do Pedido: R$ {{  number_format($total, 2, ',', '.') }}</div>

        </div>
        
        <form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.limpar') }}">

            <input type="hidden" name="idPedido" id="idPedido" value="{{ $pedidosAgrupados }}">

            <button class="btn btn-success float-right">Checkout</button>

            @csrf
        </form>

        <a class="btn btn-info float-right mr-3" href="{{ url('/') }}">Continuar comprando</a>

        <form id="form-adicionar-produto" method="POST" action="{{ route('carrinho.limpar') }}">

            <input type="hidden" name="idPedido" id="idPedido" value="{{ $pedidosAgrupados }}">

            <button class="btn btn-secondary float-right mr-3">Limpar carrinho</button>

            @csrf
        </form>

    </div>
</div>

@endsection