<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index(Topic $topic)
    {
        $tasks = $topic->tasks()->orderBy('id')->get();
        return view('tasks-list/tasks1_1', compact('tasks', 'topic'));
    }

    public function show(Task $task)
    {
        return view('tasks.first_module/1', [
            'task' => $task,
            'nextTask' => Task::where('id', '>', $task->id)->first()
        ]);
    }

    public function check(Request $request, Task $task)
{
    $request->validate(['answer' => 'required']);

    $user = Auth::user();
    
    $completed = $user->tasks()->where('task_id', $task->id)->exists();
    
    if ($completed) {
        return back()->with('error', 'Вы уже выполняли это задание!');
    }

    $isCorrect = $request->answer === $task->correct_answers;

    if ($isCorrect) {
        $user->increment('points', $task->points);

        $user->tasks()->attach($task->id);

        return back()->with('success', 'Правильно! +'.$task->points.' очков');
    }

    return back()->with('error', 'Неверный ответ');
}

}
