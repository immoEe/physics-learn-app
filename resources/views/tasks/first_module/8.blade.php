<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/first-module.css')}}">
    <style>
        /* Добавьте это в ваш файл first-module.css или app.css */

/* Основной контейнер вариантов ответов */
.answer-options {
    margin: 25px 0;
    width: 100%;
}

/* Группа вопросов */
.question-group {
    margin-bottom: 30px;
    padding: 20px;
    background-color: #f8fafc;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.question-group:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.option-item input[type="radio"]:checked {
    border-color: #3b82f6;
    background-color: #3b82f6;
}

/* Добавить стиль для выделения всего контейнера при выборе */
.option-item input[type="radio"]:checked + span {
    color: #1e40af;
}

.option-item input[type="radio"]:checked {
    border-color: #3b82f6;
    background-color: #3b82f6;
}

/* Добавить фон для выбранного варианта */
.option-item input[type="radio"]:checked ~ span {
    font-weight: 500;
}

.option-item:has(input[type="radio"]:checked) {
    background-color: #eff6ff;
    border-color: #3b82f6;
}

.question-group p {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 15px;
    padding-bottom: 8px;
    border-bottom: 1px solid #e2e8f0;
}

/* Элемент варианта ответа */
.option-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    margin: 8px 0;
    background-color: white;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid #e2e8f0;
}

.option-item:hover {
    background-color: #f1f5f9;
    border-color: #cbd5e1;
}

/* Кастомные радио-кнопки */
.option-item input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #94a3b8;
    border-radius: 50%;
    margin-right: 12px;
    position: relative;
    cursor: pointer;
    transition: all 0.2s ease;
}

.option-item input[type="radio"]:checked {
    border-color: #3b82f6;
    background-color: #3b82f6;
}

.option-item input[type="radio"]:checked::after {
    content: '';
    position: absolute;
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/* Текст варианта ответа */
.option-item {
    font-size: 1rem;
    color: #334155;
    line-height: 1.4;
}

/* Адаптация для мобильных устройств */
@media (max-width: 768px) {
    .question-group {
        padding: 15px;
    }
    
    .option-item {
        padding: 10px 12px;
    }
    
    .question-group p {
        font-size: 1rem;
    }
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
                            <div class="question-group">
        <p>1. Что такое материя?</p>
        <label class="option-item">
            <input type="radio" name="answers[]" value="1" required>
            Оболочка Земли, населённая живыми организмами
        </label>
        <label class="option-item">
            <input type="radio" name="answers[]" value="2" required>
            Это всё то, что существует во Вселенной независимо от нашего сознания
        </label>
    </div>

    <!-- Группа 2: Вопрос о физическом теле -->
    <div class="question-group">
        <p>2. Что в физике понимают под термином «физическое тело»?</p>
        <label class="option-item">
            <input type="radio" name="answers[]" value="3" required>
            Каждое из окружающих нас тел принято называть физическим телом
        </label>
        <label class="option-item">
            <input type="radio" name="answers[]" value="4" required>
            Тонкое тело, определяемое многими религиозными философами
        </label>
    </div>
                            </div>                                                   
                        </form>
                        <div class="task-actions">
                                @if($previousTask)
                                    <a href="{{ route('tasks.show', $previousTask) }}" 
                                       class="btn btn-next btn-prev">← Предыдущее задание</a>
                                @endif

                                @if($nextTask)
                                    <a href="{{ route('tasks.show', $nextTask) }}" 
                                       class="btn btn-next">Следующее задание →</a>
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