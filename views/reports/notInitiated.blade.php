@extends('reports.layout')
 
@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb" align="left">
            <div class="pull-left">
                <h2>Relatório de Enquetes Não Iniciadas</h2>
            </div>
        </div>
        <div class="col-lg-12 margin-tb">    
            <div class="pull-right">
               <a class="btn btn-primary" href="/expireds">Finalizadas</a>&nbsp;  
               <a class="btn btn-primary" href="/inProgress">Em andamento</a>&nbsp;
               <a class="btn btn-primary" href="/notInitiated">Não Iniciadas</a>&nbsp;    
            </div>      
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <br>
    <table class="table table-bordered">
        <tr>
            <th>Enquete</th>
            <th>Básico</th>
            <th>Intermediário</th>
            <th>Avançado</th>
            <th>Início</th>
            <th>Término</th>
        </tr>
        @foreach ($reports as $report)
        <tr>
           <?php
             $results = DB::select('select sum(answer1) as a1, sum(answer2) as a2, 
             sum(answer3) as a3 from options where enquete_id = :id', ['id' => $report->id]);
             foreach ($results as $row) {
                 $a1 = $row->a1;
                 $a2 = $row->a2;
                 $a3 = $row->a3;
             }
           ?>
            <td>{{$report->title}}</td>
            <td>{{$a1 == null ? "sem votos" : $a1}}</td>
            <td>{{$a2 == null ? "sem votos" : $a2}}</td> 
            <td>{{$a3 == null ? "sem votos" : $a3}}</td>
            <td><?php $dateStart = new DateTime($report->start); 
                      echo $dateStart->format('d-m-Y');?></td>
            <td><?php $dateEnd = new DateTime($report->end); 
                      echo $dateEnd->format('d-m-Y');?></td>
        </tr>
        @endforeach
    </table>
  
      
@endsection
