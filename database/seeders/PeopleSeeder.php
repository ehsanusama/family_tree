<?php

// In the PeopleSeeder.php seeder file (database/seeders/PeopleSeeder.php)

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\People;

class PeopleSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 records
        \App\Models\People::factory(50)->create();
    }
}
