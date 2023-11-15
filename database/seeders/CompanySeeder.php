<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            ['name' => 'مسك الدار'],
            ['name' => 'الاساس العربية'],
            ['name' => 'تايم كليك  للتجارة العامة '],
            ['name' => 'انترناشونال ستار'],
            ['name' => 'تايم كليك العقارية '],
            ['name' => 'المسك للمواد الغذائيه '],
            ['name' => 'ام اس ام '],
            ['name' => 'تايم كليك'],
        ];

        foreach($companies as $company){
            Company::create($company);
        }
    }
}
