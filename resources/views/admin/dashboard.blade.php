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
    <div class="container user-dashboard pb-3">
       

        <div class="row mt-5 flex-column-reverse flex-lg-row">
            {{-- Lista appartamenti --}}
            <div class="col-lg-8 col-12">

                <a href="{{ route('admin.apartments.create') }}" class="btn my-btn-turchese mb-5">
                    <i class="fa-solid fa-plus"></i>
                    Aggiungi appartamento
                </a>

                <h5 class="fw-bold">I TUOI ANNUNCI:</h5>

                <div class="row mt-4 gap-4">
                    @foreach ($apartments as $apartment)
                    <div class="col-12 col-sm-5">
                        <div class="card p-0 positision-relative h-100"  >
                            <div class="img-container rounded-4">
                                <img src="{{ asset('storage/' . $apartment->cover_img) }}" class="card-img-top overflow-hidden" alt="...">
                            </div>

                            <a href="{{route("admin.messages.index",$apartment->id)}}" class="btn my-btn-orange position-absolute message-span">
                                <i class="fa-regular fa-envelope"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{ countmessage([$apartment]) }}
                                </span>
                            </a>

                            <div class="card-body">
                                {{-- {{ $apartment->title . ' #' . $apartment->id }} --}}
                                <h5 class="card-title">{{ $apartment->title}}</h5>
                                <p class="card-text">{{Str::limit($apartment->description, 100, ' ...')}}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Prezzo: {{ $apartment->price }},00 €</li>
                                <label class="list-group-item "> {{$apartment->visibile ? "Visibile" : "Non visibile"}} </label>
                            </ul>

                            <div class="p-3">
                                <a href="{{ route('admin.apartments.show', $apartment->id) }}" class="btn-sm btn my-btn-sabbia d-block m-auto">
                                    Maggiori informazioni
                                </a>

                                <div class="d-grid gap-2 d-md-flex justify-content-lg-end pt-2">
                                    <a href="{{ route('admin.apartments.edit', $apartment->id) }}" class="btn-sm btn my-btn-turchese me-md-2">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                        Modifica
                                    </a>
                                    <form class="form  " method="post" action="{{ route('admin.apartments.destroy', $apartment->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn-sm btn btn-danger">
                                            <i class="fa-regular fa-trash-can"></i>
                                            Cancella
                                        </button>
                                        <div class="position-absolute" style="z-index:1500">
                                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                                <div class="toast-body">
                                                  Sei sicuro di voler cancellare questo elemento
                                                  <div class="mt-2 pt-2 border-top">
                                                    <button type="button" class="btn btn-primary btn-sm btn-confirm">Elimina</button>
                                                    <button type="button" class="btn btn-secondary btn-sm btn-go-back" data-bs-dismiss="toast">Annulla</button>
                                                  </div>
                                                </div>
                                              </div>
                                
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- Informazioni utente --}}
            <div class="col-md-4 col-12">

                <div class="container-account-card my-3">
                    <div class="row d-flex align-items-center h-100">
                        <div class="col col-md-9 col-lg-7 col-xl-5">
                            <div class="card background-image-profile " style="border-radius: 15px;">
                                <div class="card-body p-4">
                                    <div class="d-flex text-black">
                                        <div class="flex-shrink-0 d-none d-sm-block">
                                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Generic placeholder image" class="img-fluid"
                                                style="width: 180px; border-radius: 10px;">
                                        </div>
                                        <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-center">
                                            <h4 class="mb-1">{{ Auth::user()->name . ' ' . Auth::user()->surname }}</h4>
                                            <p class="mb-2 pb-1" style="color: #2b2a2a;">{{ Auth::user()->email }}</p>
                                            <div class="d-flex justify-content-start rounded-3 py-2" style="background-color: turchese;">
                                                <div>
                                                    <p class="small text-muted mb-1">Appartamenti</p>
                                                    <p class="mb-0">{{ Auth::user()->apartments()->count() }}</p>
                                                </div>
                                                <div class="px-3">
                                                    <p class="small text-muted mb-1">Messaggi</p>
                                                    <p class="mb-0">{{ countmessage($apartments) }}</p>
                                                </div>
                                            </div>
                                            {{-- <div class="d-flex pt-1">
                                                <button type="button"
                                                    class="btn my-btn-outline-sabbia me-1 flex-grow-1">Chat</button>
                                                <button type="button"
                                                    class="btn my-btn-sabbia flex-grow-1">STATISTICHE</button>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let form = document.querySelectorAll(".form");
       
        

        form.forEach((formDelete) => {
            formDelete.addEventListener("submit", function(e) {
                e.preventDefault();
                console.log(e.target);
                let formClicked=e.target;
                const toastHTML=formClicked.querySelector(".toast");
                const btnConfirm=formClicked.querySelector(".btn-confirm");
                const btnGoBack=formClicked.querySelector(".btn-go-back");               
                toastHTML.classList.add("d-block");
                btnConfirm.addEventListener("click",()=>{
                    formDelete.submit();
                    toastHTML.classList.toggle("d-block");
                })
                btnGoBack.addEventListener("click",()=>{
                    toastHTML.classList.toggle("d-block");
                })
                


                

                
            })
        })

        
        
    </script>
@endsection
