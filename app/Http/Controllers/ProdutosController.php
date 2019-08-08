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

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    // public function index()
    // {
    //     $produtos = Produto::all;

    //     //return view('produtos.index', compact('produtos'));
    //     return view('produtos.index', [
    //         'produtos' => $produtos
    //     ]);
    // }

    public function show(Request $request)
    {
        $produtos = Produto::query()->where('idProduto', '=', $request->idProduto)->get();
        return view('produtos.show', compact('produtos'));
    }


}
