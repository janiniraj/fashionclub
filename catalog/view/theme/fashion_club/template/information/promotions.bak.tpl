<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
</div>
</div>
<style>
#promotion {
background: #fff;
}

#promotion .box {
background: #fff url('../catalog/view/theme/fashion_club/image/fashion_background.jpg') center 0 no-repeat;
background-size: cover;
margin: -30px 0 0 0;
padding: 40px 0 0 0;
}

#promotion .container {
margin: 0 auto 60px;
padding: 0;
width: 960px;
}

#promotion article {
background: #fff;
}

#promotion .rebel {
display: inline-block;
margin: -20px 0 0;
}

#promotion img {
width: inherit;
}

#promotion .span-2-1,
#promotion .span-3-1 {
float: left;
}

#promotion .span-2-1 {
border: 1px solid #eee;
width: 468px;
margin: 0 10px 10px 50px;
}

#promotion .span-2-1.small {
width: 378px;
margin: 0 0 10px 0;
}

#promotion .span-3-1 {
border: 1px solid #eee;
width: 278px;
margin: 0 10px 10px 0;
}

#promotion .span-3-1.first {
margin: 0 10px 10px 50px;
}

#promotion .span-3-1.last {
margin: 0 0 10px 0;
}

</style>

  <section id="promotion">
	  <div class="box">
	  <img src="/catalog/view/theme/fashion_club/image/promotion/schoolhero.jpg">
	  </div>
	  
	  <article>
	  <div class="container">
	  <div class="rebel">
	  <a class="span-2-1" href="http://fashionclub.my/index.php?route=product/product&path=59&product_id=103">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school1.jpg">
	  </a>
	  <a class="span-2-1 small" href="http://fashionclub.my/index.php?route=product/product&path=79&product_id=88">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school2.jpg">
	  </a>
	  <a class="span-2-1 small" href="http://fashionclub.my/index.php?route=product/product&path=59&product_id=79">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school3.jpg">
	  </a>
	  <div class="clear"></div>
	  
	  <a class="span-3-1 first" href="http://fashionclub.my/index.php?route=product/product&path=59&product_id=50">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school4.jpg">
	  </a>
	  <a class="span-3-1" href="http://fashionclub.my/index.php?route=product/product&path=65&product_id=100">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school5.jpg">
	  </a>
	  <a class="span-3-1 last" href="http://fashionclub.my/index.php?route=product/product&path=65&product_id=58">
		  <img src="/catalog/view/theme/fashion_club/image/promotion/school6.jpg">
	  </a>
	  <div class="clear"></div>
	  </div>
	  </div>
	  </article>
 
  <?php echo $content_bottom; ?></section>
<?php echo $footer; ?>