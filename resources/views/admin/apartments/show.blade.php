@extends('layouts.app')

@php
    // Funzione che ritorna il conteggio dei messaggi per ogni appartamento
    function countmessage($listaAppartamenti)
    {
        $counter = 0;
        foreach ($listaAppartamenti as $apartment) {
            $counter += $apartment->messages()->count();
        }
    
        return $counter;
    }
    
@endphp

@section('content')
<div class="container py-3 apartment-show">
    <h1 class="pt-4">{{ $apartment->title }}</h1>

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"">
        <div class="">
            {{-- <button type="button" class="btn bg-azzurro">
                Visualizzazioni <span class="badge bg-turchese ms-2">{{ $apartment->views->count() }}</span>
            </button> --}}
            <div class="text-muted">{{ $apartment->full_address }}</div>
            

        </div>

        {{-- <div>
            @if (session('status') === "success")
            <div class='alert alert-success'>
                {{session('message')}}
            </div>
            @elseif (session('status') === "error")
            <div class='alert alert-danger'>
                {{session('message')}}
            </div>
            @endif
        </div> --}}

        <div class="">
            <a href="{{route("admin.sponsors.index",$apartment->id)}}" class="btn my-btn-sabbia text-dark">
                <i class="fa-solid fa-dollar-sign"></i>
                Sponsorizza
            </a>

            <a href="{{route("admin.apartments.edit",$apartment->id)}}" class="btn my-btn-turchese">
                <i class="fa-regular fa-pen-to-square"></i>
                Modifica
            </a>
                <a href="{{route("admin.messages.index",$apartment->id)}}" class="btn my-btn-orange position-relative">
                <i class="fa-regular fa-envelope"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ countmessage([$apartment]) }}
                </span>
            </a>
        </div>
    </div>

    <div class="apartment-image">
        <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="img-fluid rounded-4" alt="">
    </div>

    <div>
        <h5>Descrizione</h5>
        <p>{{ $apartment->description }}</p>
        <div class="row py-3 gy-4">
            <div class="col-12 col-md-6 col-lg-3">
                <h5>Informazioni</h5>
                <ul class="list-group">
                    <li class="list-group-item">Numero di bagni: <span class="">{{ $apartment->num_bathrooms }}</span>
                    </li>
                    <li class="list-group-item">Numero di letti: <span class="">{{ $apartment->num_beds }}</span></li>
                    <li class="list-group-item">Numero di stanze: <span class="">{{ $apartment->num_rooms }}</span></li>
                    <li class="list-group-item">Metri quadri: <span class="">{{ $apartment->square_meters }} mq</span>
                    </li>

                </ul>
                <ul class="list-group py-2">
                    <li class="list-group-item"> <span class="">{{ $apartment->visibile===1 ? "Visibile" : "Non visibile" }}</span></li>
                </ul>

            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5>Regole</h5>

                <ul class="list-group">
                    @foreach ($apartment->rules as $rule)
                    <li class="list-group-item">
                        <i class="fa-solid {{ $rule->icon }}"></i>
                        <span class=" me-2">
                            {{ $rule->name }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5>Servizi</h5>

                <ul class="list-group">
                    @foreach ($apartment->services as $service)
                    <li class="list-group-item">
                        <i class="fa-solid {{ $service->icon }}"></i>
                        <span class=" me-2">
                            {{ $service->name }}
                        </span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <h5>Sponsorizzazione</h5>

                <ul class="list-group">
                   @foreach ($apartment->sponsors as $sponsor)
                    <li class="list-group-item">
                        <span class=" me-2">
                            {{ Str::title($sponsor->name) }} - {{$sponsor->price}}€
                        </span>
                        <i class="fa-solid "></i>
                    </li>
                    @endforeach
                </ul>
            </div>


        </div>

    </div>
</div>
@endsection