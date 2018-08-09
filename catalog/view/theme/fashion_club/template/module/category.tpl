<div class="box">
  <div class="box-content">
    <div class="box-category">
      <?php foreach ($categories as $category) { ?>
        <?php if ($category['category_id'] == $category_id) { ?>
        <?php if ($category['children']) { ?>
		<h2>Category</h2>
        <ul class="category_list">
          <?php foreach ($category['children'] as $child) { ?>
          
            <?php if ($child['category_id'] == $child_id) { ?>
			<li>
            <a href="<?php echo $child['href']; ?>" class="active"> <?php echo $child['name']; ?></a>
			</li>
			<?php }  else {?>
			<li>
			<a href="<?php echo $child['href']; ?>"> <?php echo $child['name']; ?></a>
			</li>
		  <?php } ?>
          <?php } ?>
        </ul>
        <?php } ?>
      <?php } ?>
	  <?php } ?>
    </div>
  </div>
</div>
