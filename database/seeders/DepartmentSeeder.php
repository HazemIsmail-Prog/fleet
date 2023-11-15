<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'مجلس الاداره'],
            ['name' => 'ادارة القطاع الانشائي'],
            ['name' => 'المبيعات'],
            ['name' => 'الصحي'],
            ['name' => 'الكهرباء'],
            ['name' => 'الومنيوم ونجارة'],
            ['name' => 'الستلايت والكاميرات'],
            ['name' => 'التكييف والثلاجات والغسالات'],
            ['name' => 'المقاولين'],
            ['name' => 'التاجير الخارجى'],
        ];

        foreach($departments as $department){
            Department::create($department);
        }
    }
}
