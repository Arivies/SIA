@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <div class="container">
        <div class="d-flex flex-row ">
            <div class="p-2 col-2" style="height: 45px;">
                <h1>Roles</h1>
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

<div class="container mt-1">
    @can('roles.create')
        <a class="btn btn-sm btn-secondary" href="{{ route('roles.create') }}">Agregar Rol</a>
    @endcan

    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard') }}">Regresar</a>
    <table class="table mt-3">
        <thead>
            <th>Rol</th>
            <th>Permisos</th>
            <th class="d-flex justify-content-end">acciones</th>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{$role->name}}</td>
                    <td>
                        @forelse ($role->permissions as $permission)
                            <span class="badge badge-secondary">{{ $permission->name}}</span>
                        @empty
                            <span class="badge badge-warning">Rol sin permisos asignados</span>
                        @endforelse
                    </td>
                    <td class="d-flex justify-content-end">
                        @can('roles.show')
                            <a class="btn btn-sm btn-info"  href="{{ route('roles.show',$role->id ) }}">VER</a>
                        @endcan

                        @can('roles.edit')
                            <a class="btn btn-sm btn-warning ml-1" href="{{ route('roles.edit',$role->id )}}">EDITAR</a>
                        @endcan

                        @can('roles.destroy')
                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST" class="elimina-role">
                                @method('DELETE')
                                @csrf
                                <input type="hidden" name="_id" id="_id" value="{{$role->id}}">
                                <button type="submit" class="btn btn-sm btn-danger ml-1"> ELIMINAR</button>
                            </form>
                        @endcan
                        {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <a href="javascript:void(0)" data-id="{{ $role->id }}" class="btn btn-sm ml-1 btn-danger" onclick="eliminarRol(event.target)">Eliminar</a> --}}

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$roles->links()}}
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





/*
        function eliminarRol(event){

            let id  = $(event).data("id");
            let _url = `/admin/roles/destroy/${id}`;
            let _token   = $('input[name="_token"]').attr('value');

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

                    $.ajax({
                        url: _url,
                        type: 'POST',
                        data: {_token: _token  },
                        success: function(response) {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'success',
                                title: 'Eliminado Correctamente!',
                                showConfirmButton: false
                            })
                            setTimeout ("redireccionar()", 1300);
                        }
                    });

                }

            })

            }*/

            /*function redireccionar(){
            $(location).attr('href','{{ route('roles.index')}}');
            }*/


    </script>
@stop
