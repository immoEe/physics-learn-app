<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run()
    {
        $section = Section::create([
            'title' => 'Введение. Физика и методы научного познания',
            'slug' => 'introduction',
            'order' => 1
        ]);

        $topics = [
            ['order' => 1, 'title' => 'Введение'],
            ['order' => 2, 'title' => 'Макро- и микромир. Числа со степенью 10'],
            ['order' => 3, 'title' => 'Наблюдения, опыты, измерения, гипотеза, эксперимент'],
            ['order' => 4, 'title' => 'Физические величины. Международная система единиц']
        ];

        foreach ($topics as $topicData) {
            $section->topics()->create($topicData);
        }
    }
}