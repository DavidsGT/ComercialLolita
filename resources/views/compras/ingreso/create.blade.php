@extends ('layouts.admin')
@section ('contenido')
@push ('scripts')
	<script src="{{ asset('js/compras/ingreso.js') }}"></script>
@endpush
		{!! Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
			{{Form::token()}}
<div class="row">
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
			@foreach($personas as $persona)
				<option value="{{$persona->id}}">
					{{$persona->nombre}}
				</option>
			@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<input type="hidden" id="idvendedor" name="idvendedor"  required>
			<label for="vendedor">Empleado Responsable</label><label id="nombreVendedor"></label>
			<input type="password" name="vendedor" id="vendedor" class="form-control" required placeholder="Codigo Empleado...." >
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Forma de Pago</label>
			<select name="formapago" class="form-control">
				<option value="" selected>Seleccione Forma de Pago</option>
				@foreach($formaPago as $for)
				<option value="{{$for->id}}">{{$for->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label>Tipo de Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="" selected>Seleccione Tipo de Comprobante</option>
				@foreach($tipoComprobante as $tcomp)
				<option value="{{$tcomp->id}}">{{$tcomp->descripcion}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie Comprobante</label>
			<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
		<div class="col-lg-4 col-mg-4 col-sg-4 col-xs-12">
		<div class="form-group">
			<label for="numero_comprobante">Numero Comprobante</label>
			<input type="text" name="numero_comprobante" required value="{{old('numero_comprobante')}}" class="form-control" placeholder="Serie Documento....">		
		</div>
	</div>
</div>
<div class="row">
<div class="panel panel-primary">
	<div class="panel-body">
		<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12">
			<div class="form-group">
			<label>Articulo</label>
			<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
			@foreach($articulos as $articulo)
				<option value="{{$articulo->idarticulo}}">
					{{$articulo->articulo}}
				</option>
			@endforeach
			</select>
			</div>
		</div>
		<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
			<div class="form-group">
			<label for="cantidad">Cantidad</label>
			<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="cantidad...." >
			</div>
		</div>
		<div class="col-lg-3 col-mg-3 col-sg-3 col-xs-12">
			<div class="form-group">
			<label for="precio_compra">Prec.Compra</label>
			<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Prec.Compra.." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="por_venta">% Ganancia</label>
			<input type="number" name="por_venta" id="por_venta" class="form-control" placeholder="% Ganancia.." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Normal</label>
			<input type="number" name="pprecio_venta_normal" id="pprecio_venta_normal" class="form-control" placeholder="Prec.Venta.Normal." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Empresarial</label>
			<input type="number" name="pprecio_venta_empresarial" id="pprecio_venta_empresarial" class="form-control" placeholder="Prec.Venta.Empresarial." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="precio_venta">Prec.Venta Distribución</label>
			<input type="number" name="pprecio_venta_distribucion" id="pprecio_venta_distribucion" class="form-control" placeholder="Prec.Venta.Distribución." >
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<label for="tipoiva">Tipo Iva</label>
			<select name="ptipoiva" id="ptipoiva" class="form-control">
				<option value="12">12%</option>
				<option value="0">0%</option>
			</select>
			</div>
		</div>
		<div class="col-lg-2 col-mg-2 col-sg-2 col-xs-12">
			<div class="form-group">
			<p>&nbsp;</p>
			<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
			</div>
		</div>
		<div class="col-lg-12 col-mg-12 col-sg-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color:#A9D0F5">
					<th>Opciones</th>
					<th>Articulo</th>
					<th>Cantidad</th>
					<th>Precio Compra</th>
					<th>Precio Venta</th>
					<th>Tipo Iva</th>
					<th>Subtotal</th>
				</thead>
				<tfoot>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
			
					<th style="text-align: right;" >Subtotal 12%</th>
					
					<th colspan="2" style="text-align: right;"><h4 id="total">$ 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
					<th></th>
					</tr>
					<tr>
					<th>Retencion Fuente. </th>
					<th style="text-align: right;">
						
						<select name="pretfuente" class="form-control" id="pretfuente" onchange="mostrarValor(Math.round(((this.value/100)*subtotalr)*100)/100);">
						<option value="1">1 % Bienes</option>
						<option value="2">2 % Servicios</option>
						<option value="5">5 % Bancos</option>
						<option value="8">8 % ND</option>
						<option value="10">10 % Profesionales</option>
						</select>

					</th>
					<th ><input  name="retfuente" id="retfuente" value="" style="text-align: right; width: 80px; "></th>
					<th></th>
					<th style="text-align: right;" >Subtotal 0%</th>
					<th colspan="2" style="text-align: right;"><h4 id="total12">$ 0.00</h4><input type="hidden" name="total_venta12" id="total_venta12"></th>
					</tr>
					<th></th>
					<tr>
					<th>Retencion Iva. </th>
					<th style="text-align: right;">
						
						<select name="pretiva" class="form-control" id="pretiva" onchange="mostrarValor1(Math.round(((this.value/100)*totiva12)*100)/100);">
						<option value="10">10 %</option>
						<option value="30">30 %</option>
						<option value="70">70 %</option>
						<option value="100">100 %</option>
						</select>

					</th>
					<th><input name="retiva" id="retiva" style="text-align: right; width: 80px; "></th></th>
					<th></th>
				
					<th style="text-align: right;" >Subtotal</th>
					
					<th colspan="2" style="text-align: right;"><h4 id="subtot">$ 0.00</h4><input type="hidden" name="subtot1" id="subtot1" value=""></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>

					<th style="text-align: right;" >Iva 12%</th>					
	<th colspan="2" style="text-align: right;"><h4 id="totiva121">$ 0.00</h4><input type="hidden" name="total_iva" id="total_iva" value=""></th>
					</tr>
					<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				
					<th style="text-align: right;" >Total a Pagar</th>
				
					<th colspan="2" style="text-align: right;"><h4 id="totalpagar">$ 0.00</h4><input type="hidden" name="total_pagar" id="total_pagar"></th>
					</tr>
				</tfoot>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>
	<div class="col-lg-6 col-mg-6 col-sg-6 col-xs-12" id="guardar">
		<div class="form-group">
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" onclick="history.back()" type="reset">Salir</button>
				</div>
		</div>
	</div>
</div>
</div>


@push ('scripts')
<script>

$("#retfuente").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

 $(document).ready(function () {
          $("#por_venta").keyup(function () {
              var porc = $(this).val();
              var valor2 = $("#pprecio_compra").val();
              var nuevoprecio = (porc/100) * valor2;
              var newPrecioEmpresarial
              nuevoprecio = parseFloat(valor2) + parseFloat(nuevoprecio);
              var pre_venta = parseFloat(Math.round(nuevoprecio * 100) / 100).toFixed(2);
              $("#pprecio_venta_normal").val(pre_venta);
          });
      });

	var mostrarValor = function(x){
		document.getElementById('retfuente').value=x;
		};

	var mostrarValor1 = function(x){
		document.getElementById('retiva').value=x;
	};
 //cargar items del ingreso

$(document).ready(function(){
    $('#bt_add').click(function(){
    agregar();
    });
  });

var cont=0;
total=0;
 total12=0;
 totiva12=0;
 totalpagar=0;
 subtotalr=0;
 subtotal=[];
 $("#guardar").hide();
  $("#idproveedor").change(mostrarvalores);

function agregar()
{

	idarticulo=$("#pidarticulo").val();
    articulo=$("#pidarticulo option:selected").text();
    cantidad=$("#pcantidad").val();
    precio_compra=$("#pprecio_compra").val();
    precio_normal=$("#pprecio_venta_normal").val();
    precio_empresarial=$("#pprecio_venta_empresarial").val();
    precio_distribucion=$("#pprecio_venta_distribucion").val();
    tipoiva=$("#ptipoiva").val();


if (idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_normal!="" && precio_distribucion!="" && precio_empresarial!="")

		{
			if (tipoiva==12)
			{
				//alert('sdds')
				subtotal[cont]=Math.round((cantidad*precio_compra) *100)/100;
				total=total+(Math.round(subtotal[cont]*100)/100);
				totiva12=Math.round(total*(tipoiva/100)*100)/100;
			}
			else
			{
				//alert('dddd')
				subtotal[cont]=Math.round((cantidad*precio_compra)*100)/100;
				//subtotal[cont]=(cantidad*precio_venta);
				total12=total12+(Math.round(subtotal[cont]*100)/100);
				
			}

			subtotalr=Math.round((total+total12)*100)/100;
			totalpagar=(Math.round((total+totiva12+total12)*100)/100);
			
			var fila='<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td><td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td><td><input type="number" name="precio_venta_normal[]" value="'+precio_normal+'"><input type="hidden" name="precio_venta_empresarial[]" value="'+precio_empresarial+'"><input type="hidden" name="precio_venta_distribucion[]" value="'+precio_distribucion+'"></td><td ><input type="number" name="iva[]" value="'+tipoiva+'"></td><td>'+subtotal[cont]+'</td></tr>';

			   cont++;
		       limpiar();
		       $('#total').html("$ " + total);
		    //   $('#total_venta').val(total);
		       $('#total12').html("$ " + total12);
		     //  $('#total_venta12').val(total12);
		       $('#totiva121').html("$ " + totiva12);
		       $('#total_iva').val(totiva12);
		       $('#totalpagar').html("$ " + totalpagar);
		      // $('#total_pagar').val(totiva12);
		       $('#subtot').html("$ " + subtotalr);
		       $('#subtot1').val(subtotalr);
  				
		       evaluar();
		       $('#detalles').append(fila);

		     
		}

		else {
			alert("Error en el ingreso de datos");
		}
}


	function mostrarvalores()
	{

		datosProveedor=document.getElementById('idproveedor').value.split('_');
		$("#vendedor").val(datosProveedor[1]);
		//$("#pstock").val(datosArticulo[1]);
		//$("#piva").val(datosArticulo[3]);
	}

	function limpiar(){
		$("#pcantidad").val("");
		$("#pprecio_compra").val("");
		$("#pprecio_venta_normal").val("");
		$("#ptipoiva").val("");
	}

	function evaluar()
	{
		if (total>0 || total12>0)
		{
			$("#guardar").show();
		}
		else {
			$("#guardar").hide();
		}
	}


	function eliminar(index){
		total=total-subtotal[index];
		$("#total").html("$ "+total);
		$("#total_venta").val(total);
		$("#fila"+index).remove();
		evaluar();
	}

</script>
@endpush
@endsection