<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [   
                'name' => 'Григорий',
                'rank' => 'Новичок',
                'email' => 'novice@example.com',
                'password' => 'password',
                'points' => 50
            ],
            [
                'name' => 'Анна',
                'rank' => 'Подмастерье',
                'email' => 'apprentice1@example.com',
                'password' => 'password',
                'points' => 100
            ],
            [
                'name' => 'Влада',
                'rank' => 'Подмастерье',
                'email' => 'apprentice2@example.com',
                'password' => 'password',
                'points' => 250
            ],
            [
                'name' => 'Диана',
                'rank' => 'Мастер',
                'email' => 'master1@example.com',
                'password' => 'password',
                'points' => 251
            ],
            [
                'name' => 'Марина',
                'rank' => 'Мастер',
                'email' => 'master2@example.com',
                'password' => 'password',
                'points' => 500
            ],
            [
                'name' => 'Даниил',
                'rank' => 'Эксперт',
                'email' => 'expert@example.com',
                'password' => 'password',
                'points' => 600
            ],
            [
                'name' => 'Дельфина',
                'rank' => 'Кандидат наук',
                'email' => 'candidate@example.com',
                'password' => 'password',
                'points' => 800
            ],
            [
                'name' => 'Сергей',
                'rank' => 'Гуру',
                'email' => 'guru@example.com',
                'password' => 'password',
                'points' => 1000
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'points' => $user['points'],
                'rank' => $this->determineRank($user['points'])
            ]);
        }
    }

    private function determineRank(int $points): string
    {
        return match(true) {
            $points == 1000 => "Гуру",
            $points >= 650 => "Кандидат наук",
            $points >= 501 => "Эксперт",
            $points >= 251 => "Мастер",
            $points >= 100 => "Подмастерье",
            default => "Новичок"
        };
    }
}