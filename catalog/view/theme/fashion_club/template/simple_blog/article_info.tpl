<?php if($this->config->get('blog_manager_custom_theme')) { ?>
	<?php echo $blog_header; ?>
	
	<link rel="stylesheet" type="text/css" href="/catalog/view/theme/fashion_club/stylesheet/jquery.fancybox.css" media="screen" />
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
	  			
				<?php if(isset($article_info_found)) { ?>
					<div class="article-info">
						<div class="article-title">
							<h1><?php echo $article_info['article_title']; ?><h1>
						</div>
						
						<div class="article-sub-title">
							<span class="article-author"><a href="<?php echo $author_url; ?>"><?php echo $article_info['author_name']; ?></a></span>
							
							<span class="bullet">&bull;</span>
							<span class="article-date"><?php echo $article_date_modified; ?></span>
							
							<?php if($article_info['allow_comment']) { ?>
								<span class="bullet">&bull;</span>
								<span class="article-comment"><?php echo $total_comment; ?></span>
							<?php } ?>
							
							
							<?php if($this->config->get('blog_share_social_site')) { ?>
								<span class="article-share" style="float: right;">
								
									<span class="addthis_default_style"><a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a> <a class="addthis_button_google_plusone_share"></a> <a class="addthis_button_linkedin"></a> <a class="addthis_button_pinterest_share"></a></span>
          							<script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
								
								
									<!-- ShareThis Button BEGIN -->
									<!-- <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
									<script type="text/javascript">stLight.options({publisher: "ur-d825282d-618f-598d-fca6-d67ef9e76731", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>
									<span class='st_facebook' displayText=''></span>
									<span class='st_twitter' displayText=''></span>
									<span class='st_linkedin' displayText=''></span>
									<span class='st_googleplus' displayText=''></span>
									<span class='st_pinterest' displayText=''></span> -->
									<!-- ShareThis Button END -->
								</span>
							<?php } ?>	

							<style type="text/css">
								
								.social span a img {
									width: 42px;
								}
								
								.social span a {
									display: inline-block;
									margin-right: 5px;
								}
 
									#share-buttons img {
									width: 35px;
									padding: 5px;
									border: 0;
									box-shadow: 0;
									display: inline;
									}
									 
							</style>
							
							<div class="social">
								
								<span class="article-date" encoded="<?php echo str_replace('amp%3B', '', str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]))) ?>" normalurl="<?php echo 'https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>">
																	
									<!-- Buffer -->
									<a href="https://bufferapp.com/add?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/buffer.png" alt="Buffer" />
									</a>
									
									<!-- Digg -->
									<a href="http://www.digg.com/submit?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/diggit.png" alt="Digg" />
									</a>
									
									<!-- Email -->
									<a href="mailto:?Subject=Simple Share Buttons&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20 <?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>">
										<img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
									</a>
								 
									<!-- Facebook -->
									<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
									</a>
									
									<!-- Google+ -->
									<a href="https://plus.google.com/share?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
									</a>
									
									<!-- LinkedIn -->
									<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
									</a>
									
									<!-- Pinterest -->
									<?php /*<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
										<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
									</a>*/ ?>

									<!-- Pinterest -->
									<a href="http://pinterest.com/pin/create/button/?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
									</a>
									
									<!-- Print -->
									<a href="javascript:;" onclick="window.print()">
										<img src="https://simplesharebuttons.com/images/somacro/print.png" alt="Print" />
									</a>
									
									<!-- Reddit -->
									<a href="http://reddit.com/submit?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
									</a>
								
									<!-- Tumblr-->
									<a href="http://www.tumblr.com/share/link?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
									</a>
									 
									<!-- Twitter -->
									<a href="https://twitter.com/share?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
									</a>
									
									<!-- VK -->
									<a href="http://vkontakte.ru/share.php?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/vk.png" alt="VK" />
									</a>
									
									<!-- Yummly -->
									<a href="http://www.yummly.com/urb/verify?url=<?php echo str_replace('amp%3B', '', urlencode('https://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"])) ?>" target="_blank">
										<img src="https://simplesharebuttons.com/images/somacro/yummly.png" alt="Yummly" />
									</a>
								
								</span>
								
							</div>
							
						</div>
						
						
						
						
						<?php if($image) { ?>
							<?php if(isset($featured_found)) { ?>
								<div class="article-image">
									<!--<img src="<?php echo $image; ?>" alt="<?php echo $article_info['article_title']; ?>" height="500" />-->
									<img src="<?php echo $image; ?>" alt="<?php echo $article_info['article_title']; ?>"/>
								
								</div>
							<?php } else { ?>
								<div class="article-thumbnail-image">
									<img src="<?php echo $image; ?>" alt="<?php echo $article_info['article_title']; ?>" height="100" width="100" />
									<span class="article-description">
										<?php echo html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8'); ?>
									</span>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php if(isset($featured_found)) { ?>
							<div class="article-description">
								<?php echo html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8'); ?>
							</div>
						<?php } else { ?>
							<div class="article-description">
								<?php echo html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8'); ?>
							</div>
						<?php } ?>
						
						<?php if($article_additional_description) { ?>
							<?php foreach($article_additional_description as $description) { ?>
								<div class="article-description">
									<?php echo html_entity_decode($description['additional_description'], ENT_QUOTES, 'UTF-8'); ?>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php if ($products) { ?>
							<div class="box">
								<div class="box-heading"><?php echo $text_related_product; ?></div>
								<div class="box-content">
									<div class="box-product">
							      		<?php foreach ($products as $product) { ?>
								      		<div style="width:auto !important">
								        		<?php if ($product['thumb']) { ?>
								        			<div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
								        		<?php } ?>
								        		<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
								        		
								        		<?php if ($product['rating']) { ?>
								        			<div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
								        		<?php } ?>
								        	</div>
							      		<?php } ?>
							    	</div>
								</div>
							</div>
						<?php } ?>
						
						<?php if($this->config->get('blog_related_articles')) { ?>
							<?php if($related_articles) { ?>
								<div class="box">
									<div class="box-heading">Related Article</div>
									<div class="box-content">
										<div class="related-article">
											<?php $i=0; ?>
											<?php foreach($related_articles as $related_article) { ?>
												<?php if(($i%2) == 0) { ?>
													<div class="<?php if($column_left || $column_right) { ?> related-article-blok-11 <?php } else { ?> related-article-blok-1 <?php } ?>">
												<?php } else { ?>
													<div class="<?php if($column_left || $column_right) { ?> related-article-blok-22 <?php } else { ?> related-article-blok-2 <?php } ?>">
												<?php } ?>
													
													<?php $url = $this->url->link('simple_blog/article/view', 'simple_blog_article_id=' . $related_article['simple_blog_article_id'], 'SSL'); ?>
													
													<div class="name">
														<a href="<?php echo $url; ?>"><?php echo $related_article['article_title']; ?></a>
													</div>
													
													<div class="related-article-meta">
														<?php $author_href = $this->url->link('simple_blog/author', 'simple_blog_author_id=' . $related_article['simple_blog_author_id'], 'SSL'); ?>
														<?php echo $text_posted_by; ?> <a href="<?php echo $author_href; ?>"><?php echo $related_article['author_name']; ?></a> | <?php echo $text_on; ?> <?php echo $related_article['date_added']; ?> | <?php echo $text_updated; ?> <?php echo $related_article['date_modified']; ?> |
													</div>
													
													<div class="related-article-description">
														<div class="left">
															<img src="<?php echo $related_article['image']; ?>" height="150" width="150" />	
														</div>
														
														<div class="right">
															<?php if($column_left || $column_right) { ?>
																<?php echo utf8_substr(strip_tags(html_entity_decode($related_article['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '...'; ?>
															<?php } else { ?>
																<?php echo utf8_substr(strip_tags(html_entity_decode($related_article['description'], ENT_QUOTES, 'UTF-8')), 0, 350) . '...'; ?>
															<?php } ?>
														</div>
													</div>
													
													<div class="related-article-button">
														<a href="<?php echo $url; ?>" class="button"><?php echo $button_continue_reading; ?></a>
													</div>
													
													<div class="related-article-footer">
														<?php echo $related_article['total_comment']; ?><?php echo $text_comment_on_article; ?> <a href="<?php echo $url; ?>#comment-section"><?php echo $text_view_comment; ?></a>
													</div>
													
													<?php $i++; ?>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>
						<?php } ?>						
						
						<?php if($this->config->get('blog_author_information')) { ?>
							<?php if(isset($author_image)) { ?>
								<div class="box">
									<div class="box-heading"><?php echo $author_name; ?> <?php echo $text_author_information; ?></div>
									<div class="box-content">
										<div class="author-info">
											<div class="left">
												<img src="<?php echo $author_image; ?>" alt="<?php echo $article_info['article_title']; ?>" style="border: 1px solid #cccccc; padding: 5px; border-radius: 5px;" />
											</div>
											<div class="right">
												<?php echo $author_description; ?>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
						
						<?php if($article_info['allow_comment']) { ?>
							<div class="box">
								<div class="box-heading"><h2><?php echo $text_related_comment; ?></h2></div>
								<div class="box-content">
									<div id="comments" class="blog-comment-info">
										<div id="comment-list"></div>
										<div id="comment-section"></div>
										<h3 id="review-title">
											<?php echo $text_write_comment; ?>
											<img src="<?php echo HTTP_SERVER; ?>catalog/view/theme/default/image/remove.png" alt="Remove" id="reply-remove" style="display:none;" onclick="removeCommentId();" />
										</h3>							
										<input type="hidden" name="blog_article_reply_id" value="0" id="blog-reply-id"/>
										
										<div class="comment-left">
											<b><?php echo $entry_name; ?></b><br />
											<input type="text" name="name" value="" />								
											<br /><br />
											<b><?php echo $entry_review; ?></b><br />
										    <textarea name="text" cols="40" rows="4" style="width: 98%;"></textarea>
										    <span style="font-size: 11px;"><?php echo $text_note; ?></span>
										    <br /><br />
										    <b><?php echo $entry_captcha; ?></b><br />
										    <input type="text" name="captcha" style="" value="" /><br />
										    <img src="index.php?route=product/product/captcha" alt="" id="captcha" />
										</div>
										<br />
										<div class="buttons">
											<div class="right"><a id="button-comment" class="button"><span><?php echo $button_submit; ?></span></a></div>					    
										</div>
										
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="buttons">
						<div class="center">
							<?php echo $text_no_found; ?>
						</div>
					</div>
				<?php } ?>
				
			<?php echo $content_bottom; ?>
		</div>
		<script type="text/javascript" src="/catalog/view/javascript/jquery.fancybox.pack.js?v=2.1.5"></script>
		<script type="text/javascript">
			function removeCommentId() {
				$("#blog-reply-id").val(0);
				$("#reply-remove").css('display', 'none');
			}
		</script>
		
		<script type="text/javascript">
			$('#comment-list .pagination a').live('click', function() {
				$('#comment-list').fadeOut('slow');
					
				$('#comment-list').load(this.href);
				
				$('#comment-list').fadeIn('slow');
				
				return false;
			});			
			
			$('#comment-list').load('index.php?route=simple_blog/article/comment&simple_blog_article_id=<?php echo $simple_blog_article_id; ?>');
			
		</script>		
		
		
		<script type="text/javascript">		
			$('#button-comment').bind('click', function() {
				$.ajax({
					type: 'POST',
					url: 'index.php?route=simple_blog/article/writeComment&simple_blog_article_id=<?php echo $simple_blog_article_id; ?>',
					dataType: 'json',
					data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()) + '&reply_id=' + encodeURIComponent($('input[name=\'blog_article_reply_id\']').val()),
					beforeSend: function() {
						$('.success, .warning').remove();
						$('#button-comment').attr('disabled', true);
						$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
					},
					complete: function() {
						$('#button-comment').attr('disabled', false);
						$('.attention').remove();
					},
					success: function(data) {
						if (data['error']) {
							$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
						}
						
						if (data['success']) {
							$('#review-title').after('<div class="success">' + data['success'] + '</div>');
											
							$('input[name=\'name\']').val('');
							$('textarea[name=\'text\']').val('');
							$('input[name=\'captcha\']').val('');
							$("#blog-reply-id").val(0);
							$("#reply-remove").css('display', 'none');
							
							$('#comment-list').load('index.php?route=simple_blog/article/comment&simple_blog_article_id=<?php echo $simple_blog_article_id; ?>');							
						}
					}
				});
			});

		$(document).ready(function(){
			$('.article-description img').each(function(){

				//$(this).addClass('fancybox');

				$(this).before('<a class="fancybox" href="'+$(this).attr('src')+'" data-fancybox-group="gallery" title=""><img alt="'+$(this).attr('src')+'" src="'+$(this).attr('src')+'" style="'+$(this).attr('style')+'">');

				$(this).remove();
			});

			$('.article-image img').each(function(){

				//$(this).addClass('fancybox');

				$(this).before('<a class="fancybox" href="'+$(this).attr('src')+'" data-fancybox-group="gallery" title=""><img alt="'+$(this).attr('src')+'" src="'+$(this).attr('src')+'" style="'+$(this).attr('style')+'">');

				$(this).remove();
			});

			

			$('.fancybox').fancybox();

		});			


		</script> 

		<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

		
	<?php echo $footer; ?>	
<?php } ?>