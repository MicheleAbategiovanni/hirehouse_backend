@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6">
      <div class="container-payment-maxwidth">
        <div class="container-payment-empty">
    
        </div>
        <div class="container-payment-form py-3 mt-4">
          <h2> Inserisci un metodo di pagamento </h2>
          <div>Stai acquistando la sponsorizzazione da <strong>{{$sponsor->hours}} h</strong>  al costo di <strong>{{$sponsor->price}}€</strong> per il tuo appartamento <strong>{{$apartment->title}}</strong</div>
          <div id="dropin-container">
    
          </div>
          
          <button type="button" class="btn my-btn-turchese" id="submit-button"> Conferma e attiva la promo </button>
          <form name="form" action="{{route('payment.process')}}" method="post">
            @csrf
            @method('POST')
            <form>
              <div class="form-group">
                <input type="hidden" class="form-control" name="fake-valid-nonce" id="nonce" placeholder="" value="12">
                <input type="hidden" class="form-control" name="sponsor" id="nonce" placeholder="" value="{{$sponsor->id}}">
                <input type="hidden" class="form-control" name="apartment" id="nonce" placeholder="" value="{{$apartment->id}}">
              </div>
        </div>
      </div>

    </div>
  </div>

</div>
  <script type="module">
    var button = document.querySelector('#submit-button');
    braintree.dropin.create({
    authorization: 'sandbox_csftj7wv_m52fv2wvg4mdqvst',
    container: '#dropin-container'
    }, function (err, instance) {
    button.addEventListener('click', function () {
    instance.requestPaymentMethod(function (err, payload) {
    document.querySelector('#nonce').value = payload.nonce;
    form.submit();
    });
    });
    });
  </script>

  @endsection


