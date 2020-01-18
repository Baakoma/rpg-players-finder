<?php


use App\Models\Type;
use Illuminate\Database\Seeder;

class CreateTypeSeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'name' => 'type_1',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
            ],
            [
                'name' => 'type_2',
                'description' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.'
            ]
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
