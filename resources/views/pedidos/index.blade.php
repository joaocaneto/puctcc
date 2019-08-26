@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8">
        @if(!empty($mensagem))
        <div class="alert alert-danger">{{ $mensagem }}</div>
        @endif

        <div class="conteiner bg-light">
            <div class="row align-items-center ml-4 pt-4 font-weight-bold">Meus Pedidos</div>
            <hr />
            <div class="row mx-auto g-light">
                <div class="col-sm ml-4 pb-3 font-weight-bold">Pedido</div>
                <div class="col-sm ml-4 pb-3 font-weight-bold">Produto</div>
                <div class="col-sm ml-4 pb-3 font-weight-bold">Valor</div>
                <div class="col-sm ml-4 pb-3 font-weight-bold">Situação</div>
            </div>

            @foreach($pedidosAgrupados as $pedido)
            <div class="row mx-auto bg-white">
                <div class="col-sm ml-4">{{ str_pad($pedido[0]->idPedido, 6 , '0' , STR_PAD_LEFT) }}</div>
                <div class="col-sm ml-4">{{ $pedido[0]->nomeProduto }}</div>
                <div class="col-sm ml-4">{{ 'R$ ' . $pedido[0]->valor }}</div>
                <div class="col-sm ml-4">
                    @php
                    if ($pedido[0]->situacao == 'T') {
                    echo 'Pedido em Transporte';
                    } elseif ($pedido[0]->situacao == 'R') {
                    echo 'Pedido Reservado';
                    };
                    @endphp</div>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection