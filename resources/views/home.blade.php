@extends('master')

@section('title', 'KołobrzegHotele')

@section('content')

<section class="home-search">
    <div class="search-container-image transition-main-image">
        <img src="{{ asset('img/port-low-res.png') }}" data-src="{{ asset('img/port.png') }}" id="main-image">
    </div>
    <h1 class="main-text">{{ __('Twój wypoczynek')}} <br> {{__('w Kołobrzegu')}}</h1>
    <div class="search-container transition-search-container">
        <p class="search-p transition-search-text">{{__('Zaznacz co jest dla ciebie najważniejsze, a my znajdziemy twój idealny nocleg.')}}</p>
        @include('searchbar')
    </div>
    <a href="https://en.wikipedia.org/wiki/Ko%C5%82obrzeg#/media/File:Ko%C5%82obrzeg,_wej%C5%9Bcie_do_portu_-_panoramio.jpg" id="licence">{{__('źródło zdjęcia oraz licencja')}}</a>
</section>
<div class="features-container">
    <div class="feature-both">
        <div class="feature-image">
            <img class="feature-img" src="{{ asset('img/ico_main1.png') }}" />
        </div>
        <div class="feature-text">
            <h1>{{__('Wyszukiwarka od ')}}<br> {{__('turystów dla turystów')}}</h1>
            <p>{{__('Wyszukiwanie dogodnego miejsca nigdy nie było tak proste! Nowoczesny, prosty i elegancki design sprawia, że znalezienie idealnej oferty to kwestia kilku minut.')}}</p>
        </div>
    </div>
    <div class="feature-both feature-right">
        <div class="feature-image">
            <img class="feature-img" src="{{ asset('img/ico_main2.png') }}" />
        </div>
        <div class="feature-text">
            <h1>{{__('Znajdź swoje ')}}<br> {{__('wymarzone miejsce')}}</h1>
            <p>{{__('Wybierz to, co dla ciebie jest najważniejsze, a my dopasujemy najlepsze miejsca do twoich preferencji, abyś mógł spędzić czas tak jak to zaplanowałeś.')}}</p>
        </div>
    </div>
    <div class="feature-both">
        <div class="feature-image">
            <img class="feature-img" src="{{ asset('img/ico_main3.png') }}" />
        </div>
        <div class="feature-text">
            <h1>{{__('Jak to działa?')}}</h1>
            <p>{{__('Nasz innowacyjny system wyszukiwania ofert sam dopasuje najlepszy nocleg do twoich preferencji. Wszystko co musisz zrobić, to wybrać jak ważne są dla ciebie podane kategorie.')}}</p>
        </div>
    </div>
    <div class="feature-both feature-right">
        <div class="feature-image">
            <img class="feature-img" src="{{ asset('img/ico_main4.png') }}" id="ico_main4" />
        </div>
        <div class="feature-text">
            <h1>{{__('Zajrzyj również tutaj')}}</h1>
            <p>
                <a href="{{url(app()->getLocale()).'/maps?type=bike'}}">{{__('Mapa Stacji Rowerów Miejskich')}}</a><br />
                <a href="{{url(app()->getLocale()).'/maps?type=recreation'}}">{{__('Mapa Terenów Rekreacyjnych')}}</a><br />
                <a href="{{url(app()->getLocale()).'/maps?type=playground'}}">{{__('Mapa Placów Zabaw')}}</a><br />
                <a href="{{url(app()->getLocale()).'/maps?type=dog'}}">{{__('Mapa Wybiegów dla Psów')}}</a><br />
            </p>
        </div>
    </div>
</div>

@endsection