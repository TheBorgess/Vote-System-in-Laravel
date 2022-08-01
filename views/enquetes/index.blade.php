@extends('enquetes.layout')
 
@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" align="left">
                <h2>Enquetes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('enquetes.create') }}"> Criar Nova Enquete</a>
            </div>
        </div>
    </div>
    <br>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" align="center">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>Título</th>
            <th>Início</th>
            <th>Término</th>
            <th width="290px">Ações</th>
        </tr>
        @foreach ($enquetes as $enquete)
        <tr>
            <td>{{ $enquete->title }}</td>
            <td><?php $dateStart = new DateTime($enquete->start); 
                      echo $dateStart->format('d-m-Y');?>
            </td>
            <td><?php $dateEnd = new DateTime($enquete->end); 
                      echo $dateEnd->format('d-m-Y');?>
            </td>
            <td>
                <form action="{{ route('enquetes.destroy',$enquete->id) }}" method="POST">
                <?php
                    $dt_atual		= date("Y-m-d"); // data atual
                    $timestamp_dt_atual 	= strtotime($dt_atual); // converte para timestamp
 
                    $dt_expira		= $enquete->end;// data de expiração da enquete
                    $timestamp_dt_expira	= strtotime($dt_expira); // converte para timestamp
 
                    // data atual é maior que a data de expiração
                    if ($timestamp_dt_atual > $timestamp_dt_expira){ // true 
                ?>
                       <a class='btn btn-warning' href='#'>Expirou</a>
            <?php   } else { // false ?>
                       <a class='btn btn-info' href='voteEnquetes/{{$enquete->id}}'>Votar</a>
            <?php   } ?>     
                    <a class="btn btn-primary" href="{{ route('enquetes.edit',$enquete->id) }}">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja mesmo deletar?');">Deletar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
<br>      
@endsection
