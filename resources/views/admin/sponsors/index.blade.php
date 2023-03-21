@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row mt-5 gy-4">
            @foreach($sponsors as $sponsor)
            <div class="col-12 col-md-4 ">
                <div class="card">
                    <h4 class="card-header bg-sabbia">
                        {{Str::title($sponsor->name)}}
                    </h4>
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">Scegli questa sponsorizzazione per una durata di: <strong>{{$sponsor->hours}} ore</strong> </p>
                        <a href="{{route('payment.show', [$sponsor->id, $apartment->id])}}" class="btn my-btn-orange text-dark">{{$sponsor->price}} €</a>
                    </div>
                </div>

            </div>
                
            @endforeach

        </div>
       
            
    </div>
    

@endsection
