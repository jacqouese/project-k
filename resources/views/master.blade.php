<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css?version=5') }}" rel="stylesheet">
    <!-- Icons -->
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <!-- SWUP -->
    <script src="{{ asset('js/swup.js') }}" defer></script>
    <script src="{{ asset('js/swupScriptsPlugin.min.js') }}" defer></script>
    <script src="{{ asset('js/swupFormsPlugin.min.js') }}" defer></script>
    <script src="{{ asset('js/swupTransitions.js?version=2') }}" defer></script>
</head>

<body>
    <noscript>
        <div class="noscript">
            {{__('Strona wymaga JavaScript do poprawnego działania.')}}
        </div>
    </noscript>
    <header>
        <div class="header-logo"><a href="{{url(app()->getLocale()).'/'}}">KołobrzegHotele</a></div>
        <div class="header-links">
            <ul>
                <li><a href="{{url(app()->getLocale()).'/'}}">{{__('znajdź')}}</a></li>
                <li><a href="{{url(app()->getLocale()).'/searchquery'}}">{{__('szukaj')}}</a></li>
                <li>
                    <div class="header-language">
                        <img
                            src="{{ asset('img/ico_pl.png') }}"
                            data-pl="{{ asset('img/ico_pl.png') }}"
                            data-en="{{ asset('img/ico_us.png') }}"
                            data-de="{{ asset('img/ico_ge.png') }}"
                            class="language-flag"
                            id="language-main-flag"
                        >
                        <div id="langauge-dropdown">
                            <a data-no-swup href="/pl">
                                <div>
                                    <img src="{{ asset('img/ico_pl.png') }}" class="language-flag" alt="language">polski
                                </div>
                            </a>
                            <a data-no-swup href="/en">
                                <div>
                                    <img src="{{ asset('img/ico_us.png') }}" class="language-flag" alt="language">English
                                </div>
                            </a>
                            <a data-no-swup href="/de">
                                <div>
                                    <img src="{{ asset('img/ico_ge.png') }}" class="language-flag" alt="language">Deutsch
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <script src="{{ asset('js/headerAnim.js') }}"></script>
    </header>
    <main id="swup" class="transition-main">
        @yield('content')
    </main>
    <div class="cookie-banner">
        <span class="iconify" id="cookie-icon" data-icon="la:cookie-bite" data-inline="false"></span>
        <p>{{__('Niniejszy serwis wykorzystuje pliki cookies do prawidłowego działania, kontynuując korzystanie z serwisu wyrażasz zgodę na ich wykorzystywanie.')}}<br />
            {{__('Więcej informacji znajdziesz w ')}}<a class="cookie-banner-a" href="./cookies">{{__('polityce plików cookies')}}</a>{{__(' oraz w ')}}<a class="cookie-banner-a" href="./privacy">{{__('polityce prywatności.')}}</a></p>
        <button class="button-primary" id="cookie-btn">{{__(('Rozumiem'))}}</button>
    </div>
    <div class="help-banner">
        <span class="iconify" id="help-btn" data-icon="bi:x" data-inline="false" onclick="hideHelpBanner()"></span>
        <p>{{__('Jesteś tu nowy?')}}<br />{{__('Sprawdź jak to działa.')}}</p>
        <button class="button-primary" onclick="showHelp()">{{__('Pomoc')}}</button>
    </div>
    <div class="help-content-container" id="helpContentContainer">
        <div class="help-content">
            <span class="iconify" id="help-btn-content" data-icon="bi:x" data-inline="false" onclick="hideHelp()"></span>
            <h1>{{__('Jak to działa?')}}</h1>
            <p>{{__('Na naszej stronie masz dwie możliwości wyszukiwana hoteli:')}}</p>
            <p>{{__('1. Jeśli nie jesteś jeszcze zdecydowany, to wybierz opcję ')}}<a href="{{url(app()->getLocale()).'/'}}" onclick="hideHelp()">{{__('znajdź.')}}</a></p>
            <p>{{__('2. Jeśli zastanawiasz się nad kilkoma hotelami użyj opcji ')}}<a href="{{url(app()->getLocale()).'/'}}" onclick="hideHelp()">{{__('szukaj')}}</a>{{__(', która pozwoli Ci na wyszukanie noclegu wpisując jego nazwę.')}}</p>
            <p>{{__('Wybierając pierwszą opcje na ')}}<a href="{{url(app()->getLocale()).'/'}}" onclick="hideHelp()">{{__('stronie głównej')}}</a>{{__(' ujrzysz pole wyszukiwana.')}}</p>
            <p>{{__('W tym polu znajduje się 6 kategorii, są to: plaże, rowery miejskie, tereny rekreacyjne, place zabaw, wybiegi dla psów oraz rodzaj noclegu.')}}</p>
            <p>{{__('Abyśmy byli w stanie znaleźć nocleg dopasowany do Twoich preferencji, zaznacz przy użyciu suwaka w poszczególnych kategoriach jak istotne są one dla Ciebie. Im bardziej w góre przesuniesz suwak tym bardziej dana kategoria będzie uwzględniona podczas wyszukiwania.')}}</p>
            <p>{{__('Gdy już wszystko wybierzesz kliknij "szukaj" a my zajmiemy się resztą i przekierujemy Ciebie na stronę wyników.')}}</p>
            <p>{{__('Powodzenia!')}}</p>
        </div>
    </div>
    <script data-swup-ignore-script src="{{ asset('js/cookieConsent.js?version=2') }}"></script>
    <footer>
        <div class="footer-container">
            <div class="footer-item">
                <h1>{{__('Informacje')}}</h1>
                <p><a href="{{url(app()->getLocale()).'/about'}}">{{__('O Nas')}}</a></p>
                <p><a href="{{url(app()->getLocale()).'/cookies'}}">{{__('Polityka Cookies')}}</a></p>
                <p><a href="{{url(app()->getLocale()).'/privacy'}}">{{__('Polityka Prywatności')}}</a></p>
            </div>
            <div class="footer-item">
                <h1>{{__('Pozostałe')}}</h1>
                <p><a href="{{url(app()->getLocale()).'/maps?type=bike'}}">{{__('Mapa Stacji Rowerów Miejskich')}}</a></p>
                <p><a href="{{url(app()->getLocale()).'/maps?type=recreation'}}">{{__('Mapa Terenów Rekreacyjnych')}}</a></p>
                <p><a href="{{url(app()->getLocale()).'/maps?type=playground'}}">{{__('Mapa Placów Zabaw')}}</a></p>
                <p><a href="{{url(app()->getLocale()).'/maps?type=dog'}}">{{__('Mapa Wybiegów dla Psów')}}</a></p>
            </div>
            <div class="footer-item">
                <h1>{{__('Przydatne Linki')}}</h1>
                <p><a href="{{url(app()->getLocale()).'/'}}">{{__('Strona główna')}}</a></p>
                <p><a href="http://www.kolobrzeg.pl/" target="_blank" rel="noreferrer noopener">{{__('Portal UM Kołobrzeg')}}</a></p>
                <p><a href="http://www.opendata.gis.kolobrzeg.pl/" target="_blank" rel="noreferrer noopener">{{__('Kołobrzeskie Otwarte Dane')}}</a></p>
            </div>
            <div class="footer-item">
                <h1>{{__('Języki')}}</h1>
                <p><a href="/pl">polski</a></p>
                <p><a href="/en">English</a></p>
                <p><a href="/de">Deutsch</a></p>
            </div>
            <div class="footer-item">
                <h1>{{__('Kontakt')}}</h1>
                <p><a href="mailto: kontakt@jakubdev.vxm.pl">kontakt@jakubdev.vxm.pl</a></p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js" integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/ScrollTrigger.min.js"></script>

    <script src="{{ asset('js/searchbarDropdown.js?version=3') }}"></script>
    <script src="{{ asset('js/homeLoading.js?version=2') }}" defer></script>

</body>
</html>