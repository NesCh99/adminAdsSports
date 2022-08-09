@extends('adminlte::page')

@section('title', 'Videos')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h5><b>TRANSMISION EN VIVO</b></h5>
    </div>
</div>
@stop
@if(session('info'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@section('content')
<div class="card">
    <div class="card-body">  
    <strong>TRANSMISION EN VIVO</strong>
    {!! Form::open(['route'=>'admin.videos.storeLiveStream']) !!}
        <div class="form-group">
        {!! Form::label('Nombre', 'Nombre de la Transmisión en Vivo') !!}
        {!! Form::hidden('idVideo', $video->idVideo, ['class'=>'form-control']) !!}
        {!! Form::text('Nombre', $video->NombreVid, ['class'=>'form-control', 'readonly']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('record', 'Grabar') !!}
        {!! Form::select('record', ['true' => 'Si', 'false' => 'No'], ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
        {!! Form::label('player', 'PlayerID') !!}
        {!! Form::text('PlayerID', 'pt3Wfux4rAA7iJh4QlMCYJRr', ['class'=>'form-control', 'readonly']) !!}
        </div>
        {!! Form::submit('Crear Transmision en Vivo', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
    </div>
</div>
@stop
