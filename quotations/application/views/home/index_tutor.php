<div class="white-area-content">
	<div class="row">
		<div class="col-md-3">
			<a href="<?php echo site_url("instancias/crear"); ?>">
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
				<?php foreach ($instancias as $k => $v): ?>
				<div class="col-sm-3">
					<div class="panel panel-instancia  panel-<?php echo _status_instancia_label($v['status']); ?>">
						<div class="panel-heading text-left">
							<span class="pull-left">Instancia # <?php echo $v['id']; ?></span>
							<label for=""  class="label pull-right  label-<?php echo _status_instancia_label($v['status']); ?>">
							<?php echo _status_instancia($v['status']); ?></label>
							<div class="clearfix"></div>
						</div>
						<div class="panel-body">
							<h3>
							<span class="badge">
								<?php echo $v['total_alumnos']; ?>
							</span>
							Alumnos registrados
							</h3>
							<div class="text-center">
								<span> <i class="far fa-money-bill-alt"></i> <?php echo $v['monto']; ?></span>
							</div>
							<div class="text-center">
								<span>
									<i class="far fa-calendar-alt"></i>
								<?php echo date("Y/m/d", strtotime($v['fecha'])); ?></span>
							</div>
						</div>
						<div class="panel-footer">

							 <a href="<?php echo site_url("instancias/ver_instancia/" . $v['id']); ?>" class="btn btn-info btn-sm btn-block"> Detalles </a>
						</div>
					</div>
				</div>
				<?php endforeach?>
				<div class="clearfix"></div>
			</div>
			<div class="block-area">
				<?php echo lang("ctn_326") ?> <b><?php echo date($this->settings->info->date_format, $this->user->info->online_timestamp); ?></b>
			</div>
		</div>
	</div>
</div>