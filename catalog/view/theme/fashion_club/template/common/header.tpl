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
<link rel="stylesheet" type="text/css" href="catalog/view/theme/fashion_club/stylesheet/stylesheet.css" />


<?php foreach ($styles as $style) { ?>
<link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>

<link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css">

<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Actor' rel='stylesheet' type='text/css'>
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
<link rel="stylesheet" type="text/css" href="/catalog/view/theme/fashion_club/stylesheet/jquery.fancybox.css" media="screen" />
<link rel="stylesheet" type="text/css" href="catalog/view/theme/fashion_club/stylesheet/xzoom.css" media="all" />
<!-- XZOOM JQUERY PLUGIN  -->
<script type="text/javascript" src="catalog/view/javascript/xzoom.js"></script>
</head>
<body>


<div class="header">
<div class="container">
  <?php if ($logo) { ?>
  <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
  <?php } ?>
  <?php echo $language; ?>
  
  
  
  
<div class="right_col">
  <?php echo $currency; ?> 
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
 
  
 


<?php 
if ($categories) { 
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
    <li class="cat_<?php echo $category['category_id'];?>"><a href="<?php echo $category['href']; ?>" <?php if($cat[0]==$category['category_id']) echo "class=\"active\""; ?> ><?php echo $category['name']; ?></a>
    </li>
    <?php } ?>
  
	
     <li><a href="/?route=simple_blog/article"  <?php if($route=='simple_blog/article' || $route=='simple_blog/article/view') echo "class=\"active\""; ?>>Blog</a></li>

       <li><a href="/?route=gallery/album"  <?php if($route=='gallery/album' || $route=='gallery/gallery') echo "class=\"active\""; ?>>Gallery</a></li>
    
    <li><a href="/?route=information/media"  <?php if($route=='information/media'||$route=='information/news') echo "class=\"active\""; ?>>Media</a></li>
    
    
	<!-- <li><a href="/?route=information/customerservice"  <?php if($route=='information/customerservice') echo "class=\"active\""; ?>>Customer Service</a></li> -->
	<li class="class"><a style="margin-bottom: 20px;">Study Fashion</a>
		<ul><li><a href="https://www.limkokwing.net/malaysia/academic/courses_details/ba_hons_in_fashion_retailing" target="_blank">
			Bachelor of Arts (Hons) in Fashion & Retailing</a></li>
			<li><a href="https://www.limkokwing.net/malaysia/academic/courses_details/ba_of_arts_hons_in_fashion_design1" target="_blank">
			Bachelor of Arts (Hons) in Fashion Design</a></li>
			<li><a href="https://www.limkokwing.net/malaysia/academic/courses_details/diploma_in_fashion_retail_design" target="_blank">
			Diploma in Fashion and Retail Design</a></li>
		</ul>
	</li>
  </ul>
</div>
<?php } ?>
</div>


</div>
</div>


<div class="container">
<div id="notification"></div>
</div>

<?php
/*------------------------------------------------------*/
/* BEGIN: Change currency based on IP  					*/
/*------------------------------------------------------*/

$ip_addr = $_SERVER['REMOTE_ADDR'];
//test
if(isset($_GET['ip'])) $ip_addr = $_GET['ip'];

if (isset($_COOKIE["currencyCookie"])){
	$thisCurrency = $_COOKIE["currencyCookie"];
    setcookie("currencyCookie", $thisCurrency, time()+86400, "/"); //cookie lasts 1 day, 86400 = 1 day
}
else {
//no cookie set
$link = mysql_connect("localhost", "root", "fashion101") or die(mysql_error());  
mysql_select_db("lkw_fashion_club") or die(mysql_error());

$sql = 'SELECT c.country FROM ip2nationCountries c, ip2nation i WHERE i.ip < INET_ATON("'.$ip_addr.'") AND c.code = i.country ORDER BY i.ip DESC LIMIT 0,1';
list($countryName) = mysql_fetch_row(mysql_query($sql));
// Output full country name
//echo $countryName;
mysql_close($link);

//set currency
switch ($countryName) {
	case 'Malaysia': $thisCurrency = "MYR";
					break;
	case 'Australia': $thisCurrency = "AUD";
					break;
	case 'United Kingdom': $thisCurrency = "GBP";
					break;
	case 'China': $thisCurrency = "CNY";
					break;
	case 'Hong Kong': $thisCurrency = "HKD";
					break;
	case 'Indonesia': $thisCurrency = "IDR";
					break;
	case 'Japan': $thisCurrency = "JPY";
					break;
	case 'New Zealand (Aotearoa)': $thisCurrency = "NZD";
					break;
	case 'Singapore': $thisCurrency = "SGD";
					break;
	case 'Korea (South)': $thisCurrency = "KRW";
					break;
	case  'Austria': 
	case  'Belgium':
	case  'Cyprus':
	case  'Estonia':
	case  'Finland':
	case  'France':
	case  'Germany':
	case  'Greece':
	case  'Ireland':
	case  'Italy':
	case  'Latvia':
	case  'Lithuania':
	case  'Luxembourg':
	case  'Malta':
	case  'Netherlands':
	case  'Portugal':
	case  'Slovak Republic':
	case  'Slovenia':
	case  'Spain': $thisCurrency = "EUR";
					break;	
	default: $thisCurrency = "USD";
					break;
}
setcookie("currencyCookie", $thisCurrency, time()+86400, "/"); //cookie lasts 1 day, 86400 = 1 day
$setCurrency="<script>$(\"select[name='curselect']\").val(\"$thisCurrency\");$(\"input[name='currency_code']\").attr(\"value\", \"$thisCurrency\");$(\".money\").submit();</script>";
echo $setCurrency;
}

//deleteCookie();
function deleteCookie(){
if (isset($_COOKIE["currencyCookie"])) unset($_COOKIE["currencyCookie"]);
setcookie("currencyCookie", null, time() - 3600, "/");
echo "<p>We deleted the cookie.</p>"; 
}

/*------------------------------------------------------*/
/* END: Change currency based on IP  					*/
/*------------------------------------------------------*/
?>
