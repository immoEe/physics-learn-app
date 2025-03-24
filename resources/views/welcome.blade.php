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
        <title>Learn Physics</title>
    </head>
    <body>
        <div class="container">
        <header class="header">
            <div class="wrapper">
                <div class="header__content">
                    <nav class="header__navigation-container">
                        <ul class="header__navigation-list">
                            <li class="header__navigation-item active">
                                <a class="header__navigation-link" href="{{ route('welcome') }}">Главная</a>
                            </li>
                            <li class="header__navigation-item">
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
                <div class="main__content">
                    <div class="main__hero">
                        <div class="main__hero-text">
                            Добро пожаловать на наш образовательный портал,
                                        для изучения Физики
                        </div>
                        <div class="main__hero-button-conteiner">
                            <a href="{{ route('catalog') }}"><button class="main__hero-button">
                                Перейти к заданиям
                            </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        </div>
    </body>
</html>
