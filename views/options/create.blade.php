@extends('options.layout')
  
@section('content')

<?php
   $enqueteId = Request::segment(2);
   $results = DB::select('select title from enquetes where id = :id', ['id' => $enqueteId]);
   foreach ($results as $row) {
        $enqueteName = $row->title;
   }
?>
<br>
<div class="row" align="left"> 
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Conhecimento em relação a enquete <strong>{{$enqueteName}}</strong></h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('enquetes.index') }}">Back</a>
        </div>
    </div>
</div>
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
<form action="{{ route('options.store') }}" method="POST">
    @csrf
    <input type="hidden"  name="enquete_id" value="{{$enqueteId}}">
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
          <br>
          <input type="radio" name="answers" value="basico">&nbsp;<strong>Básico</strong> <br/><br>
          <input type="radio" name="answers" value="intermediario">&nbsp;<strong>Intermediário</strong><br><br>
          <input type="radio" name="answers" value="avancado">&nbsp;<strong>Avançado</strong><br>
          <br>
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
@endsection