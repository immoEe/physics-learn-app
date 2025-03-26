<?php
namespace App\Services;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Services\ProfileService;

class TaskService
{

    public function checkAnswer($userData, $task)
    {
        $user = Auth::user();
    
        $userAnswer = mb_strtolower(str_replace(' ', '', $userData->answer));
    
        $correctAnswer = mb_strtolower(str_replace(' ', '', $task->correct_answers));
    
        $isCorrect = ($correctAnswer === $userAnswer);
    
        $alreadyAnsweredCorrectly = $user->tasks()
            ->where('task_id', $task->id)
            ->wherePivot('is_correct', 1)
            ->exists();

        if ($isCorrect && !$alreadyAnsweredCorrectly) {
            $user->increment('points');
        }

        $user->tasks()->syncWithoutDetaching([
            $task->id => ['is_correct' => $isCorrect, 'user_answer' => $userAnswer]
        ]);

        return [
            'message' => $isCorrect ? 'Ответ правильный!' : 'Ответ неправильный!',
            'type' => $isCorrect ? 'success' : 'error'
        ];
    }
}