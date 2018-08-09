<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($thumb || $description) { ?>   
      <div class="album-info">
        <?php if ($thumb) { ?>
        <?php if ($position == 'center') { ?>  
        <div class="image" style="float:none;text-align:center;clear:both;margin:10px 0px;"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></div>  
        <?php } elseif ($position == 'left')  { ?>  
        <div class="image" style="float:left;margin-right:12px;"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></div>
        <?php } else { ?>  
        <div class="image" style="float:right;margin-left:12px;"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" /></div>  
        <?php } ?>  
        <?php } ?>
        <?php if ($description) { ?>
        <?php echo $description; ?>
        <?php } ?>   
      </div>
      <hr />
      <?php } ?>
      <div class="box-gallery">
  <?php foreach ($gallimages as $gallimage) { ?>        
  <div>      
      <div class="image img-gallery" style="min-height:<?php echo $gheight; ?>px;"><a href="<?php echo $gallimage['popup']; ?>" data-title="<?php echo $gallimage['title']; ?>" <?php if ($popstyle == 'blueimp') { ?> data-gallery="#blueimp-gallery-links" <?php } ?><?php if ($popstyle == 'lightgall') { ?> data-lightbox="lightbox<?php echo $gallimage_id; ?>" <?php } ?>><img src="<?php echo $gallimage['image']; ?>" alt="<?php echo $gallimage['title']; ?>" title="<?php echo $gallimage['title']; ?>" class="img-responsive" /></a></div>   
      <?php if ($gallimage['title']) { ?>      
  <?php if ($gallimage['link']) { ?>
  <div class="name"><a href="<?php echo $gallimage['link']; ?>"><?php echo $gallimage['title']; ?></a></div>
  <?php } else { ?>
          <div class="name"><?php echo $gallimage['title']; ?></div>
  <?php } ?>
  <?php } ?>       
  </div>
  <?php } ?>     
  </div>
<?php if ($popstyle == 'blueimp') { ?>          
  <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> 
<?php } ?>       
  </div>  
        </div>          
  <?php echo $content_bottom; ?></div>
</div>
<?php if ($popstyle == 'blueimp') { ?>     
<script type="text/javascript"><!--
$('#blueimp-gallery').data('useBootstrapModal', 0);
$('#blueimp-gallery').toggleClass('blueimp-gallery-controls', 0);
--></script>  
<?php } else if ($popstyle == 'lightgall') { ?>

<?php } else { ?>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.img-gallery').magnificPopup({
		type:'image',
		delegate: 'a',
		gallery: {
			enabled:true
		}
	});
});
//--></script>
<?php } ?>    
<script type="text/javascript">   
	function setEqualHeight(columns) { 
		var tallestcolumn = 0;
 			columns.each( function() {
 				currentHeight = $(this).height();
 				if(currentHeight > tallestcolumn)  {
 					tallestcolumn  = currentHeight; } 
 				});
 				columns.height(tallestcolumn);  }
	$(document).ready(function() {
 		setEqualHeight($(".gallheight<?php echo $gallimage_id; ?>"));
	});	
</script>	
<?php echo $footer; ?> 