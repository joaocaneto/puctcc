@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">

            @if(!empty($mensagem))
             <div class="alert alert-success">{{ $mensagem }}</div>
            @endif

            <div class="card">
                <div class="card-header">Cadastro de Fornecedores</div>

                <div class="card-body">
                    <form method="POST" action="/fornecedores/create">
                        @csrf

                        <div class="form-group row">
                            <label for="cnpj" class="col-md-4 col-form-label text-md-right">CNPJ:</label>

                            <div class="col-md-6">
                                <input id="cnpj" name="cnpj" type="text" class="form-control" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="nomeFornecedor" class="col-md-4 col-form-label text-md-right">Razão Social:</label>

                                <div class="col-md-6">
                                    <input id="nomeFornecedor" name="nomeFornecedor" type="text" class="form-control" required autofocus>
                                </div>
                            </div>

                        <div class="form-group row">
                                    <label for="descFornecedor" class="col-md-4 col-form-label text-md-right">Descriçao:</label>

                                    <div class="col-md-6">
                                        <textarea id="descFornecedor" name="descFornecedor" type="text" class="form-control" required autofocus></textarea>
                                    </div>
                                </div>

                        <div class="form-group row">
                                <label for="emailFornecedor" class="col-md-4 col-form-label text-md-right">E-mail:</label>

                                <div class="col-md-6">
                                    <input id="emailFornecedor" name="emailFornecedor" type="email" class="form-control" required autofocus>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
