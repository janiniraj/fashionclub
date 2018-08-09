<?php
//-----------------------------------------------------
// News Module for Opencart v1.5.6   					
// Modified by villagedefrance                          		
// contact@villagedefrance.net                         		
//-----------------------------------------------------
?>

<?php if ($news) { ?>
<?php if($box) { ?>
<style>
.box.news {
margin: 0 0 50px;
}
.box.news h2 {
display: none;
}
.box-news {
background: #ddd;
border: 1px solid #fff;
border-radius: 0;
box-shadow: none;
color: #555!important;
display: block;
padding: 20px;
margin-bottom: 0;
overflow: auto;
float: left;
width: 184px;
height: 214px;
}
.box-news .small {
display: block;
font-size: 11px;
margin: 10px 0;
}
.box-news h4 {
font-family: 'Arial',sans-serif;
font-size: 20px;
margin-top: 0px;
margin-bottom: 5px;
height: 78px;
overflow: hidden;
}
.box-news p {
margin-top: 0px;
margin-bottom: 5px;
}
</style>
	<div class="container">
			<?php if($customtitle) { ?>
				<h2><?php echo $customtitle; ?></h2>
			<?php } ?>
		<div class="news">
			<!--<div class="box-heading">
	
				<?php if($icon) { ?>
					<div style="float: left; margin-right: 8px;"><img src="catalog/view/theme/default/image/message.png" alt="" /></div>
				<?php } ?>
				<?php if($customtitle) { ?>
					<?php echo $customtitle; ?>
				<?php } ?>
			</div>-->
			<div class="box-content">
			<?php foreach ($news as $news_story) { ?>
				<a href="<?php echo $news_story['href']; ?>" class="box-news">
					<?php if ($show_headline) { ?>
						<h4><?php echo $news_story['title']; ?></h4>...
					<?php } ?>
					
					<span class="small"><!--<b><?php echo $text_posted; ?></b> --><?php echo $news_story['posted']; ?></span>
					<p><?php echo $news_story['description']; ?> ...</p>
				</a>
			<?php } ?>
			<?php if($showbutton) { ?>
				<div style="text-align:right;">
					<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
				</div>
			<?php } ?>
			</div>
		</div>
		<div id="more">
			<a id="promo">
			<h3>15% OFF</h2>
			<p>For All Limkokwing Students &amp; Staff</p>
			</a>
			
			<a href="/?route=information/storelocation" id="store">
			<h3>Store<br>Locations</h3>
			</a>
			
			<div class="clear">&nbsp;</div>
		</div>
	</div>
<?php } else { ?>
	<div style="margin-bottom:10px;">
		<?php foreach ($news as $news_story) { ?>
			<div class="box-news">
				<?php if ($show_headline) { ?>
					<h4><?php echo $news_story['title']; ?></h4>
				<?php } ?>
				<?php echo $news_story['description']; ?> .. <br />
				<a href="<?php echo $news_story['href']; ?>"> <?php echo $text_more; ?></a>
				</p>
				<a href="<?php echo $news_story['href']; ?>"><img src="catalog/view/theme/default/image/message-news.png" alt="" /></a> 
				<span class="small"><b><?php echo $text_posted; ?></b> <?php echo $news_story['posted']; ?></span>
			</div>
		<?php } ?>
		<?php if($showbutton) { ?>
			<div style="text-align:right;">
				<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
			</div>
		<?php } ?>
		<div class="clear"></div>
	</div>
<?php } ?>
<?php } ?>