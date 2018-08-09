<?php echo $header; ?>
<section id="product">
<div class="container">
<h2><?php echo $heading_title; ?></h2>
<div id="columm-sort" class="sort_category">
<?php echo $column_left; ?>
 <div class="sort">
 <h2>Sort by Price</h2>
        <ul class="category_list">
        <?php 
		$sortcnt=0;
		foreach ($sorts as $sorts) { ?>
		<?php if(($sortcnt==3)||($sortcnt==4)){?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <li><input type="radio" name="price" id="high" value="<?php echo $sorts['href']; ?>" checked="checked" onchange="location = this.value;">
		<label for="high">
        <?php 
		if ($sortcnt==3) echo "Low to High";
		if ($sortcnt==4) echo "High to Low";
		?></label></li>
        <?php } else { ?>
        
       <li><input type="radio" name="price" id="low" value="<?php echo $sorts['href']; ?>" onchange="location = this.value;">
		<label for="low">
        <?php 
		if ($sortcnt==3) echo "Low to High";
		if ($sortcnt==4) echo "High to Low";
		?> </label></li>
        <?php } ?>
		<?php }//sortcnt ?>
        <?php $sortcnt++;} ?>
        </ul>
    </div>
</div>


<?php echo $column_right; ?>
<div id="content" class="products_list"><?php echo $content_top; ?>
  
  <?php if ($thumb || $description) { ?>
  <div class="category-info">
    <?php if ($thumb) { ?>
    <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($products) { ?>
<?php if(isset($product_video)) { ?>
						<div id="blanket" style="display:none;"></div>
						<?php } ?>
 <div class="product-list">
<?php $video = 0; ?>
    <?php foreach ($products as $product) { ?>
    
      <?php if ($product['thumb']) { ?>
	  
	 <div>
     <a href="<?php echo $product['href']; ?>">
     <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
     <h3><?php echo $product['name']; ?></h3>
        
      <?php if ($product['price']) { ?>
		 
      <div class="price">
        <?php if (!$product['special']) { ?>
        <p><?php echo $product['price']; ?></p>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
	 </div>
	  <?php } ?>
      
            </a>
      </div>       
      
	  <?php } //if thumb ?>
   
    <?php }  //foreach ?>
  </div><!--end product-list-->
  <div class="pagination"><?php echo $pagination; ?></div>
  
  <?php } //if products ?>
  <?php if (!$categories && !$products) { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php } ?></div><div class="clear"></div>
  <?php echo $content_bottom; ?>
  </div>
  </section>
<!--script type="text/javascript"><!--
function display(view) {
	if (view == 'list') {
		$('.product-grid').attr('class', 'product-list');
		
		$('.product-list > div').each(function(index, element) {
			html  = '<div class="right">';
			html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
			html += '</div>';			
			
			html += '<div class="left">';
			
			var image = $(element).find('.image').html();
			
			if (image != null) { 
				html += '<div class="image">' + image + '</div>';
			}
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
					
			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
			html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
			
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
				
			html += '</div>';
						
			$(element).html(html);
		});		
		
		$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');
		
		$.totalStorage('display', 'list'); 
	} else {
		$('.product-list').attr('class', 'product-grid');
var video=0;
			var productVideo = <?php echo json_encode($product_video); ?>;
			var playersize = <?php echo json_encode($player_size); ?>;
		
		$('.product-grid > div').each(function(index, element) {
			html = '';
			
			var image = $(element).find('.image').html();
			
			if (image != null) {
				html += '<div class="image">' + image + '</div>';
			}
			
			html += '<div class="name">' + $(element).find('.name').html() + '</div>';
			html += '<div class="description">' + $(element).find('.description').html() + '</div>';
			
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
if(productVideo[video]["id"] != '')
						{   
							html += '<div><a onclick="popup(\'playerDivG'+productVideo[video]["id"]+'\','+playersize["width"]+','+playersize["height"]+',\'blanket'+productVideo[video]["id"]+'\')" ><img src="image/hdwplayer/dis_video.jpg" /></a></div>';
 							
							html += '<div  id="playerDivG'+productVideo[video]["id"]+'" style="display:none;">';
                            html += '<a onclick="popup(\'playerDivG'+productVideo[video]["id"]+'\',1,1,\'blanket'+productVideo[video]["id"]+'\')" class="close" title="close">X</a>';
                            html += productVideo[video]["embed"];
                            html += '</div>';
						}
                video++;
			var rating = $(element).find('.rating').html();
			
			if (rating != null) {
				html += '<div class="rating">' + rating + '</div>';
			}
						
			html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
			html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
			html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';
			
			$(element).html(html);
		});	
					
		$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');
		
		$.totalStorage('display', 'grid');
	}
}

view = $.totalStorage('display');

if (view) {
	display(view);
} else {
	display('list');
}
</script > -->
<?php if(isset($product_video)) { ?>
				<?php foreach($product_video as $product) { ?>
				<?php if($product['id'] != '') { ?>
					<style type="text/css">
								#playerDiv<?php echo $product['id']; ?> {
							position:absolute;
							border: 4px solid #C0C0C0;
							border-radius: 5px;
							z-index: 9002;
							width: <?php echo $player_size['width']; ?>px;
							height: <?php echo $player_size['height']; ?>px;
						}
						#playerDivG<?php echo $product['id']; ?> {
							position:absolute;
							border: 4px solid #C0C0C0;
							border-radius: 5px;
							z-index: 9002;
							width: <?php echo $player_size['width']; ?>px;
							height: <?php echo $player_size['height']; ?>px;
						}
						#playerDivG<?php echo $product['id']; ?> a {
							position:absolute;
							top:5px; right:5px
						}
						#playerDivG<?php echo $product['id']; ?> a.close {
							display:none;
						}
						#playerDivG<?php echo $product['id']; ?>:hover a.close {
							display:block;
							position:absolute;
							top:5px; right:5px
						}
						
						#playerDiv<?php echo $product['id']; ?> a.close {
							display:none;
						}
						#playerDiv<?php echo $product['id']; ?>:hover a.close {
							display:block;
							position:absolute;
							top:5px; right:5px
						}
						 
								</style>
								<?php } ?>
					<?php } } ?>
							<style type="text/css">
						    #blanket {
						   background-color:#111;
						   opacity: 0.40;
						   
						   position:absolute;
						   z-index: 9001;
						   top:0px;
						   left:0px;
						   width:100%;
						}
						a.close {
						opacity: 0.5;
						text-decoration:none;
						font-weight:bold;
						font-size: 15px;
						font-family: "Verdana";
						color:#fff;
						}
						a.close:hover {
						opacity: 1;
						color:#fff;
						}
						</style>
						<script type="text/javascript" src="catalog/view/javascript/videopopup.js"></script>
<?php echo $footer; ?>