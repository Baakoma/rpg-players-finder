<?php

use App\Models\{Filter, System, Language, Type};
use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
{
    public function run(): void
    {
        $systems = System::all();
        $languages = Language::all();
        $types = Type::all();

        Filter::all()->each(function (Filter $filter) use ($systems, $languages, $types){
            $filter->systems()->attach(
                $systems->random(rand(1,3))->pluck('id')->toArray()
            );
            $filter->languages()->attach(
                $languages->random(rand(1,3))->pluck('id')->toArray()
            );
            $filter->types()->attach(
                $types->random(rand(1,5))->pluck('id')->toArray()
            );
        });
    }
}
