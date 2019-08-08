<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class FornecedoresController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        $fornecedores = Fornecedor::query()->where('situacao', '<>', 'E')->get();
        return view('fornecedores.index', compact('fornecedores', 'mensagem'));
    }

    public function lock(Request $request)
    {
        $fornecedor = Fornecedor::find($request->idFornecedor);
        $fornecedor->situacao = 'L';
        $fornecedor->save();

        Mail::to($fornecedor->emailFornecedor)
        ->send(new SendMail('Bloqueio de cadastro', 2));

        $request->session()->flash(
            'mensagem',
            "Fornecedor {$fornecedor->nomeFornecedor} bloqueado com sucesso."
        );

        return redirect('fornecedores');
    }

    public function unlock(Request $request)
    {
        $fornecedor = Fornecedor::find($request->idFornecedor);
        $fornecedor->situacao = 'U';
        $fornecedor->save();

        Mail::to($fornecedor->emailFornecedor)
        ->send(new SendMail('Liberação de cadastro', 3));

        $request->session()->flash(
            'mensagem',
            "Fornecedor {$fornecedor->nomeFornecedor} liberado com sucesso."
        );

        return redirect('fornecedores');
    }

    public function remover(Request $request)
    {
        $fornecedor = Fornecedor::find($request->idFornecedor);
        $fornecedor->situacao = 'E';
        $fornecedor->save();

        Mail::to($fornecedor->emailFornecedor)
        ->send(new SendMail('Cadastro removido pelo Administrador', 4));

        $request->session()->flash(
            'mensagem',
            "Fornecedor {$fornecedor->nomeFornecedor} removido com sucesso."
        );

        return redirect('fornecedores');
    }

    public function create(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');
        return view('fornecedores.create', compact('mensagem'));
    }

    public function store(Request $request)
    {

        $fornecedor = Fornecedor::create(
            [
                'cnpj' => $request->cnpj,
                'nomeFornecedor' => $request->nomeFornecedor,
                'descFornecedor' => $request->descFornecedor,
                'emailFornecedor' => $request->emailFornecedor,
                'situacao' => 'L'
            ]
        );

        Mail::to($fornecedor->emailFornecedor)
            ->send(new SendMail('Novo cadastro de Fornecedor', 1));

        $request->session()->flash(
            'mensagem',
            "Fornecedor {$fornecedor->nomeFornecedor} inserido com sucesso. Aguarde liberação do Administrador."
        );

        return redirect('fornecedores/create');
    }
}
