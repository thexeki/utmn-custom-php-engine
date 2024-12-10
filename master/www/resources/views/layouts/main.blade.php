<!DOCTYPE html>
<html>
<head>
    <title>@yield("header")</title>
    <link rel=stylesheet href="{{ asset('css/setting.css') }}" type='text/css'>
    <link rel=stylesheet href="{{ asset('css/styles.css') }}" type='text/css'>
    <link rel=stylesheet href="{{ asset('css/sections.css') }}" type='text/css'>
</head>
<body >

<div class="wrapper">
    <div class="content">
        <div class="header container">
            <div class="header__items">
                <div class="logo">
                    <a class="" href="/">
                        <img src="/logo.svg" alt="Логотип сайта">
                    </a>
                </div>
                <div class="title circumference">
                    <h2>
                        Клуб любителей творчества «ОчУмелые ручки»
                    </h2>
                </div>
                <div class="auth ">
                    @if(Auth::check())
                        <a class="circumference" href="{{ route('cabinet') }}">Кабинет</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Выход</button>
                        </form>
                    @else
                        <a class="circumference" href="{{ route('login.form') }}">Вход</a>
                        <a class="circumference" href="{{ route('register.form') }}">Регистрация</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="main container">
            @yield("main")
        </div>
    </div>

    <div class="footer">
        <div class="row container">
            <div class="address">Наш адрес: ВДНХ, 120в</div>
            <div class="tel">Тел: 89123456765</div>
            <div class="copy">(с) Copyright, 2017</div>
        </div>
    </div>
</div>
</body>
</html>
