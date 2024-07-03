<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalleCompra extends Model
{
    use HasFactory;
    protected $table="detalleCompra";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkDetalleCompra';
    public $timestamps=false;
}
