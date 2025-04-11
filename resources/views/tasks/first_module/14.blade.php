<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
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
                        <h1 class="task-title">Электрические явления</h1>
                        <div class="task-meta">
                            <span class="task-difficulty difficulty-medium">
                                Сложность: Средняя
                            </span>
                            <span class="task-points">
                                Можно заработать: 2 очк.
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
                            <p>Укажи все понятия, относящиеся к электрическим явлениям:</p>
                        </div>
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                @csrf
                                <div class="answer-options grid-options">
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="1">
                                        <span>Молния</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="2">
                                        <span>Слышны раскаты грома</span>
                                    </label>
                                    
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="снег тает">
                                        <span>Снег тает</span>
                                    </label>
                                    <label class="option-item">F5
                                        <input type="checkbox" name="answers[]" value="свинец плавится">
                                        <span>Свинец плавится</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="холодает">
                                        <span>Холодает</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="звёзды мерцают">
                                        <span>Звёзды мерцают</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="3">
                                        <span>Горит люминесцентная лампа</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="вода кипит">
                                        <span>Вода кипит</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="мурлыкание кошки">
                                        <span>Мурлыкание кошки</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="плывёт бревно">
                                        <span>Плывёт бревно</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="шар катится">
                                        <span>Шар катится</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="наступает рассвет">
                                        <span>Наступает рассвет</span>
                                    </label>
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