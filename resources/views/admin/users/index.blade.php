@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container">
        <div class="d-flex flex-row ">
            <div class="p-2 col-2" style="height: 45px;">
                <h1>Usuarios</h1>
            </div>
            <div class="p-2 col-sm-10" style="height: 45px;">
                @if ($mensaje = Session::get('success'))
                    <div class="alert alert-success py-2" style="height: 45px;" id="msg">
                        <strong>{{ $mensaje }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        @can('users.create')
            <a class="btn btn-sm btn-secondary" href="{{ route('users.create') }}">Agregar Usuario</a>
        @endcan

        <a class="btn btn-sm btn-secondary" href="{{ route('dashboard') }}">Regresar</a>
        <div class="card mt-1">
            <div class="card-header bg-secondary"><strong>Lista de Usuarios</strong></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @forelse ($users as $user )
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @forelse ( $user->roles as $role )
                                        <label for="rol">{{ $role->name }}</label>
                                    @empty
                                        <label for="rol">Sin Rol asignado</label>
                                    @endforelse
                                </td>
                                <td>
                                    @can('users.show')
                                        <a class="btn btn-sm btn-info"  href="{{ route('users.show',$user->id ) }}">VER</a>
                                    @endcan

                                    @can('users.edit')
                                        <a class="btn btn-sm btn-warning ml-1" href="{{ route('users.edit', $user->id) }}" >Editar</a>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <card-footer>
                {{$users->links()}}
            </card-footer>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            $("#msg").fadeOut(7000);

            $('.elimina-role').submit(function(e){
                e.preventDefault();

                Swal.fire({
                title: 'Deseas eliminar el rol?',
                text: "Una vez eliminado ya no se revertira!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Deseo eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                })
            });

        });
    </script>
@stop
