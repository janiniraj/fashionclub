<div class="box">
  <div class="top" <?php if (!$title) {echo "style=\"height: 5px; overflow: hidden; padding: 0 !important;\""; }; ?>>
	<?php
	  if($title) { ?>
		<img src="catalog/view/theme/default/image/brands.png" alt="" /><?php echo $title; ?>
	<?php
	} else { echo "&nbsp;";} ?>
  </div>
  <div class="middle" style="text-align: left;">
    <?php echo $code; ?>
  </div>
  <div class="bottom">&nbsp;</div>
</div>
