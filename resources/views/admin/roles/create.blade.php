@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
<div class="container mt-2">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="row">
            <label for="" class="form-label col-sm-2 py-2">Nombre Rol</label>
            <input type="text" name="name" class="form-control col-sm-6"/>
            <div class="col-sm-4 py-1">
                <button class="btn btn-sm btn-secondary ml-1">GUARDAR</button>
                <a class="btn btn-secondary btn-sm ml-1" href="{{ route('roles.index') }}">REGRESAR</a>
             </div>
        </div>

        <div class="row">
            <div class="card mt-5">
                <div class="card-header bg-secondary"><strong>Seleccione Permisos</strong></div>
                <div class="card-body">
                    @foreach ($permissions as $id => $permission)
                        <label for="name" class="col-sm-10">{{ $permission }}</label>
                        <input type="checkbox" class="form-check-input col-sm-2 ml-1" name="permissions[]" value="{{ $id}}">
                    @endforeach
                </div>
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
