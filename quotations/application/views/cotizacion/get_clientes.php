<?php if (count($clientes) > 0): ?>

	 <option value="">Seleccione </option>
	<?php foreach ($clientes as $key => $value): ?>
	 <option value="<?php echo $value['clientes_id']; ?>"><?php echo $value['nombre'] ?></option>
<?php endforeach?>

<?php else: ?>
	<option value="">No existen contactos</option>
<?php endif?>