@extends('adminlte::page')

@section('title', 'Actividades')

@section('content_header')
    <h1>Actividades</h1>
@stop

@section('content')
<div class="container mt-2">
    <form action="{{ route('actividades.store') }}" method="POST">
        @csrf
        <div class="row">
            <label for="" class="form-label col-sm-2 py-2">Nombre Actividad</label>
            <input type="text" name="actividad" class="form-control col-sm-6"/>
            <div class="col-sm-4 py-1">
                <button class="btn btn-sm btn-secondary ml-1">GUARDAR</button>
                <a class="btn btn-secondary btn-sm ml-1" href="{{ route('actividades.index') }}">REGRESAR</a>
             </div>
        </div>
    </form>
</div>

    {{-- </div>
</div> --}}

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
