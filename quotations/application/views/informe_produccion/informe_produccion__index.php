<div class="white-area-content">
	<div class="db-header clearfix">
		<div class="page-header-title"> <span class="glyphicon glyphicon-check  "></span>
		Informe de producción
	</div>
	<div class="db-header-extra">
	</div>
</div>
<form method="post"  action="<?php echo site_url("informe_produccion/index"); ?>" class="form-horizontal js-validation">
	<div class="row">

		<div class="col-sm-3">
			<label for="" class="col-sm-3 control-label">Año</label>
			<div class="col-sm-9">
				<select class="form-control" name="anio" id="anio" data-rule-required="true">
					<option value="">Seleccione</option>
					<?php for ($i = date("Y"); $i > 2018; $i--) {
	$selected = '';
	if ($anio == $i) {$selected = 'selected';}
	?>
					<option <?php echo $selected; ?> value="<?php echo $i; ?>"> <?php echo $i; ?></option>
					<?PHP
}?>
				</select>
			</div>
		</div>
		<div class="col-sm-3">
			<label for="" class="col-sm-3 control-label">Mes</label>
			<div class="col-sm-9">
				<select name="mes" id="mes" class="form-control">
					<option value="">Todos</option>
					<option value="1" <?php echo ($mes == 1) ? 'selected' : ''; ?> >Enero</option>
					<option value="2"  <?php echo ($mes == 2) ? 'selected' : ''; ?>  >Febrero</option>
					<option value="3"  <?php echo ($mes == 3) ? 'selected' : ''; ?> >Marzo</option>
					<option value="4"  <?php echo ($mes == 4) ? 'selected' : ''; ?> >Abril</option>
					<option value="5"  <?php echo ($mes == 5) ? 'selected' : ''; ?> >Mayo</option>
					<option value="6"  <?php echo ($mes == 6) ? 'selected' : ''; ?> >Junio</option>
					<option value="7"  <?php echo ($mes == 7) ? 'selected' : ''; ?> >Julio</option>
					<option value="8"  <?php echo ($mes == 8) ? 'selected' : ''; ?> >Agosto</option>
					<option value="9"  <?php echo ($mes == 9) ? 'selected' : ''; ?> >Setiembre</option>
					<option value="10"  <?php echo ($mes == 10) ? 'selected' : ''; ?> >Octubre</option>
					<option value="11" <?php echo ($mes == 11) ? 'selected' : ''; ?> >Noviembre</option>
					<option value="12" <?php echo ($mes == 12) ? 'selected' : ''; ?> >Diciembre</option>
				</select>
			</div>
		</div>
			<div class="col-sm-4">
			<label for="" class="control-label col-sm-3">Vendedor</label>
			<div class="col-sm-9">
				<select style=" " name="vendedor_id" class="form-control" id="vendedor_id">
					<option value="">Todos</option>
					<?php foreach ($vendedores as $k => $v): ?>
					<?php
$selected = '';
if ($users_id == $v['ID']) {$selected = 'selected';}?>
					<option <?php echo $selected; ?> value="<?php echo $v['ID']; ?>"> <?php echo $v['first_name']; ?> <?php echo $v['last_name']; ?>
						(<?php echo $v['email']; ?>)
					</option>
					<?php endforeach?>
				</select>
			</div>
		</div>
		<div class="col-sm-2">
			<button class="btn btn-primary" type="submit">Mostrar</button>
		</div>
	</div>
	<?php _token();?>
</form>
 <hr>
  <?php

/* recorriendo para poder agurpar en año y fecha */

$all = array();
 

	foreach ($proyectos as $k => $v) {
		$all[$v['year']][$v['month']][] = $v;
	}

 
 
?>
<div class="row">
	<div class="col-sm-12">
		  <?php if (count($all)>0): ?>
		  	 <?php foreach ($all as $year => $month_array): ?>

		  	 	 <?php foreach ($month_array as $month => $proyectos): ?>

		  	 	 	 <caption>
		  	 	 	 	<h2> <?php  echo $year; ?>/ <?php  echo $month; ?></h2>
		  	 	 	 </caption>
		  	 	 	<table id="table-informe-ventas" class="table table-sm table-bordered table-responsive table-condensed table-striped">
			<thead>
				<tr><th>Status</th>
					<th> Usuario </th>
					<th>Proyecto</th>

					<th>F.Entrada</th>
					<th>F.Produccion</th>
					<th>F.Entrega</th>
					<th>Arte</th>
					<th>Mercancia</th>
					<th>Insumos</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($proyectos) && count($proyectos) > 0): ?>
				<?php foreach ($proyectos as $k => $v): ?>
				<tr class="<?php echo _status_proyecto_color($v['status_row']); ?>">
					<th>
							 <div class=" text-center text-<?php echo _status_proyecto_color($v['status_row']); ?>">
							 	<?php _helper_tt('', _status_proyecto($v['status_row']), 'fa-circle');?>
							 </div>

						</th>
					<td><?php echo $v['user_created_info']; ?></td>
					<td><?php echo $v['nombre']; ?></td>

					<td class="text-right"><?php echo ($v['fecha_entrada']); ?></td>
					<td class="text-right"><?php echo ($v['fecha_produccion']); ?></td>
					<td class="text-right"><?php echo ($v['fecha_entrega']); ?></td>
					<td class="text-right"><?php echo ((int) $v['arte_aprobado'] == 1) ? 'Si' : 'No'; ?></td>
					<td class="text-right"><?php echo ((int) $v['mercancia_comprada'] == 1) ? 'Si' : 'No'; ?></td>
					<td class="text-right"><?php echo ((int) $v['insumos_comprados'] == 1) ? 'Si' : 'No'; ?></td>
					<!-- <td>
						<?php
						$margen = bcsub($v['total'], $v['monto_oc'], 4);
						$margen = bcsub($margen, $v['comision_total'], 4);
						$margen_porcentaje = round(($v['total'] / $margen) * 100, 2);
						?>
												<?php
						_helper_tt($margen_porcentaje . ' %', '[total/( Total- (monto oc+comision) )]*100%');
						?>
											</td>
											-->
				</tr>
				<?php endforeach?>
				<?php endif?>
			</tbody>
		</table>
		  	 	 <?php endforeach ?>
		  	 	
		  	 <?php endforeach ?>
		  	
		  <?php endif ?>
		
	</div>
</div>
</div>