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
		
		<div class="box">
			<div class="heading">
      			<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      			<div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    		</div>
    		
    		<div class="content">
    			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
    				<table class="form">
    					<tr>
    						<td><?php echo $entry_status; ?></td>
    						<td>
    							<select name="simple_blog_status">
    								<option value="1" <?php if($simple_blog_status == 1) { echo "selected='selected'"; } ?>><?php echo $text_enabled; ?></option>
    								<option value="0" <?php if($simple_blog_status == 0) { echo "selected='selected'"; } ?>><?php echo $text_disabled; ?></option>
    							</select>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_simple_blog_heading; ?></td>
    						<td>
    							<input type="text" name="blog_footer_heading" value="<?php echo $blog_footer_heading; ?>" size="100" />
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_blog_module_heading; ?></td>
    						<td>
    							<input type="text" name="simple_blog_heading" value="<?php echo $simple_blog_heading; ?>" size="100" />
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_product_related_heading; ?></td>
    						<td>
    							<input type="text" name="product_related_heading" value="<?php echo $product_related_heading; ?>" size="100" />
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_comment_related_heading; ?></td>
    						<td>
    							<input type="text" name="comment_related_heading" value="<?php echo $comment_related_heading; ?>" size="100" />
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_display_category; ?></td>
    						<td>
    							<?php if($blog_display_category) { ?>
	    							<input type="radio" name="blog_display_category" value="1" checked="checked" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_display_category" value="0" /> <?php echo $text_disabled; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_display_category" value="1" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_display_category" value="0" checked="checked" /> <?php echo $text_disabled; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_comment_approval; ?></td>
    						<td>
    							<?php if($blog_comment_auto_approval) { ?>
	    							<input type="radio" name="blog_comment_auto_approval" value="1" checked="checked" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="blog_comment_auto_approval" value="0" /> <?php echo $text_no; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_comment_auto_approval" value="1" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="blog_comment_auto_approval" value="0" checked="checked" /> <?php echo $text_no; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_show_author; ?></td>
    						<td>    						
    							<?php if($blog_show_authors) { ?>
	    							<input type="radio" name="blog_show_authors" value="1" checked="checked" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="blog_show_authors" value="0" /> <?php echo $text_no; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_show_authors" value="1" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="blog_show_authors" value="0" checked="checked" /> <?php echo $text_no; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_author_information; ?></td>
    						<td>
    							<?php if($blog_author_information) { ?>
	    							<input type="radio" name="blog_author_information" value="1" checked="checked" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_author_information" value="0" /> <?php echo $text_disabled; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_author_information" value="1" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_author_information" value="0" checked="checked" /> <?php echo $text_disabled; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_related_article; ?></td>
    						<td>
    							<?php if($blog_related_articles) { ?>
	    							<input type="radio" name="blog_related_articles" value="1" checked="checked" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_related_articles" value="0" /> <?php echo $text_disabled; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_related_articles" value="1" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_related_articles" value="0" checked="checked" /> <?php echo $text_disabled; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_show_social_site_option; ?></td>
    						<td>
    							<?php if($blog_share_social_site) { ?>
	    							<input type="radio" name="blog_share_social_site" value="1" checked="checked" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_share_social_site" value="0" /> <?php echo $text_disabled; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="blog_share_social_site" value="1" /> <?php echo $text_enabled; ?>&nbsp;
	    							<input type="radio" name="blog_share_social_site" value="0" checked="checked" /> <?php echo $text_disabled; ?>
	    						<?php } ?>
    						</td>
    					</tr>
    					
    					<!-- <tr>
    						<td><?php echo $entry_custom_theme; ?></td>
    						<td>    						
    							<?php if($simple_blog_custom_theme) { ?>
	    							<input type="radio" name="simple_blog_custom_theme" value="1" checked="checked" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="simple_blog_custom_theme" value="0" /> <?php echo $text_no; ?>
	    						<?php } else { ?>
	    							<input type="radio" name="simple_blog_custom_theme" value="1" /> <?php echo $text_yes; ?>&nbsp;
	    							<input type="radio" name="simple_blog_custom_theme" value="0" checked="checked" /> <?php echo $text_no; ?>
	    						<?php } ?>
    						</td>
    					</tr> -->
    				</table>
    				
    				<h2 id="custom-header-display" style="display:none;"><?php echo $text_set_header; ?></h2>
    				<table class="form" id="custom-header" style="display:none">
    					<tr>
    						<td><?php echo $entry_set_tagline; ?></td>
    						<td><input type="text" name="blog_tagline" value="<?php echo $blog_tagline; ?>" size="100" /></td>
    					</tr>
    					
    					<tr>
    						<td><?php echo $entry_image; ?></td>
    						<td>
    							<div class="image">
    								<img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                					<input type="hidden" name="blog_image" value="<?php echo $blog_image; ?>" id="image" />
                					<br />
                					<a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a> | <a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a>
                				</div>
    						</td>
    					</tr>
    					
    				</table>
    				
    				<h2><?php echo $text_article_related; ?></h2>
    				
    				<table id="module" class="list">
    					<thead>
            				<tr>
            					<td class="left"><?php echo $entry_article_limit; ?></td>
            					<td class="left"><?php echo $entry_category; ?></td>
              					<td class="left"><?php echo $entry_layout; ?></td>
              					<td class="left"><?php echo $entry_position; ?></td>
              					<td class="left"><?php echo $entry_status; ?></td>
              					<td class="right"><?php echo $entry_sort_order; ?></td>
              					<td></td>
            				</tr>
          				</thead>
          				
          				<?php $module_row = 0; ?>
          				<?php foreach ($modules as $module) { ?>
          					<tbody id="module-row<?php echo $module_row; ?>">
          						<tr>
          							<td class="left">
          								<input type="text" name="simple_blog_module[<?php echo $module_row; ?>][article_limit]" value="<?php echo $module['article_limit']; ?>" size="3" />
          							</td>
          							
          							<td class="left">
          								<select name="simple_blog_module[<?php echo $module_row; ?>][category_id]">
          									<option value="" disabled="disabled" style="font-weight: bold;"><?php echo $text_category_label; ?></option>
          									<option value="all" <?php if($module['category_id'] == 'all') { echo "selected='selected'"; } ?>><?php echo $text_latest_article; ?></option>
          									<option value="popular" <?php if($module['category_id'] == 'popular') { echo "selected='selected'"; } ?>><?php echo $text_popular_article; ?></option>
          									<option value="" disabled="disabled" style="font-weight: bold;"><?php echo $entry_category; ?></option>
          									<?php foreach($categories as $category) { ?>
          										<option value="<?php echo $category['simple_blog_category_id']; ?>" <?php if($category['simple_blog_category_id'] == $module['category_id']) { echo "selected='selected'"; } ?>><?php echo $category['name']; ?></option>
          									<?php } ?>
          								</select> 
          							</td>
          							
          							<td class="left">
          								<select name="simple_blog_module[<?php echo $module_row; ?>][layout_id]">
                  							<?php foreach ($layouts as $layout) { ?>
                  								<?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  									<option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  								<?php } else { ?>
                  									<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  								<?php } ?>
                  							<?php } ?>
                						</select>
                					</td>
          							
          							<td class="left">
          								<select name="simple_blog_module[<?php echo $module_row; ?>][position]">
                  							<?php if ($module['position'] == 'content_top') { ?>
                  								<option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                  							<?php } else { ?>
                  								<option value="content_top"><?php echo $text_content_top; ?></option>
                  							<?php } ?>
                  							<?php if ($module['position'] == 'content_bottom') { ?>
                  								<option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                  							<?php } else { ?>
                  								<option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                  							<?php } ?>
                  							<?php if ($module['position'] == 'column_left') { ?>
                  								<option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                  							<?php } else { ?>
                  								<option value="column_left"><?php echo $text_column_left; ?></option>
                  							<?php } ?>
                  							<?php if ($module['position'] == 'column_right') { ?>
                  								<option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                  							<?php } else { ?>
                  								<option value="column_right"><?php echo $text_column_right; ?></option>
                  							<?php } ?>
                						</select>
                					</td>
          							
          							<td class="left">
          								<select name="simple_blog_module[<?php echo $module_row; ?>][status]">
                  							<?php if ($module['status']) { ?>
							                	<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							                  	<option value="0"><?php echo $text_disabled; ?></option>
                  							<?php } else { ?>
                  								<option value="1"><?php echo $text_enabled; ?></option>
                  								<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  							<?php } ?>
                						</select>
                					</td>
                					
                					<td class="right"><input type="text" name="simple_blog_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
          							
          							<td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
          							
          						</tr>
          					</tbody>
          					<?php $module_row++; ?>
          				<?php } ?>
          				
          				<tfoot>
            				<tr>
              					<td colspan="6"></td>
              					<td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            				</tr>
          				</tfoot>          				
    				</table>   				
    			</form>
    		</div>
    		
		</div>
  		
  	</div>
  	
  	<script type="text/javascript"><!--
		function image_upload(field, thumb) {
			$('#dialog').remove();
			
			$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
			
			$('#dialog').dialog({
				title: '<?php echo $text_image_manager; ?>',
				close: function (event, ui) {
					if ($('#' + field).attr('value')) {
						$.ajax({
							url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
							dataType: 'text',
							success: function(data) {
								$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
							}
						});
					}
				},	
				bgiframe: false,
				width: 800,
				height: 400,
				resizable: false,
				modal: false
			});
		};
	</script>
  	
  	<script type="text/javascript">
  		$("input[name='simple_blog_custom_theme']").change(function(){
		    var value = $("input[name='simple_blog_custom_theme']:checked").val();		    
		    if(value == 1) {
		    	$("#custom-header").css({display: "table-row"});
		    	$("#custom-header-display").css({display: "block"});
		    } else {
		    	$("#custom-header").css({display: "none"});
		    	$("#custom-header-display").css({display: "none"});
		    }		    
		});
  	</script>
  	
  	<script type="text/javascript">
		$(document).ready(function() {
			<?php if ($simple_blog_custom_theme) { ?>
				$("#custom-header").css({display: "table-row"});
		    	$("#custom-header-display").css({display: "block"});
			<?php } else { ?>
				$("#custom-header").css({display: "none"});
		    	$("#custom-header-display").css({display: "none"});
			<?php } ?>
		});
	</script>
	
	<script type="text/javascript">
		
		var module_row = <?php echo $module_row; ?>;
		
		function addModule() {
			html = '<tbody id="module-row' + module_row + '">';			
			html += '	<tr>';
			html += '		<td class="left"><input type="text" name="simple_blog_module[' + module_row + '][article_limit]" value="" size="3" /></td>';
			html += '		<td class="left">';
			html += '			<select name="simple_blog_module[' + module_row + '][category_id]">';
			html += '				<option value="" disabled="disabled" style="font-weight: bold;"><?php echo $text_category_label; ?></option>';
			html += '				<option value="all"><?php echo $text_latest_article; ?></option>';
			html += '				<option value="populuar"><?php echo $text_popular_article; ?></option>';
			html += '				<option value="" disabled="disabled" style="font-weight: bold;"><?php echo $entry_category; ?></option>';
									<?php foreach($categories as $category) { ?>
										html += '<option value="<?php echo $category['simple_blog_category_id']; ?>"><?php echo $category['name']; ?></option>';						
									<?php } ?>			
			html += '			</select>';
			html += '		</td>';			
			html += '		<td class="left">';
			html += '			<select name="simple_blog_module[' + module_row + '][layout_id]">';
									<?php foreach ($layouts as $layout) { ?>
										html += '<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
									<?php } ?>			
			html += '			</select>';
			html += '		</td>';			
			html += '		<td class="left">';
			html += '			<select name="simple_blog_module[' + module_row + '][position]">';
			html += '      			<option value="content_top"><?php echo $text_content_top; ?></option>';
			html += '      			<option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
			html += '      			<option value="column_left"><?php echo $text_column_left; ?></option>';
			html += '      			<option value="column_right"><?php echo $text_column_right; ?></option>';
			html += '			</select>';
			html += '		</td>';			
			html += '		<td class="left">';
			html += '			<select name="simple_blog_module[' + module_row + '][status]">';
			html += '				<option value="1"><?php echo $text_enabled; ?></option>';
			html += '				<option value="0"><?php echo $text_disabled; ?></option>';											
			html += '			</select>';
			html += '		</td>';			
			html += '		<td class="right"><input type="text" name="simple_blog_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
			html += '    	<td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
			html += '	</tr>';			
			html += '</tbody>';
			
			$('#module tfoot').before(html);
	
			module_row++;
		}		
	</script> 	
  	
<?php echo $footer; ?>