<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carterapa extends Model
{
    use HasFactory;
    protected $table = "carterapa";
    protected $fillable=['rpu','nombre','programa','producto','tipo','idpresup','pin','tfinanciado','tcobranza','tadeudo','npr','trezago','division'];


}
