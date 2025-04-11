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
                        <h1 class="task-title">Явления природы</h1>
                        <div class="task-meta">
                            <span class="task-difficulty difficulty-medium">
                                Сложность: Средняя
                            </span>
                            <span class="task-points">
                                Можно заработать: 5 очк.
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
                            <p>Отметь, что относится к понятию «явление»:</p>
                        </div>
                        <div class="task-answers">
                            <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
                                @csrf
                                <div class="answer-options grid-options">
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="1">
                                        <span>Пурга</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="2">
                                        <span>Рассвет</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="3">
                                        <span>Кипение</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="4">
                                        <span>Снегопад</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="5">
                                        <span>Наводнение</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="6">
                                        <span>Гром</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="7">
                                        <span>Выстрел</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="спирт" disabled>
                                        <span>Спирт</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="вертолёт" disabled>
                                        <span>Вертолет</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="алюминий" disabled>
                                        <span>Алюминий</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="ножницы" disabled>
                                        <span>Ножницы</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="9">
                                        <span>Метель</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="рельсы" disabled>
                                        <span>Рельсы</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="ртуть" disabled>
                                        <span>Ртуть</span>
                                    </label>
                                    <label class="option-item">
                                        <input type="checkbox" name="answers[]" value="10">
                                        <span>Буран</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="медь" disabled>
                                        <span>Медь</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="стол" disabled>
                                        <span>Стол</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="свинец" disabled>
                                        <span>Свинец</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="нефть" disabled>
                                        <span>Нефть</span>
                                    </label>
                                    <label class="option-item hidden">
                                        <input type="checkbox" name="answers[]" value="Луна" disabled>
                                        <span>Луна</span>
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