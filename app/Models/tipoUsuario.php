<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipoUsuario extends Model
{
    use HasFactory;
    protected $table="tipoUsuario";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkTipoUsuario';
    public $timestamps=false;
}
