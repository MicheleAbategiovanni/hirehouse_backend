@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-turchese text-white fw-bold text-uppercase text-center">{{ __('Registrazione') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="form-register">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Cognome --}}
                        <div class="mb-4 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Cognome')
                                }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text"
                                    class="form-control @error('surname') is-invalid @enderror" name="surname"
                                    value="{{ old('surname') }}" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Data di nascita --}}
                        <div class="mb-4 row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Data di
                                nascita')
                                }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" value="{{ old('date_of_birth') }}" autofocus>

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                                }}*</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
                                }}*</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class=" form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" minlength="8">
                                    <div class="invalid-feedback">
                                        le password non sono uguali
                                      </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm
                                Password') }}*</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                                    <div class="invalid-feedback">
                                        le password non sono uguali
                                      </div>
                            </div>
                        </div>

                        {{-- Immagine del profilo --}}
                        <div class="mb-4 row">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Scegli l'immagine del Profilo</label>

                            <div class="col-md-6">

                                <div class="input-group mb-3">
                                    <input type="file" class="form-control @error(" profile_image") is-invalid @enderror"
                                        name="profile_image">
    
                                    @error('profile_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn my-btn-turchese">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let passwordInput=document.querySelector("#password");
    let confirmPasswordInput=document.querySelector("#password-confirm");
    let formRegister=document.querySelector("#form-register");
    console.log(passwordInput,confirmPasswordInput,formRegister)
    formRegister.addEventListener("submit",function(e){
        e.preventDefault();
        if(passwordInput.value===confirmPasswordInput.value){
            formRegister.submit();
        }else{
            passwordInput.classList.add("is-invalid");
            confirmPasswordInput.classList.add("is-invalid");


        }

    })
</script>
@endsection