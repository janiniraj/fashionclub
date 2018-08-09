<h2><?php echo $text_instruction; ?></h2>
<div class="content">

  <p>
  <?php echo $text_description; ?>
  <br />
  <form action="https://www.maybank2u.com.my/mbb/m2u/m1105/m2uM2UPayLogin.do" name="m2uPayForm" method="post" target="m2uPay">
<input type="hidden" name="sendString" value="<?php echo $bank; ?>" />
<input name="ticket" type="image" src="image/data/payment/maybank2upay-square.png" width="80" height="72" onclick="openM2UPay();" value="m2u pay">
</form>
<script type="text/javascript">function openM2UPay(){window.open('','m2uPay','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=70,height=70');document.m2uPayForm.submit();}</script>
  <br /><br />
  <?php echo $bankinfo; ?>
  </p>  

<p><?php echo $text_payment; ?></p>  
</div>
<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
  </div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({ 
		type: 'get',
		url: 'index.php?route=payment/bank_transfer_maybank2upay/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}		
	});
});
//--></script> 
