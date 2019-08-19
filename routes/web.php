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

Route::get('/categoria/{categoria}', 'HomeController@index');

Route::get('/produtos', 'ProdutosController@index');

Route::get('/fornecedores', 'FornecedoresController@index')->middleware('auth');

Route::get('/fornecedores/lock/{idFornecedor}', 'FornecedoresController@lock')->middleware('auth');
Route::get('/fornecedores/unlock/{idFornecedor}', 'FornecedoresController@unlock')->middleware('auth');
Route::get('/fornecedores/remover/{idFornecedor}', 'FornecedoresController@remover')->middleware('auth');

Route::get('/fornecedores/create', 'FornecedoresController@create');
Route::post('/fornecedores/create', 'FornecedoresController@store');

Route::get('/produtos/{idProduto}', 'ProdutosController@show')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/produtos/{idProduto}/atualizarImagem', 'ProdutosController@atualizarImagem');
