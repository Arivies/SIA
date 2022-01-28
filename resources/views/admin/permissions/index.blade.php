@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
    <div class="container">
        <div class="d-flex flex-row ">
            <div class="p-2 col-2" style="height: 45px;">
                <h1>Permisos</h1>
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
    @can('permissions.create')
        <a class="btn btn-sm btn-secondary" href="{{ route('permissions.create') }}">Agregar Permiso</a>
    @endcan

    <a class="btn btn-sm btn-secondary" href="{{ route('dashboard') }}">Regresar</a>
    <table class="table mt-3">
        <thead>
            <th>Nombre Permiso</th>
            <th class="d-flex justify-content-end">acciones</th>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{$permission->name}}</td>
                    <td class="d-flex justify-content-end">
                        @can('permissions.show')
                            <a class="btn btn-sm btn-info"  href="{{ route('permissions.show',$permission->id ) }}">VER</a>
                        @endcan

                        @can('permissions.edit')
                           <a class="btn btn-sm btn-warning ml-1" href="{{ route('permissions.edit',$permission->id ) }}">EDITAR</a>
                        @endcan

                        @can('permissions.destroy')
                            <form action="{{ route('permissions.destroy',$permission->id) }}" method="POST" class="elimina-permission">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-1"> ELIMINAR</button>
                            </form>
                        @endcan
                        {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <a href="javascript:void(0)" data-id="{{ $permission->id }}" class="btn btn-sm ml-1 btn-danger" onclick="eliminarPermiso(event.target)">Eliminar</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$permissions->links()}}
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

            $('.elimina-permission').submit(function(e){
                e.preventDefault();

                Swal.fire({
                title: 'Deseas eliminar el permiso?',
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
        function eliminarPermiso(event){

            let id  = $(event).data("id");
            let _url = `/admin/permissions/destroy/${id}`;
            let _token   = $('input[name="_token"]').attr('value');

            Swal.fire({
                title: 'Deseas eliminar el permiso?',
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
                            //$(location).attr('href','{{ route('permissions.index')}}');
                            setTimeout ("redireccionar()", 1300);
                        }
                    });

                }

            })

        }
*/
        function redireccionar(){
            $(location).attr('href','{{ route('permissions.index')}}');
        }

    </script>
@stop
