<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'جيب'],
            ['name' => 'صالون'],
            ['name' => 'وانيت L 200'],
            ['name' => 'باص مقفل'],
            ['name' => 'بوكس مقفل'],
            ['name' => 'باص مقفل ركاب'],
            ['name' => 'هاف لوري'],
            ['name' => 'وانيت'],
        ];

        foreach($types as $type){
            Type::create($type);
        }
    }
}
