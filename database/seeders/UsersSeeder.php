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
            $points == 70 => "Гуру",
            $points >= 65 => "Кандидат наук",
            $points >= 50 => "Эксперт",
            $points >= 25 => "Мастер",
            $points >= 10 => "Подмастерье",
            default => "Новичок"
        };
    }
}