<div class="box">

  <div class="box-content">
    <ul class="box-filter sorting">
      <?php foreach ($filter_groups as $filter_group) { ?>
      <li class="<?php echo $filter_group['name']; ?>"><h2 id="filter-group<?php echo $filter_group['filter_group_id']; ?>"><?php echo $filter_group['name']; ?></h2>
        <ul>
          <?php foreach ($filter_group['filter'] as $filter) { ?>
          <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
          <li>
            <input type="radio" name="filter-group<?php echo $filter_group['filter_group_id']; ?>" value="<?php echo $filter['filter_id']; ?>" class="filter" id="filter<?php echo $filter['filter_id']; ?>" checked="checked" />
            <label for="filter<?php echo $filter['filter_id']; ?>"><?php echo $filter['name']; ?></label>
          </li>
          <?php } else { ?>
          <li>
           <input type="radio" name="filter-group<?php echo $filter_group['filter_group_id']; ?>" value="<?php echo $filter['filter_id']; ?>" class="filter"  id="filter<?php echo $filter['filter_id']; ?>" />
            <label for="filter<?php echo $filter['filter_id']; ?>"><?php echo $filter['name']; ?></label>
          </li>
          <?php } ?>
          <?php } ?>
        </ul>
        <div class="clear"></div>
      </li>
      <?php } ?>
    </ul>
    <!--a id="button-filter" class="button"><?php //echo $button_filter; ?></a-->
  </div>
</div>

<div class="result">
</div>
<script type="text/javascript"><!--
$('.filter').bind('click', function() {
	filter = [];
	
	$('.box-filter input[type=\'radio\']:checked').each(function(element) {
		filter.push(this.value);
	});
	console.log('<?php echo $action; ?>');
	location = '<?php echo $action; ?>&filter=' + filter.join(',');

});
//--></script> 
