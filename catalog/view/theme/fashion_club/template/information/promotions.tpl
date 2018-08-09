<!-- comment in if there are new promotions, uncomment link in common/header.tpl and common/footer.tpl-->
<?php  header( 'Location: http://fashionclub.my/' ) ;  ?>

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
padding: 40px 0 40px 0;
}

#promotion .container {
margin: 0 auto 60px;
padding: 0;
}

#promotion article {
background: #fff;
}

#promotion article .container {
margin: 0 auto;
padding: 50px 0 0 0;
width: 720px;
}

#promotion article .container h1 {
text-align: center;
}

#promotion article.grey {
background: #f5f5f5;
}

#promotion article p {
color: #555;
font-size: 18px;
line-height: 1.6;
margin: 0 0px 30px;
}

#promotion article #facebook,
#promotion article #twitter,
#promotion article #instagram {
display: inline-block;
}

#promotion img {
width: inherit;
}

#promotion hr {
background: #ddd;
width: 50%;
height: 1px;
border: none;
}

#promotion article .step {
padding: 20px 0 40px;
}

#promotion article .step h3 {
color: #642c91;
font-family: lucida grande, sans-serif;
font-size: 50px;
line-height: 1;
float: left;
margin: 0 30px 0 50px;
}

#promotion article .step .step-info {
float: left;
width: 500px;
border-bottom: 1px solid #ddd;
}
#promotion article .step .step-info.last {
border-bottom: 0;
}

#promotion .newsletter {
margin: 70px 0 -280px;
}
</style>

  <section id="promotion">
	  <div class="box">
	  <img src="/catalog/view/theme/fashion_club/image/promotion-christmas-2014.jpg">
	  </div>
 
  <?php echo $content_bottom; ?></section>
<?php echo $footer; ?>