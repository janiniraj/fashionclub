<div class="container">
<div class="box article">
	<h2><?php echo $heading_title; ?></h2>
	<div class="box-content" >
		<?php if( !empty($blogs) ) { ?>
		<div class="pavblog-latest clearfix">
			<?php foreach( $blogs as $key => $blog ) { $key = $key + 1;?>
			<div class="pavcol<?php echo $cols;?>">
					<a href="<?php echo $blog['link'];?>" title="<?php echo $blog['title'];?>" class="blog-item">
							<div class="blog-body">
								<?php if( $blog['thumb']  )  { ?>
								<img src="<?php echo $blog['thumb'];?>" title="<?php echo $blog['title'];?>" align="left"/>
								<?php } ?>
								<div class="description <?php if( $blog['thumb']  )  { ?>withimage<?php } ?>">
																										<h4 class="blog-title"><?php echo $blog['title'];?></h4>
										<?php echo utf8_substr( strip_tags($blog['description']),0, 130 );?>...
								</div>
							</div>	
						</a>
			</div>
			
			
			
			<?php if( ( $key%$cols==0 || $key == count($blogs)) ){  ?>
				<div class="clearfix"></div>
			<?php } ?>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
 </div>
 
<div id="more">
	<a id="promo">
		<h3>15% OFF</h2>
		<p>For All Limkokwing Students &amp; Staff</p>
	</a>

	<a href="/?route=information/storelocation" id="store">
		<h3>Store<br>Locations</h3>
	</a>
<div class="clear"></div>
</div>
</div>
