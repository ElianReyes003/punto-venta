<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;
    protected $table="unidad";
    //si mi id se hubiera llamado diferente
    protected $primaryKey='pkUnidad';
    public $timestamps=false;
}
