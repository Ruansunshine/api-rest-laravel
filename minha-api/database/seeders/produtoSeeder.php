<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\produto;

class produtoSeeder extends Seeder
{

    public function run()
    {
        produto::factory()->count(10)->create();
    }
}
