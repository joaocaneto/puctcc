<?php

use App\Models\Produto;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |

Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/categoria/{categoria}', 'HomeController@index');

Route::get('/produtos', 'ProdutosController@index');

Route::get('/produtos/{idProduto}', 'ProdutosController@show');

Route::get('/fornecedores', 'FornecedoresController@index')->middleware('auth');

Route::get('/pedidos', 'PedidosController@index')->name('pedidos.listar')->middleware('auth');

Route::get('/fornecedores/lock/{idFornecedor}', 'FornecedoresController@lock')->middleware('auth');
Route::get('/fornecedores/unlock/{idFornecedor}', 'FornecedoresController@unlock')->middleware('auth');
Route::get('/fornecedores/remover/{idFornecedor}', 'FornecedoresController@remover')->middleware('auth');

Route::get('/fornecedores/create', 'FornecedoresController@create');
Route::post('/fornecedores/create', 'FornecedoresController@store');

Route::post('/carrinho/adicionar', 'CarrinhoController@insert')->name('carrinho.adicionar')->middleware('auth');
Route::get('/carrinho/visualizar', 'CarrinhoController@index')->name('carrinho.visualizar')->middleware('auth');
Route::get('/carrinho/limpar', 'CarrinhoController@clear')->name('carrinho.limpar')->middleware('auth');
Route::get('/carrinho/entrega', 'CarrinhoController@shipping')->name('carrinho.entrega')->middleware('auth');
Route::post('/carrinho/finalizar', 'CarrinhoController@checkout')->name('carrinho.finalizar')->middleware('auth');

Route::post('/produtos/{idProduto}/atualizarImagem', 'ProdutosController@atualizarImagem');
