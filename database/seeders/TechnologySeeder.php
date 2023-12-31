<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = ['php', 'laravel', 'programming', 'css', 'vite', 'my sql', 'javascript', 'html', 'bootstrap', 'vue', 'debugging'];
    
        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name_tech = $technology;
            $new_technology->save();
        }
    }
}
