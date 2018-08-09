<title>Blogs</title>
<?php if($this->config->get('blog_manager_custom_theme')) { ?>
	<?php echo $blog_header; ?>
	
	
	<div class="row">
		<div class="col-lg-2 visible-lg"></div>
		<div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
					
		</div>
		<div class="col-lg-2 visible-lg"></div>
	</div>
	
	
	<?php echo $blog_footer; ?>	
<?php } else { ?>

	<?php echo $header; ?>
		<?php echo $column_left; ?>
		<?php echo $column_right; ?>
		<div id="content">
			<?php echo $content_top; ?>
			
			<div class="breadcrumb">
    			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    				<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    			<?php } ?>
  			</div>
			
			<div class="margin-top-21"></div>
			
			<?php if(isset($author_information_found)) { ?>
				<div class="author-info">
					<div class="left">
						<img src="<?php echo $author_image; ?>" alt="<?php echo $author_name; ?>" style="border-radius: 5px; border: 1px solid #eee;" />
					</div>
					<div class="right">
						<h1><?php echo $author_name; ?></h1>
						<?php echo $author_description; ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="article-sidebar">
				<h1>Category </h1>
				
				<!---<?php if($heading_title!="Editor's Picks") { ?> <?php } ?>--><a href="/?route=simple_blog/category&simple_blog_category_id=1">Editor's Picks</a>
                
               <!--- <?php if($heading_title!="Blogs") { ?><?php } ?>--><a href="/?route=simple_blog/category&simple_blog_category_id=4">Blogs</a>
				<?php if($heading_title!="Latest Blogs") { ?><a href="/?route=simple_blog/article">Latest Blogs</a><?php } ?>
				
				</div>
			<?php } ?>
			
			
			<div class="article-container blog">
			<?php if($articles) { ?>
				<?php foreach($articles as $article) { ?>
					<div class="article-info">
						<div class="article-title">
							<h1><a href="<?php echo $article['href']; ?>"><?php echo $article['article_title']; ?></a><h1>
						</div>
						
						<div class="article-sub-title">
							<span class="article-author"><a href="<?php echo $article['author_href']; ?>"><?php echo $article['author_name']; ?></a></span>
							<!-- <span class="article-author"><?php echo $article['author_name']; ?></span> -->
							<span class="bullet">&bull;</span>
							<span class="article-date"><?php echo $article['date_added']; ?></span>
							
							<?php if($article['allow_comment']) { ?>
								<span class="bullet">&bull;</span>
								<span class="article-comment"><a href="<?php echo $article['comment_href']; ?>#comment-section"><?php echo $article['total_comment']; ?></a></span>
							<?php } ?>
							
						</div>
						
						<?php if($article['image']) { ?>
							<?php if($article['featured_found']) { ?>
								<div class="article-image">
									<!--<img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" height="500" />-->
									<a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" /></a>
								</div>
							<?php } else { ?>
								<div class="article-thumbnail-image">
									<a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['image']; ?>" alt="<?php echo $article['article_title']; ?>" height="100" width="100" /></a>
									<span class="article-description">
										<?php echo $article['description']; ?>
									</span>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php if($article['featured_found']) { ?>						
							<div class="article-description">
								<?php echo $article['description']; ?>
							</div>
						<?php } else { ?>
							<div class="article-description">
								<?php echo $article['description']; ?>
							</div>
						<?php } ?>
						
						<div align="right"><a class="button" href="<?php echo $article['href']; ?>"><?php echo $button_continue_reading; ?></a></div>
						
						<?php if(!$article['featured_found']) { ?>
							<div class="article-thumbnail-found"></div>
						<?php } ?>
						
					</div>				
				<?php } ?>
			<?php } else { ?>
				<div class="buttons">
					<div class="center">
						<?php echo $text_no_found; ?>
					</div>
				</div>
			<?php } ?>
			</div>
			<div class="pagination"><?php echo $pagination; ?></div>
			
			<?php echo $content_bottom; ?>
		</div>
	<?php echo $footer; ?>	
	
<?php } ?>