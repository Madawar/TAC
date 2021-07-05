<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create(array(
            'name' => 'Dennis Wanyoike',
            'email' => 'dwanyoike@codedcell.com',
        ));
        Artisan::call('prod:fetch');

    }
}
