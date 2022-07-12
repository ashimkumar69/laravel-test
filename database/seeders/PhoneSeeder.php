<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
{

    public function run()
    {
        Phone::factory(100)->create();
    }
}
