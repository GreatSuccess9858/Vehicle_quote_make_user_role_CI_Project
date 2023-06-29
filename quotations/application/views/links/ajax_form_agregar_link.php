<form data-trigger="custom__reload_table_links" role="form" class="js-validation-plus" method="post" action="<?php echo site_url("links/ajax_agregar_link"); ?>">

	<div class="form-group">
		<label for="usrname"><span class="glyphicon glyphicon-user"></span> SKU</label>
		<input type="text" class="form-control" data-rule-required="true" id="codigo" name="codigo" placeholder="Codigo del producto">
	</div>



	<div class="form-group">
		<label for="usrname"><span class="glyphicon glyphicon-user"></span> Nombre del producto</label>
		<input type="text" class="form-control" data-rule-required="true" id="nombre" name="nombre" placeholder="Nombre del producto">
	</div>
	<div class="form-group">
		<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Producto San Pablo</label>
	<select style="width:100%" name="base_sanpablo_id" data-url="<?php echo site_url("bases/index/base_sanpablo"); ?>" class="ajax_select2_sites base_sanpablo_id form-control" id="base_sanpablo_id"></select>
</div>
<div class="form-group">
	<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Producto Farma Ahorro</label>
<select style="width:100%" name="base_fahorro_id" data-url="<?php echo site_url("bases/index/base_fahorro"); ?>" class="ajax_select2_sites form-control" id="base_fahorro_id"></select>
</div>
<div class="form-group">
<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Producto Farmatodo</label>
<select style="width:100%" name="base_farmatodo_id" data-url="<?php echo site_url("bases/index/base_farmatodo"); ?>" class=" ajax_select2_sites form-control" id="base_farmatodo_id"></select>
</div>
<div class="form-group">
<label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Producto Superama</label>
<select style="width:100%" name="base_superama_id" data-url="<?php echo site_url("bases/index/base_superama"); ?>" class="ajax_select2_sites form-control" id="base_superama_id"></select>
</div>
<div class="form-group">
<label for="psw">
<span class="glyphicon glyphicon-eye-open"></span> Producto Farma Lacomer
</label>
<select style="width:100%" name="base_lacomer_id" data-url="<?php echo site_url("bases/index/base_lacomer"); ?>" class="ajax_select2_sites form-control" id="base_lacomer_id"></select>
</div>
<button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Agregar  producto</button>
<input type="hidden" name="proyectos_id" value="<?php echo $proyectos_id; ?>">
<?php _token();?>
 <button type="reset" class="hidden" id="reset"></button>
</form>