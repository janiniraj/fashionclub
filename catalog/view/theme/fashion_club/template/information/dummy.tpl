<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<section id="services">
<?php echo $content_top; ?>
<div class="container">

<h2>Dummey.</h2>

<?php

if (session_id()) {
  echo "<p>Session is in order.</p>";
}
else
{
  echo "<p>No session.</p>";
}

?>
<div class="clear"></div>

<?php echo $content_bottom; ?>
</div>
</section>





<!-- END: Pop-up Scripts -->
<?php echo $footer; ?>