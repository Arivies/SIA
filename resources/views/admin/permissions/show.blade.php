@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
    <h1>Permisos</h1>
@stop

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <div class="row">
                  <label for="" class="col-sm-2">ID</label>
                  <span class="col-sm-4">{{$permission->id}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Nombre</label>
                <span class="col-sm-4">{{$permission->name}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Tipo Seguridad</label>
                <span class="col-sm-4">{{$permission->guard_name}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Creado</label>
                <span class="col-sm-4">{{$permission->created_at}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Actualizado</label>
                <span class="col-sm-4">{{$permission->updated_at}}</span>
            </div>
            <div class="row">
                <a class="btn btn-secondary btn-sm ml-2" href="{{ route('permissions.index') }}">REGRESAR</a>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
