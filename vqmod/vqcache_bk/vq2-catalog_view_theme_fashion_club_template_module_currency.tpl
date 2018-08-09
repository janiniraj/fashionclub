<!--<style>
/*Initialize*/
#currency ul, #currency ul ul.sub-menu {
padding:0;
margin: 0;
z-index: 30;
}
#currency ul li, #currency ul ul.sub-menu li {
list-style-type: none;
display: block;
}
/*Link Appearance*/
#currency ul li a, #currency ul li ul.sub-menu li a {
text-decoration: none;
color: #fff;
background: #666;
padding: 5px;
display:block;
}
/*Make the parent of sub-menu relative*/
#currency ul li {
position: relative;
}
/*sub menu*/
#currency ul li ul.sub-menu {
display:none;
position: absolute;
top: 30px;
left: 0;
width: 100px;
}
#currency ul li:hover ul.sub-menu {
display: block;
z-index: 30;
}
</style>

				
<?php if (count($currencies) > 1) { ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		<div id="currency" style="left:415px;"><span style="margin-bottom:5px;"><?php echo $text_currency; ?>: </span>
			<select style="margin-top:7px;" id="currencies" name="currencies" onChange="$('input[name=\'currency_code\']').attr('value', $('#currencies option:selected').val()
).submit(); $(this).parent().parent().submit();">
			<?php foreach ($currencies as $currency) { ?>
            	<?php if ($currency['code'] == $currency_code) { ?>
                    	<option class="option" selected value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
            	<?php }else{  ?>
                    	<option class="option" value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
				<?php } ?>
            <?php } ?>
            </select>
            <input type="hidden" name="currency_code" value="" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		</div>
	</form>
<?php } ?>
				
			
























	</ul>
  </div>
</form>
<?php } ?>-->
<!--

				
<?php if (count($currencies) > 1) { ?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		<div id="currency" style="left:415px;"><span style="margin-bottom:5px;"><?php echo $text_currency; ?>: </span>
			<select style="margin-top:7px;" id="currencies" name="currencies" onChange="$('input[name=\'currency_code\']').attr('value', $('#currencies option:selected').val()
).submit(); $(this).parent().parent().submit();">
			<?php foreach ($currencies as $currency) { ?>
            	<?php if ($currency['code'] == $currency_code) { ?>
                    	<option class="option" selected value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
            	<?php }else{  ?>
                    	<option class="option" value="<?php echo $currency['code']; ?>"><?php echo $currency['title']; ?></option>
				<?php } ?>
            <?php } ?>
            </select>
            <input type="hidden" name="currency_code" value="" />
            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		</div>
	</form>
<?php } ?>
				
			
























