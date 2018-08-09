<div class="box">
<h2><?php echo $heading_title; ?></h2>
  <div id="playerG" style="height: <?php echo $height; ?>px; width: <?php echo $width; ?>px;"><?php echo $node; ?>
</div>
<div><br></div>
  <div id="gallery"
	style="text-align: left; width: <?php echo ($img_width+14+4)*4; ?>px; overflow: hidden;">
<?php foreach ($videos as $product_video)  { ?>
<div style="display: inline-block; overflow: auto; vertical-align: top;">
<div style="float: left; margin: 7px 7px 7px 7px; cursor: pointer; display:inline-block;"
	id="<?php echo $product_video['id']; ?>" onclick="playerG(this.id);"><img
	title="<?php echo $product_video['title']; ?>" class="play"
	src="image/hdwplayer/dis_play.gif" /> <?php if(!$product_video['thumb_image']) { ?>
<img class="thumb" src="image/hdwplayer/dis_noimage.jpg"
	title="<?php echo $product_video['title']; ?>"
	alt="<?php echo $product_video['title']; ?>" /> <?php }else { ?> <img
	class="thumb" src="<?php echo $product_video['thumb_image']; ?>"
	title="<?php echo $product_video['title']; ?>"
	alt="<?php echo $product_video['title']; ?>" /> <?php } ?>
<div style="display: none;" id="g<?php echo $product_video['id']; ?>"><?php echo $product_video['embed']; ?></div>
<?php if($title == "1") { ?>
<div style="margin: 0px 0px 0px 7px; color:black; width:<?php echo $img_width; ?>px;"><span><?php echo $product_video['title']; ?></span></div>
<?php } ?>
</div>
</div>

<?php } ?>
<p style="clear: both">&nbsp;</p>
</div>
   </div>
   <style type="text/css">
#gallery .play {

	width: 30px;
	height: 30px;
	margin-left: <?php echo $img_width/2-15+2; ?>px;
	margin-top: <?php echo $img_height/2-15+2; ?>px;
	opacity: 0.5;
	position: absolute
}

#gallery .thumb {
	border: 2px solid #e4e4e7;
	height: <?php echo $img_height; ?>px;
	width: <?php echo $img_width; ?>px;
}
</style>
<script
	type="text/javascript" src="catalog/view/javascript/videopopup.js"></script>