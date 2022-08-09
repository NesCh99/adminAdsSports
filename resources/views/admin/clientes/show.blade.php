@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h1><b>{{$cliente->NombreCli}}</b></h1>
                <h5><b>{{$cliente->email}}</b></h5>
            </div>
        </div>
    </div>
</div>
@stop

@section('content')
@if(session('info'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <div class="title">
            <h5><strong>Videos Disponibles para Suscribir</strong></h5>
        </div>
    </div>   
    <div class="card-body">
        @if(is_null($videos))
            <div class="card-body">
                <p>Ningun video disponible</p>
            </div>
        @else
            <table class="table table-stripe" id="videos">
                <thead class="thead">
                    <tr>
                        <th>VIDEO</th>    
                        <th>CAMPEONATO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($videos as $video)
                        <tr>
                            <td>{{$video->NombreVid}}</td>
                            <td>{{$video->campeonato->NombreCam}}</td>
                            <td>
                            {!! Form::model($video, ['route' => ['admin.clientes.subscribeVideo', $cliente, $video], 'method'=>'put', 'id' => 'formSuscribirVideo'.$video->idVideo]) !!}
                            <button type="submit" onclick="suscribir()" class="btn btn-outline-success"><i class="fa fa-gift"></i> Suscribir</button>
                            {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="title">
            <h5><strong>Lista de Suscripciones Entregadas</strong></h5>
        </div>
    </div>      
    <div class="card-body">
        @if(is_null($suscripcionesVideos))
            <div class="card-body">
            <p>No posee suscripciones</p>
            </div>
        @else
            <table class="table table-stripe" id="suscripciones">
                <thead class="thead">
                    <tr>
                        <th>VIDEO</th>    
                        <th>CAMPEONATO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($suscripcionesVideos as $video)
                        <tr>
                            <td>{{$video->NombreVid}}</td>
                            <td>{{$video->campeonato->NombreCam}}</td>
                            <td>
                            {!! Form::model($video, ['route' => ['admin.clientes.unsubscribeVideo', $cliente, $video], 'method'=>'put', 'id' => 'formDesuscribirVideo', 'name' => 'formDesuscribirVideo']) !!}
                                <button type="submit" onclick="desuscribir()" class="btn btn-outline-danger"><i class="fa fa-minus"></i> Desuscribir</button>
                            {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        @endif  
    </div>
</div>
@stop
@section('css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<script>
var id = <?php json_encode($video->idVideo) ?>;
function suscribir(){
    event.preventDefault();
    $.confirm({
        title: 'Confirmar Suscripción',
        content: '¿Seguro de regalar suscripción?',
        buttons: {
            Confirmar: function () {
                $('#formSuscribirVideo'+id).submit();
            },
            Cancelar: function () {
                $.alert('Cancelado!');
            }
        }
    });
};

function desuscribir(){
    event.preventDefault();
    $.confirm({
        title: 'Confirmar Acción',
        content: '¿Seguro de quitar suscripción?',
        buttons: {
            Confirmar: function () {
                $('#formDesuscribirVideo'+id).submit();
            },
            Cancelar: function () {
                $.alert('Cancelado!');
            }
        }
    });
};
</script>

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        $('#suscripciones').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
    $(document).ready(function () {
        $('#videos').DataTable({
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
</script>
@endsection