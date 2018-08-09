<?php echo $header; ?>
<div id="content">
<div class="breadcrumb"><?php foreach ($breadcrumbs as $breadcrumb) { ?>
<?php echo $breadcrumb['separator']; ?><a
	href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
<?php } ?></div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?> <?php if($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<div class="box">
<div class="heading">
<h1><img src="../image/hdwplayer/dis_hd.png" alt="" /> <?php echo $heading_title; ?></h1>
<div class="buttons"><a onclick="$('#form0').submit();" id="save"
	style="display: none;" class="button"><?php echo $button_save; ?></a> <a
	onclick="publishVideos();" id="publishv" style="display: none;"
	class="button"><?php echo $button_publish; ?></a> <a
	onclick="unpublishVideos();" id="unpublishv" style="display: none;"
	class="button"><?php echo $button_unpublish; ?></a> <a
	href="<?php echo $insert; ?>" id="insertv" style="display: none;"
	class="button"><?php echo $button_insert; ?></a> <a
	onclick="deleteVideo();" id="deletev" style="display: none;"
	class="button"><?php echo $button_delete; ?></a> <a
	onclick="publishCategories();" id="publishc" style="display: none;"
	class="button"><?php echo $button_publish; ?></a> <a
	onclick="unpublishCategories();" id="unpublishc" style="display: none;"
	class="button"><?php echo $button_unpublish; ?></a> <a
	href="<?php echo $insertc; ?>" id="insertc" style="display: none;"
	class="button"><?php echo $button_insert; ?></a> <a
	onclick="deleteCategory();" id="deletec" style="display: none;"
	class="button"><?php echo $button_delete; ?></a>
	 <a
	href="<?php echo $cancel; ?>" id="cancel" class="button"><?php echo $button_cancel; ?></a>
</div>
</div>
<div class="content">
<div>
<p></p>
<div id="tabs" class="htabs"><a
	onclick="javascript:changeType(this.id);" id="tab_settings"
	href="#tab-settings"><?php echo $tab_settings; ?></a><a
	onclick="javascript:changeType(this.id);" id="tab_videos"
	href="#tab-videos"><?php echo $tab_videos; ?></a><a
	onclick="javascript:changeType(this.id);" id="tab_category"
	href="#tab-category"><?php echo $tab_category; ?></a></div>
</div>
<div id="tab-settings">
<form action="<?php echo $action; ?>" method="post"
	enctype="multipart/form-data" id="form0"><?php //SETTING TAB ?>
<table width="100%">
	<tr>
		<td>
		<fieldset><legend
			style="padding: 0.2em 0.5em; border: 1px solid black; font-size: 100%; text-align: left;"><?php echo $entry_player_settings; ?></legend>
		<table class="form">
			<tr>
				<td class="left"><?php echo $entry_width; ?></td>
				<td><input type="text" name="width" value="<?php echo $width; ?>"
					size="20" /> <?php if (isset($error_name['width'])) { ?>
				<div class="error"><?php echo $error_name['width']; ?></div>
				<?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_height; ?></td>
				<td><input type="text" name="height" value="<?php echo $height; ?>" />
				<?php if (isset($error_name['height'])) { ?>
				<div class="error"><?php echo $error_name['height']; ?></div>
				<?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_licence_key; ?></td>
				<td><input type="text" name="licence_key" size="50"
					value="<?php echo $licence_key; ?>" /> <?php if (isset($error_name['licence_key'])) { ?>
				<div class="error"><?php echo $error_name['licence_key']; ?></div>
				<?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_logo; ?></td>
				<td><input type="text" name="logo" size="50"
					value="<?php echo $logo; ?>" /> <?php if (isset($error_name['logo'])) { ?>
				<div class="error"><?php echo $error_name['logo']; ?></div>
				<?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_logo_position; ?></td>
				<td><select name="logo_position">
				<?php if ($logo_position == 'topright') { ?>
					<option value="topright" selected="selected"><?php echo $text_top_right ?></option>
					<?php } else { ?>
					<option value="topright"><?php echo $text_top_right ?></option>
					<?php } ?>
					<?php if ($logo_position == 'topleft') { ?>
					<option value="topleft" selected="selected"><?php echo $text_top_left ?></option>
					<?php } else { ?>
					<option value="topleft"><?php echo $text_top_left ?></option>
					<?php } ?>
					<?php if ($logo_position == 'bottomleft') { ?>
					<option value="bottomleft" selected="selected"><?php echo $text_bottom_left ?></option>
					<?php } else { ?>
					<option value="bottomleft"><?php echo $text_bottom_left ?></option>
					<?php } ?>
					<?php if ($logo_position == 'bottomright') { ?>
					<option value="bottomright" selected="selected"><?php echo $text_bottom_right ?></option>
					<?php } else { ?>
					<option value="bottomright"><?php echo $text_bottom_right ?></option>
					<?php } ?>
					<?php if ($logo_position == 'center') { ?>
					<option value="center" selected="selected"><?php echo $text_center ?></option>
					<?php } else { ?>
					<option value="center"><?php echo $text_center ?></option>
					<?php } ?>
				</select></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_logo_alpha; ?></td>
				<td><input type="text" name="logo_alpha"
					value="<?php echo $logo_alpha; ?> " /> <?php if (isset($error_name['logo_alpha'])) { ?>
				<div class="error"><?php echo $error_name['logo_alpha']; ?></div>
				<?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_logo_target; ?></td>
				<td><input type="text" name="logo_target"
					value="<?php echo $logo_target; ?>" size="50" /></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_skin_mode; ?></td>
				<td><select name="skin_mode">
				<?php if ($skin_mode == 'float') { ?>
					<option value="float" selected="selected"><?php echo $text_float; ?></option>
					<?php } else { ?>
					<option value="float"><?php echo $text_float; ?></option>
					<?php } ?>
					<?php if ($skin_mode == 'static') { ?>
					<option value="static" selected="selected"><?php echo $text_static; ?></option>
					<?php } else { ?>
					<option value="static"><?php echo $text_static; ?></option>
					<?php } ?>
				</select>
			
			</tr>
			<tr>
				<td class="left"><?php echo $entry_stretch_type; ?></td>
				<td><select name="stretch_type">
				<?php if ($stretch_type == 'fill') { ?>
					<option value="fill" selected="selected"><?php echo $text_fill; ?></option>
					<?php } else { ?>
					<option value="fill"><?php echo $text_fill; ?></option>
					<?php } ?>
					<?php if ($stretch_type == 'uniform') { ?>
					<option value="uniform" selected="selected"><?php echo $text_uniform; ?></option>
					<?php } else { ?>
					<option value="uniform"><?php echo $text_uniform; ?></option>
					<?php } ?>
					<?php if ($stretch_type == 'none') { ?>
					<option value="none" selected="selected"><?php echo $text_original; ?></option>
					<?php } else { ?>
					<option value="none"><?php echo $text_original; ?></option>
					<?php } ?>
					<?php if ($stretch_type == 'exact_fit') { ?>
					<option value="exact_fit" selected="selected"><?php echo $text_exact; ?></option>
					<?php } else { ?>
					<option value="exact_fit"><?php echo $text_exact; ?></option>
					<?php } ?>
				</select>
			
			</tr>
			<tr>
				<td class="left"><?php echo $entry_buffer_time; ?></td>
				<td><input type="text" name="buffer_time"
					value="<?php echo $buffer_time; ?>" /></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_volume_level; ?></td>
				<td><input type="text" name="volume_level"
					value="<?php echo $volume_level; ?>" /></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_autoplay; ?></td>

				<td><?php if ($autoplay) { ?> <input type="checkbox" name="autoplay"
					value="1" checked="checked" /> <?php } else { ?> <input
					type="checkbox" name="autoplay" value="1" /> <?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_playlist_autoplay; ?></td>
				<td><?php if ($playlist_autoplay) { ?> <input type="checkbox"
					name="playlist_autoplay" value="1" checked="checked" /> <?php } else { ?>
				<input type="checkbox" name="playlist_autoplay" value="1" /> <?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_playlist_open; ?></td>
				<td><?php if ($playlist_open) { ?> <input type="checkbox"
					name="playlist_open" value="1" checked="checked" /> <?php } else { ?>
				<input type="checkbox" name="playlist_open" value="1" /> <?php } ?></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_random_playlist; ?></td>
				<td><?php if ($random_playlist) { ?> <input type="checkbox"
					name="random_playlist" value="1" checked="checked" /> <?php } else { ?>
				<input type="checkbox" name="random_playlist" value="1" /> <?php } ?></td>
			</tr>
		</table>
		</fieldset>
		</td>
		<td style="margin-top: 0px; vertical-align: top;">
		<table width="100%">
			<tr>
				<td>
				<fieldset><legend
					style="padding: 0.2em 0.5em; border: 1px solid black; font-size: 100%; text-align: left;"><?php echo $entry_server_settings; ?></legend>
				<table class="form">
					<tr>
						<td class="left"><?php echo $entry_ffmpeg; ?></td>
						<td><input type="text" name="ffmpeg"
							value="<?php echo $ffmpeg; ?>" /></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_flvtool2; ?></td>
						<td><input type="text" name="flvtool2"
							value="<?php echo $flvtool2; ?>" /></td>
					</tr>
				</table>
				</fieldset>
				</td>
			</tr>
			<tr>
				<td>
				<fieldset><legend
					style="padding: 0.2em 0.5em; border: 1px solid black; font-size: 100%; text-align: left;"><?php echo $entry_skin_settings; ?></legend>
				<table class="form">
					<tr>
						<td class="left"><?php echo $entry_control_bar; ?></td>
						<td><?php if ($control_bar) { ?> <input type="checkbox"
							name="control_bar" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="control_bar" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_play_pause; ?></td>
						<td><?php if ($play_pause) { ?> <input type="checkbox"
							name="play_pause" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="play_pause" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_progress_bar; ?></td>
						<td><?php if ($progress_bar) { ?> <input type="checkbox"
							name="progress_bar" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="progress_bar" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_timer; ?></td>
						<td><?php if ($timer) { ?> <input type="checkbox" name="timer"
							value="1" checked="checked" /> <?php } else { ?> <input
							type="checkbox" name="timer" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_share; ?></td>
						<td><?php if ($share) { ?> <input type="checkbox" name="share"
							value="1" checked="checked" /> <?php } else { ?> <input
							type="checkbox" name="share" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_volume; ?></td>
						<td><?php if ($volume) { ?> <input type="checkbox" name="volume"
							value="1" checked="checked" /> <?php } else { ?> <input
							type="checkbox" name="volume" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_full_screen; ?></td>
						<td><?php if ($full_screen) { ?> <input type="checkbox"
							name="full_screen" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="full_screen" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_play_dock; ?></td>
						<td><?php if ($play_dock) { ?> <input type="checkbox"
							name="play_dock" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="play_dock" value="1" /> <?php } ?></td>
					</tr>
					<tr>
						<td class="left"><?php echo $entry_play_list; ?></td>
						<td><?php if ($play_list) { ?> <input type="checkbox"
							name="play_list" value="1" checked="checked" /> <?php } else { ?>
						<input type="checkbox" name="play_list" value="1" /> <?php } ?></td>
					</tr>
				</table>
				</fieldset>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
</form>
</div>

					<?php //VIDEO TAB ?>
<div id="tab-videos">
<form action="<?php echo $update; ?>" method="post"
	enctype="multipart/form-data" id="form1">
<table style="padding-bottom: 10px;">
	<tr>
		<td align="left" width="100%"><?php echo $entry_filter; ?>&nbsp; <input
			type="text" name="search" id="search" value=""
			title="Search The Video" /> <a onclick="filterVideo();"
			class="button"><?php echo $entry_go; ?></a> <a
			onclick="resetVideo();" class="button"><?php echo $entry_reset; ?></a>
		</td>
		<td nowrap="nowrap"></td>
	</tr>
</table>
<table id="player" class="list">
	<thead>
		<tr>
			<td class="center" width="1%"><?php echo $entry_hash; ?></td>
			<td class="center" width="1%"><input type="checkbox"
				onclick="$('input[name*=\'selectedv\']').attr('checked', this.checked);" />
			</td>
			<td class="center" width="15%"><?php echo $entry_title; ?></td>
			<td class="center" width="15%"><?php echo $entry_category; ?></td>
			<td class="center" width=""><?php echo $entry_video; ?></td>
			<td class="center" width="10%"><?php echo $entry_type; ?></td>
			<td class="center" width="5%" nowrap="nowrap"><?php echo $entry_published; ?></td>
		</tr>
	</thead>
	<?php $video_row = 1; ?>
	<?php foreach ($videos as $video){ ?>
	<tbody id="video-row<?php echo $video_row;?>">
		<tr>
			<td class="center"><?php echo $video_row; ?></td>
			<td class="center"><?php if($video['selected']) { ?> <input
				type="checkbox" name="selectedv[]"
				value="<?php echo $video['video_id']; ?>" checked="checked" /> <?php } else { ?>
			<input type="checkbox" name="selectedv[]"
				value="<?php echo $video['video_id']; ?>" /> <?php } ?></td>
			<td class="center"><?php foreach ($video['action'] as $action) { ?> <a
				href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a>
				<?php } ?></td>
			<td class="center"><?php if($video['category'] == '') { 
				echo 'none';
			}
			else {
				echo $video['category'];
			}
			?></td>
			<td class="center"><?php echo $video['video']; ?></td>
			<td class="center"><?php echo $video['video_type']; ?></td>
			<td class="center"><?php if($video['published']) { ?> <a
				onclick="unpublishVideo(this.id);"
				id="<?php echo $video['video_id']; ?>"><?php echo $button_publish; ?></a>
				<?php } else { ?> <a onclick="publishVideo(this.id);"
				id="<?php echo $video['video_id']; ?>" style="color: red;"><?php echo $button_unpublish; ?></a>
				<?php } ?></td>
		</tr>
	</tbody>
	<?php $video_row++ ; } ?>
</table>
<input type="hidden" name="edit" value="" /> <input type="hidden"
	name="value" value="" /></form>
<div class="pagination"><?php echo $pagination; ?></div>
</div>
	<?php //CATEGORY TAB ?>
<div id="tab-category">
<form action="<?php echo $updatec; ?>" method="post"
	enctype="multipart/form-data" id="form2">
<table style="padding-bottom: 10px;">
	<tbody id="category-row">
		<tr>
			<td class="left" width="100%"><?php echo $entry_filter; ?>&nbsp; <input
				type="text" name="search" id="search" value="" class="text_area"
				title="Search The Category" /> <a onclick="filterCategory();"
				class="button"><?php echo $entry_go; ?></a> <a
				onclick="resetCategory();" class="button"><?php echo $entry_reset; ?></a>
			</td>
		</tr>
	</tbody>
</table>
<table id="category" class="list">
	<thead>
		<tr>
			<td class="center" width="1%"><?php echo $entry_hash; ?></td>
			<td class="center" width="1%"><input type="checkbox"
				onclick="$('input[name*=\'selectedc\']').attr('checked', this.checked);" />
			</td>
			<td class="center" width="20%"><?php echo $entry_category_name; ?></td>
			<td class="center"><?php echo $entry_category_images; ?></td>
			<td class="center" width="5%" nowrap="nowrap"><?php echo $entry_published; ?></td>
		</tr>
	</thead>
	<?php $category_row = 1; ?>
	<?php foreach ($categories as $category) { ?>
	<tbody id="category-row<?php echo $category_row; ?>">
		<tr>
			<td class="center"><?php echo $category_row; ?></td>
			<td class="center"><?php if($category['selected']) { ?> <input
				type="checkbox" name="selectedc[]"
				value="<?php echo $category['category_id']; ?>" checked="checked" />
				<?php } else { ?> <input type="checkbox" name="selectedc[]"
				value="<?php echo $category['category_id']; ?>" /> <?php } ?></td>
			<td class="center"><?php foreach ($category['action'] as $action) { ?>
			<a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a>
			<?php } ?></td>
			<td class="center"><?php echo $category['image']; ?></td>
			<td class="center"><?php if($category['publish']) { ?> <a
				onclick="unpublishCategory(this.id);"
				id="<?php echo $category['category_id']; ?>"><?php echo $button_publish; ?></a>
				<?php } else { ?> <a onclick="publishCategory(this.id);"
				id="<?php echo $category['category_id']; ?>" style="color: red;"><?php echo $button_unpublish; ?></a>
				<?php } ?></td>
		</tr>
		<?php $category_row++; } ?>
	</tbody>
</table>
<input type="hidden" name="value" value="" /> <input type="hidden"
	name="edit" value="" /></form>
</div>
<input type="hidden" name="view" id="view" value="<?php echo $view; ?>" />
</div>
</div>
</div>
<script type="text/javascript"><!--
    var W3CDOM = (document.createElement && document.getElementsByTagName);
    //--></script>
<script type="text/javascript"><!--
    $('#tabs a').tabs(); 
    //--></script>
<script type="text/javascript">
        
    changeType('tab_settings');
        
 
    function changeType(typ) {
    document.getElementById('save').style.display="none";
    document.getElementById('insertv').style.display="none";
    document.getElementById('deletev').style.display="none";
    document.getElementById('publishv').style.display="none";
    document.getElementById('unpublishv').style.display="none";
    document.getElementById('insertc').style.display="none";
    document.getElementById('deletec').style.display="none";
    document.getElementById('publishc').style.display="none";
    document.getElementById('unpublishc').style.display="none";
			
    switch(typ) {
    case 'tab_settings':
    	document.getElementById('save').style.display="";
    	break;
    case 'tab_videos':
        document.getElementById('insertv').style.display="";
        document.getElementById('insertv').style.cssText="background: white; color: #003A88; border: 1px solid #FFFFEF; font-weight: bold;";
        document.getElementById('deletev').style.display="";
        document.getElementById('publishv').style.display="";
        document.getElementById('unpublishv').style.display="";
        break;
    case 'tab_category':
        document.getElementById('insertc').style.display="";
        document.getElementById('insertc').style.cssText="background: white; color: #003A88; border: 1px solid #FFFFEF; font-weight: bold;";
        document.getElementById('deletec').style.display="";
        document.getElementById('publishc').style.display="";
        document.getElementById('unpublishc').style.display="";
        break;
    }
}
</script>
<script type="text/javascript">
             function deleteVideo()  {
             document.forms['form1'].edit.value = "delete";
             document.forms['form1'].submit();
         }
         function deleteCategory()  {
         document.forms['form2'].edit.value = "delete";
             document.forms['form2'].submit();
         }
         function publishCategories() {
         document.forms['form2'].edit.value = "publish_selected";
         document.forms['form2'].submit();
         }
         function publishCategory(pub) {
         document.forms['form2'].value.value = pub;
         document.forms['form2'].edit.value = "publish";
         document.forms['form2'].submit();
         }
         function unpublishCategories() {
         document.forms['form2'].edit.value = "unpublish_selected";
         document.forms['form2'].submit();
         }
         function unpublishCategory(pub) {
         document.forms['form2'].value.value = pub;
         document.forms['form2'].edit.value = "unpublish";
         document.forms['form2'].submit();
         }
         function publishVideos() {
         document.forms['form1'].edit.value = "publish_selected";
         document.forms['form1'].submit();
         }
        function publishVideo(pub) {
        document.forms['form1'].value.value = pub;
        document.forms['form1'].edit.value = "publish";
         document.forms['form1'].submit();
         }
         function unpublishVideo(pub) {
         document.forms['form1'].value.value = pub;
         document.forms['form1'].edit.value = "unpublish";
         document.forms['form1'].submit();
         }
         function unpublishVideos() {
         document.forms['form1'].edit.value = "unpublish_selected";
         document.forms['form1'].submit();
         }
         function filterVideo(){
         document.forms['form1'].edit.value = "filter";
         document.forms['form1'].submit();
         }
         function resetVideo(){
         document.forms['form1'].edit.value="reset";
         document.forms['form1'].submit();
         }
         function filterCategory(){
         document.forms['form2'].edit.value = "filter";
         document.forms['form2'].submit();
         }
         function resetCategory(){
         document.forms['form2'].edit.value="reset";
         document.forms['form2'].submit();
         }
         
         
    </script>
<script type="text/javascript">
var val = document.getElementById('view').value;
changeTab(val);

    function changeTab(tab){
    switch (tab) {
    case 'set':
        document.getElementById('tab_settings').click();
        break;
    case 'vid':
        document.getElementById('tab_videos').click();
        break;
    case 'cat':
        document.getElementById('tab_category').click();
        break;
    default:
        document.getElementById('tab_settings').click();
        break;
}
    
}
    </script>
<?php echo $footer; ?>