@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container">
        
    </div>
@stop

@section('content')
    <div class="container">
        <h3>Datos Cliente</h3>
        <form>
            <div class="form-row">
              <div class="col-md-2 mb-2">
                <label for="validationDefault01">RPU</label>
                <input type="text" class="form-control" id="rpu" name="rpu" value="{{ $datos['rpu'] }}" disabled>
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationDefault02">NOMBRE</label>
                <input type="text" class="form-control" id="nombre" name="nombre"  value="{{ $datos['nombre'] }}" disabled>
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationDefault01">No. de Cuenta</label>
                <input type="text" class="form-control" id="ncuenta" name="ncuenta" value="{{ $datos['numCta'] }}" disabled>
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationDefault01">Tarifa</label>
                <input type="text" class="form-control" id="tarifa" name="tarifa" value="{{ $datos['tarifa'] }}" disabled>
              </div>              
            </div>
            <div class="form-row">
              <div class="col-md-2 mb-2">
                <label for="validationDefault03">Medidor</label>
                <input type="text" class="form-control" id="medidor" name="medidor" value="{{ $datos['numMedidor'] }}" disabled>
              </div>
              <div class="col-md-2 mb-2">
                <label for="validationDefault03">Estatus</label>
                <input type="text" class="form-control" id="estatus" name="estatus" value="{{ $datos['estatusSRV'] }}" disabled>
              </div>
              <div class="col-md-5 mb-2">
                <label for="validationDefault03">Direccion</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $datos['direccion'] }}" disabled>
              </div>
              <div class="col-md-3 mb-2">
                <label for="validationDefault03">Colonia</label>
                <input type="text" class="form-control" id="colonia" name="colonia" value="{{ $datos['colonia'] }}" disabled>
              </div>
            </div>
            <div class="form-row">
                <div class="col-md-2 mb-2">
                    <label for="validationDefault03">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $datos['ciudad'] }}" disabled>
                </div>
                <div class="col-md-2 mb-2">
                    <label for="validationDefault03">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ $datos['estado'] }}" disabled>
                </div>
            </div>
            <a class="btn btn-secondary btn-sm ml-1" href="{{ route('datos.index') }}">REGRESAR</a>
            <button class="btn btn-secondary btn-sm" type="submit">SIGUIENTE</button>

          </form>


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
