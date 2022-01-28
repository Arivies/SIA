@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <div class="container">
        <div class="d-flex flex-row ">
            <div class="p-2 col-2">
                <h1>Usuarios</h1>
            </div>
            <div class="p-2 col-sm-10">
                @if ($errors->any())
                    <div class="alert alert-danger py-2" id="msg">
                            @foreach ($errors->all() as $error )
                                <strong>{{ $error }}</strong><br>
                            @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('content')

<div class="container mt-1">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre Usuario</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="username">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-8">
                  <input type="password"  class="form-control"  name="password">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                <div class="col-sm-8">
                  <select name="role" class="form-control">
                            <option value="0">--Seleccione--</option>
                      @foreach ($roles as $id => $role)
                            <option value="{{ $id }}">{{ $role }}</option>
                      @endforeach
                  </select>
                </div>
            </div>
            <div class="col-sm-4 py-1">
                <button class="btn btn-sm btn-secondary ml-1">GUARDAR</button>
                <a class="btn btn-secondary btn-sm ml-1" href="{{ route('users.index') }}">REGRESAR</a>
             </div>
    </form>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
