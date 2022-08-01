@extends('enquetes.layout')
  
@section('content')

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

<br>
<div class="row" align="left">
    <div class="col-xs-12 col-sm-12 col-md-12">    
          <h2>Criar Enquete</h2>
          <a class="btn btn-primary" href="{{ route('enquetes.index') }}">Back</a>
     </div>
</div>
<br>   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('enquetes.store') }}" method="POST">
    @csrf  
     <div class="row" align="left">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Título:</strong>
                <input type="text" name="title" class="form-control" placeholder="Título">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
             <label for="name"><strong>Início:</strong></label>
             <input id="datepicker" name="start" width="250" required />
             <script>
                $('#datepicker').datepicker({
                  uiLibrary: 'bootstrap4',
                  format: 'yyyy-mm-dd'
                });
             </script>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
             <label for="name"><strong>Término:</strong></label>
             <input id="datepicker2" name="end" width="250" required />
             <script>
                $('#datepicker2').datepicker({
                  uiLibrary: 'bootstrap4',
                  format: 'yyyy-mm-dd'
                });
             </script>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection