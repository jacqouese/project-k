<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Icons -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
</head>

<body>
    <header>
        <div class="header-logo"><a href="/">KołobrzegHotele</a></div>
        <div class="header-links">
            <ul>
                <li><img src="{{ asset('img/ico_pl.png') }}" class="language-flag" alt="language"></li>
                <li><img src="{{ asset('img/ico_ge.png') }}" class="language-flag" alt="language"></li>
                <li><img src="{{ asset('img/ico_us.png') }}" class="language-flag" alt="language"></li>
            </ul>
        </div>
    </header>
    @yield('content')
    <footer>
        <div>
            <h1>Strony</h1>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <h1>Informacje</h1>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <h1>Więcej</h1>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <h1>O Nas</h1>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
            <p>Lorem ipsum</p>
        </div>
    </footer>
</body>

</html>