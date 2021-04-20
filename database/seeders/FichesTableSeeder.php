<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FichesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $fiches =[
            [
                 'id' => 1,
                 'title' => 'Boutique Mielcéliño',
                 'image' => 'https://via.placeholder.com/200x250',
                 'description' => 'Notre boutique a été fondée en 1898 par Charles Galland, président de l\'union des apiculteurs Français, afin de diffuser sur Paris les miels des différentes régions de France et y faire découvrir la richesse des produits de la ruche. En 1905, il s\'installe rue Vignon et La Maison du Miel est aujourd\'hui l\'une des plus anciennes boutiques de Paris et est classée à l\'inventaire des monuments historiques de la ville. Ayant pour vocation première de diffuser la richesse de la production apicole Française, La Maison du Miel s\'est aujourd\'hui ouverte au Monde entier et répertorie une cinquantaine de variétés de miels différents. Très engagés dans notre travail et passionnés par la valorisation des meilleurs terroirs, la qualité et la rigueur de nos sélections nous ont fait connaître dans le monde. Nombreux sont les grands chefs et pâtissiers qui se pressent à notre boutique pour y découvrir des récoltes confidentielles.',
                 'adresse' => 'N° 157 - Avenue des abeilles
                                97470 - Saint-Benoit',
            ],
         ];
 
     DB::table('fiches')->insert($fiches);
    }
}
