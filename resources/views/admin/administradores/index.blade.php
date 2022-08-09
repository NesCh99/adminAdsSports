@extends('adminlte::page')

@section('title', 'Administradores')

@section('content_header')
<div class="card-header bg-dark">
    <div class="row align-items-center">
        <h5><b>ADMINISTRADORES | </b> Lista de Registros</h5>
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
            <table class="table">
                <thead>
                    <tr>
                        <th>NOMBRE</th>
                        <th>EMAIL</th>
                        <th>ROL</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($administradores as $administrador)
                        <tr>
                            <td>{{$administrador->NombreAdm}}</td>
                            <td>{{$administrador->email}}</td>
                            <td><span class="badge badge-info">{{str_replace(array('"', '[', ']'),'',$administrador->getRoleNames())}}</span></td>
                            <td>
                            @can('admin.administradores.edit')
                                <a class="btn btn-outline-warning rounded-circle m-1" href="{{url('/admin/administradores/'.$administrador->idAdministrador.'/edit')}}">
                                    <i class="fas fa-pen"></i>
                                </a>
                            @endcan
                            @can('admin.administradores.destroy')
                                <form action="#" method="POST" class="btn">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger rounded-circle m-1" onclick="return confirm('¿Desea eliminar {{$administrador->name}}?')">
                                    <i class="fas fa-trash"></i>
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


@stop

@section('js')

@stop
    