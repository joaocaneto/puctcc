@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="">
        @if(!empty($mensagem))
        <div class="alert alert-info">{{ $mensagem }}</div>
        @endif

        @if (!empty($pedidosAgrupados))           
        
        @php
        $primeiroGrupo = $pedidosAgrupados->first();    
        @endphp

        <div class="mb-4">
            <div class="mb-4">
                <h4>Produtos no carrinho</h4>
                <hr />
                <h5>Pedido: {{ str_pad($primeiroGrupo[0]->idPedido, 6 , '0' , STR_PAD_LEFT) }}</h5>
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
                    <div class="col-md" data-toggle="tooltip" data-placement="top" title="{{ $pedido->nomeFornecedor }}">{{ $pedido->nomeProduto }}</div>
                    <div class="" data-toggle="tooltip" data-placement="top" title="{{ $pedido->nomeFornecedor }}">R$ {{  number_format($pedido->preco, 2, ',', '.') }}</div>
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
        
        <a class="btn btn-success float-right" href="{{ route('carrinho.entrega') }}">Dados de Entrega</a>

        @endif

        <a class="btn btn-info float-right mr-3" href="{{ url('/') }}">Continuar comprando</a>

        <a class="btn btn-secondary float-right mr-3" href="{{ route('carrinho.limpar') }}">Limpar carrinho</a>

    </div>
</div>

@endsection