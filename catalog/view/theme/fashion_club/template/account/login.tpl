<?php echo $header; ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<section id="account" class="login">
<?php echo $content_top; ?>
	<div class="container">
		<div class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
			<?php } ?>
		</div>
		<h2><?php echo $heading_title; ?></h2>
		  <!--
		  <div class="login-content">
		    <div class="left">
		      <h2><?php echo $text_new_customer; ?></h2>
		      <div class="content">
		        <p><?php echo $text_register; ?></p>
		        <p><?php echo $text_register_account; ?></p>
		        <a href="<?php echo $register; ?>" class="button"><?php echo $button_continue; ?></a></div>
		    </div>
		    <div class="right">
		      <h2><?php echo $text_returning_customer; ?></h2>
		      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
		        <div class="content">
		          <p><?php echo $text_i_am_returning_customer; ?></p>
		          <b><?php echo $entry_email; ?></b><br />
		          <input type="text" name="email" value="<?php echo $email; ?>" />
		          <br />
		          <br />
		          <b><?php echo $entry_password; ?></b><br />
		          <input type="password" name="password" value="<?php echo $password; ?>" />
		          <br />
		          <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a><br />
		          <br />
		          <input type="submit" value="<?php echo $button_login; ?>" class="button" />
		          <?php if ($redirect) { ?>
		          <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
		          <?php } ?>
		        </div>
		      </form>
		    </div>
		  </div>-->
  	
		  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="return">
			  <h3><?php echo $text_returning_customer; ?></h3>
			  <div class="content">
				  <table class="form">
					  <tr>
						  <td><?php echo $entry_email; ?></td>
						  <td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
						 </tr>
						<tr>
							<td><?php echo $entry_password; ?></td>
							<td><input type="password" name="password" value="<?php echo $password; ?>" /></td>
						</tr>
					</table>
				</div>
				<div class="buttons">
				<a href="<?php echo $forgotten; ?>" class="small"><?php echo $text_forgotten; ?></a></td>
				<input type="submit" value="<?php echo $button_login; ?>" class="button right" />
				<?php if ($redirect) { ?>
				<input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
				<?php } ?>
				</div>
			</form>
	
			<h3><?php echo $text_new_customer; ?></h3>
			<div class="content last">
				<p><?php echo $text_register_account; ?></p>
			</div>
			<a href="<?php echo $register; ?>" class="button right"><?php echo $button_continue; ?></a>
			<div class="clear"></div>
			<?php echo $content_bottom; ?>
</div></section>
<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#login').submit();
	}
});
//--></script> 
<?php echo $footer; ?>