@extends('adminlte::page')

@section('title', 'Rol')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h5><b>EDITAR ROL</b></h5>
    </div>
</div>
@stop

@section('content')
@if(session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
    <div class="card">
        
        <div class="card-body">
            <!-- Formulario de laravel colective -->
            {!! Form::model($rol, ['route' => ['admin.roles.update', $rol], 'method'=>'put']) !!}
            <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', $rol->name, ['class'=>'form-control']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Permisos', 'Permisos') !!}
                @error('permissions')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                @foreach($permisos as $permiso)
                    <div>
                        <label>
                            {!! Form::checkbox('permissions[]', $permiso->id, null, ['class'=>'mr-1']) !!}
                            {{$permiso->descripcion}}
                        </label>
                    </div>
                @endforeach                
                </div>
                {!! Form::submit('Actualizar Rol', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop