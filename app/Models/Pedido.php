<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pedido
 *
 * @property int $idPedido
 * @property int $idUser
 * @property float $valor
 * @property string $situacao 
 *
 * @property \Illuminate\Database\Eloquent\Collection $produto_Fornecedors
 *
 * @package App\Models
 */
class Pedido extends Eloquent
{
	protected $table = 'pedido';
	protected $primaryKey = 'idPedido';
	public $timestamps = false;

	protected $casts = [
		'valor' => 'float'
	];

	protected $fillable = [
		'idUser',
		'valor',
	    'situacao'        
	];

	public function produto_Fornecedors()
	{
		return $this->belongsToMany(\App\Models\ProdutoFornecedor::class, 'produto_pedido', 'pedido_idPedido', 'produtoFornecedor_idPF');
	}
}
