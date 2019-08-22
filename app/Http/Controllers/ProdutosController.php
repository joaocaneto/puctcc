<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of ProdutosController
 *
 * @author joaoc
 */

use App\Models\Fornecedor;
use App\Models\Produto;
use App\Models\ProdutoFornecedor;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function show(Request $request)
    {
        $produtos = Produto::query()->where('idProduto', '=', $request->idProduto)->get();
        $produtosFornecedores = ProdutoFornecedor::query()->where([
            ['p_idProduto', '=', $request->idProduto],
            ['quantidade', '>', 0]
        ])->get();
        $fornecedores = [];

        foreach ($produtosFornecedores as $key => $value) {
            $objProdutoFornecedor = Fornecedor::query()->where('idFornecedor', '=', $value->f_idFornecedor)->first();

            if (!empty($objProdutoFornecedor)) {
                $fornecedores[$key] = [
                    'idFornecedor' => $objProdutoFornecedor->idFornecedor,
                    'nomeFornecedor' => $objProdutoFornecedor->nomeFornecedor
                ];
            }
        }

        return view('produtos.show', ['produtos' => $produtos, 'fornecedores' => $fornecedores]);
    }

    public function atualizarImagem(Request $request)
    {
        $fileName = 'produto' . $request->idProduto . '.jpg';
        $path = $request->file('image')->move('./images/produtos', $fileName);
        $imageURL = url($fileName);
        return response()->json(['url' => $imageURL], 200);
    }
}
