<?php echo $header; ?>
<?php echo $column_left; ?>
<?php echo $column_right; ?>
<section id="article">
<?php echo $content_top; ?>
	<div class="container">
	<div class="breadcrumb">
	<?php foreach ($breadcrumbs as $breadcrumb) { ?>
	<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	<?php } ?>
	</div>
	<h2 class="main-title"><?php echo $heading_title; ?></h2>
	<?php if( $config->get('blog_show_created') ) { ?>
	<center><p><?php echo $blog['created'];?></p></center>
	<?php } ?>
	<div class="pav-blog">
		<?php if( $blog['thumb_large'] ) { ?>
			<div class="image">
				<img src="<?php echo $blog['thumb_large'];?>" title="<?php echo $blog['title'];?>" id="image"/>
			</div>
			<?php } ?>
		
		 <div class="description clearfix"><?php echo $description;?></div>
		 <div class="blog-content clearfix">
				<div class="content-wrap clearfix">
				<?php echo $content;?>
				</div>
			<?php if( $blog['video_code'] ) { ?>
			<div class="pav-video clearfix"><?php echo html_entity_decode($blog['video_code'], ENT_QUOTES, 'UTF-8');?></div>
			<?php } ?>	
		 </div>
		 
	<?php echo $content_bottom; ?>
		</div>
</section>
<?php echo $footer; ?>
