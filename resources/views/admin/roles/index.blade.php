@extends('adminlte::page')

@section('title', 'Roles')
@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>ROLES | </b> Lista de Registros</h5>
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
            <table class="table table-stripe">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ROL</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $rol)
                        <tr>
                            <td>{{$rol->id}}</td>
                            <td>{{$rol->name}}</td>
                            @can('admin.roles.show')
                            <td width="10px">
                            <a class="btn btn-primary" href="{{route('admin.roles.show', $rol)}}">Ver</a>
                            </td>
                            @endcan
                            @can('admin.roles.edit')
                            <td width="10px">
                                <a class="btn btn-primary" href="{{url('/admin/roles/'.$rol->id.'/edit')}}">Editar</a>
                            </td>
                            @endcan
                            @can('admin.roles.destroy')
                            <td width="10px">
                                <form action="#" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar {{$rol->name}}?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
    