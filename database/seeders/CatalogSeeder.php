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
        $sections = [
            [
                'title' => 'Введение. Физика и методы научного познания',
                'slug' => 'introduction',
                'order' => 1,
                'topics' => [
                    ['order' => 1, 'title' => 'Введение'],
                    ['order' => 2, 'title' => 'Макро- и микромир. Числа со степенью 10'],
                    ['order' => 3, 'title' => 'Наблюдения, опыты, измерения, гипотеза, эксперимент'],
                    ['order' => 4, 'title' => 'Физические величины. Международная система единиц']
                ]
            ],
            [
                'title' => 'Основы кинематики',
                'slug' => 'kinematics-basics',
                'order' => 2,
                'topics' => [
                    ['order' => 1, 'title' => 'Описание механического движения'],
                    ['order' => 2, 'title' => 'Прямолинейное равномерное движение'],
                    ['order' => 3, 'title' => 'Равнопеременное движение'],
                    ['order' => 4, 'title' => 'Равномерное движение по окружности']
                ]
            ],
            [
                'title' => 'Основы динамики',
                'slug' => 'dynamics-basics',
                'order' => 3,
                'topics' => [
                    ['order' => 1, 'title' => 'Законы Ньютона'],
                    ['order' => 2, 'title' => 'Сила тяготения'],
                    ['order' => 3, 'title' => 'Сила упругости'],
                    ['order' => 4, 'title' => 'Силы трения']
                ]
            ],
        ];

        foreach ($sections as $sectionData) {
            $section = Section::create([
                'title' => $sectionData['title'],
                'slug' => $sectionData['slug'],
                'order' => $sectionData['order']
            ]);

            foreach ($sectionData['topics'] as $topic) {
                $section->topics()->create($topic);
            }
        }
    }
}