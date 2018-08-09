<div class="box">
  	<div class="box-heading"><?php echo $heading_title; ?></div>
  	<div class="box-content">
    	<?php foreach($articles as $article) { ?>
    		<div class="module-info">
	    		<div class="left">
					<img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" style="border-radius: 5px; padding: 3px; border: 1px solid #eeeeee;" />
				</div>
				<div class="right">
					<h4><?php echo $article['article_title']; ?></h4>
					<?php echo $article['description']; ?>
				</div>
	    	</div>
    	<?php } ?>
  	</div>
</div>