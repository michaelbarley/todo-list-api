<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ItemSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            ItemSeeder::class,
        ]);
    }
}
