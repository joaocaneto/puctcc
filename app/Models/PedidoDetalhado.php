<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PedidoDetalhado
 *
 * @package App\Models
 */
class PedidoDetalhado extends Eloquent
{
	protected $table = 'pedidoDetalhado';
	protected $primaryKey = 'idPP';
	public $timestamps = false;

	protected $casts = [
		'valor' => 'float',		
		'quantidade' => 'int',		
		'preco' => 'float'		
	];

}
