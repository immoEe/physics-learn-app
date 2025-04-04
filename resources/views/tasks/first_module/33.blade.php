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
            margin: 25px 0;
        }
        .conversion-item {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .input-group {
            display: flex;
            align-items: center;
        }
        .answer-input {
            width: 150px;
            text-align: center;
            margin: 0 10px;
        }
        .units {
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }
        .note {
            font-size: 0.9em;
            color: #666;
            margin-top: 10px;
            font-style: italic;
        }
        sup {
            vertical-align: super;
            font-size: smaller;
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
                            <p class="note">Ответы округляй до четырёх цифр после запятой</p>
                        </div>
                        
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                @csrf
                                
                                <div class="conversion-container">
                                    <div class="conversion-item">
                                        <div class="input-group">
                                            <span>137 см<sup>2</sup> =</span>
                                            <input type="number" step="0.0001" name="answers[]" class="answer-input" required>
                                            <span class="units">м<sup>2</sup></span>
                                        </div>
                                    </div>
                                    
                                    <div class="conversion-item">
                                        <div class="input-group">
                                            <span>311 дм<sup>2</sup> =</span>
                                            <input type="number" step="0.0001" name="answers[]" class="answer-input" required>
                                            <span class="units">м<sup>2</sup></span>
                                        </div>
                                    </div>
                                    
                                    <div class="conversion-item">
                                        <div class="input-group">
                                            <span>98039 мм<sup>2</sup> =</span>
                                            <input type="number" step="0.0001" name="answers[]" class="answer-input" required>
                                            <span class="units">м<sup>2</sup></span>
                                        </div>
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