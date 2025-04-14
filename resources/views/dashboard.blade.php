<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('styles/utils.css')}}">
        <link rel="stylesheet" href="{{asset('styles/app.css')}}">
        <link rel="stylesheet" href="{{asset('styles/rank.css')}}">
        <title>Learn Physics</title>
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
                            <li class="header__navigation-item">
                                <a class="header__navigation-link" href="{{ route('catalog') }}">Каталог</a>
                            </li>
                            <li class="header__navigation-item">
                                <a class="header__navigation-link active" href="{{ route('dashboard') }}">Личный кабинет</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
        <main class="main">
        <div class="wrapper main-wrapper">
                    <div class="profile-content">
                        <h1 class="profile-title">Добро пожаловать, {{ Auth::user()->name }}!</h1>
                        <div class="rank-panel">
                            <div class="rank-progress">
                                <span class="rank-label">Ваш ранг:</span>
                                <span class="rank-name">{{ $userRank }}</span>
                                <progress 
                                    class="rank-progress-bar" 
                                    value="{{ $user->points }}" 
                                    max="70"
                                ></progress>
                                <span class="rank-points">{{ $user->points }}/70 очк.</span>
                            </div>
                        </div>

                    </div>
                    <div class="ranking">
        <div class="ranking__title-container">
            <h2 class="ranking-title">Топ пользователей</h2>
        </div>
        <div class="ranking_content">
            <ul class="ranking__list">
                @foreach($users as $name => $userData)
                <li class="ranking__item @if($userData['id'] === Auth::id()) current-user @endif">
                    <div class="ranking__position">
                        #{{ $loop->iteration }}
                    </div>
                    <div class="ranking__item-name">
                        {{ $name }}
                    </div>
                    <div class="ranking__item-rank">
                        {{ $userData['rank'] }}
                    </div>
                    <div class="ranking__item-points">
                        <span>{{ number_format($userData['points'], 0, ',', ' ') }} очков</span>
                        <div class="ranking__progress">
                        <div class="ranking__progress-fill" 
     style="width: {{ ($userData['points'] / 70) * 100 }}%">
</div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <button class="logout-button" onclick="showLogoutModal()">Выйти из системы</button>
                </div>
                
        </main>
        <dialog id="logoutModal" class="logout-modal">
                <div class="modal-content">
                    <h3 class="modal-title">Подтверждение выхода</h3>
                    <p class="modal-text">Вы точно хотите выйти?</p>
                    <div class="modal-actions">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="modal-button confirm">Да</button>
                        </form>
                        <button class="modal-button cancel" onclick="closeLogoutModal()">Нет</button>
                    </div>
                </div>
            </dialog>
        </div>
        <script src="{{asset('js/ranks.js')}}"></script>
    </body>
</html>
