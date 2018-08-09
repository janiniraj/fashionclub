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
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
  </div>
    <div class="content">
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="country_zone_status">
                <?php if ($country_zone_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="country_zone_sort_order" value="<?php echo $country_zone_sort_order; ?>" size="1" /></td>
          </tr>
	    </table>
	    
        <table id="country-zone-shipping" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_country; ?></td>
              <td class="left"><?php echo $entry_zone; ?></td>
              <td class="left"><?php echo $entry_tax_class; ?></td>
              <td class="left"><?php echo $entry_first; ?></td>
              <td class="left"><?php echo $entry_next; ?></td>
              <td></td>
            </tr>
          </thead>
          
          <?php $row = 0; ?>
            <?php if (is_array($country_zone_cost)) { ?>
	          <?php foreach ($country_zone_cost as $czc) { ?>
	          <tbody id="country-zone-cost-row<?php echo $row; ?>">
	            <tr>
	              <td class="left"><select name="country_zone_cost[<?php echo $row; ?>][country_id]" id="country<?php echo $row; ?>" onchange="$('#zone<?php echo $row; ?>').load('index.php?route=localisation/geo_zone/zone&token=<?php echo $token; ?>&country_id=' + this.value + '&zone_id=0');">
	                  <?php foreach ($countries as $country) { ?>
	                    <?php  if ($country['country_id'] == $czc['country_id']) { ?>
	                      <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
	                    <?php } else { ?>
	                      <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
	                    <?php } ?>
	                  <?php } ?>
	                </select></td>
	              <td class="left"><select name="country_zone_cost[<?php echo $row; ?>][zone_id]" id="zone<?php echo $row; ?>">
	                </select></td>
	                
	            <td><select name="country_zone_cost[<?php echo $row; ?>][tax_class_id]">
	                  <option value="0"><?php echo $text_none; ?></option>
	                  <?php foreach ($tax_classes as $tax_class) { ?>
	                    <?php if ($czc['tax_class_id'] == $tax_class['tax_class_id']) { ?>
	                  	  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
	                    <?php } else { ?>
	                    	<option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
	                    <?php } ?>
	                  <?php } ?>
	                </select></td>
	                
	              <td><input type="text" size="5" maxlength="9" name="country_zone_cost[<?php echo $row; ?>][first]" value="<?php echo number_format($czc['first'], 2, '.', ''); ?>" />
	              <td><input type="text" size="5" maxlength="9" name="country_zone_cost[<?php echo $row; ?>][next]" value="<?php echo number_format($czc['next'], 2, '.', ''); ?>" />
	              <td class="left"><a onclick="$('#country-zone-cost-row<?php echo $row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
	            </tr>
	          </tbody>
	          <?php $row++; ?>
	          <?php } ?>
	        <?php } ?>
          <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="left"><a onclick="addRow();" class="button"><?php echo $button_add; ?></a></td>
            </tr>
          </tfoot>
        </table>
	    
	  </form>
  </div>
</div>
  
<?php $row = 0; ?>
<?php foreach ($country_zone_cost as $country_zone_cost) { ?>
	<script type="text/javascript"><!--
	$('#zone<?php echo $row; ?>').load('index.php?route=localisation/geo_zone/zone&token=<?php echo $token; ?>&country_id=<?php echo $country_zone_cost['country_id']; ?>&zone_id=<?php echo $country_zone_cost['zone_id']; ?>');
	//--></script>
<?php $row++; ?>
<?php } ?>

<script type="text/javascript"><!--
var row = <?php echo $row; ?>;

function addRow() {
	html  = '<tbody id="country-zone-cost-row' + row + '">';
	html += '<tr>';
	html += '<td class="left"><select name="country_zone_cost[' + row + '][country_id]" id="country' + row + '" onchange="$(\'#zone' + row + '\').load(\'index.php?route=localisation/geo_zone/zone&token=<?php echo $token; ?>&country_id=\' + this.value + \'&zone_id=0\');">';
	<?php foreach ($countries as $country) { ?>
	html += '<option value="<?php echo $country['country_id']; ?>"><?php echo addslashes($country['name']); ?></option>';
	<?php } ?>   
	html += '</select></td>';
	html += '<td class="left"><select name="country_zone_cost[' + row + '][zone_id]" id="zone' + row + '"></select></td>';
	html += '<td class="left"><select name="country_zone_cost['+ row +'][tax_class_id]">';
	html += '<option value="0"><?php echo $text_none; ?></option>';
    <?php foreach ($tax_classes as $tax_class) { ?>
    	html += '<option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>';
    <?php } ?>
	html += '</select></td>';
	html += '<td><input size="5" maxlength="9" type="text" name="country_zone_cost['+row+'][first]" value="0.00" />';
    html += '<td><input size="5" maxlength="9" type="text" name="country_zone_cost['+row+'][next]" value="0.00" />';
	html += '<td class="left"><a onclick="$(\'#country-zone-cost-row' + row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	html += '</tbody>';
	
	$('#country-zone-shipping > tfoot').before(html);
		
	$('#zone' + row).load('index.php?route=localisation/geo_zone/zone&token=<?php echo $token; ?>&country_id=' + $('#country' + row).attr('value') + '&zone_id=0');
	
	row++;
}
//--></script> 

<?php echo $footer; ?> 