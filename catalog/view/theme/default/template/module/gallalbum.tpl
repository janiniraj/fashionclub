<div class="box">
  <div class="box-heading"><?php echo $headtitle; ?></div>
  <div class="box-content">
    <div class="box-album">
      <?php foreach ($gallalbums as $gallalbum) { ?>
      <div style="width:<?php echo $boxwidth; ?>px;margin:<?php echo $marginv; ?>px <?php echo $marginh; ?>px;">
        <div class="image"><a href="<?php echo $gallalbum['href']; ?>"><img src="<?php echo $gallalbum['thumb']; ?>" alt="<?php echo $gallalbum['name']; ?>" title="<?php echo $gallalbum['name']; ?>" class="img-responsive" /></a></div>
        <div class="name"><a href="<?php echo $gallalbum['href']; ?>"><?php echo $gallalbum['name']; ?></a></div>
        <?php if ($shortdesc == '1') { ?>  
        <div class="desc"><?php echo $gallalbum['description']; ?></div>  
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<style>
.box-album > div {
    <?php if ($boxgallcol) { ?>  
    background-color: #<?php echo $boxgallcol; ?>;
    <?php } ?>      
    border: <?php echo $borderthick; ?>px solid #<?php echo $bordercol; ?>;
    }
.box-album .name {
	text-align: <?php echo $namepos; ?>;
}
.box-album .name a {
	font-weight: bold;
	font-size: <?php echo $namefontsize; ?>px;
    color: #<?php echo $namecol; ?>;
}    

</style>