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
        //echo '<pre>';  print_r($sorts); die;
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
			<?php }//sortcnt 

			if( ($sortcnt==5) || ($sortcnt==6) ){
				if( $sortcnt==5){
				echo '</ul></div>';
				}
			?>

					

					<?php

			}

			if( ($sortcnt==9) || ($sortcnt==10) ){
				if( $sortcnt==9 ){
				//echo '</ul></div><div class="sort"><h2>Sort by Discount</h2><ul class="category_list">';
				}
			?>

					<?php if ($sorts['value'] == $sort . '-' . $order) {/* ?>
			     <li><input type="radio" name="discount" id="high" value="<?php echo $sorts['href']; ?>" checked="checked" onchange="location = this.value;">
					<label for="high">
			        <?php 
					if ($sortcnt==9) echo "Low to High";
					if ($sortcnt==10) echo "High to Low";
					?></label></li>
			        <?php } else { ?>
			        
			      <li><input type="radio" name="discount" id="low" value="<?php echo $sorts['href']; ?>" onchange="location = this.value;">
					<label for="low">
			        <?php 
					if ($sortcnt==9) echo "Low to High";
					if ($sortcnt==10) echo "High to Low";
					?> </label></li>
			        <?php */ } ?>

					<?php

			}

			?>
        <?php $sortcnt++;} ?>
        </ul>

</div>


<?php echo $column_right; ?>
<div id="content" class="products_list"><?php echo $content_top; ?>
  
  <?php if ($thumb || $description) { ?>
  <div class="category-info">
    <?php if ($thumb) { ?>
    <div class="image "><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
    <?php } ?>
    <?php if ($description) { ?>
    <?php echo $description; ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php if ($products) { ?>
 <div class="product-list">
    <?php foreach ($products as $product) { ?>
    
      <?php if ($product['thumb']) { ?>
	  
	 <div class="crossfd">
     <a href="<?php echo $product['href']; ?>">
     <img class="crossfd-thumb" ori-thumb="<?php echo $product['thumb']; ?>" src="<?php echo $product['thumb']; ?>" flip-thumb="<?php echo $product['flip-thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
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

<script type="text/javascript">
	$('.crossfd-thumb').on('hover', function(){

		$(this).attr("src", $(this).attr("flip-thumb"));
    	
	});

	$('.crossfd-thumb').on('mouseout', function(){

		$(this).attr("src", $(this).attr("ori-thumb"));
    	
	});

</script>

<?php echo $footer; ?>