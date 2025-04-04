<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
    <style>
        .task-question {
            margin-bottom: 25px;
        }
        .question-number {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .answer-options {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <!-- Шапка (как в ваших примерах) -->
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
                                
                                <!-- Вопрос 1 -->
                                <div class="task-question">
                                    <div class="question-number">1. Допиши предложение.</div>
                                    <p>Точность измерения тем больше, чем:</p>
                                    
                                    <div class="answer-options">
                                        <label class="option-item">
                                            <input type="radio" name="answers[]" value="меньше цена деления" required>
                                            <span>меньше цена деления</span>
                                        </label>
                                        <label class="option-item">
                                            <input type="radio" name="answers[]" value="больше цена деления" required>
                                            <span>больше цена деления</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Вопрос 2 -->
                                <div class="task-question">
                                    <div class="question-number">2. Длина ручки измеряется с помощью измерительной ленты, у которой цена деления равна 0,5 см.</div>
                                    <p>В результате 7 измерений получено среднее значение длины ручки, равное 15 см. Выбери верный вариант записи результатов проведенного измерения ручки.</p>
                                    <p><em>(Погрешность измерений прими равной цене деления.)</em></p>
                                    
                                    <div class="answer-options">
                                        <label class="option-item">
                                            <input type="radio" name="answers[]" value="(15.0 ± 0.5) см" required>
                                            <span>(15.0 ± 0.5) см</span>
                                        </label>
                                        <label class="option-item">
                                            <input type="radio" name="answers[]" value="(15 ± 0.5) см" required>
                                            <span>(15 ± 0.5) см</span>
                                        </label>
                                        <label class="option-item">
                                            <input type="radio" name="answers[]" value="(15.0 ± 0.5) м" required>
                                            <span>(15.0 ± 0.5) м</span>
                                        </label>
                                    </div>
                                </div>
                                
                                @if(session('success'))
                                    <div class="alert success">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert error">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </form>
                            
                            <div class="task-actions">
                                @if($previousTask)
                                    <a href="{{ route('tasks.show', $previousTask) }}" class="btn btn-next btn-prev">← Предыдущее задание</a>
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