<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class ProdutoPedido
 * 
 * @property int $produtoFornecedor_idPF
 * @property int $pedido_idPedido
 * 
 * @property \App\Models\ProdutoFornecedor $ProdutoFornecedor
 * @property \App\Models\Pedido $pedido
 *
 * @package App\Models
 */
class ProdutoPedido extends Eloquent
{
	protected $table = 'produto_pedido';
	protected $primaryKey = 'idPP';	
	public $timestamps = false;	

	protected $fillable = [
		'idPedido' => 'int',
		'idPF' => 'int'
	];

	public function produtoFornecedor()
	{
		return $this->belongsTo(\App\Models\ProdutoFornecedor::class, 'produtoFornecedor_idPF');
	}

	public function pedido()
	{
		return $this->belongsTo(\App\Models\Pedido::class, 'pedido_idPedido');
	}
}
