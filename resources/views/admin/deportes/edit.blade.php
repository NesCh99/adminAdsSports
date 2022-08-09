@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>EDITAR DEPORTE</b></h4>
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
            {!! Form::model($deporte, ['route' => ['admin.deportes.update', $deporte], 'method'=>'put', 'files' => true]) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', $deporte->NombreDep, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del Deporte']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Descripcion', 'Descripción') !!}
                {!! Form::text('Descripcion', $deporte->DescripcionDep, ['class'=>'form-control', 'placeholder'=>'Ingrese una descripcion del Deporte']) !!}
                @error('Descripcion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Portada', 'Portada del Deporte') !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image-wrapper">
                            <img id="picture" src="{{Storage::url($deporte->PortadaDep)}}"
                            alt="" class="img-fluid">
                            </div>
                        </div>
                        <div-col>
                            <div class="form-group">
                            {!! Form::file('Portada', ['class'=>'form-control-file', 'accept' => 'image/*']) !!}
                            </div>
                            <p>Tamaño máximo de 5MB</p>
                            @error('Portada')
                            <span class="text-danger">{{$message}}</span>
                            @enderror 
                        </div-col>
                    </div>
                </div>
                {!! Form::submit('Actualizar Deporte', ['class'=>'btn btn-outline-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
@section('js')
<script>
    //Cambia la imagen predeterminada por la que se cargó
    document.getElementById("PortadaDep").addEventListener('change', cambiarImagen);
    function cambiarImagen(event){
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = (event) => {
            document.getElementById("picture").setAttribute('src', event.target.result);
        };

        reader.readAsDataURL(file);
    }
</script>
@endsection