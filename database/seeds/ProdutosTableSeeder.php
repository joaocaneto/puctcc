<?php

use Illuminate\Database\Seeder;
use App\Models\Produto;
use Faker\Factory as Faker;

class ProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
        foreach (range(1, 50) as $i) {
           Produto::create([
            'nomeProduto' => $faker->name(),
            'descProduto' => $faker->sentence(),
            'preco' => $faker->numberBetween(10, 200),
            'situacao' => $faker->randomLetter
            ]);  
        }       
    }
}
