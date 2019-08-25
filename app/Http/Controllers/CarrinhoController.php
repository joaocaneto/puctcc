<?php

namespace App\Http\Controllers;

use App\Models\Entrega;
use App\Models\Fornecedor;
use App\Models\Pedido;
use App\Models\PedidoDetalhado;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class CarrinhoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $pedidoDetalhado = PedidoDetalhado::query()->where([
            ['situacao', '=', 'R'], // Reservado
            ['idUser', '=', Auth::id()]
        ])->get();

        $mensagem = $request->session()->get('mensagem');

        if ($pedidoDetalhado->isEmpty() && (is_null($mensagem))) {
            $mensagem = 'Seu carrinho de compras está vazio.';
            return view('carrinho.index', compact('mensagem'));
        }

        if ($pedidoDetalhado->isEmpty() && (!is_null($mensagem))) {
            return view('carrinho.index', compact('mensagem'));
        }

        $pedidosAgrupados = $pedidoDetalhado->groupBy('idPF');

        return view('carrinho.index', compact('pedidosAgrupados', 'mensagem'));
    }

    public function clear(Request $request)
    {
        $pedido = Pedido::query()->where([
            ['situacao', '=', 'R'],
            ['idUser', '=', Auth::id()]
        ])->update(['situacao' => 'E']); // Excluído

        $request->session()->flash('mensagem', 'Seu carrinho de compras está vazio.');

        return redirect()->route('carrinho.visualizar');
    }

    public function checkout(Request $request)
    {
        $pedidoDetalhado = PedidoDetalhado::query()->where([
            ['situacao', '=', 'R'], // Reservado
            ['idPedido', '=', $request->idPedido]
        ])->get();

        $idPF = 'x';

        foreach ($pedidoDetalhado as $pedido) {
            // Atualizar estoque Fornecedor
            $produtoFornecedor = ProdutoFornecedor::query()
                ->where('idPF', '=', $pedido->idPF)
                ->update(['quantidade' => $pedido->quantidade - 1]);

            $entrega = Entrega::create([
                'idPedido' => $request->idPedido,
                'cep' => $request->cep,
                'endereco' => $request->endereco,
                'complemento' => $request->complemento,
                'cidade' => $request->cidade,
                'uf' => $request->uf,
                'idPF' => $pedido->idPF
            ]);


            if ($idPF != $pedido->idPF) {
                $fornecedor = Fornecedor::query()->where('idFornecedor', '=', $pedido->f_idFornecedor)->first();
                $conteudo = [
                    'cabecalho' => 'Compra efetuada no site Multitools.',
                    'texto' => 'Prezado, você acaba de realizar uma venda no site MultiTools.<br/>
                    Providenciar o envio do produto para o cliente conforme normas da empresa e aguardar liberação do pagamento. Em caso de dúvidas, favor entrar em contato com nossa Central de Atendimento.<br/>
                    Seguem os dados do produto vendido:<br/>
                    Pedido: ' . str_pad($pedido->idPedido, 6, '0', STR_PAD_LEFT) . '<br/>
                    Produto: ' . $pedido->nomeProduto . '<br/>
                    Comprador: ' . Auth::user()->name . '<br/>
                    CEP: ' . $request->cep . '<br/>
                    Endereço: ' . $request->endereco . '<br/>
                    Complemento: ' . $request->complemento . '<br/>
                    Cidade: ' . $request->cidade . '<br/>
                    UF: ' . $request->uf
                ];
                Mail::to($fornecedor['emailFornecedor'])
                    ->send(new SendMail('Nova compra efetuada no site MultiTools', 5, $conteudo));
            }

            $idPF = $pedido->idPF;
        }

        Pedido::query()->where([
            ['situacao', '=', 'R'], // Reservado
            ['idPedido', '=', $request->idPedido]
        ])->update(['situacao' => 'T']); // Em transporte

        $request->session()->flash('mensagem', 'Pedido realizado com sucesso e encaminhado ao Fornecedor.');

        return redirect()->route('carrinho.visualizar');
    }

    public function shipping(Request $request)
    {
        $pedido = Pedido::query()->where([
            ['situacao', '=', 'R'], // Reservado
            ['idUser', '=', Auth::id()]
        ])->get();

        if ($pedido->isEmpty()) {
            $request->session()->flash('mensagem', 'Seu carrinho de compras está vazio.');
            return redirect()->route('carrinho.visualizar');
        }

        return view('carrinho.shipping', compact('pedido'));
    }

    public function insert(Request $request)
    {
        $produto = Produto::find($request->idProduto);

        $idUsuario = Auth::id(); //Usuário logado

        $pedido = Pedido::query()->where([
            ['idUser', '=', $idUsuario],
            ['situacao', '=', 'R'] //Reservado
        ])->first();

        $idPedido = $pedido['idPedido'];

        if (empty($pedido)) {
            $novoPedido = Pedido::create([
                'idUser' => $idUsuario,
                'valor' => $produto->preco,
                'situacao'  => 'R' //Reservado
            ]);

            $idPedido = $novoPedido->idPedido;
        }

        $produtoFornecedor = ProdutoFornecedor::query()->where([
            ['p_idProduto', '=', $request->idProduto],
            ['f_idFornecedor', '=', $request->idFornecedor]
        ])->first();

        $produtoPedido = DB::table('produto_pedido')->insert(
            ['idPedido' => $idPedido, 'idPF' => $produtoFornecedor['idPF']]
        );

        $request->session()->flash('mensagem', 'Produto adicionado ao carrinho.');

        return redirect()->route('carrinho.visualizar');
    }
}
