@extends('adminlte::page')

@section('title', 'Video')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h5><b>EDITAR VIDEO</b></h5>
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
            <!-- Formulario de laravel colective -->
            {!! Form::model($video, ['route' => ['admin.videos.update', $video], 'method'=>'put', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('Nombre', 'Nombre') !!}
                {!! Form::text('Nombre', null, ['class'=>'form-control', 'placeholder'=>'Ingrese el nombre del Video']) !!}
                @error('Nombre')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Descripcion', 'Descripcion') !!}
                {!! Form::text('Descripcion', null, ['class'=>'form-control', 'placeholder'=>'Ingrese una descripcion del Video']) !!}
                @error('Descripcion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Campeonato', 'Deporte') !!}
                {!! Form::select('Campeonato', $campeonatos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                {!! Form::label('Fecha', 'Fecha de Inicio') !!}
                {{ Form::date('Fecha', null, ['class' => 'form-control']) }}
                @error('Fecha')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Hora', 'Hora de Inicio') !!}
                {{ Form::time('Hora', null, ['class' => 'form-control']) }}
                @error('Hora')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                {!! Form::label('Precio', 'Precio') !!}
                {!! Form::number('Precio', null, ['min' => '0', 'class' => 'form-control']) !!}
                @error('Precio')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('Portada', 'Portada del Video') !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image-wrapper">
                            <img id="picture" src="{{Storage::url($video->PortadaVid)}}"
                            alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            {!! Form::file('Portada', ['class'=>'form-control-file', 'accept' => 'image/*']) !!}
                            </div>
                            <p>Tamaño máximo de 5MB</p>
                            @error('PortadaVid')
                            <span class="text-danger">{{$message}}</span>
                            @enderror 
                        </div>
                    </div>
                </div>
                {!! Form::submit('Actualizar Video', ['class'=>'btn btn-primary']) !!}
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