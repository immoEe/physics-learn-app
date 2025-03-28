<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
    <link rel="stylesheet" href="{{asset('styles/app.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/1.css')}}">
    <link rel="stylesheet" href="{{asset('styles/modules/1.1.css')}}">
    <style>
        .drag-drop-table {
            width: 100%;
            margin: 2rem 0;
            border-collapse: collapse;
        }

        .body {
            font-family: Inter;
        }

        .drag-drop-table td {
            padding: 1rem;
            border: 2px solid #E5E7EB;
        }

        .drop-zone {
            min-width: 120px;
            min-height: 50px;
            background: #F9FAFB;
            transition: all 0.3s;
        }

        .drag-items-container {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin: 2rem 0;
        }

        .drag-item {
            padding: 12px 20px;
            background: white;
            border: 2px solid #3B82F6;
            border-radius: 6px;
            cursor: move;
            user-select: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-next {
            margin: 0;
            background-color: #FC4C00;
        }

        .drag-item.dragging {
            opacity: 0.5;
        }

        .drop-zone.hovered {
            background: #EFF6FF;
            border-color: #3B82F6;
        }

        .task-page { margin-top: 20px; }
        .alert { padding:12px; border-radius:8px; margin:15px 0; font-weight:500; }
        .alert.success { background:#d1fae5; color:#065f46; }
        .alert.error { background:#fee2e2; color:#b91c1c; }
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
                    <div class="task-content">
                        <div class="task-description">
                            <h3>Условие задания:</h3>
                            <p>Соотнеси дольную приставку с множителем, который она выражает:</p>
                        </div>

                        <form id="task-form" method="POST" action="{{ route('tasks.check', $task) }}">
            @csrf
            <table class="drag-drop-table">
                <tr>
                    <td>Деци</td>
                    <td class="drop-zone" data-target="деци"></td>
                </tr>
                <tr>
                    <td>Пико</td>
                    <td class="drop-zone" data-target="пико"></td>
                </tr>
                <tr>
                    <td>Милли</td>
                    <td class="drop-zone" data-target="милли"></td>
                </tr>
                <tr>
                    <td>Атто</td>
                    <td class="drop-zone" data-target="атто"></td>
                </tr>
            </table>

            <div class="drag-items-container">
                <div class="drag-item" draggable="true" data-value="10⁻¹">10⁻¹</div>
                <div class="drag-item" draggable="true" data-value="10⁻¹²">10⁻¹²</div>
                <div class="drag-item" draggable="true" data-value="10⁻³">10⁻³</div>
                <div class="drag-item" draggable="true" data-value="10⁻¹⁸">10⁻¹⁸</div>
            </div>

            <input type="hidden" name="answer" id="hidden-answer">
            @if(session('message'))
                <div class="alert {{ session('message_type') }}">
                    {{ session('message') }}
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
    <script src="{{asset('js/1_1_5.js')}}"></script>
</body>
</html>