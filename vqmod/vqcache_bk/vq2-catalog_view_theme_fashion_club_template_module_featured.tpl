<div class="box latest">
  <div class="box-heading"><h2><?php echo $heading_title; ?></h2></div>
    <div class="box-product">
<?php $video = 0; ?>
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <a href="<?php echo $product['href']; ?>">
        <div class="image">
        <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
        </div>
        <?php } ?>
        <div class="name"><h3><?php echo $product['name']; ?></h3></div>
        <?php if ($product['price']) { ?>
        <!--div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <div class="cart"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div--></a>
      </div>
      <?php } ?>
  </div>
</div><?php if(isset($product_video)) { ?>
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