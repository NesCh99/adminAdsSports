@extends('adminlte::page')

@section('title', 'Publicidad')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h4><b>EDITAR PUBLICIDAD</b></h4>
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
            {!! Form::model($publicidad, ['route' => ['admin.publicidades.update', $publicidad], 'method'=>'put']) !!}
                <div class="form-group">
                {!! Form::label('Descripcion', 'Descripción') !!}
                {!! Form::text('Descripcion', $publicidad->DescripcionPub, ['class'=>'form-control', 'placeholder'=>'Ingrese una descripcion de la Publicidad']) !!}
                @error('Descripcion')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Url', 'Url') !!}
                {!! Form::text('Url', $publicidad->UrlPub, ['class'=>'form-control', 'placeholder'=>'Ingrese el Url de la Publicidad']) !!}
                @error('Url')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                </div>

                <div class="form-group">
                {!! Form::label('Portada', 'Portada') !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image-wrapper">
                            <img id="picture" src="{{Storage::url($publicidad->PortadaPub)}}"
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
                {!! Form::submit('Actualizar Publicidad', ['class'=>'btn btn-outline-primary']) !!}
            {!! Form::close() !!}
        </div>
        
    </div>
@stop
@section('js')
<script>
    //Cambia la imagen predeterminada por la que se cargó
    document.getElementById("PortadaPub").addEventListener('change', cambiarImagen);
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