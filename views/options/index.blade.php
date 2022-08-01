@extends('options.layout')
 
@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left" align="left">
                <h2>Respostas</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success" align="center">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Enquete</th>
            <th>Básico</th>
            <th>Intermediário</th>
            <th>Avançado</th>
            <th width="280px">Ações</th>
        </tr>
        @foreach ($options as $option)
        <tr>
           <?php
             $results = DB::select('select title from enquetes 
             where id = :id', ['id' => $option->enquete_id]);
             foreach ($results as $row) {
                 $enqueteName = $row->title;
             }
             $results2 = DB::select('select sum(answer1) as a1, sum(answer2) as a2, 
             sum(answer3) as a3 from options where enquete_id = :id', ['id' => $option->enquete_id]);
             foreach ($results2 as $row2) {
                 $a1 = $row2->a1;
                 $a2 = $row2->a2;
                 $a3 = $row2->a3;
             }
           ?>
            <td>{{ $enqueteName }}</td>
            <td>{{$option->answer1}}</td>
            <td>{{$option->answer2}}</td> 
            <td>{{$option->answer3}}</td>
            <td>
                <form action="{{ route('options.destroy',$option->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('options.edit',$option->id) }}">&nbsp;&nbsp;Editar&nbsp;&nbsp;</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Deseja mesmo deletar?');">&nbsp;&nbsp;Deletar&nbsp;&nbsp;</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
<br>      
@endsection
