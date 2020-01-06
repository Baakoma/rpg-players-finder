<?php

use App\Models\LanguageProfile;
use Illuminate\Database\Seeder;

class LanguageProfileTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(LanguageProfile::class)->create(['language_id' => 1, 'profile_id' => 1]);
        factory(LanguageProfile::class)->create(['language_id' => 1, 'profile_id' => 2]);
        factory(LanguageProfile::class)->create(['language_id' => 1, 'profile_id' => 3]);
        factory(LanguageProfile::class)->create(['language_id' => 2, 'profile_id' => 1]);
        factory(LanguageProfile::class)->create(['language_id' => 2, 'profile_id' => 2]);
        factory(LanguageProfile::class)->create(['language_id' => 3, 'profile_id' => 1]);
    }
}
