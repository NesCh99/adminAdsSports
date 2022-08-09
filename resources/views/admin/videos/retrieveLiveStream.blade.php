@extends('adminlte::page')

@section('title', 'Videos')

@section('content_header')
<div class="card bg-dark">
    <div class="card-body">
        <h5><b>{{$video->NombreVid}} </b>| Transmisión en Vivo</h5>
    </div>
</div>
@stop
@if(session('info'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session('info')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@section('content')
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <iframe src="{{$video->metadato->PlayerMetaDato}}" width="540" height="360" frameborder="0"></iframe>
                </div>
                <div class="col-md-5">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>Servidor</b></span>
                        <input type="text" id="Server" readonly value="rtmp://broadcast.api.video/s" class="form-control">
                        <button onclick="copyServer()" class="btn btn-outline-light"><i class="fas fa-clipboard"></i></button>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><b>Clave</b></span>
                        <input type="text" id="StreamKey" readonly value="{{$video->metadato->StreamKeyMetaDato}}" class="form-control">
                        <button onclick="copyStreamKey()" class="btn btn-outline-light"><i class="fas fa-clipboard"></i></button>
                    </div>             
                </div>
            </div>
        </div> 
    </div>
</div>
@endsection

@section('js')
<script>
    function copyServer() {
    /* Get the text field */
    var copyText = document.getElementById("Server");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
    } 
    function copyStreamKey() {
    /* Get the text field */
    var copyText = document.getElementById("StreamKey");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
    } 
</script>
@endsection
