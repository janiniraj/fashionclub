<div class="container">
<div class="box">
  <div class="box-heading" style="display:none"><?php echo $headtitle; ?></div>
  <div class="box-content">
    <div class="box-album">
      <?php foreach ($gallalbums as $gallalbum) { ?>
      <div class="image_container">
        <a href="<?php echo $gallalbum['href']; ?>">
        <div class="image">
          <img src="<?php echo $gallalbum['thumb']; ?>" alt="<?php echo $gallalbum['name']; ?>" title="<?php echo $gallalbum['name']; ?>" class="img-responsive" />
          <div class="gradient_desc">
            <!--
            <?php if ($shortdesc == '1') { ?>  
                <div class="desc"><?php echo $gallalbum['description']; ?></div>  
              <?php } ?>
            -->
            <div class="desc">
              <div class="date_custom"><?php echo $gallalbum['date']; ?>&nbsp;</div>
              <div class="name"><?php echo $gallalbum['name']; ?></div>
            </div>
          </div>
        </div>
        </a>
      </div>

      <?php } ?>
    </div>
  </div>
</div>
</div>
<link href="https://fonts.googleapis.com/css?family=Oswald:700" rel="stylesheet">
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


.top_bar .container {
    width: 900px;
}

.box {
    margin: 20px 120px;
}

.image_container {
    padding: 0 !important;
    border: none !important;
    height: 200px;
    width: 200px;
    overflow: hidden;
    margin: 8px !important;
    position: relative;
}

.box-album .image {
  margin: 0px;
    height: 200px;
    width: 200px;
}

.gradient_desc {
    position: absolute;
    bottom: 0;
    height: 100%;
    width: 100%;
    background: linear-gradient( transparent 50% , black 90%);
}

.gradient_desc:hover{
    background: linear-gradient( transparent 50% , #642c90 90%);
}

.desc{
  position: absolute;
  bottom:8px;
  left: 10px;
  min-height: 60px;
}

.date_custom, .name {
    color: white !important;
    text-align: left !important;
    padding-right: 10px;
}

.box-album .image img{
  width:100%;
}

.name {
    font-size: 20px;
    line-height: 1;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
}

</style>