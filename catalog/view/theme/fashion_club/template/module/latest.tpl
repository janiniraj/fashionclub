<div class="box latest">
  <div class="box-heading"><h2><?php echo $heading_title; ?></h2></div>
  <div class="box-content">
    <div class="box-product">
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
  </div>
</div>
