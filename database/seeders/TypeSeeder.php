<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Vue', 'Laravel', 'Php', 'Javascript', 'Html', 'Css', 'Sass', 'Bootstrap', 'Sql'];

        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->type = $type;
            $new_type->save();

        }
    }
}
