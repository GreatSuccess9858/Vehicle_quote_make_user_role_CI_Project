<div class="panel">
	<div class="panel-heading">

		<h2 id="title-create"  class="<?php if ($cotizacion_id > 0) {echo 'hidden';}?>" >Crear Cotización</h2>
		<h2 id="title-update"   class="<?php if ($cotizacion_id <= 0) {echo 'hidden';}?>" >Actualizar Cotización #<?PHP echo $cotizacion_id; ?></h2>
	</div>
	<div class="panel-body panel-form-sm">
		<form data-trigger="custom__update_form_cotizacion" action="<?php echo site_url("cotizacion/ajax_save"); ?>" method="post" class="form-horizontal js-validation-plus">
			 <input type="hidden" id="cotizacion_id" name="cotizacion_id" value="<?php echo $cotizacion_id; ?>">
			<!--   cuadro  para el cliente -->
			<div class="row">
				<div class="col-sm-5">
					<div class="well well-sm">
						<div class="row">
							<label for="" class="control-label col-sm-3">Empresa</label>
							<div class="col-sm-9">
								<select name="empresas_id" class="js-validation-plus" data-rule-required="true" class="form-control" id="empresas_id">
									<option  value="" >Selecciona</option>
									 <?php _helper_select($empresas);?>
								</select>
							</div>
						</div>
						<div class="row">
							<label for="" class="control-label col-sm-3">Contacto</label>
							<div class="col-sm-9">
								<select name="clientes_id" data-rule-required="true" class="js-select2" class="form-control" id="clientes_id">
									<option value="">Seleccione el contacto</option>
								</select>
							</div>
						</div>

						 <div id="js-info-cliente"></div>
					</div>
				</div>
				<div class="col-sm-7">
					<div class="well well-sm">
						<div class="row">
							<div class=" col-sm-6">
								<label for="" class="control-label col-sm-7">Unidad Monetaria</label>
								<div class="col-sm-5"><select name="moneda_id" id="moneda_id" class="" >

									 <?php _helper_select($monedas);?>
								</select></div>
							</div>
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Incoterms </label>
								<div class="col-sm-5"><select name="incoterms_id" id="incoterms_id" class=" ">
									 <?php _helper_select($incoterms);?>
								</select></div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Término de Pago</label>
								<div class="col-sm-5">
									<select name="terminospago_id" id="terminospago_id" class="" >
									 <?php _helper_select($terminospago);?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Plazo</label>
								<div class="col-sm-5">
									<select name="plazo_id" id="plazo_is" class="" >
										 <?php _helper_select($plazo);?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Tiempo de Entrega</label>
								<div class="col-sm-5">
									<select name="tiemposentrega_id" id="tiemposentrega_id" class="" >
										 <?php _helper_select($tiemposentrega);?>
									</select>
								</div>
							</div>
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Validez</label>
								<div class="col-sm-5">
									<select name="validezpropuesta_id" id="validezpropuesta_id" class="" >
										 <?php _helper_select($validezpropuesta);?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<label for="" class="control-label col-sm-7">Lugar de Entrega</label>
								<div class="col-sm-5">
									<input type="text" required name="lugar_entrega">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- -->
			<!--  productos -->
			<div class="productos-list">
				<div class="row">
					<div class="col-sm-12">
						<a href="javascript:add()" class="btn btn-primary">Agregar nuevo producto</a>
					</div>
				</div>
				<br>
				<table id="tabla_productos" class="table table-condensed table-striped">
					<thead>
						<tr>
							<th class="c1"></th>
							<th width="10%" class="c2">QTY</th>

							<th class="c4">DESCRIPCION
							</th>

							<th class="c6">MARCADO							</th>
							<th class="c7">ENTREGA							</th>
							<th class="c8">P.U							</th>
							<th class="c9">TOTAL							</th>
						</tr>
					</thead>
					<tbody>
						<tr> <td class="point-error"><a href="javascript:void(0);" class="btn-tr-delete btn btn-danger btn-xs">
							<i class="fa fa-trash"></i>
						</a></td>
						<td  class="point-error"><input type="text" data-toggle="tooltip" data-rule-cantidadminima="true"   title=""  class=" fila-cantidad " id="cantidad_0" data-rule-required="true" name="cantidad[0]"></td>

						<td  class="point-error"><select name="producto_id[0]" id="producto_id_0"  class=" fila-producto-id  js-select2-form not-load" data-url="<?php echo site_url("productos/get_ajax"); ?>"></select></td>

						<td  class="point-error"><select name="marcado[0]"  id="marcado_0"  class=" fila-marcado   ">
							<option value="">-</option>
							<?php _helper_select($marcado);?>
						</select></td>
						<td  class="point-error"><select name="entrega[0]" id="entrega_0"   class="  fila-entrega   ">
							<option value="">-</option>
							<?php _helper_select($tiemposentrega);?>
						</select></td>
						<td><span class="fila-precio"></span></td>
						<td><span class="fila_total"></span></td>
					</tr>
				</tbody>
				<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th></th>


					<th></th>
					<th>Subtotal</th>
					<th></th>
					<th><span id="subtotal"></span></th>
				</tr>
				<tr>
					<th></th>
					<th></th>


					<th></th>
					<th></th>
					<th>Impuesto</th>
					<th><select name="impuesto" id="impuesto" data-rule-required="true">
						<option value="">-</option>

					<?php _helper_select($impuesto);?>

				</select></th>
					<th></th>
				</tr>
				<tr>
					<th></th>
					<th></th>


					<th></th>
					<th></th>
					<th>Total</th>
					<th></th>
					<th><span id="total"></span></th>
				</tr>
				</tfoot>
			</table>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<button class="btn btn-success btn-cotizacion-save" type="submit"> Guardar </button>
				<button class="btn btn-default btn-cotizacion-preview"  <?PHP if ($cotizacion_id <= 0) {echo "disabled";}?> type="button" > Previsualizar </button>
				<button class="btn btn-primary btn-cotizacion-send "  <?PHP if ($cotizacion_id <= 0) {echo "disabled";}?> type="button"> Enviar por email</button>

				<a href="<?php echo site_url("cotizacion/index"); ?>" class="btn btn-primary ">Volver</a>
			</div>
		</div>
	</form>
</div>
</div>
<script>
	 var contador=100;

	function add()

	{ console.log("add...");
	 contador++;

	 	var _tr='	<tr> <td><a href="javascript:void(0);" class="btn btn-tr-delete  btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>'+
					'<td   class="point-error"><input data-toggle="tooltip" title=""  data-rule-cantidadminima="true"  type="text" class="fila-cantidad" id="cantidad_'+contador+'" data-rule-required="true" name="cantidad['+contador+']"></td>'+

					'<td  class="point-error"><select name="producto_id['+contador+']"   id="producto_id_'+contador+'"   class="fila-producto-id js-select2-form not-load "></select></td>'+

					'<td  class="point-error"><select name="marcado['+contador+']"     id="marcado-'+contador+'"  class="fila-marcado" >'+jQuery(".fila-marcado:first-child").html()+'</select></td>'+
					'<td  class="point-error"><select name="entrega['+contador+']"    id="entrega-'+contador+'"  class="fila-entrega" >'+jQuery(".fila-entrega:first-child").html()+'</select></td>'+
					'<td><span class="fila-precio"></span></td>'+
					'<td><span class="fila_total"></span></td>'+
				'</tr>';
		jQuery("#tabla_productos tbody").append(_tr);
		_helper_trigger('custom__new_line');
	}
</script>