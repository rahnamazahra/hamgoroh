<?php

namespace Database\Seeders;

use App\Models\EvaluationModel;
use Illuminate\Database\Seeder;

class EvaluationModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EvaluationModel::create(['title' => 'آپلود ویدئو']);
        EvaluationModel::create(['title' => 'آپلود عکس']);
        EvaluationModel::create(['title' => 'آپلود صوت']);
        EvaluationModel::create(['title' => 'متن']);
        EvaluationModel::create(['title' => 'آزمون آنلاین چهارگزینه‌ای']);
        EvaluationModel::create(['title' => 'آزمون آنلاین تصویری']);
    }
}
