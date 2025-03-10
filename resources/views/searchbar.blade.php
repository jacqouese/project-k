<form action="{{route('search', app()->getLocale())}}" method="get" data-swup-form>
    <div class="searchbar">
        <div class="searchbar-filter">
            <div class="filter-icon"><span class="iconify" data-icon="fa-solid:umbrella-beach" data-inline="false" id="beach-icon"></span></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Plaża')}}</p>
                <p class="filter-value filter-end-value">{{__('bez znaczenia')}}</p>
            </div>
            <div class="filter-dropdown">
                <p class="slider-p">{{__('bardzo ważne')}}</p>
                <div class="outer-slider">
                    <div class="range-slider">
                        <input class="input-range search-input" type="range" step="1" value="0" min="1" max="50" name="sea">
                    </div>
                    <span class="range-value"></span>
                </div>
                <p class="slider-p">{{__('bez znaczenia')}}</p>
            </div>
        </div>
        <div class="searchbar-filter">
            <div class="filter-icon"><span class="iconify" data-icon="cil:bike" data-inline="false"></span></i></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Rowery Miejskie')}}</p>
                <p class="filter-value filter-end-value">{{__('bez znaczenia')}}</p>
            </div>
            <div class="filter-dropdown">
                <p class="slider-p">{{__('bardzo ważne')}}</p>
                <div class="outer-slider">
                    <div class="range-slider">
                        <input class="input-range search-input" type="range" step="1" value="0" min="1" max="50" name="bike">
                    </div>
                    <span class="range-value"></span>
                </div>
                <p class="slider-p">{{__('bez znaczenia')}}</p>
            </div>
        </div>
        <div class="searchbar-filter">
            <div class="filter-icon"><span class="iconify" data-icon="maki:park-11" data-inline="false"></span></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Tereny rekreacyjne')}}</p>
                <p class="filter-value filter-end-value">{{__('bez znaczenia')}}</p>
            </div>
            <div class="filter-dropdown">
                <p class="slider-p">{{__('bardzo ważne')}}</p>
                <div class="outer-slider">
                    <div class="range-slider">
                        <input class="input-range search-input" type="range" step="1" value="0" min="1" max="50" name="park">
                    </div>
                    <span class="range-value"></span>
                </div>
                <p class="slider-p">{{__('bez znaczenia')}}</p>
            </div>
        </div>
        <div class="searchbar-filter">
            <div class="filter-icon"><span class="iconify" data-icon="map:playground" data-inline="false"></span></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Place zabaw')}}</p>
                <p class="filter-value filter-end-value">{{__('bez znaczenia')}}</p>
            </div>
            <div class="filter-dropdown">
                <p class="slider-p">{{__('bardzo ważne')}}</p>
                <div class="outer-slider">
                    <div class="range-slider">
                        <input class="input-range search-input" type="range" step="1" value="0" min="1" max="50" name="playground">
                    </div>
                    <span class="range-value"></span>
                </div>
                <p class="slider-p">{{__('bez znaczenia')}}</p>
            </div>
        </div>
        <div class="searchbar-filter">
            <div class="filter-icon"><span class="iconify" data-icon="fluent:animal-dog-20-filled" data-inline="false"></span></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Wybiegi dla psów')}}</p>
                <p class="filter-value filter-end-value">{{__('bez znaczenia')}}</p>
            </div>
            <div class="filter-dropdown">
                <p class="slider-p">{{__('bardzo ważne')}}</p>
                <div class="outer-slider">
                    <div class="range-slider">
                        <input class="input-range search-input" type="range" step="1" value="0" min="1" max="50" name="dogpark">
                    </div>
                    <span class="range-value"></span>
                </div>
                <p class="slider-p">{{__('bez znaczenia')}}</p>
            </div>
        </div>
        <div class="searchbar-standard">
            <div class="filter-icon"><span class="iconify" data-icon="clarity:star-solid" data-inline="false"></span></div>
            <div class="filter-text">
                <p class="filter-label">{{__('Rodzaj')}}</p>
                <p chosen="{{__('wybrano')}}" class="filter-value filter-end-value filter-end-value-s">{{__('dowolny')}}</p>
            </div>
            <div class="filter-dropdown-standard">
                <div>
                    <span><input type="checkbox" name="hotel" class="standard-checkbox"> Hotel</span>
                    <span><input type="checkbox" name="san" class="standard-checkbox"> Sanatorium</span>
                    <span><input type="checkbox" name="room" class="standard-checkbox"> {{__('Pokoje gościnne')}}</span>
                    <div class="slider-translations" one="{{__('bez znaczenia')}}" two="{{__('mniej ważne')}}" three="{{__('ważne')}}" four="{{__('bardzo ważne')}}"></div>
                </div>
            </div>
        </div>
        <button class="searchbar-button button-primary"><span class="iconify" data-icon="ant-design:search-outlined" data-inline="false" id="search-iconify"></span>&nbsp;&nbsp;&nbsp;&nbsp;{{__('szukaj')}}</button>
    </div>
</form>

<script src="{{ asset('js/rangeSlider.js?version=3') }}"></script>