<?php

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Profile::class, 3)->create();
    }
}
