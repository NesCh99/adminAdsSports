@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>NUEVO DEPORTE</b></h4>
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
            {!! Form::open(['route'=>'admin.deportes.store', 'files' => true ]) !!}
                <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del Deporte']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Descripcion', 'Descripción') !!}
                {!! Form::text('Descripcion', null, ['class'=>'form-control', 'placeholder'=>'Ingrese una descripcion del Deporte']) !!}
                @error('Descripcion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('Portada', 'Portada del Deporte') !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image-wrapper">
                            <img id="picture" src="https://img.freepik.com/foto-gratis/accion-jugador-futbol-estadio_1150-14606.jpg?t=st=1654605732~exp=1654606332~hmac=d1e53ef159f15d91b569c12a93267b8de0e6299caba8c1c46d04f10c256bfa53&w=740"
                            alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            {!! Form::file('Portada', ['class'=>'form-control-file', 'accept' => 'image/*']) !!}
                            </div>
                            <p>Tamaño máximo de 5MB</p>
                            @error('Portada')
                            <span class="text-danger">{{$message}}</span>
                            @enderror 
                        </div>
                    </div>
                </div>
                
                {!! Form::submit('Registrar Deporte', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop

@section('js') 
<script>
    //Cambia la imagen predeterminada por la que se cargó
    document.getElementById("Portada").addEventListener('change', cambiarImagen);
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
