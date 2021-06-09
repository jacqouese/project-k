@extends('master')

@section('title', '500')

@section('content')

<section class="single-whole">
    <div class="empty-box">
        <h1>{{__('O nie, tylko nie to!')}}</h1>
        <img src="{{ asset('img/500.svg') }}">
        <h1>500</h1>
        <h2>{{__('Serwer z danymi nie odpowiada')}}</h2>
    </div>
</section>

@endsection