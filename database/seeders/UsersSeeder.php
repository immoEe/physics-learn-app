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
                'rank' => 'Эксперт"',
                'email' => 'novice@example.com',
                'password' => 'password',
                'points' => 50
            ],
            [
                'name' => 'Анна',
                'rank' => 'Подмастерье',
                'email' => 'apprentice1@example.com',
                'password' => 'password',
                'points' => 10
            ],
            [
                'name' => 'Влада',
                'rank' => 'Мастер',
                'email' => 'apprentice2@example.com',
                'password' => 'password',
                'points' => 25
            ],
            [
                'name' => 'Диана',
                'rank' => 'Мастер',
                'email' => 'master1@example.com',
                'password' => 'password',
                'points' => 25
            ],
            [
                'name' => 'Марина',
                'rank' => 'Эксперт',
                'email' => 'master2@example.com',
                'password' => 'password',
                'points' => 50
            ],
            [
                'name' => 'Даниил',
                'rank' => 'Эксперт',
                'email' => 'expert@example.com',
                'password' => 'password',
                'points' => 60
            ],
            [
                'name' => 'Дельфина',
                'rank' => 'Кандидат наук',
                'email' => 'candidate@example.com',
                'password' => 'password',
                'points' => 70
            ],
            [
                'name' => 'Сергей',
                'rank' => 'Эксперт',
                'email' => 'guru@example.com',
                'password' => 'password',
                'points' => 69
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