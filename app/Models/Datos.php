<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    use HasFactory;
    protected $fillable=[
        'estatus','rpu','numCta','tipoFac','nombre','direccion','ciudad',
        'estado','tarifa','fechadesde','fechahasta','fechalimite','fechalimite',
        'colonia','division','zona','agencia','estatusSRV','empleado'];
}
