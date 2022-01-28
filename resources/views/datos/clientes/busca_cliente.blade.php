@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container">
        
    </div>
@stop

@section('content')
    <div class="container"> 
        
        <h3 class="mb-3">Registro de Solicitudes</h3><br>       
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-header bg-secondary text-center">Valida RPU</div>
                <div class="card-body">
                    <form action="{{ route('datos.busca') }}" method="POST"> 
                        @csrf
                            <div class="mb-2">
                            <input type="text" class="form-control" id="rpu" name="rpu"  />
                            </div>     
                        <button class="btn btn-secondary btn-block" type="submit">BUSCAR</button>
                    </form>
                </div>
            </div>
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
           

        });
    </script>
@stop
