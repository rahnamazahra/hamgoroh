<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create(['title' => 'آذربایجان شرقی']);
        Province::create(['title' => 'آذربایجان غربی']);
        Province::create(['title' => 'اردبیل']);
        Province::create(['title' => 'اصفهان']);
        Province::create(['title' => 'البرز']);
        Province::create(['title' => 'ایلام']);
        Province::create(['title' => 'بوشهر']);
        Province::create(['title' => 'تهران']);
        Province::create(['title' => 'چهارمحال و بختیاری']);
        Province::create(['title' => 'خراسان جنوبی']);
        Province::create(['title' => 'خراسان رضوی']);
        Province::create(['title' => 'خراسان شمالی']);
        Province::create(['title' => 'خوزستان']);
        Province::create(['title' => 'زنجان']);
        Province::create(['title' => 'سمنان']);
        Province::create(['title' => 'سیستان و بلوچستان']);
        Province::create(['title' => 'فارس']);
        Province::create(['title' => 'قزوین']);
        Province::create(['title' => 'قم']);
        Province::create(['title' => 'کردستان']);
        Province::create(['title' => 'کرمان']);
        Province::create(['title' => 'کرمانشاه']);
        Province::create(['title' => 'کهگیلویه و بویراحمد']);
        Province::create(['title' => 'گلستان']);
        Province::create(['title' => 'گیلان']);
        Province::create(['title' => 'لرستان']);
        Province::create(['title' => 'مازندران']);
        Province::create(['title' => 'مرکزی']);
        Province::create(['title' => 'هرمزگان']);
        Province::create(['title' => 'همدان']);
        Province::create(['title' => 'یزد']);
    }
}
