<?php

namespace comercial;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    //
    protected $table='detalle_ingreso';
    protected $primaryKey='iddetalle_ingreso';

    public $timestamps=false;

    protected $fillable = [
    'idingreso',
    'idarticulo',
    'cantidad',
	'precio_compra',
	'precio_venta_normal',
    'precio_venta_empresarial',
    'precio_venta_distribucion',
    'tipoiva'
	];
}
