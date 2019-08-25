<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoDetalhado;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $pedidoDetalhado = PedidoDetalhado::query()->where([
            ['situacao', '=', 'R'],
            ['idUser', '=', Auth::id()]
        ])->get();

        $pedidosAgrupados = $pedidoDetalhado->groupBy('idPF');

        
        
        return view('carrinho.index', compact('pedidosAgrupados'));
    }

    public function insert(Request $request)
    {
        $produto = Produto::find($request->idProduto);

        $idUsuario = Auth::id(); //Usuário logado

        $pedido = Pedido::query()->where([
            ['idUser', '=', $idUsuario],
            ['situacao', '=', 'R'] //Reservado
        ])->first();

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
            ['idPedido' => $pedido['idPedido'], 'idPF' => $produtoFornecedor['idPF']]
        );

        $request->session()->flash('mensagem', 'Produto adicionado ao carrinho.');

        return redirect()->route('carrinho.index');
    }
}
