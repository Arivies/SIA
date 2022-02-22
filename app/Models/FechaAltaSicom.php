<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FechaAltaSicom extends Model
{
    use HasFactory;
    protected $table = "fecha_alta_sicom";
    protected $fillable=['rpu','rutacomp','division','zona','nombre','direccion','colonia',
                         'tipo_facturacion','fecha_alta','tarifa','tarifa_dac','empleado','medidor','estatus_sicom'];
}
