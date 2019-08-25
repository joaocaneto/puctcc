@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="">

        <div class="mb-4">           
            
            <form method="POST" action="{{ route('carrinho.finalizar') }}">

            <div class="">
                <h4>Informe o endereço de entrega</h4>
                <hr />
                <h5>Pedido: {{ str_pad($pedido[0]->idPedido, 6 , '0' , STR_PAD_LEFT) }}</h5>
                <input type="hidden" name="idPedido" id="idPedido" value="{{ $pedido[0]->idPedido }}">
            </div>

            <div class="form-group row">
                    <label for="cep" class="col-md-3 col-form-label text-md-left">CEP:</label>
                    <div class="col-md-4">
                        <input id="cep" name="cep" type="text" class="form-control" required autofocus>
                    </div>
            </div>

            <div class="form-group row">
                <label for="endereco" class="col-md-3 col-form-label text-md-left">Endereço:</label>
                <div class="col-md-9">
                    <input id="endereco" name="endereco" type="text" class="form-control" required autofocus>
                </div>
            </div>    

            <div class="form-group row">
                <label for="complemento" class="col-md-3 col-form-label text-md-left">Complemento:</label>
                <div class="col-md-9">
                    <input id="complemento" name="complemento" type="text" class="form-control" required autofocus>
                </div>
            </div> 

            <div class="form-group row">
                <label for="cidade" class="col-md-3 col-form-label text-md-left">Cidade:</label>
                <div class="col-md-9">
                    <input id="cidade" name="cidade" type="text" class="form-control" required autofocus>
                </div>
            </div> 

            <div class="form-group row">
                <label for="uf" class="col-md-3 col-form-label text-md-left">UF:</label>
                <div class="col-md-9">
                    <input id="uf" name="uf" type="text" class="form-control" required autofocus>
                </div>
            </div>  

        </div>     
        
        <button type="submit" class="btn btn-success float-right">Finalizar</button>
        @csrf
    </form> 

        <a class="btn btn-info float-right mr-3" href="{{ url('/') }}">Continuar comprando</a>

        <a class="btn btn-secondary float-right mr-3" href="{{ route('carrinho.limpar') }}">Limpar carrinho</a>

    </div>
</div>

@endsection