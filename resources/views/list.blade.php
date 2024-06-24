@extends('layouts.main')
@section('title', 'IntelliCard')

@php
    $decklink = true;
    $homelink = false;
@endphp

@section('content')
    <div></div>
    <div class="dashboard-title">
        <h1>Decks</h1>
        <div>            
            <div class="cards-list">
            @foreach($decks as $deck)
                <div class="card 1">
                  <div class="card_image"> <img src="https://i.redd.it/b3esnz5ra34y.jpg" /> 
                    <button onclick="window.location.href='/list/deck/{{$deck->id}}'" class="btn btn-primary" style="position: absolute; height: 35px; width: 40px ; z-index: 1000; left: 0px; border-radius: 10px; background-color: #040721">
                        <img src="{{ asset('icons/edit.png') }}" alt="delete" style="height: 25px; width: 25px; padding-right: 8px;">
                    </button>
                </div>
                  <div class="card_title title-white">
                    <p>{{ $deck->name }}</p>
                  </div>
                </div>
            @endforeach
            <div class="card 1">
                <div class="card_image"><img src="https://i.redd.it/b3esnz5ra34y.jpg" /></div>
                <div class="card_title title-white">
                  <p>Sem Título</p>
                </div>
              </div>
            </div>
        </div>
        <div></div>
    </div>
@endsection


