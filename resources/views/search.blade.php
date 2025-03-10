@extends('master')

@section('title', 'Szukaj noclegu')

@section('content')

<div class="search-page-whole">
    <section class="home-search search-page-search">
        <div class="search-container-image transition-main-image-search">
            <img src="{{ asset('img/port-low-res.png') }}" data-src="{{ asset('img/port.png') }}" id="main-image">
        </div>
        <div class="search-container">
            @include('searchbar')
        </div>
    </section>

    <section class="search-results-container">
        <div class="search-results-container-inner">
            @foreach ($results as $item)
            @php
                $name = substr($item['nazwa_obiektu'], 0, 30);
            @endphp
                <div class="search-single-listing">
                    <div class="search-single-listing-inner">
                        <div class="listing-image">
                            <img src="{{"https://dev.virtualearth.net/REST/V1/Imagery/Map/Road/".$item['x']."%2C".$item['y']."/15?mapSize=400,300&format=png&key=ArnGjMKK1i1pqfVUfvKGlq33gKNMEgcV5wFmJ3L2QLm65AgaekhL44ZlGvAktUQ_"}}" alt="Bing Map" class="search-img" >
                            <span class="iconify map-pin" data-icon="eva:pin-fill" data-inline="false"></span>
                        </div>
                        <div class="listing-right">
                            <div class="listing-name">
                                <div>
                                    @for ($i = 0; $i < $item['stars']; $i++)
                                        <span class="iconify yellow-star" data-icon="ant-design:star-filled" data-inline="false"></span>
                                    @endfor
                                    @if ($i == 0)
                                        <p class="listing-type">{{ __($item['rodzaj']) }}</p>
                                    @endif
                                </div>
                                <a href="{{ url(app()->getLocale()).'/search/'.$item['_id'] }}">
                                <h3>{{__($name)}}</h3>
                                </a>
                            </div>
                            <div class="listing-features">
                                @if ( array_key_exists('features', $item))
                                    @if ( array_key_exists('high_standard', $item['features']))
                                        <div class="listing-feature feature-standard"><p>{{__('wysoki standard')}}</p></div>
                                    @endif
                                    @if ( array_key_exists('train', $item['features']))
                                        <div class="listing-feature feature-train"><p>{{__('dworzec w pobliżu')}}</p></div>
                                    @endif
                                    @if ( array_key_exists('city_center', $item['features']))
                                        <div class="listing-feature feature-center"><p>{{__('blisko centrum')}}</p></div>
                                    @endif
                                    @if ( array_key_exists('greenery', $item['features']))
                                        <div class="listing-feature feature-greenery"><p>{{__('blisko zieleni')}}</p></div>
                                    @endif
                                    @if ( array_key_exists('lighthouse', $item['features']))
                                        <div class="listing-feature feature-lighthouse"><p>{{__('blisko latarni morskiej')}}</p></div>
                                    @endif
                                @endif
                            </div>
                            <div class="listing-bottom">
                                <div class="listing-bottom-icons">
                                    @if ($item['showOne'][1] == 'sea' || $item['showTwo'][1] == 'sea')
                                        <div>
                                            <span class="iconify" data-icon="fa-solid:umbrella-beach" data-inline="false" id="beach-icon"></span>
                                            <p>{{ $item['from_sea'] }} min {{__('do plaży')}}</p>
                                        </div>
                                    @endif
                                    @if ($item['showOne'][1] == 'bike' || $item['showTwo'][1] == 'bike')
                                        <div>
                                            <span class="iconify" data-icon="cil:bike" data-inline="false"></span>
                                            <p>{{ $item['from_bike'] }} min {{__('do rowerów')}}</p>
                                        </div>
                                    @endif
                                    @if ($item['showOne'][1] == 'park' || $item['showTwo'][1] == 'park')
                                        <div>
                                            <span class="iconify" data-icon="maki:park-11" data-inline="false"></span>
                                            <p>{{ $item['from_park'] }} min {{__('do terenu rekreacyjnego')}}</p>
                                        </div>
                                    @endif
                                    @if ($item['showOne'][1] == 'playground' || $item['showTwo'][1] == 'playground')
                                        <div>
                                            <span class="iconify" data-icon="map:playground" data-inline="false"></span>
                                            <p>{{ $item['from_playground'] }} min {{__('do placu zabaw')}}</p>
                                        </div>
                                    @endif
                                    @if ($item['showOne'][1] == 'dogpark' || $item['showTwo'][1] == 'dogpark')
                                        <div>
                                            <span class="iconify" data-icon="fluent:animal-dog-20-filled" data-inline="false"></span>
                                            <p>{{ $item['from_dogpark'] }} min {{__('do wybiegu dla psów')}}</p>
                                        </div>
                                    @endif
                                    <div class="listing-bottom-icons-dropdown">
                                        <div>
                                            <span class="iconify" data-icon="maki:park-11" data-inline="false"></span>
                                            <p>{{ $item['from_park'] }} min {{__('do terenu rekreacyjnego')}}</p>
                                        </div>
                                        <div>
                                            <span class="iconify" data-icon="map:playground" data-inline="false"></span>
                                            <p>{{ $item['from_playground'] }} min {{__('do placu zabaw')}}</p>
                                        </div>
                                        <div>
                                            <span class="iconify" data-icon="fluent:animal-dog-20-filled" data-inline="false"></span>
                                            <p>{{ $item['from_dogpark'] }} min {{__('do wybiegu dla psów')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url(app()->getLocale()).'/search/'.$item['_id'] }}"><button class="button-secondary">{{__('więcej')}}</button></a>
                            </div>
                        </div>
                        <div class="listing-active-bottom">
                            <p>{{$item['adrespelny'].", ".$item['kod_pocz']." ".$item['miejscowosc']}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($limit != 16)
            <a data-no-swup href={{ add_query_params(['limit' => 2]) }}><button class="button-secondary">{{__('Pokaż mniej trafne rezultaty')}}</button></a>
        @endif
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js" integrity="sha512-cdV6j5t5o24hkSciVrb8Ki6FveC2SgwGfLE31+ZQRHAeSRxYhAQskLkq3dLm8ZcWe1N3vBOEYmmbhzf7NTtFFQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>

@endsection