<div class="white-area-content">
	<div class="row">
		<div class="col-md-3">
			<a href="<?php echo site_url("instancias/crear"); ?>" class="hidden">
				<div class="dashboard-window clearfix" style="background: #62acec; border-left: 5px solid #5798d1;">
					<div class="d-w-icon">
						<span class="glyphicon glyphicon-check giant-white-icon"></span>
					</div>
					<div class="d-w-text">
						Crear una instancia de inscripción
					</div>
				</div>
			</a>
		</div>
		<div class="hidden col-md-3">
			<div class="dashboard-window clearfix" style="background: #5cb85c; border-left: 5px solid #4f9f4f;">
				<div class="d-w-icon">
					<span class="glyphicon glyphicon-wrench giant-white-icon"></span>
				</div>
				<div class="d-w-text">
					<span class="d-w-num"><?php ?></span><br /><?php echo lang("ctn_137") ?>
				</div>
			</div>
		</div>
		<div class="hidden col-md-3">
			<div class="dashboard-window clearfix" style="background: #f0ad4e; border-left: 5px solid #d89b45;">
				<div class="d-w-icon">
					<span class="glyphicon glyphicon-folder-close giant-white-icon"></span>
				</div>
				<div class="d-w-text">
					<span class="d-w-num"><?php echo 0; ?></span><br /><?php echo lang("ctn_138") ?>
				</div>
			</div>
		</div>
		<div class="hidden col-md-3">
			<div class="dashboard-window clearfix" style="background: #d9534f; border-left: 5px solid #b94643;">
				<div class="d-w-icon">
					<span class="glyphicon glyphicon-user giant-white-icon"></span>
				</div>
				<div class="d-w-text">
					<span class="d-w-num"><?php echo 0; ?></span><br /><?php echo lang("ctn_139") ?>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<div class="block-area align-center">
				<h4 class="home-label">Instancias registradas</h4>

<table id="grid-data" class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th data-column-id="id" data-type="numeric">ID</th>
            <th data-column-id="referencia_pago">Referencia Pago</th>
             <th data-column-id="tutor_nombres" data-formatter="tutor_datos"    >Tutor</th>

            <th data-column-id="numero_alumnos" data-order="desc">#Alumnos</th>
            <th data-column-id="monto"  >Monto</th>
 <th data-column-id="usuario_nombres" data-formatter="usuario_datos"    >Gestor</th>
            <th data-column-id="status" data-formatter="status"  >Estado</th>
            <th data-column-id="id" data-formatter="link" data-sortable="false">Acciones</th>
        </tr>
    </thead>
</table>

				<div class="clearfix"></div>
			</div>
			<div class="block-area">
				<?php echo lang("ctn_326") ?> <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
			</div>
		</div>
	</div>
</div>