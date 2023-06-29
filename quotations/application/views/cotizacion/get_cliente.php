<?php if (count($cliente) > 0): ?>

	 
	<?php foreach ($cliente as $key => $value): ?>
	 

	 <div class="row">
	 	<label for="" class="control-label col-sm-3">RUC</label>
	 	<div class="col-sm-9  "> <?php  echo $value['ruc']; ?></div>
	 </div>
	 	 <div class="row">
	 	<label for="" class="control-label col-sm-3">Nombre</label>
	 	<div class="col-sm-9  "> <?php  echo $value['nombre']; ?> / <?php  echo $value['email']; ?> / <?php  echo $value['telefono']; ?></div>
	 </div>

	 	 

	 	 	 <div class="row">
	 	<label for="" class="control-label col-sm-3">Dirección</label>
	 	<div class="col-sm-9  "> <?php  echo $value['direccion']; ?></div>
	 </div>


	 	 <div class="row">
	 	<label for="" class="control-label col-sm-3">Marca</label>
	 	<div class="col-sm-9   "> <?php  echo $value['marca']; ?></div>
	 </div>


<?php endforeach?>

<?php else: ?>
	 --
<?php endif?>