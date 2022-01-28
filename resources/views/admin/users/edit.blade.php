@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
<div class="container mt-2">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
            <div class="mb-3 row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre Usuario</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="name" value="{{ old('name', $user->name) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="usuario" class="col-sm-2 col-form-label">Usuario</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="username" value="{{ old('username', $user->username) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="correo" class="col-sm-2 col-form-label">Correo</label>
                <div class="col-sm-8">
                  <input type="text"  class="form-control"  name="email" value="{{ old('email', $user->email) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                <div class="col-sm-8">
                  <input type="password"  class="form-control"  name="password" value="{{ old('password', $user->password) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rol" class="col-sm-2 col-form-label">Rol</label>
                <div class="col-sm-8">
                  <select name="role" class="form-control">
                            <option value="0">--Seleccione--</option>
                      @foreach ($roles as $id => $role)
                            <option value="{{ $id }}" {{ $user->roles->contains($id) ? 'selected' : '' }}>{{ $role }}</option>
                      @endforeach
                  </select>
                </div>
            </div>

            <div class="col-sm-4 py-1">
                <button class="btn btn-sm btn-secondary ml-1">ACTUALIZAR</button>
                <a class="btn btn-secondary btn-sm ml-1" href="{{ route('users.index') }}">REGRESAR</a>
             </div>
    </form>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
