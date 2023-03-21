@extends('layouts.app')

@section ('content')

<div class="container">
    <h3 class="mt-5">MESSAGGI</h3>
    <div><strong>{{$apartment->title}}</strong></div>

    <div class="row d-md-none pt-3">
      @foreach($messages as $message)
      <div class="col py-2">
        <div class="toast d-block" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header justify-content-between">
            <div>
              <strong class="me-auto text-dark">{{$message->name}}</strong>
              <div class="text-muted">{{$message->email}}</div>
            </div>

            <div class="d-flex align-items-center">
              <small>{{date("d/m/Y",strtotime($message->created_at))}}</small>
  
              <form method="POST" class="form" action="{{route("admin.messages.delete",$message->id)}}">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger m-2"><i class="fa-regular fa-trash-can"></i></button>
              </form>
            </div>
          </div>

          <div class="toast-body">
            {{$message->content}}
          </div>
        </div>
        
      </div>
      @endforeach
    </div>
    <table class="table d-none d-md-table table-striped mt-5">
        <thead>
          <tr>
            <th scope="col"></th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Contenuto</th>
            <th scope="col">Inviato il</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                
            <tr>
                <th scope="row"></th>
                <td>{{$message->name}}</td>
                <td>{{$message->email}}</td>
                <td>{{$message->content}}</td>
                <td>{{date("d/m/Y",strtotime($message->created_at))}}</td>
                <td>
                  <form method="POST" class="form" action="{{route("admin.messages.delete",$message->id)}}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                      Cancella
                    </button>
                  </form>
                 
                </td>
            </tr>
            
            
            @endforeach
        </tbody>
      </table>

</div>

<script>
  let form = document.querySelectorAll(".form");
  form.forEach((formDelete) => {
      formDelete.addEventListener("submit", function(e) {
          e.preventDefault();
          const conferma = confirm("Vuoi cancellare questo messaggio?");

          if (conferma === true) {
              formDelete.submit();
          }


      })

  })
</script>

@endsection