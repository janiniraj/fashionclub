<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<section id="message" class="error"><?php echo $content_top; ?>
<div class="container">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <!--h2><?php echo $heading_title; ?></h2-->
  <div class="content"><h2><?php echo $text_error; ?></h2></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?>
  </div>
  </section>
<?php echo $footer; ?>