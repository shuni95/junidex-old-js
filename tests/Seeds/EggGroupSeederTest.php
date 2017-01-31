<?php

use Illuminate\Database\Seeder;

class EggGroupSeederTest extends Seeder
{
    public function run()
    {
        DB::table('egg_groups')->insert([
            ['name' => 'Field'],
            ['name' => 'Fairy'],
            ['name' => 'Bug'],
            ['name' => 'Water 1'],
            ['name' => 'Dragon'],
        ]);
    }
}
