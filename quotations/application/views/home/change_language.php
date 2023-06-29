<div class="white-area-content">
<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_146") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"><?php echo lang("ctn_146") ?></li>
</ol>

<p><?php echo lang("ctn_147") ?></p>

<hr>

	<div class="panel panel-default">
  	<div class="panel-body">
  	<?php echo form_open(site_url("home/change_language_pro"), array("class" => "form-horizontal")) ?>
			<div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang("ctn_148") ?></label>
			    <div class="col-sm-10">
			      <select name="language" class="form-control">
			      <?php foreach($languages as $k=>$v) : ?>
			      	<option value="<?php echo $k ?>" <?php if($k == $user_lang) echo "selected" ?>><?php echo $v['display_name'] ?></option>
			      <?php endforeach; ?>
			      </select>
			    </div>
			</div>
			 <input type="submit" name="s" value="<?php echo lang("ctn_146") ?>" class="btn btn-primary form-control" />
    <?php echo form_close() ?>
    </div>
    </div>
    </div>