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
            $userPoints == 1000 => "Гуру",
            $userPoints >= 650 && $userPoints <= 999 => "Кандидат наук",
            $userPoints >= 501 && $userPoints <= 649 => "Эксперт",
            $userPoints >= 251 && $userPoints <= 500 => "Мастер",
            $userPoints >= 100 && $userPoints <= 250 => "Подмастерье",
            $userPoints >= 0 && $userPoints <= 99 => "Новичок",
            default => "Новичок"
        };

        if ($user->rank !== $newRank) {
            $user->rank = $newRank;
            $user->saveQuietly();
        }

        return $newRank;
    }
}