<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
    <style>
    .answer-block {
        display: grid;
        grid-template-columns: 1fr auto 1fr auto 1fr; /* 5 колонок: инпут, знак, инпут, знак, инпут */
        grid-template-rows: auto auto;
        gap: 10px;
        align-items: center;
        justify-items: center;
    }
    
    /* Первый инпут (левый) */
    .answer-block input:nth-child(1) {
        grid-column: 1;
        grid-row: 2;
    }
    
    /* Знак минуса */
    .answer-block::after {
        content: "*";
        grid-column: 2;
        grid-row: 2;
        font-size: 1.5rem;
    }
    
    /* Второй инпут (центральный) */
    .answer-block input:nth-child(2) {
        grid-column: 3;
        grid-row: 2;
    }
    
    /* Знак равенства */
    .answer-block::before {
        content: "=";
        grid-column: 4;
        grid-row: 1;
        font-size: 1.5rem;
        align-self: end;
        margin-bottom: 15px;
    }
    
    /* Третий инпут (правый, приподнятый) */
    .answer-block input:nth-child(3) {
        grid-column: 5;
        grid-row: 1;
        margin-bottom: 15px;
    }
    
    .answer-input {
        width: 100%;
        max-width: 100px;
        text-align: center;
        box-sizing: border-box;
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
                    <div class="image__container">
                    </div>
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                 @csrf
                                 <div class="answer-block">
    <input type="text" name="answers[]" class="answer-input" required autocomplete="off">
    <input type="text" name="answers[]" class="answer-input" required autocomplete="off">
    <input type="text" name="answers[]" class="answer-input" required autocomplete="off">
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
                                    <a href="{{ route('tasks.show', $previousTask) }}" 
                                       class="btn btn-next">← Предыдущее задание</a>
                                @endif

                                @if($nextTask)
                                    <a href="{{ route('tasks.show', $nextTask) }}" 
                                       class="btn btn-next mod">Следующее задание →</a>
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
        </main>
    </div>
</body>
</html>