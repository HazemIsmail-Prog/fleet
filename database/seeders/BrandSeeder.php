<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'تويوتا'],
            ['name' => 'سوزوكي'],
            ['name' => 'ميتشوبيشي'],
            ['name' => 'هيونداى'],
            ['name' => 'شيفروليه'],
            ['name' => 'هيونداى h1'],
            ['name' => 'سوزوكي سويفت'],
            ['name' => 'مرسيدس'],
            ['name' => 'كاتربلر'],
            ['name' => 'هيتاشي'],
            ['name' => 'هينو ديترو'],
            ['name' => 'نيسان'],
            ['name' => 'جيب'],
            ['name' => 'جى ام سى'],
        ];
        foreach($brands as $brand){
            Brand::create($brand);
        }
    }
}
