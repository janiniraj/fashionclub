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
            <h1><img src="../image/hdwplayer/dis_hd.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
        </div>
        <div class="content">
            <form id="form" class="form" method="post" action="<?php echo $action ?>">
                <div class="content">
                    <table>
                        <tr>
                            <td>
                                <fieldset >
                                    <legend style=" padding: 0.2em 0.5em; border:1px solid black; font-size:100%; text-align:left;"><?php echo $entry_category_name; ?></legend>
                                    <table class="form">
                                        <tr>
                                            <td class="left"><?php echo $entry_name; ?></td>
                                            <td><input type="text" name="name" size="60" value="<?php echo $name; ?>" />
                                                <?php if (isset($error_name['name'])) { ?>
                                        <span class="error"><?php echo $error_name['name']; ?></span>
                                        <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_parent; ?></td>
                                            <td><select id="type" name="parent" >
                                                    <option value="root" selected="selected" ><?php echo $text_root; ?></option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="left"><?php echo $entry_category_image; ?></td>
                                            <td>
                                            <input type="text" id="text" name="image" value="<?php echo $image; ?>" size="50" />
                                            <?php if (isset($error_name['image'])) { ?>
                                            <span class="error"><?php echo $error_name['image']; ?></span>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="left"><?php echo $entry_published; ?></td>
                                        <td>
                                        <?php if($publish) { ?>
                                        <input type="checkbox" name="publish" value="1" checked="checked"/>
                                        <?php } else { ?>
                                        <input type="checkbox" name="publish" value="1"/>
                                        <?php } ?>
                                        </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </td>
                            <td class="left">
                                <div class="content" >
                                <fieldset style="display: block; ">
                                    <legend style=" padding: 0.2em 0.5em; border:1px solid black; font-size:100%; text-align:left;"><?php echo $entry_seo_settings; ?></legend>
                                    <table class="form">
                                        <tbody>
                                            <tr><td class="left"><?php echo $entry_meta_keywords; ?></td><td><input type="text" name="meta_keywords" size="60" value="<?php echo $keywords; ?>" /></td></tr>
                                            <tr><td class="left"><?php echo $entry_meta_description; ?></td><td><textarea name="meta_description" rows="5" cols="50" ><?php echo $description; ?>
                                                    </textarea></td></tr></tbody>
                                    </table>
                                </fieldset>
                                    </div>  
                            </td>
                        </tr>
                    </table>
                </div>  
                <div>
                <input type="hidden" name="save" value="category"/>
                <input type="hidden" name="delete" value="category"/>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
    $('#tabs a').tabs(); 
    //--></script>
<?php echo $footer; ?>