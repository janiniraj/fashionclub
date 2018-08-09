<?php echo $header; ?>
	<div id="content">
		
		<div class="breadcrumb">
    		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
    			<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    		<?php } ?>
  		</div>
  		
  		<?php if ($error_warning) { ?>
  			<div class="warning"><?php echo $error_warning; ?></div>
  		<?php } ?>
  		
  		<?php if ($success) { ?>
  			<div class="success"><?php echo $success; ?></div>
  		<?php } ?>
		
		<div class="box">
    		<div class="heading">
      			<h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      			<div class="buttons"><a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a><a onclick="$('form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    		</div>
    		
    		<div class="content">
      			<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
      			
      				<table class="list">
						<thead>
			            	<tr>
			              		<td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
			              		
			              		<td class="left">
			              			<?php if ($sort == 'sbad.article_title') { ?>
			                			<a href="<?php echo $sort_article_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_article_title; ?></a>
			                		<?php } else { ?>
			                			<a href="<?php echo $sort_article_title; ?>"><?php echo $column_article_title; ?></a>
			                		<?php } ?>
			                	</td>
			              		
			              		<td class="left">
			              			<?php if ($sort == 'sbau.author_name') { ?>
			                			<a href="<?php echo $sort_author_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_author_name; ?></a>
			                		<?php } else { ?>
			                			<a href="<?php echo $sort_author_name; ?>"><?php echo $column_author_name; ?></a>
			                		<?php } ?>
			                	</td>
			                	
			                	<td class="right">
			              			<?php if ($sort == 'sba.sort_order') { ?>
			                			<a href="<?php echo $sort_sortorder; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
			                		<?php } else { ?>
			                			<a href="<?php echo $sort_sortorder; ?>"><?php echo $column_sort_order; ?></a>
			                		<?php } ?>
			                	</td>
			                	
			              		<td class="left">
			              			<?php if ($sort == 'sba.status') { ?>
			                			<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
			                		<?php } else { ?>
			                			<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
			                		<?php } ?>
			                	</td>
			                	<td class="right">
			              			<?php if ($sort == 'sba.date_added') { ?>
			                			<a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
			                		<?php } else { ?>
			                			<a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
			                		<?php } ?>
			                	</td>
			              		<td class="right"><?php echo $column_action; ?></td>
			            	</tr>
			          	</thead>
			          	
			          	<tbody>
			          		<?php if ($articles) { ?>
			          			<?php foreach($articles as $article) { ?>
			          				<tr>
				          				<td style="text-align: center;">
			          						<?php if ($article['selected']) { ?>
	            								<input type="checkbox" name="selected[]" value="<?php echo $article['simple_blog_article_id']; ?>" checked="checked" />
	            							<?php } else { ?>
	            								<input type="checkbox" name="selected[]" value="<?php echo $article['simple_blog_article_id']; ?>" />
	            							<?php } ?>
	            						</td>  
	            						<td class="left"><?php echo $article['article_title']; ?></td>
	            						<td class="left"><?php echo $article['author_name']; ?></td>
	            						<td class="right"><?php echo $article['sort_order']; ?></td>
                						<td class="left"><?php echo $article['status']; ?></td>
                						<td class="right"><?php echo $article['date_added']; ?></td>
                						<td class="right">
                							<?php foreach ($article['action'] as $action) { ?>
                								[ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                							<?php } ?>
                						</td>  
            						</tr>            						            						
			          			<?php } ?>
			          		<?php } else { ?>
			          			<tr>
			          				<td class="center" colspan="7"><?php echo $text_no_results; ?></td>
			          			</tr>
			          		<?php } ?>
			          	</tbody>			          	
					</table>					
      			</form>
      			<div class="pagination"><?php echo $pagination; ?></div>
      		</div>
    		
    		
    	</div>
    </div>	
<?php echo $footer; ?>