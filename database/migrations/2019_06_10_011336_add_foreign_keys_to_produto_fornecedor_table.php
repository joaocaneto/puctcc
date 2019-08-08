<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProdutoFornecedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('produto_fornecedor', function(Blueprint $table)
		{
			$table->foreign('f_idFornecedor', 'fk_p_f_fornecedor')->references('idFornecedor')->on('fornecedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('p_idProduto', 'fk_p_f_produto')->references('idProduto')->on('produto')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('produto_fornecedor', function(Blueprint $table)
		{
			$table->dropForeign('fk_p_f_fornecedor');
			$table->dropForeign('fk_p_f_produto');
		});
	}

}
