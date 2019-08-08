@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <div class="col-md-8">
            @if(!empty($mensagem))
            <div class="alert alert-success">{{ $mensagem }}</div>
            @endif

        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center bg-light">Lista de Fornecedores
                Cadastrados</li>
            @foreach($fornecedores as $fornecedor)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span
                    id="fornecedor-{{ $fornecedor->idFornecedor }}">{{ substr($fornecedor->cnpj, 0, 2) . '.'
                    . substr($fornecedor->cnpj, 2, 3) . '.'
                    . substr($fornecedor->cnpj, 5, 3) . '-'
                    . substr($fornecedor->cnpj, 8, 4) . '/'
                    . substr($fornecedor->cnpj, 12, 2) . ' - ' . $fornecedor->nomeFornecedor }}</span>
                <span class="d-flex">
                        @if ($fornecedor->situacao == 'L')
                        <a href="/fornecedores/unlock/{{ $fornecedor->idFornecedor }}" onclick="return confirm('Tem certeza que deseja liberar este Fornecedor?');" class="btn btn-success btn-sm mr-1" >
                            <i class="fas fa-unlock"></i>
                        @else
                            <a href="/fornecedores/lock/{{ $fornecedor->idFornecedor }}" onclick="return confirm('Tem certeza que deseja bloquear este Fornecedor?');" class="btn btn-info btn-sm mr-1" >
                            <i class="fas fa-lock"></i>
                        @endif
                    </a>

                    <a href="/fornecedores/remover/{{ $fornecedor->idFornecedor }}" onclick="return confirm('Tem certeza que deseja remover?');" class="btn btn-danger btn-sm mr-1" >
                        <i class="far fa-trash-alt"></i>
                    </a>

                </span>
            </li>
            @endforeach
        </ul>

    </div>
</div>

@endsection
