<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (isset($request->categoria)) {
            $produtos = Produto::query()->where('categoria', '=', $request->categoria)->get();
        } else {
            $produtos = Produto::all()->random(6);
        }
        return view('home', compact('produtos'));
    }
}
