<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
        <link rel="stylesheet" href="{{asset('styles/app.css')}}">
        <link rel="stylesheet" href="{{asset('styles/tasks.css')}}">

        <style>
            .solved-task {
                background-color:rgb(80, 199, 80) !important;
                transition: background-color 0.3s ease;
            }
        </style>
        <title>Learn Physics</title>
    </head>
    <body>
        <div class="container">
        <header class="header">
            <div class="wrapper">
                <div class="header__content">
                    <nav class="header__navigation-container">
                        <ul class="header__navigation-list">
                            <li class="header__navigation-item">
                                <a class="header__navigation-link" href="{{ route('welcome') }}">Главная</a>
                            </li>
                            <li class="header__navigation-item active">
                                <a class="header__navigation-link" href="{{ route('catalog') }}">Каталог</a>
                            </li>
                            @auth
                                    <li class="header__navigation-item">
                                        <a class="header__navigation-link" href="{{ route('dashboard') }}">Личный кабинет</a>
                                    </li>
                                @else
                                    <li class="header__navigation-item">
                                        <a class="header__navigation-link" href="{{ route('register') }}">Вход/Регистрация</a>
                                    </li>
                                @endauth
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
        <div class="wrapper">
            <div class="tasks-content">
                <h1 class="tasks-title">Задания</h1>
                
                <div class="tasks-list">
                    @foreach($tasks as $task)
                    <div class="task-item task-card @if(auth()->check() && auth()->user()->hasSolved($task)) solved-task @endif">
                        <a href="{{ route('tasks.show', $task) }}" class="task-link">
                            <div class="task-header">
                                <span class="task-number">{{ $loop->iteration }}.</span>
                                <h2 class="task-name">{{ $task->name }}</h2>
                            </div>
                            <div class="task-meta">
                                <span class="task-difficulty difficulty-{{ strtolower($task->difficulty) }}">
                                    Сложность: {{ $task->difficulty }}
                                </span>
                                <span class="task-points">
                                    {{ $task->points }} очк.
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
        </div>
    </body>
</html>

