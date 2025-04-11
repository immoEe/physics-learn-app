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
                'name' => 'Новичок',
                'email' => 'novice@example.com',
                'password' => 'password',
                'points' => 50
            ],
            [
                'name' => 'Подмастерье',
                'email' => 'apprentice1@example.com',
                'password' => 'password',
                'points' => 100
            ],
            [
                'name' => 'Подмастерье',
                'email' => 'apprentice2@example.com',
                'password' => 'password',
                'points' => 250
            ],
            [
                'name' => 'Мастер',
                'email' => 'master1@example.com',
                'password' => 'password',
                'points' => 251
            ],
            [
                'name' => 'Мастер',
                'email' => 'master2@example.com',
                'password' => 'password',
                'points' => 500
            ],
            [
                'name' => 'Эксперт',
                'email' => 'expert@example.com',
                'password' => 'password',
                'points' => 600
            ],
            [
                'name' => 'Кандидат наук',
                'email' => 'candidate@example.com',
                'password' => 'password',
                'points' => 800
            ],
            [
                'name' => 'Гуру',
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