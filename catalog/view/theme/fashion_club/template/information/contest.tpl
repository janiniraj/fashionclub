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
	  <h2 style="
    text-align: center;
    color: white;
    font-size: 60px;
    width: 900px;
    margin: 0 auto;
    background: #662E91;
    padding: 20px 0;
">Share and Win<br>Gifts More Than RM5000!</h2>
	  <img src="/catalog/view/theme/fashion_club/image/promotion/photo-contest.jpg">
	  </div>
	  
	  <article class="grey">
	  <div class="container">
	 	<h1>Here's How:</h2>
	 	<div class="step">
	 	<h3>1</h3>
	 	<div class="step-info">
	 	<p>Become our friend!<br>Like, follow and Pin @LKWFashionClub on Social Media</p>
	 	<p>
	 	<a href="https://www.facebook.com/pages/LKW-Fashion-Club/523180937752551" id="facebook" target="_blank"><img src="http://fashionclub.my/catalog/view/theme/fashion_club/image/fb-small.png"></a>
	 	<a href="https://twitter.com/LKWFashionClub" id="twitter" target="_blank"><img src="http://fashionclub.my/catalog/view/theme/fashion_club/image/tw-small.png"></a>
	 	<a href="http://instagram.com/lkwfashionclub" id="instagram" target="_blank"><img src="http://fashionclub.my/catalog/view/theme/fashion_club/image/ig-small.png"></a>
	 	</p>
	 	</div>
	 	<div class="clear"></div>
	 	</div>
	 	<div class="step">
	 	<h3>2</h3>
	 	<div class="step-info">
	 	<p>Post your most creative Limkokwing Fashion Club photo with the hashtag #LKWFashionClub &amp; share as much as you can!</p>
	 	<h2 style="color:#333;">#LKWFashionClub</h2>
	 	</div>
	 	<div class="clear"></div>
	 	</div>
	 	<div class="step">
	 	<h3>3</h3>
	 	<div class="step-info last">
	 	<p>10 winners will be contacted via Social Media by 30 June 2014</p>
	 	</div>
	 	<div class="clear"></div>
	 	<center><small style="color:#aaa">*terms and conditions apply</small></center>
	 	</div>
	  </div>
	  </article>
 
  <?php echo $content_bottom; ?></section>
<?php echo $footer; ?>