@extends('adminlte::page')

@section('title', 'Campeonato')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h5><b>EDITAR CAMPEONATO</b></h5>
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
            {!! Form::model($campeonato, ['route' => ['admin.campeonatos.update', $campeonato], 'method'=>'put', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('NombreCam', 'Nombre') !!}
                {!! Form::text('NombreCam', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del Campeonato']) !!}
                @error('NombreCam')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('DescripcionCam', 'Descripcion') !!}
                {!! Form::text('DescripcionCam', null, ['class'=>'form-control', 'placeholder'=>'Ingrese una descripcion del Campeonato']) !!}
                @error('DescripcionCam')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('idDeporte', 'Deporte') !!}
                {!! Form::select('idDeporte', $deportes, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('FechaInicioCam', 'Fecha de Inicio') !!}
                {{ Form::date('FechaInicioCam', null, ['class' => 'form-control']) }}
                @error('FechaInicioCam')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Descuento', 'Descuento') !!}
                {!! Form::number('Descuento', null, ['min' => '0', 'max' => '100', 'class' => 'form-control']) !!}
                @error('Descuento')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('PortadaCam', 'Portada del Campeonato') !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image-wrapper">
                            <img id="picture" src="{{Storage::url($campeonato->PortadaCam)}}"
                            alt="" class="img-fluid">
                            </div>
                        </div>
                        <div-col>
                            <div class="form-group">
                            {!! Form::file('PortadaCam', ['class'=>'form-control-file', 'accept' => 'image/*']) !!}
                            </div>
                            <p>Tamaño máximo de 5MB</p>
                            @error('PortadaCam')
                            <span class="text-danger">{{$message}}</span>
                            @enderror 
                        </div-col>
                    </div>
                </div>
                {!! Form::submit('Actualizar Campeonato', ['class'=>'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
@section('js')
<script>
    //Cambia la imagen predeterminada por la que se cargó
    document.getElementById("PortadaCam").addEventListener('change', cambiarImagen);
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