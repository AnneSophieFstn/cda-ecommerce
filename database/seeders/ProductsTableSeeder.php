<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products =[
           [
                'id' => 1,
                'title' => 'Miel d\'oranger biologique - 500 g',
                'slug' => 'Mielpéi a- 974',
                'subtitle' => 'Mielpéi oranger - 974',
                'description' => 'Miel certifié agriculture biologique
                                  Pour la santé et pour le plaisir de toute la famille
                                  Plante mellifère sélectionnée pour ses bienfaits reconnus',
                'price' => 10,
                'image' => 'https://via.placeholder.com/200x250',
           ], 
           [
                'id' => 2,
                'title' => 'Miel de citronier biologique - 500 g',
                'slug' => 'Mielpéi b- 974',
                'subtitle' => 'Mielpéi citronnier - 974',
                'description' => 'Miel certifié agriculture biologique
                                  Pour la santé et pour le plaisir de toute la famille
                                  Plante mellifère sélectionnée pour ses bienfaits reconnus',
                'price' => 10,
                'image' => 'https://via.placeholder.com/200x250',
           ], 
           [
                'id' => 3,
                'title' => 'Miel d\'alaska biologique - 500 g',
                'slug' => 'Mielpéi c- 974',
                'subtitle' => 'Mielpéi alaska- 974',
                'description' => 'Miel certifié agriculture biologique
                                  Pour la santé et pour le plaisir de toute la famille
                                  Plante mellifère sélectionnée pour ses bienfaits reconnus',
                'price' => 10,
                'image' => 'https://via.placeholder.com/200x250',
           ], 
           [
                'id' => 4,
                'title' => 'Miel d\'azur biologique - 500 g',
                'slug' => 'Mielpéi d- 974',
                'subtitle' => 'Mielpéi azur- 974',
                'description' => 'Miel certifié agriculture biologique
                                  Pour la santé et pour le plaisir de toute la famille
                                  Plante mellifère sélectionnée pour ses bienfaits reconnus',
                'price' => 10,
                'image' => 'https://via.placeholder.com/200x250',
           ], 
           [
                'id' => 5,
                'title' => 'Miel de romarin biologique - 500 g',
                'slug' => 'Mielpéi e- 974',
                'subtitle' => 'Mielpéi romarin- 974',
                'description' => 'Miel certifié agriculture biologique
                                  Pour la santé et pour le plaisir de toute la famille
                                  Plante mellifère sélectionnée pour ses bienfaits reconnus',
                'price' => 10,
                'image' => 'https://via.placeholder.com/200x250',
           ], 
        ];

    DB::table('products')->insert($products);
    }
}
