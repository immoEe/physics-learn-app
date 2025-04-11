<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
    <style>
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .data-table th {
            background-color: #f2f2f2;
        }
        .answer-select {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 16px;
            margin-top: 15px;
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
                            <table class="data-table">
                                <tr>
                                    <th>x,м</th>
                                    <td>0</td>
                                    <td>4</td>
                                    <td>9</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <th>t,с</th>
                                    <td>0</td>
                                    <td>7</td>
                                    <td>14</td>
                                    <td>21</td>
                                </tr>
                            </table>
                        </div>
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                @csrf
                                <div class="answer-block">
                                    <label class="answer-label">Ответ:</label>
                                    <select name="answers[]" class="answer-select" required>
                                        <option value="">Выберите ответ</option>
                                        <option value="1">движение равномерное</option>
                                        <option value="0">движение неравномерное</option>
                                    </select>
                                </div>
                            </form>
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
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>