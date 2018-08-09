<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<section id="search"><?php echo $content_top; ?>
<div class="container">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <h2><?php echo $text_search; 
  if (count($products)>1) echo "s";
  ?></h2>
  <?php if ($products) { ?>
<?php if(isset($product_video)) { ?>
						<div id="blanket" style="display:none;"></div>
						<?php } ?>
  <div class="product-filter">
    <!--div class="display"><b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display('grid');"><?php echo $text_grid; ?></a></div-->
    <div class="limit"><?php echo $text_limit; ?>
      <select onchange="location = this.value;">
        <?php foreach ($limits as $limits) { ?>
        <?php if ($limits['value'] == $limit) { ?>
        <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="sort"><?php echo $text_sort; ?>
      <select onchange="location = this.value;">
        <?php foreach ($sorts as $sorts) { ?>
        <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
        <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
        <?php } else { ?>
        <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
        <?php } ?>
        <?php } ?>
      </select>
    </div>
    <div class="clear"></div>
  </div>
  <!--div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div-->
  <div class="product-list">
<?php $video = 0; ?>
    <?php foreach ($products as $product) { ?>
    <div>
      <?php if ($product['thumb']) { ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
      <div class="description"><?php echo $product['description']; ?>
				<?php if($product_video[$video]['id'] != '') { ?>
 						<div><a onclick="popup('playerDiv<?php echo $product_video[$video]['id']; ?>',<?php echo $player_size['width']; ?>,<?php echo $player_size['height']; ?>)" ><img src="image/hdwplayer/dis_video.jpg" title="<?php echo $product['name']; ?> Videos"/></a></div>
 						
						<div  id="playerDiv<?php echo $product_video[$video]['id']; ?>" style="display:none;">
           					<a onclick="popup('playerDiv<?php echo $product_video[$video]['id']; ?>',1,1)" class="close" title="close">X</a>
           					<?php echo $product_video[$video]['embed']; ?>
           				</div>
          		<?php } ?>
                <?php $video++; ?></div>
      <?php if ($product['price']) { ?>
      <div class="price">
        <?php if (!$product['special']) { ?>
        <?php echo $product['price']; ?>
        <?php } else { ?>
        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
        <?php if ($product['tax']) { ?>
        <br />
        <span class="price-tax" style="display:none"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
        <?php } ?>
      </div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
      <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
      <div class="wishlist"><a onclick="addToWishList('<?php echo $product['product_id']; ?>');"><?php echo $button_wishlist; ?></a></div>
      <div class="compare"><a onclick="addToCompare('<?php echo $product['product_id']; ?>');"><?php echo $button_compare; ?></a></div>
    </div>
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <div class="clear"></div>
  <?php echo $content_bottom; ?></div></section>
<script type="text/javascript"><!--
$('#content input[name=\'search\']').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-search').trigger('click');
	}
});

$('select[name=\'category_id\']').bind('change', function() {
	if (this.value == '0') {
		$('input[name=\'sub_category\']').attr('disabled', 'disabled');
		$('input[name=\'sub_category\']').removeAttr('checked');
	} else {
		$('input[name=\'sub_category\']').removeAttr('disabled');
	}
});

$('select[name=\'category_id\']').trigger('change');

$('#button-search').bind('click', function() {
	url = 'index.php?route=product/search';
	
	var search = $('#content input[name=\'search\']').attr('value');
	
	if (search) {
		url += '&search=' + encodeURIComponent(search);
	}

	var category_id = $('#content select[name=\'category_id\']').attr('value');
	
	if (category_id > 0) {
		url += '&category_id=' + encodeURIComponent(category_id);
	}
	
	var sub_category = $('#content input[name=\'sub_category\']:checked').attr('value');
	
	if (sub_category) {
		url += '&sub_category=true';
	}
		
	var filter_description = $('#content input[name=\'description\']:checked').attr('value');
	
	if (filter_description) {
		url += '&description=true';
	}

	location = url;
});

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
			
						
			html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
			var price = $(element).find('.price').html();
			
			if (price != null) {
				html += '<div class="price">' + price  + '</div>';
			}
			
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
							html += '<div><a onclick="popup(\'playerDivG'+productVideo[video]["id"]+'\','+playersize["width"]+','+playersize["height"]+')" ><img src="image/hdwplayer/dis_video.jpg" /></a></div>';
 							
							html += '<div  id="playerDivG'+productVideo[video]["id"]+'" style="display:none;">';
                            html += '<a onclick="popup(\'playerDivG'+productVideo[video]["id"]+'\',1,1)" class="close" title="close">X</a>';
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
//--></script> 
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
						color:#fff;
						opacity: 1;
						}
						</style>
						<script type="text/javascript" src="catalog/view/javascript/videopopup.js"></script>
<?php echo $footer; ?>