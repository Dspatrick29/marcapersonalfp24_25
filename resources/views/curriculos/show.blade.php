@extends('layouts.master')

@section('content')

<div class="row m-4">
    <div class="col-sm-4">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Curriculum-vitae-warning-icon.svg/256px-Curriculum-vitae-warning-icon.svg.png" style="height:200px" alt="Imagen del curriculo"/>
    </div>
    <div class="col-sm-8">
        <h3><strong>User ID: </strong>{{ $arrayCurriculos['user_id'] }}</h3>
        <h4><strong>Video Curriculum: </strong>
            <a href="{{ $arrayCurriculos['video_curriculum'] }}">
                {{ $arrayCurriculos['video_curriculum'] }}
            </a>
        </h4>
        <h4><strong>Texto Curriculum: </strong></h4>
        <p>{{ $arrayCurriculos['texto_curriculum'] }}</p>

        <a class="btn btn-primary" href="{{ url('curriculos/edit/' . $id) }}">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            Editar Curriculo
        </a>
        <a class="btn btn-secondary" href="{{ url('curriculos') }}">
            Volver al listado
        </a>
    </div>
</div>

@endsection
