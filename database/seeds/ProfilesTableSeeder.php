<?php

use Illuminate\Database\Seeder;
use App\Models\{Profile, Language, System};

class ProfilesTableSeeder extends Seeder
{
    public function run(): void
    {
        $languages = Language::all();

        Profile::all()->each(function (Profile $profile) use ($languages)
        {
            $profile->languages()->attach(
                $languages->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $systems = System::all();

        Profile::all()->each(function (Profile $profile) use ($systems)
        {
            $profile->systems()->attach(
                $systems->random(rand(1, 3))->pluck('id')->toArray(),
            );
        });
    }
}
