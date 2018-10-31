<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    //
    protected $table='ingreso';
    protected $primaryKey='idingreso';

    public $timestamps=false;

    protected $fillable = [
    'idproveedor',
    'tipo_comprobante',
    'serie_comprobante',
	'numero_comprobante',
	'fecha_hora',
	'total_iva',
    'subtotal',
	'estado',
    'vendedor',
    'formapago',
    'retfuente',
    'retiva',
    ];

    protected $guarded =[
     
    ];
}
