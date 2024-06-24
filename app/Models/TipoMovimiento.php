<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimiento extends Model
{
    use HasFactory;
    protected $table="tipoMovimiento";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pktipoMovimiento';
    public $timestamps=false;
    
}
