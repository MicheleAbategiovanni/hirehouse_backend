@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron pt-5 mt-5 d-md-flex align-items-center gap-4">
            <h1 class="display-5 fw-bold ps-2 pt-2 d-lg-inline"> Benvenuto in </h1>
            <div class="logo_laravel d-lg-inline">
                <img src="{{ asset('storage/logo-bianco.png') }}" class="img-fluid "alt="">
            </div>
        </div>
            <div class="content ps-2 mt-5">
                <p class="h4">Ciao! <br>
                    benvenuto su <strong class="text-turchese">HireHouse</strong>, <br> 
                    un nuovo sito che ti permetterà di gestire con pochi click i tuoi immobili in maniera pratica e veloce. 
                </p>
                <a href="{{ route('register') }}" class="btn my-btn-turchese my-4">Registrati subito!</a> 
            </div>
    </div>


@endsection
