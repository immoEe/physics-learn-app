<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Topic;
use App\Models\Task;


class CatalogController extends Controller
{
    public function showTopic(Section $section, Topic $topic)
    {
        $tasks = Task::where('topic_id', $topic->id)->orderBy('id')->get();
        return view("tasks-list.tasks-list", compact('tasks'));
    }

    public function showTask(Task $task)
    {
        $nextTask = Task::where('id', '>', $task->id)
            ->orderBy('id')
            ->first();

        $previousTask = Task::where('id', '<', $task->id)
            ->orderByDesc('id')
            ->first();

        return view("tasks.first_module.{$task->id}", [
            'task' => $task,
            'nextTask' => $nextTask,
            'previousTask' => $previousTask
        ]);
    }

    public function index()
    {
        $sections = Section::with(['topics' => function($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();

        return view('catalog', compact('sections'));
    }
}
