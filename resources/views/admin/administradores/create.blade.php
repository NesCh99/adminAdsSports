@extends('adminlte::page')

@section('title', 'Administrador')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>NUEVO ADMINISTRADOR</b></h4>
    </div>
</div>
@stop
@if(session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario de laravel colective -->
            {!! Form::open(['route'=>'admin.administradores.store']) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', null, ['class'=>'form-control']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Email', 'Correo Electrónico') !!}
                {!! Form::text('Email', null, ['class'=>'form-control']) !!}
                @error('Email')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Fecha', 'Fecha de Caducidad') !!}
                {{ Form::date('Fecha', null, ['class' => 'form-control']) }}
                @error('Fecha')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Rol', 'Rol') !!}
                {!! Form::select('Rol', $roles, null, ['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Registrar Administrador', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
