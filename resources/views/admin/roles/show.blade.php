@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <div class="row">
                  <label for="" class="col-sm-2">ID</label>
                  <span class="col-sm-4">{{$role->id}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Nombre</label>
                <span class="col-sm-4">{{$role->name}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Tipo Seguridad</label>
                <span class="col-sm-4">{{$role->guard_name}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Creado</label>
                <span class="col-sm-4">{{$role->created_at}}</span>
            </div>
            <div class="row">
                <label for="" class="col-sm-2">Actualizado</label>
                <span class="col-sm-4">{{$role->updated_at}}</span>
            </div>
            <div class="row">
            <label for="" class="col-sm-2">Permisos</label>
                <div class="col-sm-10">
                    @forelse ($role->permissions as $permission)
                        <span class="badge rounded-pill bg-dark text-white">{{ $permission->name }}</span>
                    @empty
                        <span class="badge badge-danger bg-danger">Sin Permisos asignados</span>
                    @endforelse
                </div>
            </div>
            <div class="row mt-2">
                <a class="btn btn-secondary btn-sm ml-2" href="{{ route('roles.index') }}">REGRESAR</a>
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
