@extends('adminlte::page')

@section('title', 'Ver Usuario')

@section('content_header')

@stop

@section('content')

    <div class="container mt-3">
        <div class="card" style="width: 50rem;">
            <div class="card-header bg-secondary"><strong>Detalle Usuario</strong></div>
            <div class="card-body">
                <div class="d-inline-flex p-3">
                    <div class="p-2">
                        <img src="{{ $user->profile_photo_url }}" class="card-img-top" alt="..." style="width: 18rem;">
                    </div>
                    <div class="p-1">
                        <div class="row">
                            <label for="name" class="col-sm-4 col-form-label">Nombre:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                    value="{{ $user->name }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="username" class="col-sm-4 col-form-label">Usuario:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                    value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="email" class="col-sm-4 col-form-label">Correo:</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                    value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="row">
                            <label for="role" class="col-sm-4 col-form-label">Rol:</label>
                            <div class="col-sm-8">
                                @forelse ( $user->roles as $role )
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="{{ $role->name }}">
                                @empty
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail"
                                        value="Sin Rol Asignado">
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <a class="btn btn-secondary btn-sm ml-4" href="{{ route('users.index') }}">REGRESAR</a>
                    </div>
                </div>
            </div>
        </div>
    </div>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
