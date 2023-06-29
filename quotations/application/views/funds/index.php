<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-piggy-bank"></span> <?php echo lang("ctn_250") ?></div>
    <div class="db-header-extra"> <a href="<?php echo site_url("funds/payment_log") ?>" class="btn btn-info btn-sm"><?php echo lang("ctn_388") ?></a>
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"><?php echo lang("ctn_250") ?></li>
</ol>

<p><?php echo lang("ctn_247") ?></p>

<p><?php echo lang("ctn_248") ?>: <?php echo number_format($this->user->info->points,2) ?></p>

<hr>

<p class="align-center"><img src="<?php echo base_url() ?>/images/paypal.png"></p>
		<center>
		<form method="post" action="https://www.paypal.com/cgi-bin/webscr" accept-charset="UTF-8" class="form-inline">
				<input type="hidden" name="charset" value="utf-8" />
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="item_number" value="funds01" />
				<input type="hidden" name="item_name" value="<?php echo $this->settings->info->site_name ?> <?php echo lang("ctn_250") ?>" />
				<input type="hidden" name="quantity" value="1" />
				<input type="hidden" name="custom" value="<?php echo $this->user->info->ID ?>" />
				<input type="hidden" name="receiver_email" value="<?php echo $this->settings->info->paypal_email ?>" />
				<input type="hidden" name="business" value="<?php echo $this->settings->info->paypal_email ?>" />
				<input type="hidden" name="notify_url" value="<?php echo site_url("IPN/process2") ?>" />
				<input type="hidden" name="return" value="<?php echo site_url("funds") ?>" />
				<input type="hidden" name="cancel_return" value="<?php echo site_url("funds") ?>" />
				<input type="hidden" name="no_shipping" value="1" />
				<input type="hidden" name="currency_code" value="<?php echo $this->settings->info->paypal_currency ?>"> 
				<input type="hidden" name="no_note" value="1" />
		<div class="input-group col-md-4">
		    <select name="amount" class="form-control">
		    <option value="5.00"><?php echo $this->settings->info->payment_symbol ?>5.00</option>
		    <option value="10.00"><?php echo $this->settings->info->payment_symbol ?>10.00</option>
		    <option value="30.00"><?php echo $this->settings->info->payment_symbol ?>30.00</option>
		    <option value="100.00"><?php echo $this->settings->info->payment_symbol ?>100.00</option>
		    </select>
		  </div>
		  <button type="submit" class="btn btn-primary"><?php echo lang("ctn_249") ?></button>
		</form>
		</center>

<?php if($stripe !==null)  : ?>
<hr>
<h3>Pay With Stripe</h3>
<p>You can also buy funds with Stripe, which accepts any major credit/debit card. None of your information is stored on this site.</p>

<div class="row">
<div class="col-md-4">
<form action="<?php echo site_url("IPN/stripe/1") ?>" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="500"
    data-label="Buy <?php echo $this->settings->info->payment_symbol ?>5.00 Credits"
    data-name="<?php echo $this->settings->info->payment_symbol ?>5.00 for <?php echo $this->settings->info->site_name ?>"
    data-description="Credits"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="<?php echo $this->settings->info->paypal_currency ?>">
  </script>
</form>
</div>
<div class="col-md-4">
<form action="<?php echo site_url("IPN/stripe/2") ?>" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="1000"
    data-label="Buy <?php echo $this->settings->info->payment_symbol ?>10.00 Credits"
    data-name="<?php echo $this->settings->info->payment_symbol ?>10.00 for <?php echo $this->settings->info->site_name ?>"
    data-description="Credits"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="<?php echo $this->settings->info->paypal_currency ?>">
  </script>
</form>
</div>
<div class="col-md-4">
<form action="<?php echo site_url("IPN/stripe/3") ?>" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="<?php echo $stripe['publishable_key']; ?>"
    data-amount="3000"
    data-label="Buy <?php echo $this->settings->info->payment_symbol ?>30.00 Credits"
    data-name="<?php echo $this->settings->info->payment_symbol ?>30.00 for <?php echo $this->settings->info->site_name ?>"
    data-description="Credits"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    data-zip-code="true"
    data-currency="<?php echo $this->settings->info->paypal_currency ?>">
  </script>
</form>
</div>
</div>

<?php endif; ?>

<?php if( !empty($this->settings->info->checkout2_accountno) && !empty($this->settings->info->checkout2_secret)) : ?>
<h3>2CHECKOUT</h3>
<img src="https://www.2checkout.com/upload/images/paymentlogoshorizontal.png" alt="2Checkout.com is a worldwide leader in online payment services" />
<div class="row">

    <div class="col-md-4">
        <form action='https://www.2checkout.com/checkout/purchase' method='post'>
                <input type='hidden' name='sid' value='<?php echo $this->settings->info->checkout2_accountno ?>' />
                <input type='hidden' name='mode' value='2CO' />
                <input type='hidden' name='li_0_type' value='product' />
                <input type='hidden' name='li_0_name' value='<?php echo $this->settings->info->payment_symbol ?>5.00 for <?php echo $this->settings->info->site_name ?>' />
                <input type='hidden' name='li_0_price' value='5.00' />
                <input type='hidden' name='x_receipt_link_url' value="<?php echo site_url("IPN/checkout2/1") ?>">
                <input type="hidden" name="currency_code" value="<?php echo $this->settings->info->paypal_currency ?>" />
                <input name='submit' type='submit' value='<?php echo lang("ctn_249") ?> <?php echo $this->settings->info->payment_symbol ?>5.00 Credits' />
                </form>
    </div>
    <div class="col-md-4">
        <form action='https://www.2checkout.com/checkout/purchase' method='post'>
                <input type='hidden' name='sid' value='<?php echo $this->settings->info->checkout2_accountno ?>' />
                <input type='hidden' name='mode' value='2CO' />
                <input type='hidden' name='li_0_type' value='product' />
                <input type='hidden' name='li_0_name' value='<?php echo $this->settings->info->payment_symbol ?>10.00 for <?php echo $this->settings->info->site_name ?>' />
                <input type='hidden' name='li_0_price' value='10.00' />
                <input type='hidden' name='x_receipt_link_url' value="<?php echo site_url("IPN/checkout2/2") ?>">
                <input type="hidden" name="currency_code" value="<?php echo $this->settings->info->paypal_currency ?>" />
                <input name='submit' type='submit' value='<?php echo lang("ctn_249") ?> <?php echo $this->settings->info->payment_symbol ?>10.00 <?php echo lang("ctn_350") ?>' />
                </form>
    </div>
    <div class="col-md-4">
        <form action='https://www.2checkout.com/checkout/purchase' method='post'>
                <input type='hidden' name='sid' value='<?php echo $this->settings->info->checkout2_accountno ?>' />
                <input type='hidden' name='mode' value='2CO' />
                <input type='hidden' name='li_0_type' value='product' />
                <input type='hidden' name='li_0_name' value='<?php echo $this->settings->info->payment_symbol ?>30.00 for <?php echo $this->settings->info->site_name ?>' />
                <input type='hidden' name='li_0_price' value='30.00' />
                <input type='hidden' name='x_receipt_link_url' value="<?php echo site_url("IPN/checkout2/3") ?>">
                <input type="hidden" name="currency_code" value="<?php echo $this->settings->info->paypal_currency ?>" />
                <input name='submit' type='submit' value='<?php echo lang("ctn_249") ?> <?php echo $this->settings->info->payment_symbol ?>30.00 <?php echo lang("ctn_350") ?>' />
                </form>
    </div>
</div>
<?php endif; ?>

</div>