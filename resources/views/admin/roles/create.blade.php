@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>NUEVO ROL</b></h4>
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
            {!! Form::open(['route'=>'admin.roles.store']) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', null, ['class'=>'form-control']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Permisos', 'Permisos') !!}
                @foreach($permisos as $permiso)
                    <div>
                        <label>
                            {!! Form::checkbox('permisos[]', $permiso->id, null, ['class'=>'mr-1']) !!}
                            {{$permiso->descripcion}}
                        </label>
                    </div>
                @endforeach
                @error('Permisos')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                {!! Form::submit('Registrar Rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
