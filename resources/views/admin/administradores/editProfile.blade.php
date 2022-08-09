@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>ACTUALIZAR PERFIL</b></h4>
    </div>
</div>
@stop
@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('error')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@section('content')
<div class="card">
    <div class="row">
        <div class="col-md-6">
        
            <div class="card-body">
            <div class="card-header bg-light mb-3"><h5><strong>Informacion</strong></h5></div>
            <!-- Formulario de laravel colective -->
            {!! Form::model($administrador, ['route' => ['admin.administradores.updateProfile', $administrador], 'method'=>'put']) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', $administrador->NombreAdm, ['class'=>'form-control']) !!}
                @error('Nombre')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Email', 'Correo Electrónico') !!}
                {!! Form::text('Email', $administrador->email, ['class'=>'form-control']) !!}
                @error('Email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                {!! Form::submit('Actualizar Perfil', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
            </div>    
        </div>
        
        <div class="col-md-6">
        
            <div class="card-body">
            <div class="card-header bg-light mb-3"><h5><strong>Contraseña</strong></h5></div>
            {!! Form::open(['route'=>'admin.administradores.updatePassword']) !!}
                <div class="form-group">
                <div class="col">
                {!! Form::label('Contraseña', 'Antigua Contraseña') !!}
                </div>
                <div class="col">
                {!! Form::password('old_password',['class'=>'form-control']) !!}
                </div>
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                <div class="col">
                {!! Form::label('Nueva', 'Nueva Contraseña') !!}
                </div>
                <div class="col">
                {!! Form::password('password', ['class'=>'form-control']) !!}
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                </div>
                <div class="form-group">
                    <div class="col">
                    {!! Form::label('Confirmar', 'Confirmar Nueva Contraseña') !!}
                    </div>
                    <div class="col">
                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="col">
                    {!! Form::submit('Actualizar Contraseña', ['class'=>'btn btn-primary']) !!}
                </div>
            {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
