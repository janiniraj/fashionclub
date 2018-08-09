<?php if (count($currencies) > 1) { ?>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
  <div id="currency"><?php echo $text_currency; ?><br />
    <?php foreach ($currencies as $currency) { ?>
    <?php if ($currency['code'] == $currency_code) { ?>
    <?php if ($currency['symbol_left']) { ?>
    <a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_left']; ?></b></a>
    <?php } else { ?>
    <a title="<?php echo $currency['title']; ?>"><b><?php echo $currency['symbol_right']; ?></b></a>
    <?php } ?>
    <?php } else { ?>
    <?php if ($currency['symbol_left']) { ?>
    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_left']; ?></a>
    <?php } else { ?>
    <a title="<?php echo $currency['title']; ?>" onclick="$('input[name=\'currency_code\']').attr('value', '<?php echo $currency['code']; ?>'); $(this).parent().parent().submit();"><?php echo $currency['symbol_right']; ?></a>
    <?php } ?>
    <?php } ?>
    <?php } ?>
    <input type="hidden" name="currency_code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  </div>
</form>
<?php } ?>

<?php if (count($currencies) > 1) { ?>
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
  <div id="currency">
  <?php $a = 0; foreach ($currencies as $currency) { $thisCurTitle[$a] = $currency['title']; $thisCurCode[$a] = $currency['code']; if ($currency['symbol_left']) { $thisCurSymb[$a] = $currency['symbol_left']; } else { $thisCurSymb[$a] = $currency['symbol_right']; } $a++; } ?>
<select name="curselect" onchange="$('input[name=\'currency_code\']').attr('value', this.options[this.selectedIndex].value).submit(); $(this).parent().parent().submit();">
<?php for ($z = 0; $z <= $a - 1; $z++) { ?>
<?php if ($thisCurCode[$z] == $currency_code) { ?>
<option value="<?php echo $thisCurCode[$z]; ?>" selected><?php echo $thisCurTitle[$z]; ?>&nbsp;&nbsp;<?php echo $thisCurSymb[$z]; ?></option>
<?php } else { ?>
<option value="<?php echo $thisCurCode[$z]; ?>"><?php echo $thisCurTitle[$z]; ?>&nbsp;&nbsp;<?php echo $thisCurSymb[$z]; ?></option>
<?php } ?>
<?php } ?>
    <input type="hidden" name="currency_code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  </div>
</form>
<?php } ?>