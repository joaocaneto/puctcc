<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 09 Jun 2019 21:13:02 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Entrega
 *
 * @package App\Models
 */
class Entrega extends Eloquent
{
	protected $table = 'entrega';
	protected $primaryKey = 'idEntrega';
	public $timestamps = false;	

	protected $fillable = [
		'idPedido',
		'cep',
		'endereco',
		'complemento',
		'cidade',
		'uf',
		'idPF'        
	];
	
}
