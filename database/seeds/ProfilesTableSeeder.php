<?php

use Illuminate\Database\Seeder;
use App\Models\{Profile, Language, System, Filter};

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
                [
                    'lore_knowledge_rating' => rand(0, 10),
                    'mechanic_knowledge_rating' => rand(0, 10),
                    'roleplay_rating' => rand(0, 10),
                    'experience' => rand(0, 10)
                ]
            );
        });

        Profile::all()->each(function (Profile $profile)
        {
            $profile->filter()->save(factory(Filter::class)->make());
        });
    }
}
