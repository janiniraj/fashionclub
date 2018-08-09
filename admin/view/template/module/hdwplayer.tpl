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
            <div class="buttons">
            <a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a>
            <a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
        </div>
        <div class="content">
         <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
         <div id="tabs" class="htabs"><a onclick="" id="tab_general" href="#tab-general">General Settings</a><a onclick="" id="tab_player" href="#tab-player">Player Settings</a></div>
         <div id="tab-general">
             <table id="module" class="list">
        <thead>
          <tr>
            <td class="left" nowrap="nowrap"><?php echo $entry_title; ?></td>
            <td class="left" ><?php echo $entry_show; ?></td>
            <td class="left" ><?php echo $entry_video; ?></td>
            <td class="left"  nowrap="nowrap"><?php echo $entry_dimension; ?></td>
            <td class="left"  nowrap="nowrap"><?php echo $entry_layout; ?></td>
            <td class="left"  nowrap="nowrap"><?php echo $entry_position; ?></td>
            <td class="left" nowrap="nowrap"><?php echo $entry_status; ?></td>
            <td class="right"  nowrap="nowrap"><?php echo $entry_sort_order; ?></td>
            <td  ></td>
          </tr>
        </thead>
        <?php $module_row = 0; ?>
        <?php foreach ($modules as $module) { if(in_array($module['category_id'], $categories)) { ?>
        <tbody id="module-row<?php echo $module_row; ?>">
          <tr>
              <td><input type="text" name="hdwplayer_module[<?php echo $module_row; ?>][title]" value="<?php echo $module['title']; ?>"></td>
              <td><?php if($module['show_title'] == '0') { ?>
                  <input type="radio" name="hdwplayer_module[<?php echo $module_row; ?>][show_title]" value="1">&nbsp;<?php echo $text_show; ?>
                  <input type="radio" name="hdwplayer_module[<?php echo $module_row; ?>][show_title]" value="0" checked="checked">&nbsp;<?php echo $text_hide; ?>
                  <?php }else { ?>
                  <input type="radio" name="hdwplayer_module[<?php echo $module_row; ?>][show_title]" value="1" checked="checked">&nbsp;<?php echo $text_show; ?>
                  <input type="radio" name="hdwplayer_module[<?php echo $module_row; ?>][show_title]" value="0">&nbsp;<?php echo $text_hide; ?>
                  <?php } ?>
              </td>
            <td class="center"><?php echo $module['category_name']; ?><input type="hidden" name="hdwplayer_module[<?php echo $module_row; ?>][category_name]" value="<?php echo $module['category_name']; ?>" />
            <input type="hidden" name="hdwplayer_module[<?php echo $module_row; ?>][category_id]" value="<?php echo $module['category_id']; ?>" /></td>
            <td class="left"><input type="text" name="hdwplayer_module[<?php echo $module_row; ?>][player_width]" value="<?php echo $module['player_width']; ?>" size="3" />
              <input type="text" name="hdwplayer_module[<?php echo $module_row; ?>][player_height]" value="<?php echo $module['player_height']; ?>" size="3" />
              <?php if (isset($error_image[$module_row])) { ?>
              <span class="error"><?php echo $error_image[$module_row]; ?></span>
              <?php } ?></td>
            <td class="left"><select name="hdwplayer_module[<?php echo $module_row; ?>][layout_id]">
                <?php foreach ($layouts as $layout) { ?>
                <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            <td class="left"><select name="hdwplayer_module[<?php echo $module_row; ?>][position]">
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
              </select></td>
            <td class="left"><select name="hdwplayer_module[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
            <td class="right"><input type="text" name="hdwplayer_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
          </tr>
        </tbody>
        <?php $module_row++; ?>
        <?php } } ?>
        <tfoot>
          <tr>
              <td colspan="6"  class="right" ><h3 style="color: navy;">Enter Video Category Name:&nbsp;&nbsp;<input type="text" id="video" name="video" size="30"/><input type="hidden" id="hid_video" name="hid_video"/></h3></td>
            <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
          </tr>
      </table>
         </div>
         <div id="tab-player">
             <table width="100%">
                        <tr>
                            <td>
                                <fieldset>
                                    <legend><?php echo $entry_player_settings; ?></legend>
                                    <table class="form">
                                    	<tr>
                                            <td class="left"><?php echo $entry_skin_mode; ?></td>
                                            <td><select name="skin_mode">
                                                    <?php if ($skin_mode == 'float') { ?>
                                                    <option value="float" selected="selected">Float</option>
                                                    <?php } else { ?>
                                                    <option value="float" >Float</option>
                                                    <?php } ?>
                                                    <?php if ($skin_mode == 'static') { ?>
                                                    <option value="static" selected="selected">Static</option>
                                                    <?php } else { ?>
                                                    <option value="static" >Static</option>
                                                    <?php } ?>
                                                </select>
                                                </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_stretch_type; ?></td>
                                            <td><select name="stretch_type">
                                                    <?php if ($stretch_type == 'fill') { ?>
                                                    <option value="fill" selected="selected">Fill</option>
                                                    <?php } else { ?>
                                                    <option value="fill" >Fill</option>
                                                    <?php } ?>
                                                    <?php if ($stretch_type == 'uniform') { ?>
                                                    <option value="uniform" selected="selected" >Uniform</option>
                                                    <?php } else { ?>
                                                    <option value="uniform" >Uniform</option>
                                                    <?php } ?>
                                                    <?php if ($stretch_type == 'none') { ?>
                                                    <option value="none" selected="selected">Original</option>
                                                    <?php } else { ?>
                                                    <option value="none" >Original</option>
                                                    <?php } ?>
                                                    <?php if ($stretch_type == 'exact_fit') { ?>
                                                    <option value="exact_fit" selected="selected" >Exact Fit</option>
                                                    <?php } else { ?>
                                                    <option value="exact_fit" >Exact Fit</option>
                                                    <?php } ?>
                                                </select>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_buffer_time; ?></td>
                                            <td><input type="text" name="buffer_time" value="<?php echo $buffer_time; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_volume_level; ?></td>
                                            <td><input type="text" name="volume_level" value="<?php echo $volume_level; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_autoplay; ?></td>

                                            <td><?php if ($autoplay) { ?>
                                                <input type="checkbox" name="autoplay" value="1" checked="checked" />
                                                <?php } else { ?>
                                                <input type="checkbox" name="autoplay" value="1" />
                                                <?php } ?></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_playlist_autoplay; ?></td>
                                            <td><?php if ($playlist_autoplay) { ?>
                                                <input type="checkbox" name="playlist_autoplay" value="1" checked="checked" />
                                                <?php } else { ?>
                                                <input type="checkbox" name="playlist_autoplay" value="1" />
                                                <?php } ?></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_playlist_open; ?></td>
                                            <td><?php if ($playlist_open) { ?>
                                                <input type="checkbox" name="playlist_open" value="1" checked="checked" />
                                                <?php } else { ?>
                                                <input type="checkbox" name="playlist_open" value="1" />
                                                <?php } ?></td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_random_playlist; ?></td>
                                            <td><?php if ($random_playlist) { ?>
                                                <input type="checkbox" name="random_playlist" value="1" checked="checked" />
                                                <?php } else { ?>
                                                <input type="checkbox" name="random_playlist" value="1" />
                                                <?php } ?></td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </td>
                            <td style="margin-top: 0px;  vertical-align: top;">
                                <table width="100%">
                                    <tr><td>
                                            <fieldset >
                                                <legend><?php echo $entry_skin_settings; ?></legend>
                                                <table class="form">
                                                    <tr>
                                                        <td class="left"><?php echo $entry_control_bar; ?></td>
                                                        <td><?php if ($control_bar) { ?>
                                                            <input type="checkbox" name="control_bar" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="control_bar" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_play_pause; ?></td>
                                                        <td><?php if ($play_pause) { ?>
                                                            <input type="checkbox" name="play_pause" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="play_pause" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_progress_bar; ?></td>
                                                        <td><?php if ($progress_bar) { ?>
                                                            <input type="checkbox" name="progress_bar" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="progress_bar" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_timer; ?></td>
                                                        <td><?php if ($timer) { ?>
                                                            <input type="checkbox" name="timer" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="timer" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_share; ?></td>
                                                        <td><?php if ($share) { ?>
                                                            <input type="checkbox" name="share" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="share" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_volume; ?></td>
                                                        <td><?php if ($volume) { ?>
                                                            <input type="checkbox" name="volume" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="volume" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_full_screen; ?></td>
                                                        <td><?php if ($full_screen) { ?>
                                                            <input type="checkbox" name="full_screen" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="full_screen" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_play_dock; ?></td>
                                                        <td><?php if ($play_dock) { ?>
                                                            <input type="checkbox" name="play_dock" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="play_dock" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="left"><?php echo $entry_play_list; ?></td>
                                                        <td><?php if ($play_list) { ?>
                                                            <input type="checkbox" name="play_list" value="1" checked="checked" />
                                                            <?php } else { ?>
                                                            <input type="checkbox" name="play_list" value="1" />
                                                            <?php } ?></td>
                                                    </tr>
                                                </table>
                                            </fieldset>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
         </div>
         </form>
    	</div>
	</div>
</div>
<script type="text/javascript"><!--
    var W3CDOM = (document.createElement && document.getElementsByTagName);
    //--></script>
<script type="text/javascript"><!--
    $('#tabs a').tabs(); 
    //--></script>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;


function addModule() {	
var val = document.getElementById('video').value;
var val2 = document.getElementById('hid_video').value;
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
        html += ' <td><input type="text" name="hdwplayer_module['+module_row+'][title]" value=""></td>';
        html += ' <td><input type="radio" name="hdwplayer_module['+module_row+'][show_title]" value="1" checked="checked">&nbsp;<?php echo $text_show; ?><input type="radio" name="hdwplayer_module['+module_row+'][show_title]" value="0">&nbsp;<?php echo $text_hide; ?></td>';
	html += '    <td class="center">'+ val + '<input type="hidden" name="hdwplayer_module['+module_row+'][category_name]" value="'+val+'" /><input type="hidden" name="hdwplayer_module['+module_row+'][category_id]" value="'+val2+'" /></td>';
	html += '    <td class="left"><input type="text" name="hdwplayer_module[' + module_row + '][player_width]" value="176" size="3" /> <input type="text" name="hdwplayer_module[' + module_row + '][player_height]" value="150" size="3" /></td>';	
	html += '    <td class="left"><select name="hdwplayer_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="hdwplayer_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="hdwplayer_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="hdwplayer_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
        document.getElementById('video').value = "";
	
	module_row++;
}
//--></script>
<script type="text/javascript" >
                $('input[name=\'video\']').autocomplete({
					delay: 500,
					source: function(request, response) {
						$.ajax({
							url: 'index.php?route=module/hdwplayer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
							dataType: 'json',
							success: function(json) {
								response($.map(json, function(item) {
									return {
										label: item.name,
										value: item.category_id
									}
								}));
							}
						});
					},
					select: function(event, ui) {
                                        $(this).val(ui.item.label);
                                        $('#hid_video').val(ui.item.value);
						return false;
					},
					focus: function(event, ui) {
							return false;
					}
				});
</script>
<?php echo $footer; ?>