<div id="carousel<?php echo $module; ?>">
	<!-- <h2>New Arrivals</h2> -->
  <ul class="jcarousel-skin-opencart">
    <?php foreach ($banners as $banner) { ?>
    <li style="position: relative;">
    	<a href="<?php echo $banner['link']; ?>">
    		<img src="<?php echo $banner['bannerImg']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" />
    		<img src="catalog/view/theme/fashion_club/image/new_arrival.png" class="new_arrival_tag" style="position: absolute; top: -6px; left: -14px;" />
        </a>
</li>
    <?php } ?>
  </ul>
</div>
<script type="text/javascript"><!--
$('#carousel<?php echo $module; ?> ul').jcarousel({
	vertical: false,
	auto: 5,
	wrap: 'circular',
	visible: <?php echo $limit; ?>,
	scroll: <?php echo $scroll; ?>
});
//--></script>