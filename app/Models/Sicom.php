<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sicom extends Model
{
    use HasFactory;
    protected $table = "sicomcfe";

    protected $fillable=['c4_RPU'.'C4_AA_ADE','C4_MM_ADE','C4_TIPO_ADE','C4_KWH',
                         'C5_DIVISION','C5_ZONA','C4_STS','C4_FECHA_OPERACION','C1A_VENCIMI','C2_FECHA_ALTA','C4_TOTAL'];
}
