<?php

namespace Database\Seeders;

use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $titles = [
            ['name' => 'مدير عام'],
            ['name' => 'مدير تنفيذي'],
            ['name' => 'مدير مالي'],
            ['name' => 'مندوب'],
            ['name' => 'مهندس انشائي'],
            ['name' => 'محاسب'],
            ['name' => 'مسؤول مبيعات'],
            ['name' => 'مسؤول شفت'],
            ['name' => 'مدخل بيانات'],
            ['name' => 'سائق'],
            ['name' => 'فني'],
            ['name' => 'مراقب'],
            ['name' => 'مقاول'],
            ['name' => 'مسؤول متابعة'],
            ['name' => 'مراقب  انشائى'],
        ];

        foreach($titles as $title){
            Title::create($title);
        }
    }
}
