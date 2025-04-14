<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
    <style>
        .conversion-container {
            margin: 20px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .conversion-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .conversion-input {
            width: 150px;
            padding: 10px 12px;
            margin: 0 10px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
            text-align: right;
            background-color: #fff;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .conversion-input:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }

    </style>
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
                <div class="task-page">
                <div class="task-header">
                        <h1 class="task-title">{{ $task->name }}</h1>
                        <div class="task-meta">
                            <span class="task-difficulty difficulty-{{ strtolower($task->difficulty) }}">
                                Сложность: {{ $task->difficulty }}
                            </span>
                            <span class="task-points">
                                Можно заработать: {{ $task->points }} очк.
                            </span>
                            @if(session('message'))
                            <div class="alert {{ session('message_type') }}">
                                {{ session('message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="task-content">
                        <div class="task-description">
                            <h3>Условие задания:</h3>
                            <p>{{ $task->content }}</p>
                        </div>
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                @csrf
                                <div class="conversion-container">
                                    <div class="conversion-item">
                                        <span class="unit-label">2863,99 мм =</span>
                                        <input type="number" name="answers[]" class="conversion-input" step="0.0001" placeholder="0.0000" required>
                                        <span class="unit-label">см</span>
                                    </div>
                                    <div class="conversion-item">
                                        <span class="unit-label">2699,7 мм =</span>
                                        <input type="number" name="answers[]" class="conversion-input" step="0.0001" placeholder="0.0000" required>
                                        <span class="unit-label">дм</span>
                                    </div>
                                    <div class="conversion-item">
                                        <span class="unit-label">1052,54 мм =</span>
                                        <input type="number" name="answers[]" class="conversion-input" step="0.0001" placeholder="0.0000" required>
                                        <span class="unit-label">м</span>
                                    </div>
                                    <div class="conversion-item">
                                        <span class="unit-label">481,74 мм =</span>
                                        <input type="number" name="answers[]" class="conversion-input" step="0.0001" placeholder="0.0000" required>
                                        <span class="unit-label">км</span>
                                    </div>
                                </div>
                                <div class="task-actions">
                                    @if($previousTask)
                                        <a href="{{ route('tasks.show', $previousTask) }}" class="btn btn-next">← Предыдущее задание</a>
                                    @endif
                                    @if($nextTask)
                                        <a href="{{ route('tasks.show', $nextTask) }}" class="btn btn-next">Следующее задание →</a>
                                    @endif
                                </div>
                                @auth
                                    <div class="btn-check_block">
                                        <button type="submit" form="task-form" class="btn btn-check">Проверить</button>
                                    </div>
                                @else
                                    <div class="auth-alert">
                                        <p>Для проверки необходимо <a href="{{ route('login') }}">войти</a></p>
                                    </div>
                                @endauth
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>