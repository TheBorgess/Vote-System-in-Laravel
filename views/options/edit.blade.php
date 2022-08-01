@extends('options.layout')
   
@section('content')
    <br>
    <?php
       $results = DB::select('select id,title from enquetes where id = :id', 
                  ['id' => $option->enquete_id]);
        foreach ($results as $row) {
            $enqueteId   = $row->id;
            $enqueteName = $row->title;
        }
     ?> 
    <div class="row" align="left"> 
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Respostas da Enquete <strong><?php echo $enqueteName?></strong></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('options.index') }}"> Back</a>
            </div>
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
    <form action="{{ route('options.update',$option->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row" align="left">
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <input type="radio" name="answers" value="basico" {{ $option->answer1 == "1" ? "checked" : "" }}>&nbsp;<strong>Básico</strong><br><br> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">      
                <input type="radio" name="answers" value="intermediario" {{ $option->answer2 == "1" ? "checked" : "" }}>&nbsp;<strong>Intermediário</strong><br><br>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <input type="radio" name="answers" value="avancado" {{ $option->answer3 == "1" ? "checked" : "" }}>&nbsp;<strong>Avançado</strong><br><br>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection