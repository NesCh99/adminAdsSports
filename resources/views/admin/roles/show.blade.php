@extends('adminlte::page')

@section('title', 'Rol')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-10">
                <h5><b>ID: </b> {{$rol->id}}</h5>
                <h1><b>{{$rol->name}}</b></h1>
            </div>
            @can('admin.roles.edit')
            <div class="col-md-2 ">
                <a class="btn btn-light" href="{{url('/admin/roles/'.$rol->id.'/edit')}}">Editar</a>  
            </div>
            @endcan
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
    <div class="card-body">
        <div class="container">
            <div class="form-group">
                {!! Form::label('Permisos', 'Permisos') !!}
                <ul>
                @foreach($permisos as $permiso)
                    <li>
                    {{$permiso->descripcion}}
                    </li>                   
                @endforeach
                </ul>
                @error('Permisos')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>        
        </div>
    </div>  
</div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop