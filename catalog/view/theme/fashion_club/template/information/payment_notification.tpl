<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>

  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  
  <h1><?php echo $heading_title; ?></h1>
  
  
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="payment_notification">
  
    
    <div class="content" style="background: #eee;">
    
    <h2><?php echo $heading_customerinfo; ?></h2>
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
	<b><?php echo $entry_name; ?></b>&nbsp;<span class="required">*</span> 
	</div>
    <div style="float: left; display: inline-block;"> 
	<input type="text" name="name" value="<?php echo $name; ?>" size="25"/>
    <br />
    <?php if ($error_name) { ?>
    <span class="error"><?php echo $error_name; ?></span>
    <?php } ?>
	</div></div>
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_email; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;"> 
    <input type="text" name="email" value="<?php echo $email; ?>" size="25"/>
    <br />
    <?php if ($error_email) { ?>
    <span class="error"><?php echo $error_email; ?></span>
    <?php } ?>
    </div></div>
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_tel; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;"> 
    <input type="text" name="tel" value="<?php echo $tel; ?>" size="25"/>
    <br />
    <?php if ($error_tel) { ?>
    <span class="error"><?php echo $error_tel; ?></span>
    <?php } ?>
    </div></div>
    
    <br /><br />
    
    <h2><?php echo $heading_paymentdetails; ?></h2>
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_orderid; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;">
    <input type="text" name="orderid" value="<?php echo $orderid; ?>" size="25"/>
    <br />
    <?php if ($error_orderid) { ?>
    <span class="error"><?php echo $error_orderid; ?></span>
    <?php } ?>
    </div></div>
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_amountpaid; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;">
    <input type="text" name="amountpaid" value="<?php echo $amountpaid; ?>" size="25"/>
    <br />
    <?php if ($error_amountpaid) { ?>
    <span class="error"><?php echo $error_amountpaid; ?></span>
    <?php } ?>
    </div></div>
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_paymentdate; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;">
    <input type="text" name="paymentdate" value="<?php echo $paymentdate; ?>" size="25" class="date"/>
    <br />
    <?php if ($error_paymentdate) { ?>
    <span class="error"><?php echo $error_paymentdate; ?></span>
    <?php } ?>
    </div></div>
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_paymentmethod; ?></b>&nbsp;<span class="required">*</span>
    </div>
    <div style="float: left; display: inline-block;">
    <select size="1" height="1" name="paymentmethod">
    <option value="0"><?php echo $entry_pleasechoose; ?></option>
    </select>
    <br />
	    <?php if ($error_paymentmethod) { ?>
    <span class="error"><?php echo $error_paymentmethod; ?></span>
    <?php } ?>	
	</div></div>

	<div style="display: inline-block; width: 100%;">
    <div style="float: left; display: inline-block; width: 150px;"> 
	<b><?php echo $entry_paymentinfo; ?></b>&nbsp;<span class="required">*</span>
	</div>
    <div style="float: left; display: inline-block;">
    <textarea name="paymentinfo" cols="40" rows="8"><?php echo $paymentinfo; ?></textarea>
    <br />
    <?php if ($error_paymentinfo) { ?>
    <span class="error"><?php echo $error_paymentinfo; ?></span>
    <?php } ?>
    </div></div>
    
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    <b><?php echo $entry_paymentupload; ?></b>&nbsp;<br />
    </div>
    <div style="float: left; display: inline-block;">
    <input type="file" name="paymentupload" id="paymentupload" />
    <br />
    <?php if ($error_paymentupload) { ?>
    <span class="error"><?php echo $error_paymentupload; ?></span>
    <?php } ?>
    <?php echo $text_fileformat; ?>
    <br /><?php echo $text_maxfilesize; ?>
    </div></div>
    

        

    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <div style="float: left; display: inline-block; width: 150px;"> 
    &nbsp;
    </div>
    <div style="float: left; display: inline-block;">
      <div class="left"><a onclick="$('#payment_notification').submit();" class="button">
	  <span><?php echo $button_submit; ?></span></a>
	  </div>
    </div></div>
    
    
    <div style="display: inline-block; width: 100%; line-height: 25px;">
    <span class="required"><?php echo $text_required; ?></span>&nbsp;
    </div>
    
    </div>

    
</form>
  
  <?php echo $content_bottom; ?></div>
  

<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'dd-mm-yy'});
	$('.datetime').datetimepicker({
		dateFormat: 'dd-mm-yy',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 
<?php echo $footer; ?>