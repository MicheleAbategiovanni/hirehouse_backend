@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <form method="POST" action="{{ route('admin.apartments.store') }}" class="row g-3 needs-validation"
        enctype="multipart/form-data" novalidate>
        @csrf

        {{-- Titolo --}}
        <div class="col-md-6">
            <label for="inputTitle" class="form-label ">Nome Immobile*</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="inputTitle" name="title"
                required minlength="8">
            <div class="invalid-feedback">
                Il campo è obbligatorio e deve avere almeno 8 caratteri
            </div>

            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Immagine --}}
        <div class="col-md-3">
            <label for="cover_img" class="form-label">Immagine appartamento</label>
            <input type="file" class="form-control @error('cover_img') is-invalid @enderror" name="cover_img">

            @error('cover_img')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Prezzo --}}
        <div class="col-md-3">
            <label for="inputPrice" class="form-label">Prezzo*</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="inputPrice" name="price"
                required step=".01">
            <div class="invalid-feedback">
                Il campo è obbligatorio
            </div>

            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Indirizzo --}}
        <div class="col-12">
            <label for="inputAddress" class="form-label">Indirizzo*</label>
            <input type="text" class="form-control @error('full_address') is-invalid @enderror" id="inputAddress"
                placeholder="1234 Main St" name="full_address" required>
            <div class="invalid-feedback">
                Il campo è obbligatorio
            </div>

            @error('full_address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Descrizione --}}
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control @error('description') is-invalid @enderror"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                    name="description"></textarea>

                <label for="floatingTextarea2">Descrizione</label>


                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        {{-- Numero stanze --}}
        <div class="col-md-3">
            <label for="inputRomms" class="form-label">Numero stanze</label>
            <input type="number" class="form-control @error('num_rooms') is-invalid @enderror" id="inputRooms"
                name="num_rooms" min="0">
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_rooms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Numero bagni --}}
        <div class="col-md-3">
            <label for="inputBathrooms" class="form-label">Numero bagni</label>
            <input type="number" class="form-control @error('num_bathrooms') is-invalid @enderror" id="inputBathrooms"
                name="num_bathrooms" min="0">
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_bathrooms')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Numero letti --}}
        <div class="col-md-3">
            <label for="inputBeds" class="form-label">Numero letti</label>
            <input type="number" class="form-control @error('num_beds') is-invalid @enderror" id="inputBeds"
                name="num_beds" min="0">
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('num_beds')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Metri quadri --}}
        <div class="col-md-3">
            <label for="inputSquareMeters" class="form-label">Metri quadri</label>
            <input type="number" class="form-control @error('square_meters') is-invalid @enderror"
                id="inputSquareMeters" name="square_meters" min="0">
            <div class="invalid-feedback">
                Il numero deve essere maggiore di 0
            </div>

            @error('square_meters')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Check-in --}}
        <div class="col-md-3">
            <label for="inputPassword4" class="form-label">Check-in</label>
            <input type="time" class="form-control @error('check_in') is-invalid @enderror" id="inputPassword4"
                placeholder="10:00" name="check_in">

            @error('check_in')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Check-out --}}
        <div class="col-md-3">
            <label for="inputPassword4" class="form-label">Check-out</label>
            <input type="time" class="form-control @error('check_out') is-invalid @enderror" id="inputPassword4"
                placeholder="18:00" name="check_out">

            @error('check_out')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- Vuota --}}
        <div class="col-md-6">

        </div>

        {{-- Visibilità --}}
        <div class="col-md-3">
            <div class="form-switch">
                <input type="hidden" name="visibile" value="0">
                <input type="checkbox" class="form-check-input" value="1" name="visibile">
                <label class="form-check-label" for="gridCheck"> Visibilità </label>

                @error('visibile')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="col-md-12">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Regole
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            @foreach ($rules as $rule)
                            <div class="form-check form-check @error('rules') is-invalid @enderror">

                                <input class="form-check-input @error('rules') is-invalid @enderror" type="checkbox"
                                    id="ruleCheckbox_{{ $loop->index }}" value="{{ $rule->id }}" name="rules[]" {{
                                    in_array($rule->id, old('rules', [])) ? 'checked' : '' }}>

                                <i class="fa-solid {{ $rule->icon }}"></i>
                                <label class="form-check-label" for="ruleCheckbox_{{ $loop->index }}">{{ $rule->name
                                    }}</label>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <span id="textServices"> Servizi*</span> <span class="d-none text-danger"
                                id="errorServices">Seleziona almeno un servizio</span>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @foreach ($services as $service)
                            <div class="form-check form-check @error('services') is-invalid @enderror">

                                <input class="form-check-input servicesCheck @error('services') is-invalid @enderror"
                                    type="checkbox" id="servicesCheckbox_{{ $loop->index }}" value="{{ $service->id }}"
                                    name="services[]" {{ in_array($service->id, old('services', [])) ? 'checked' : ''
                                }}>

                                <i class="fa-solid {{ $service->icon }}"></i>
                                <label class="form-check-label" for="servicesCheckbox_{{ $loop->index }}">{{
                                    $service->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-12">
            <button class="btn btn-primary">Pubblica</button>
        </div>

    </form>

</div>


{{-- @vite(['resources/js/app.js']) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js"></script>
<script>
    let inputAddress = document.getElementById('inputAddress');
    inputAddress.addEventListener("input", function(event) {
        console.log(inputAddress.value);
    
        
        axios
                .get(`https://api.tomtom.com/search/2/geocode/${inputAddress.value}.json?key=6hakT8QU7IRSx9PCHGi5JyHTV2S7xWlD`)
                .then(function (response) {
                console.log(response)
                })
                
    })

    
        const forms = document.querySelectorAll('.needs-validation')
        let erroreMess=document.querySelector("#errorServices")
        let textServ=document.querySelector("#textServices")



        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                let servicesList = [];
                Array.from(document.querySelectorAll(".servicesCheck")).forEach(function(inp) {
                    if (inp.checked === true) {
                        servicesList.push(inp)
                    }
                });
                if(servicesList.length===0){
                    event.preventDefault()
                    event.stopPropagation()
                    erroreMess.classList.remove("d-none")
                    textServ.classList.add("d-none")
                }

                form.classList.add('was-validated')
            }, false)
        })
</script>
@endsection