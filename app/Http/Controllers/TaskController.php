<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Task;
use App\Models\Section;
use App\Http\Requests\TaskCheckRequest;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct(private TaskService $taskService ) {}

    public function check(TaskCheckRequest $request, Task $task)
    {
        $result = $this->taskService->checkAnswer($request, $task);

        session()->flash('message', $result['message']);
        session()->flash('message_type', $result['type']);

        return redirect()->route('tasks.show', $task);
    }

}
