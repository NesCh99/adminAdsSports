@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>NUEVO ADMINISTRADOR</b></h4>
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
            <!-- Formulario de laravel colective -->
            {!! Form::model($administrador, ['route' => ['admin.administradores.update', $administrador], 'method'=>'put']) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', $administrador->NombreAdm, ['class'=>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('Email', 'Correo Electrónico') !!}
                {!! Form::text('Email', $administrador->email, ['class'=>'form-control', 'readonly']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('Rol', 'Rol') !!}
                {!! Form::select('roles', $roles, null, ['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Actualizar Administrador', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
