<div class="box">
	<div class="box-heading"><?php echo $heading_title; ?></div>
  	<div class="box-content">
  		<?php if($articles) { ?>
	    	<?php foreach ($articles as $article) { ?>
	    		<div class="article-author">
	    			<a href="<?php echo $article['href']; ?>"><?php echo $article['article_title']; ?></a>
	    		</div>
	    		
	    		<?php if ($article['description']) { ?>
					<div class="description"><?php echo $article['description']; ?></div>
				<?php } ?>
				
				<br />
				<div style="border-bottom: 1px dotted #ccc;"></div>
				<br />
	    	<?php } ?>
	    <?php } else { ?>
	    	<div class="buttons">
	    		<div class="center"><?php echo $text_no_found; ?></div>
	    	</div>
	    <?php } ?>
  	</div>
</div>