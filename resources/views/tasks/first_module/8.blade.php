<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/1.css')}}">
    <style>
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin: 15px 0;
            font-weight: 500;
        }

        .alert.success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert.error {
            background: #fee2e2;
            color: #b91c1c;
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
                            <div class="answer-options">
                                @foreach(['Кинематика', 'Ядерная физика', 'Магнитное поле', 'Электродинамика'] as $option)
                                <label class="option-item">
                                    <input type="radio" name="answer" value="{{ $option }}" required>
                                    <span>{{ $option }}</span>
                                </label>
                                @endforeach
                            </div>                                                    
                            @auth
                                <div class="task-actions">
                                <button type="submit" style="cursor: pointer" class="btn-check">Проверить</button>
                                <a href="{{ route('tasks.show', $nextTask) }}" class="btn-next">Следующее задание</a>
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
        </main>
    </div>
</body>
</html>