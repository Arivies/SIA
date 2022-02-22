@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container">
        <div class="d-flex flex-row ">
            <div class="p-2 col-2" style="height: 45px;">
                <h1>Actividades</h1>
            </div>
            <div class="p-2 col-sm-10" style="height: 45px;">
                @if ($mensaje = Session::get('success'))
                    <div class="alert alert-success py-2" style="height: 45px;" id="msg">
                        <strong>{{ $mensaje }}</strong>
                    </div>
                @endif
                @if ($mensaje = Session::get('error'))
                    <div class="alert alert-danger py-2" style="height: 45px;" id="msg">
                        <strong>{{ $mensaje }}</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="container">
        @can('actividades.create')
            <a class="btn btn-sm btn-secondary" href="{{ route('actividades.create') }}">Agregar Actividad</a>
        @endcan

        <a class="btn btn-sm btn-secondary" href="{{ route('dashboard') }}">Regresar</a>
        <div class="card mt-1">
            <div class="card-header bg-secondary"><strong>Lista de Actividades</strong></div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Actividad</th>                        
                    </thead>
                    <tbody>
                        @forelse ($actividades as $actividad )
                            <tr>
                                <td>{{ $actividad->id }}</td>
                                <td>{{ $actividad->actividad }}</td>                   
                                <td>
                                    @can('actividades.show')
                                        <a class="btn btn-sm btn-info"  href="{{ route('actividades.show',$actividad->id ) }}">VER</a>
                                    @endcan

                                    @can('actividades.edit')
                                        <a class="btn btn-sm btn-warning ml-1" href="{{ route('actividades.edit', $actividad->id) }}" >Editar</a>
                                    @endcan

                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
            <card-footer>
                {{$actividades->links()}}
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
