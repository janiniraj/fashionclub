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
      <div id="tabs" class="htabs"><a href="#tab-basicset"><?php echo $tab_basicset; ?></a><a href="#tab-advanceset"><?php echo $tab_advanceset; ?></a></div>
      <div id="tab-basicset">
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_limit; ?></td>	
              <td class="left"><?php echo $entry_gallalbum; ?></td>
              <td class="left"><span class="required">*</span> <?php echo $entry_dimension; ?></td>
              <td class="left"><?php echo $entry_box_margin; ?></td>
              <td class="left"><?php echo $entry_headtitle; ?></td>
			  <td class="left"><?php echo $entry_shortdesc; ?></td>
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
              <td class="left"><input type="text" name="gallalbum_module[<?php echo $module_row; ?>][limit]" value="<?php echo $module['limit']; ?>" size="1" /></td>
              <td class="left">
               <div style="padding-bottom: 4px;"><?php echo $entry_gallimage; ?> <input type="text" name="gallimage_<?php echo $module_row; ?>"/><br/></div>
				<div id="selected-album-<?php echo $module_row; ?>" class="scrollbox">
	                <?php $class = 'odd'; ?>
	                <?php foreach ($module['gallalbums_list'] as $g) { ?>
	                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
	                <div id="selected-album-<?php echo $module_row . '-' . $g['gallimage_id']; ?>" class="<?php echo $class; ?>"><?php echo $g['name']; ?> <img id="deleteImage_<?php echo $module_row; ?>" src="view/image/delete.png" />
	                  <input type="hidden" value="<?php echo $g['gallimage_id']; ?>" />
	                </div>
	                <?php } ?>
              	</div>
                <input type="hidden" name="gallalbum_module[<?php echo $module_row; ?>][gallalbums]" value="<?php echo $module['gallalbums']; ?>" />  
                  
               </td>
              <td class="left"><input type="text" name="gallalbum_module[<?php echo $module_row; ?>][image_width]" value="<?php echo $module['image_width']; ?>" size="3" />
                <input type="text" name="gallalbum_module[<?php echo $module_row; ?>][image_height]" value="<?php echo $module['image_height']; ?>" size="3" />
                <?php if (isset($error_dimension[$module_row])) { ?>
                <span class="error"><?php echo $error_dimension[$module_row]; ?></span>
                <?php } ?></td>
              <td class="left"><input type="text" name="gallalbum_module[<?php echo $module_row; ?>][boxgall_margin]" value="<?php echo $module['boxgall_margin']; ?>" size="3" /></td>
              <td class="left"><input type="text" name="gallalbum_module[<?php echo $module_row; ?>][headtitle]" value="<?php echo $module['headtitle']; ?>" size="6" style="min-width:100px;" />          
              </td>
			<td class="left">
			<select name="gallalbum_module[<?php echo $module_row; ?>][shortdesc]">
                <?php if ($module['shortdesc']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select><br>
              <input type="text" name="gallalbum_module[<?php echo $module_row; ?>][shortdesc_limit]" value="<?php echo $module['shortdesc_limit']; ?>" size="6" />    
            </td>  
              <td class="left"><select name="gallalbum_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="gallalbum_module[<?php echo $module_row; ?>][position]">
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
              <td class="left"><select name="gallalbum_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td class="right"><input type="text" name="gallalbum_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
              <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="10"></td>
              <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
		<div>
        <span class="help">Note:<br />
        Box Gallery Style:<br />
        - Module : it will use the box gallery style from this module<br />
        - Theme : it will use the box product style from the theme (it will not work for custom theme without "box-product" class in css stylesheet)<br /><br />
        
        </span>
        </div>
        </div>
        <div id="tab-advanceset">
        <table class="form">    
      <tr>
      <td valign="top"><?php echo $entry_boxgallcol; ?></td>
      <td valign="top" colspan="5"><input class="color {required:false}" type="text" name="gallalbum_boxgallcol" value="<?php echo $gallalbum_boxgallcol; ?>" ></td>
	  </tr>
      <tr>
      <td><?php echo $entry_namecol; ?></td>
      <?php if(empty($gallalbum_namecol)) $gallalbum_namecol	= "222222"; ?>
      <td valign="top"><input class="color {required:false}" type="text" name="gallalbum_namecol" value="<?php echo $gallalbum_namecol; ?>" ></td>
      <td valign="top"><?php echo $entry_namefontsize; ?></td>
      <?php if(empty($gallalbum_namefontsize)) $gallalbum_namefontsize	= "12"; ?>
      <td valign="top"><input type="text" name="gallalbum_namefontsize" value="<?php echo $gallalbum_namefontsize; ?>" size="3" >px</td>
      <td valign="top"><?php echo $entry_namepos; ?></td>
      <td valign="top"><select name="gallalbum_namepos">
          <?php if (isset($gallalbum_namepos)) { $selected = "selected"; ?>
          <option value="center" <?php if($gallalbum_namepos=='center'){echo $selected;} ?>>Center</option>
          <option value="left" <?php if($gallalbum_namepos=='left'){echo $selected;} ?>>Left</option>
          <option value="right" <?php if($gallalbum_namepos=='right'){echo $selected;} ?>>Right</option>
          <?php } else { ?>
          <option value="center" selected="selected">Center</option>
          <option value="left">Left</option>
          <option value="right">Right</option>
          <?php } ?>
      </select></td>
	  </tr>
      <tr>
      <td valign="top"><?php echo $entry_bordergall; ?></td>
      <?php if(empty($gallalbum_bordercol)) $gallalbum_bordercol	= "EEEEEE"; ?>
      <td valign="top"><input class="color {required:false}" type="text" name="gallalbum_bordercol" value="<?php echo $gallalbum_bordercol; ?>" ></td>
      <td valign="top"><?php echo $entry_borderthick; ?></td>
      <?php if(empty($gallalbum_borderthick)) $gallalbum_borderthick	= "1"; ?>
      <td valign="top" colspan="3"><input type="text" name="gallalbum_borderthick" value="<?php echo $gallalbum_borderthick; ?>" size="3" >px</td>
	  </tr>
      </table> 
      <div>
        <span class="help">Note:<br />
        Box Gallery Module Style Setting is only for Box Galery Style with "Module" setting,and it will ignored when using "Theme" in Box Gallery Style.
        </span>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--


<?php for($i=0; $i<$module_row; $i++) { ?>

$('input[name=\'gallimage_<?php echo $i; ?>\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/gallimage/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.gallimage_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#selected-album-<?php echo $i; ?>-' + ui.item.value).remove();
		
		$('#selected-album-<?php echo $i; ?>').append('<div id="selected-album-<?php echo $i; ?>-' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" value="' + ui.item.value + '" /></div>');

		$('#selected-album-<?php echo $i; ?> div:odd').attr('class', 'odd');
		$('#selected-album-<?php echo $i; ?> div:even').attr('class', 'even');
		
		data = $.map($('#selected-album-<?php echo $i; ?> input'), function(element){
			return $(element).attr('value');
		});
						
		$('input[name=\'gallalbum_module[<?php echo $i; ?>][gallalbums]\']').attr('value', data.join());
					
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#selected-album-<?php echo $i; ?> div img').live('click', function() {
	$(this).parent().remove();
	
	$('#selected-album-<?php echo $i; ?> div:odd').attr('class', 'odd');
	$('#selected-album-<?php echo $i; ?> div:even').attr('class', 'even');

	data = $.map($('#selected-album-<?php echo $i; ?> input'), function(element){
		return $(element).attr('value');
	});
					
	$('input[name=\'gallalbum_module[<?php echo $i; ?>][gallalbums]\']').attr('value', data.join());
});

<?php } ?>
//--></script> 
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><input type="text" name="gallalbum_module[' + module_row + '][limit]" value="5" size="1" /></td>';
	html += '    <td class="left">';
	html += '		<div style="padding-bottom: 4px;"><?php echo $entry_gallimage; ?> <input type="text" name="gallimage_'+module_row+'"/><br/></div>';
	html += '		<div id="selected-album-'+module_row+'" class="scrollbox"></div>';
    html += '    <input type="hidden" name="gallalbum_module[' + module_row + '][gallalbums]" value="" />';
	html += '    </td>';
	html += '    <td class="left"><input type="text" name="gallalbum_module[' + module_row + '][image_width]" value="" size="3" /> <input type="text" name="gallalbum_module[' + module_row + '][image_height]" value="" size="3" /></td>'; 
	html += '    <td class="left"><input type="text" name="gallalbum_module[' + module_row + '][boxgall_margin]" value="8" size="3" /></td>';
	html += '    <td class="left"><input type="text" name="gallalbum_module[' + module_row + '][headtitle]" size="6" style="min-width:100px;" /></td>';
	html += '   <td class="left"><select name="gallalbum_module[' + module_row + '][shortdesc]">';
    html += '   <option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
    html += '      <option value="1"><?php echo $text_enabled; ?></option>';
    html += '  	</select><br><input type="text" name="gallalbum_module[' + module_row + '][shortdesc_limit]" value="100" size="6" /></td>';
	html += '    <td class="left"><select name="gallalbum_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="gallalbum_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="gallalbum_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="gallalbum_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
    
    $('input[name=\'gallimage_'+module_row+'\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/gallimage/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.gallimage_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		var name = this.name.toString();
		var module_row = name.substr(name.indexOf('_')+1,10);
		$('#selected-album-'+module_row +'-'+ui.item.value).remove();

		$('#selected-album-'+module_row).append('<div id="selected-album-'+module_row + '-'+ ui.item.value + '">' + ui.item.label + '<img id="deleteImage_'+module_row+'" src="view/image/delete.png" /><input type="hidden" value="' + ui.item.value + '" /></div>');

		$('#selected-album-'+module_row+' div:odd').attr('class', 'odd');
		$('#selected-album-'+module_row+' div:even').attr('class', 'even');
		
		data = $.map($('#selected-album-'+module_row+' input'), function(element){
			return $(element).attr('value');
		});
						
		$('input[name=\'gallalbum_module['+module_row+'][gallalbums]\']').attr('value', data.join());
					
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#selected-album-'+module_row+' div img').live('click', function() {
	var id = this.id.toString();
	var module_row = name.substr(name.indexOf('_')+1,10);
	$(this).parent().remove();
	
	$('#selected-album-'+module_row+' div:odd').attr('class', 'odd');
	$('#selected-album-'+module_row+' div:even').attr('class', 'even');

	data = $.map($('#selected-album-'+module_row+' input'), function(element){
		return $(element).attr('value');
	});
					
	$('input[name=\'gallalbum_module['+module_row+'][gallalbums]\']').attr('value', data.join());
});
	
	module_row++;
}   
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//--></script> 
<?php echo $footer; ?>