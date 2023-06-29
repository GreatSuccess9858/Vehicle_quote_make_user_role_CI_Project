<div id="responsive-menu-links">
          <select name='link' OnChange="window.location.href=$(this).val();" class="form-control">


 <option value='<?php echo site_url() ?>'><?php echo lang("ctn_154") ?></option>
          



             <option value='<?php echo site_url("cotizacion/index") ?>'><?php echo _l("Cotizacion") ?></option>

              <option value='<?php echo site_url("cotizacion/operacion") ?>'><?php echo _l("Agregar Cotización") ?></option>

<?php if (_is_admin()): ?>
 <option value='<?php echo site_url("config/vehiculos") ?>'><?php echo _l("Vehiculos") ?></option>  
<?php endif ?>


         

          <option value='<?php echo site_url("members") ?>'><?php echo lang("ctn_155") ?></option>
          <option value='<?php echo site_url("user_settings") ?>'><?php echo lang("ctn_156") ?></option>


          


          <?php if ($this->user->loggedin && isset($this->user->info->user_role_id) &&
	($this->user->info->admin || $this->user->info->admin_settings || $this->user->info->admin_members || $this->user->info->admin_payment)

): ?>
           <?php if ($this->user->info->admin || $this->user->info->admin_settings): ?>
            <option value='<?php echo site_url("admin/settings") ?>'><?php echo lang("ctn_158") ?></option>
            
            <?php endif;?>




            <?php if ($this->user->info->admin || $this->user->info->admin_members): ?>
            <option value='<?php echo site_url("admin/members") ?>'><?php echo lang("ctn_160") ?></option>
            
            <option value='<?php echo site_url("admin/custom_fields") ?>'> <?php echo lang("ctn_346") ?></option>
           
            <option value='<?php echo site_url("admin/user_logs") ?>'><?php echo lang("ctn_471") ?></option>
            <?php endif;?>
            <?php if ($this->user->info->admin): ?>
            <option value='<?php echo site_url("admin/user_roles") ?>'><?php echo lang("ctn_316") ?></option>
            <?php endif;?>
            <?php if ($this->user->info->admin || $this->user->info->admin_members): ?>
            <option value='<?php echo site_url("admin/user_groups") ?>'><?php echo lang("ctn_161") ?></option>
            <option value='<?php echo site_url("admin/ipblock") ?>'><?php echo lang("ctn_162") ?></option>
            <?php endif;?>
            <?php if ($this->user->info->admin && false): ?>
            <option value='<?php echo site_url("admin/email_templates") ?>'><?php echo lang("ctn_163") ?></option>
            <?php endif;?>
            <?php if ( ( $this->user->info->admin || $this->user->info->admin_members ) && false): ?>
            <option value='<?php echo site_url("admin/email_members") ?>'><?php echo lang("ctn_164") ?></option>
            <?php endif;?>
            <?php if (( $this->user->info->admin || $this->user->info->admin_payment) && false ): ?>
            <option value='<?php echo site_url("admin/payment_settings") ?>'><?php echo lang("ctn_246") ?></option>
            <option value='<?php echo site_url("admin/payment_plans") ?>'><?php echo lang("ctn_258") ?></option>
            <option value='<?php echo site_url("admin/payment_logs") ?>'><?php echo lang("ctn_288") ?></option>
            <option value='<?php echo site_url("admin/premium_users") ?>'><?php echo lang("ctn_325") ?></option>
            <?php endif;?>
          <?php endif;?>
         
          <?php if ($this->settings->info->payment_enabled && false): ?>
          <option value='<?php echo site_url("funds") ?>'><?php echo lang("ctn_245") ?></option>
          <option value='<?php echo site_url("funds/plans") ?>'><?php echo lang("ctn_273") ?></option>
          <?php endif;?>
          <!--
          <option value='<?php echo site_url("test/restricted_admin") ?>'><?php echo lang("ctn_167") ?></option>
          <option value='<?php echo site_url("test/restricted_group") ?>'><?php echo lang("ctn_168") ?></option>
          <option value='<?php echo site_url("test/restricted_user") ?>'><?php echo lang("ctn_169") ?></option>
        -->
          <!--
          <option value='<?php echo site_url("test/restricted_premium") ?>'><?php echo lang("ctn_289") ?></option>
        -->
          </select>
</div>