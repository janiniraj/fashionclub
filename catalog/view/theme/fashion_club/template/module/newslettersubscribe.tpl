<div class="newsletter">
	<div class="container">
  <!--<div class="box-heading"><?php echo $heading_title; ?></div>-->
  <div class="box-content subs">
  
  <?php 
   if($thickbox) { ?>
	<a href="#frm_subscribe" title="Newsletter Subscribe" class="fancybox_sub"> <?php echo($text_subscribe); ?> </a>
  <?php }  ?>
  <?php 
   if($thickbox) { ?> <div id="frm_subscribe_hidden" style="display:none;"> <?php } ?>
  <div id="frm_subscribe">
  <form name="subscribe" id="subscribe">
  <h3>Newsletter</h3>
  <p>Sign up to receive special offers & the latest style news.</p>
<input type="text" value="" name="subscribe_email" id="subscribe_email" placeholder="<?php echo $entry_email; ?>">
<input type="text" value="" name="subscribe_name" id="subscribe_name" placeholder="<?php echo $entry_name; ?>" style="width:120px;">
   <?php 
     for($ns=1;$ns<=$option_fields;$ns++) {
     $ns_var= "option_fields".$ns;
   ?>
      <?php 
       if($$ns_var!=""){
         echo($$ns_var."&nbsp;<br/>");
         echo('<input type="text" value="" name="option'.$ns.'" id="option'.$ns.'">');
       }
      ?>
   <?php 
     }
   ?>
     <a class="button" onclick="email_subscribe()"><?php echo $entry_button; ?></a><?php if($option_unsubscribe) { ?>
          <!-- <a class="button" onclick="email_unsubscribe()"><span><?php echo $entry_unbutton; ?></span></a>-->
      <?php } ?>    
     <div id="subscribe_result"></div>
  </form>
  </div>
  <?php if($thickbox) { ?> </div> <?php } ?>
  </div>
<script language="javascript">
	<?php 
  		if(!$thickbox) { 
	?>	
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
   <?php }else{ ?>
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
}
   <?php } ?>
   
$('.fancybox_sub').fancybox({
	width: 180,
	height: 180,
	autoDimensions: false
});
</script>
</div>
</div>