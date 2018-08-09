<?php
header("refresh: 20; index.php");
?>
<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<section id="message">
<div class="container">
<?php echo $content_top; ?>
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
		<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>

	<div class="content">
		<?php echo $text_message; ?>
	</div>	
	<a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a>
	<div class="clear"></div>
<?php echo $content_bottom; ?>
</div>

</section>
<?php echo $footer; ?>