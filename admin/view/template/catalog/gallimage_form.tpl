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
      <h1><img src="view/image/banner.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $tab_data; ?></a><a href="#tab-gallery"><?php echo $tab_gallery; ?></a></div>    
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <div id="tab-general">    
        <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>    
        <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                <td><input type="text" name="gallimage_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($gallimage_description[$language['language_id']]) ? $gallimage_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_description; ?></td>
                <td><textarea name="gallimage_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($gallimage_description[$language['language_id']]) ? $gallimage_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_meta_keyword; ?></td>
                <td><textarea name="gallimage_description[<?php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><?php echo isset($gallimage_description[$language['language_id']]) ? $gallimage_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
              </tr>
              <tr>
                <td><?php echo $entry_date; ?></td>
                <td><input type="text" name="gallimage_description[<?php echo $language['language_id']; ?>][date]" size="100" value="<?php echo isset($gallimage_description[$language['language_id']]) ? $gallimage_description[$language['language_id']]['date'] : ''; ?>" /></td>
              </tr>
              <tr>
                <td><?php echo $entry_description; ?></td>
                <td><textarea name="gallimage_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($gallimage_description[$language['language_id']]) ? $gallimage_description[$language['language_id']]['description'] : ''; ?></textarea></td>
              </tr>
            </table>
          </div>
          <?php } ?>
          </div>      
       <div id="tab-data">   
        <table class="form">   
          <tr>
              <td><?php echo $entry_image; ?></td>
              <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                  <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                  <br />
                  <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
            </tr>    
          <tr>
            <td><?php echo $entry_size; ?></td>
          <td>
          <input type="text" name="awidth" value="<?php echo $awidth; ?>" />&nbsp;x&nbsp;
          <input type="text" name="aheight" value="<?php echo $aheight; ?>" />
          </td>
         </tr> 
          <tr>
                <td><?php echo $entry_position; ?></td>
          <td>
                <select name="position">
                <?php if (isset($position)) { $selected = "selected"; ?>
                <option value="left" <?php if($position=='left'){echo $selected;} ?>>Left</option>
                <option value="right" <?php if($position=='right'){echo $selected;} ?>>Right</option>
                <option value="center" <?php if($position=='center'){echo $selected;} ?>>Center</option>
                <?php } else { ?>
                <option value="left" selected="selected">Left</option>
                <option value="right">Right</option>
                <option value="center">Center</option>
                <?php } ?>
              </select>
          </td>
            
          </tr>    
          <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $gallimage_store)) { ?>
                    <input type="checkbox" name="gallimage_store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="gallimage_store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $gallimage_store)) { ?>
                    <input type="checkbox" name="gallimage_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="gallimage_store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div></td>
            </tr>
          <tr>
              <td><?php echo $entry_keyword; ?></td>
              <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
            </tr> 
          <tr>
              <tr>
              <td><?php echo $entry_gsize; ?></td>
              <td><input type="text" name="gwidth" value="<?php echo $gwidth; ?>" />&nbsp;x&nbsp;
                  <input type="text" name="gheight" value="<?php echo $gheight; ?>" /></td>
            </tr> 
          <tr>
              <td><?php echo $entry_popstyle; ?></td>
              <td><select name="popstyle">
                <?php if (isset($popstyle)) { $selected = "selected"; ?>
                <option value="default" <?php if($popstyle=='default'){echo $selected;} ?>>MagnificPopup (Default)</option>
                <option value="blueimp" <?php if($popstyle=='blueimp'){echo $selected;} ?>>Bootstrap - blueimp</option>
                <option value="lightgall" <?php if($popstyle=='lightgall'){echo $selected;} ?>>LighBox</option>
                <?php } else { ?>
                <option value="default" selected="selected">Default</option>
                <option value="blueimp">Bootstrap - blueimp</option>
                <option value="lightgall">LighBox</option>
                <?php } ?>
                </select></td>
            </tr> 
            <tr>
            <td><?php echo $entry_resize; ?></td>
            <td><select name="resize">
                <?php if ($resize) { ?>
                <option value="1" selected="selected">Resize</option>
                <option value="0">Do Not Resize</option>
                <?php } else { ?>
                <option value="1">Resize</option>
                <option value="0" selected="selected">Do Not Resize</option>
                <?php } ?>
              </select></td>
          </tr>
            <tr>
              <tr>
              <td><?php echo $entry_psize; ?></td>
              <td><input type="text" name="pwidth" value="<?php echo $pwidth; ?>" />&nbsp;x&nbsp;
                  <input type="text" name="pheight" value="<?php echo $pheight; ?>" /></td>
            </tr> 
          <tr>            
              <td><?php echo $entry_sort_order; ?></td>
              <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
            </tr>    
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="status">
                <?php if ($status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
       </div>   
       <div id="tab-gallery">         
        <table id="images" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_title; ?></td>
              <td class="left"><?php echo $entry_link; ?></td>
              <td class="left"><?php echo $entry_image; ?></td>
              <td class="left"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $image_row = 0; ?>
          <?php foreach ($gallimage_images as $gallimage_image) { ?>
          <tbody id="image-row<?php echo $image_row; ?>">
            <tr>
              <td class="left"><?php foreach ($languages as $language) { ?>
                <input type="text" name="gallimage_image[<?php echo $image_row; ?>][gallimage_image_description][<?php echo $language['language_id']; ?>][title]" value="<?php echo isset($gallimage_image['gallimage_image_description'][$language['language_id']]) ? $gallimage_image['gallimage_image_description'][$language['language_id']]['title'] : ''; ?>" />
                <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />
                <?php if (isset($error_gallimage_image[$image_row][$language['language_id']])) { ?>
                <span class="error"><?php echo $error_gallimage_image[$image_row][$language['language_id']]; ?></span>
                <?php } ?>
                <?php } ?></td>
              <td class="left"><input type="text" name="gallimage_image[<?php echo $image_row; ?>][link]" value="<?php echo $gallimage_image['link']; ?>" /></td>
              <td class="left"><div class="image"><img src="<?php echo $gallimage_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                  <input type="hidden" name="gallimage_image[<?php echo $image_row; ?>][image]" value="<?php echo $gallimage_image['image']; ?>" id="image<?php echo $image_row; ?>"  />
                  <br />
                  <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
              <td class="left"><input type="text" name="gallimage_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $gallimage_image['sort_order']; ?>" size="3" /></td>    
              <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $image_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_gallimage; ?></a></td>
            </tr>
          </tfoot>
        </table>
        </div>   
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '<tr>';
    html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<input type="text" name="gallimage_image[' + image_row + '][gallimage_image_description][<?php echo $language['language_id']; ?>][title]" value="" /> <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /><br />';
    <?php } ?>
	html += '</td>';	
	html += '<td class="left"><input type="text" name="gallimage_image[' + image_row + '][link]" value="" /></td>';	
	html += '<td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="gallimage_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '<td class="left"><input type="text" name="gallimage_image[' + image_row + '][sort_order]" value="" size="3" /></td>';
	html += '<td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>'; 
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<?php echo $footer; ?>