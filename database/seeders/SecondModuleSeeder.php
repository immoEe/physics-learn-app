<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SecondModuleSeeder extends Seeder
{
    public function run()
    {
        $section = Section::where('slug', 'kinematics-basics')->first();

        $this->seedTopicTasks($section, 'Описание механического движения', [
            [
                'order' => 1,
                'name' => 'Описание механического движения',
                'content' => 'Тело двигалось из точки A в точку B криволинейно. Для каждого случая определи, какие физические величины на графике выделены зелёным цветом.',
                'difficulty' => 'Средне',
                'points' => 2
            ],
            [
                'order' => 2,
                'name' => 'Определение равномерности движения',
                'content' => 'Тело движется прямолинейно. В таблице представлены координаты этого тела, которые измеряли каждые 4 с от начала движения. Определи, является ли движение равномерным.',
                'difficulty' => 'Легко',
                'points' => 1
            ],
        ]);

    }

    private function seedTopicTasks(Section $section, string $topicTitle, array $tasks)
    {
        $topic = $section->topics()->where('title', $topicTitle)->firstOrFail();
        
        foreach ($tasks as $taskData) {
            $topic->tasks()->create($taskData);
        }
    }
}