<?php
namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function rank() {
        $user = Auth::user();
        $userPoints = $user->points;

        $newRank = match(true) {
            $userPoints >= 70 && $userPoints <= 999 => "Кандидат наук",
            $userPoints >= 50 && $userPoints <= 649 => "Эксперт",
            $userPoints >= 25 && $userPoints <= 500 => "Мастер",
            $userPoints >= 10 && $userPoints <= 250 => "Подмастерье",
            $userPoints >= 0 && $userPoints <= 99 => "Новичок",
            default => "Новичок"
        };

        if ($user->rank !== $newRank) {
            $user->rank = $newRank;
            $user->saveQuietly();
        }

        return $newRank;
    }

    public function ranking() {
        $users = User::all()->sortBydesc('points')->keyBy('name')->map(function ($user) {
            return [
                'id' => $user->id,
                'rank' => $user->rank,
                'points' => $user->points
            ];
        })
        ->toArray();

        return $users;
    }
}