<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<meta name="google-site-verification" content="I_etntbN4yo3p_ANPeKeLND0HtScA4Mn_1nx8DR4FkY" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/fashion_club/stylesheet/stylesheet.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" />

<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css">
<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Actor' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="catalog/view/javascript/common.js"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
<!--[if IE 7]> 
<link rel="stylesheet" type="text/css" href="catalog/view/theme/fashion_club/stylesheet/ie7.css" />
<![endif]-->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/fashion_club/stylesheet/ie6.css" />
<script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript">
DD_belatedPNG.fix('#logo img');
</script>
<![endif]-->
<?php if ($stores) { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
<?php foreach ($stores as $store) { ?>
$('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
<?php } ?>
});
//--></script>
<?php } ?>
<?php echo $google_analytics; ?>
</head>
<body>



<div class="header">
<div class="container">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  
  
  
  
<div class="right_col">
 
  <div id="fashion_cart">
  <div class="button-cart"></div>
  <a href="/index.php?route=checkout/cart">My Cart</a>
  </div>
 
 <div id="search">
    <div class="button-search"></div>
    <input type="text" name="search" placeholder="<?php echo $text_search; ?>" value="<?php echo $search; ?>" />
  </div>
  <?php //echo $cart; 
  ?>
 
 
  <div id="welcome">
    <?php if (!$logged) { ?>
    <?php echo "<a href='/index.php?route=account/register'>Join</a> | <a href='/index.php?route=account/login'>Sign in</a>"; ?>
    <?php } else { ?>
    <?php echo $text_logged; ?>
    <?php } ?>
  </div>
  <div class="clear"></div>
  <?php echo $currency; ?>
 
  
 


<?php if ($categories) { 
$cat=0;
if(isset($_GET['path'])) {
$cat = explode("_", $_GET['path']);
}
$route="";
if(isset($_GET['route'])) {
$route = $_GET['route'];
}
else {
//get from product
//access category_id from product itself it it is a product page

}

?>
<div id="menu">
  <ul>
	<?php foreach ($categories as $category) { ?>
    <li><a href="<?php echo $category['href']; ?>" <?php if($cat[0]==$category['category_id']) echo "class=\"active\""; ?> ><?php echo $category['name']; ?></a>
    </li>
    <?php } ?>
    <li><a href="/?route=information/promotions"  <?php if($route=='information/promotions') echo "class=\"active\""; ?>>Promotions</a></li>
	<li><a href="/?route=information/media"  <?php if($route=='information/media'||$route=='information/news') echo "class=\"active\""; ?>>Media</a></li>
	<li><a href="/?route=information/customerservice"  <?php if($route=='information/customerservice') echo "class=\"active\""; ?>>Customer Service</a></li> 
  </ul>
</div>
<?php } ?>
</div>


</div>
</div>
<?php if($this->config->get('tab_visible') == "true") { ?>
						<li id="video"><a href="<?php echo $videogallery; ?>" class="top"><?php if($this->config->get('tab_name')){ echo $this->config->get('tab_name'); } else { echo "Video Gallery"; }?></a></li>
						<?php } ?>


<div class="container">
<div id="notification"></div>
</div>