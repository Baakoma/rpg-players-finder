<?php

use App\Models\ProfileSystem;
use Illuminate\Database\Seeder;

class ProfileSystemTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(ProfileSystem::class)->create([
            'profile_id' => 1,
            'system_id' => 1,
        ]);
        factory(ProfileSystem::class)->create([
            'profile_id' => 1,
            'system_id' => 2,
        ]);
        factory(ProfileSystem::class)->create([
            'profile_id' => 2,
            'system_id' => 1,
        ]);
        factory(ProfileSystem::class)->create([
            'profile_id' => 3,
            'system_id' => 2,
        ]);

    }
}
