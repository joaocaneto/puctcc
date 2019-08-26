<?php

namespace App\Http\Controllers;

use App\Models\PedidoDetalhado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidosController extends Controller
{
    public function index(Request $request)
    {
        $pedidoDetalhado = PedidoDetalhado::query()
            ->where([
                ['idUser', '=', Auth::id()],
                ['situacao', '<>', 'E'] //Exceto os Excluídos]
            ])->get();

        if ($pedidoDetalhado->isEmpty()) {
            $mensagem = 'Você ainda não possui pedidos cadastrados.';
            return view('pedidos.index', compact('mensagem'));
        }
        
        $pedidosAgrupados = $pedidoDetalhado->groupBy('idPF');

        return view('pedidos.index', compact('pedidosAgrupados'));
    }
}
