<form  action="<?php  echo site_url("user_settings/save_facturacion_info"); ?>" method="post" class="form-horizontal js-validation-simple"> 
<?php 	 $obj=_get_facturacion_info(); 

// echo var_dump($obj);
?>
<div class="form-group">
	<label for="" class="control-label col-sm-3">
		Dirección de facturación
	</label>
	 <div class="col-sm-9">
	 	<input type="text" name="facturacion[direccion]" data-rule-required="true" value="<?php _v($obj,'direccion'); ?>" class="form-control">
	 </div>
</div>

  <div class="form-group">
  	<div class="col-sm-12">
  		<button class="btn btn-primary btn-block">Guardar  </button>
  	</div>
  </div>

  <!-- -->
  <input type="hidden"   name="facturacion[id]" value="<?php _v($obj,'id'); ?>">
  <input type="hidden"   name="facturacion[tutores_id]" value="<?php _v($obj,'tutores_id'); ?>">
  <?php _token(); ?>

</form>