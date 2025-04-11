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

        $userAnswers = array_map(function($answer) {
            return mb_strtolower(str_replace(' ', '', $answer));
        }, $userData->answers);


        $userAnswerString = implode('|', $userAnswers);

        $correctAnswer = mb_strtolower(str_replace(' ', '', $task->correct_answers));

        dd($userAnswerString);

        $isCorrect = ($correctAnswer === $userAnswerString);


        if ($isCorrect && !$user->tasks()->where('task_id', $task->id)->wherePivot('is_correct', 1)->exists()) {
            $user->increment('points');
        }

        $user->tasks()->syncWithoutDetaching([
            $task->id => [
                'is_correct' => $isCorrect,
                'user_answer' => $userAnswerString 
            ]
        ]);

        return [
            'message' => $isCorrect ? 'Ответ правильный!' : 'Ответ неправильный!',
            'type' => $isCorrect ? 'success' : 'error'
        ];
    }
}