<form  action="<?php  echo site_url("user_settings/save_colegios_info"); ?>" method="post" class="form-horizontal js-validation-simple with-padding"> 
<?php 	 $obj=_get_colegios_info(); 

// echo var_dump($obj);
?>
<div class="form-group">
	<label for="" class="control-label col-sm-3">
		Nombre del centro educativo
	</label>
	 <div class="col-sm-9">
	 	<input type="text" name="colegios[nombres]" data-rule-required="true" value="<?php _v($obj,'nombres'); ?>" class="form-control">
	 </div>
</div>
<div class="form-group">
	<label for="" class="control-label col-sm-3">
		Dirección de facturación
	</label>
	 <div class="col-sm-9">
	 	<input type="text" name="colegios[direccion]" data-rule-required="true" value="<?php _v($obj,'direccion'); ?>" class="form-control">
	 </div>
</div>
<div class="form-group">
	<label for="" class="control-label col-sm-3">
		Teléfono
	</label>
	 <div class="col-sm-9">
	 	<input type="text" name="colegios[telefono]"   value="<?php _v($obj,'telefono'); ?>" class="form-control">
	 </div>
</div>

<div class="form-group">
	<label for="" class="control-label col-sm-3">
		Email de contacto
	</label>
	 <div class="col-sm-9">
	 	<input type="text" name="colegios[email_contacto]"   value="<?php _v($obj,'email_contacto'); ?>" class="form-control">
	 </div>
</div>

<div class="form-group">
	<label for="" class="control-label col-sm-3">
		
	</label>
	 <div class="col-sm-9">

	 	<input type="checkbox" name="colegios[datos_publicos]" id="datos_publicos"  <?php 

	 		 if(_v($obj,'datos_publicos',true)==1){
	 		 	 echo "checked";
	 		 }

	 	 ?> value="1" >
	 	 <label for="datos_publicos">
	 	 	Acepto que los datos del centro educativo sean publicados en
este sitio web
	 	 </label>
	 </div>
</div>



  <div class="form-group">
  	<div class="col-sm-12">
  		<button class="btn btn-primary btn-block">Guardar  </button>
  	</div>
  </div>

  <!-- -->
  <input type="hidden"   name="colegios[id]" value="<?php _v($obj,'id'); ?>">
  <input type="hidden"   name="colegios[tutores_id]" value="<?php _v($obj,'tutores_id'); ?>">
  <?php _token(); ?>

</form>