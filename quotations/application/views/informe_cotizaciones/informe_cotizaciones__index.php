<div class="white-area-content">
	<div class="db-header clearfix">
		<div class="page-header-title"> <span class="glyphicon glyphicon-check  "></span>
		Informe de cotizaciones
	</div>
	<div class="db-header-extra">
	</div>
</div>
<form method="post" action="" class="form-horizontal  js-validation">
	<div class="row ">
		<div class="box-filters">
			<div class="col-sm-3">
				<label for=""  class="control-label col-sm-3">Año</label>
				<div class="col-sm-9">
					<select name="anio" id="anio" class="form-control " data-rule-required="true">
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
				<label for="" class="control-label col-sm-3">Mes</label>
				<div class="col-sm-9">

					<select name="mes" class="form-control" id="mes">
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

					<select name="vendedor" class="form-control" id="vendedor">
						<option value="">Todos</option>
						  <?php
if (isset($vendedores) && count($vendedores) > 0) {

	?>
		 	 <?php foreach ($vendedores as $k => $v): ?>
		 	 	<?php
$selected = '';
	if ($users_id == $v['ID']) {$selected = 'selected';}?>


				<option <?php echo $selected; ?> value="<?php echo $v['ID']; ?>"> <?php echo $v['first_name']; ?> <?php echo $v['last_name']; ?>
					(<?php echo $v['email']; ?>)
			</option>
		 	 <?php endforeach?>
						  	<?PHP
}?>
					</select>
				</div>
			</div>
			<div class="col-sm-2">
				<button class="btn btn-primary" type="submit">Mostrar</button>
			</div>
		</div>
	</div>
	<?php _token();?>
</form>
<hr>
<?php
$all = array();
if (count($cotizaciones) > 0) {
	foreach ($cotizaciones as $k => $v) {
		$all[$v['year']][$v['month']][] = $v;
	}
}
?>
<div class="row">
	<div class="col-sm-12">
		<?php foreach ($all as $year => $month): ?>

		<?php foreach ($month as $m => $cotizaciones): ?>
			 <caption> <h3><?php  echo $year; ?> /  <?php  echo $m; ?></h3> </caption>
		<table id="table-<?PHP echo $m; ?>" class="table table-cotizaciones table-bordered  table-condensed table-striped table-hovere">
			<thead>
				<tr>
					<th></th>
					<th colspan="5" class="text-center"> Cotizaciones </th>
				</tr>
				<tr>
					<th class="apply-filter" >Nombres</th>
					<th class="text-right">Importe total</th>
					<th class="text-center">Pendientes</th>
					<th class="text-center">Aprobados</th>
					<th class="text-center">Rechazados</th>
					<th class="text-center">Total</th>

				</tr>
			</thead>
			<tbody>
				<?php foreach ($cotizaciones as $k => $v): ?>
				<tr>
					<td> <?php echo $v['vendedor']; ?> </td>
					<td class="text-right"> <?php  echo _numero($v['importe_total']); ?></td>
					<td class="text-center"> <?php echo $v['pendiente']; ?></td>
					<td class="text-center">  <?php echo $v['aprobado']; ?> </td>
					<td class="text-center">  <?php echo $v['rechazado']; ?> </td>
					<td class="text-center">  <?php echo $v['total']; ?> </td>
				</tr>
				<?php endforeach?>
			</tbody>
		</table>
		<?php endforeach?>


		<?php endforeach?>
	</div>
	<!-- 
	<div class="col-sm-5">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>

-->
</div>
</div>