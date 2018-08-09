<?php echo $header; ?>
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?>
        <a href="<?php echo $breadcrumb['href']; ?>">
            <?php echo $breadcrumb['text']; ?>
        </a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning">
        <?php echo $error_warning; ?>
    </div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1>
                <img src="../image/hdwplayer/dis_hd.png" alt="" /> <?php echo $heading_title; ?>
            </h1>
            <div class="buttons">
                <a onclick="$('#form').submit();" class="button">
                    <span>
                        <?php echo $button_save; ?>
                    </span>
                </a>
                <a onclick="location = '<?php echo $cancel; ?>';" class="button">
                    <span>
                        <?php echo $button_cancel; ?>
                    </span>
                </a>
            </div>
        </div>
    <div class="content">
        <form id="form" name="form" class="form" method="post" enctype="multipart/form-data" action="<?php echo $action ?>">
            <div class="content">
                <table width="100%">
                    <tr>
                        <td>
                        <fieldset >
                            <legend style="padding: 0.2em 0.5em; border:1px solid black; font-size:100%; text-align:left;">
                                <?php echo $entry_add_video; ?>
                            </legend>
                            <table class="form">
                                <tr>
                                    <td class="left">
                                        <?php echo $entry_title; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="title" size="60" value="<?php echo $title ?>"/>
                                        <?php if (isset($error_name['title'])) { ?>
                                        <span class="error"><?php echo $error_name['title']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <?php echo $entry_video_type; ?>
                                    </td>
                                    <td>
                                        <input id="type" type="hidden" value="<?php echo $video_type; ?>"/>
                                        <select name="video_type" onchange="javascript:changeType(this.options[this.selectedIndex].value);">
                                            <?php if($video_type == "General Upload") { ?>
                                            <option value="General Upload" selected="selected" >
                                                <?php echo $text_general_video; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="General Upload" >
                                                <?php echo $text_general_video; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "FFMPEG Upload") { ?>
                                            <option value="FFMPEG Upload" selected="selected" >
                                                <?php echo $text_ffmpeg_upload; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="FFMPEG Upload" >
                                                <?php echo $text_ffmpeg_upload; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "Direct URL") { ?>
                                            <option value="Direct URL" selected="selected" >
                                                <?php echo $text_direct_url; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="Direct URL" id="direct_url" >
                                                <?php echo $text_direct_url; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "Youtube Videos") { ?>
                                            <option value="Youtube Videos" selected="selected" >
                                                <?php echo $text_youtube; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="Youtube Videos" >
                                                <?php echo $text_youtube; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "Dailymotion Videos") { ?>
                                            <option value="Dailymotion Videos" selected="selected" >
                                                <?php echo $text_dailymotion; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="Dailymotion Videos" >
                                                <?php echo $text_dailymotion; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "RTMP Streams") { ?>
                                            <option value="RTMP Streams" selected="selected" >
                                                <?php echo $text_rtmp; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="RTMP Streams" >
                                                <?php echo $text_rtmp; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "SMIL") { ?>
                                            <option value="SMIL" selected="selected" >
                                                <?php echo $text_smil; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="SMIL" >
                                                <?php echo $text_smil; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "Lighttpd Videos") { ?>
                                            <option value="Lighttpd Videos" selected="selected" >
                                                <?php echo $text_lighttpd; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="Lighttpd Videos" >
                                                <?php echo $text_lighttpd; ?>
                                            </option>
                                            <?php } ?>
                                            <?php if($video_type == "Bitgravity Videos") { ?>
                                            <option value="Bitgravity Videos" selected="selected" >
                                                <?php echo $text_bitgravity; ?>
                                            </option>
                                            <?php } else { ?>
                                            <option value="Bitgravity Videos" >
                                                <?php echo $text_bitgravity; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr id="dvr">
                                    <td class="left">
                                        <?php echo $entry_dvr; ?>
                                    </td>
                                    <td>
                                        <?php if($dvr) { ?>
                                        <input type="checkbox" name="dvr" value="1" checked />
                                        <?php } else { ?>
                                        <input type="checkbox" name="dvr" value="1"/>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="stream_data">
                                    <td class="left">
                                        <?php echo $entry_streamer; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="streamer" size="60" value="<?php echo $streamer ?>" />
                                    </td>
                                </tr>
                                <tr id="upload_video_data">
                                    <td class="left">
                                        <?php echo $entry_upload_video; ?>
                                    </td>
                                    <td>
                                        <?php if($video) { ?>
                                        <div id="videoChange">
                                        <input type="text" name="video" value="<?php echo $video; ?>"/>
                                        <input type="button" id="video_change" value="Change" onclick="changeUpload(this.id);" />
                                        </div>
                                        <input type="file" id="video" name="video" style="display:none" />
                                        <?php }else { ?>
                                        <input type="file" name="video" />
                                        <?php } ?>
                                        
                                        <?php if (isset($error_name['video'])) { ?>
                                        <span class="error"><?php echo $error_name['video']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="upload_hd_data">
                                    <td class="left">
                                        <?php echo $entry_upload_hd; ?>
                                    </td>
                                    <td>
                                        <?php if($hd_video) { ?>
                                        <div id="hdvideoChange">
                                        <input type="text" name="hd_video" value="<?php echo $hd_video; ?>"/>
                                        <input type="button" id="hd_video_change" value="Change" onclick="changeUpload(this.id);" />
                                        </div>
                                        <input type="file" id="hd_video" name="hd_video" style="display:none" />
                                        <?php }else { ?>
                                        <input type="file" name="hd_video" />
                                        <?php } ?>
                                        <?php if (isset($error_name['hd_video'])) { ?>
                                        <span class="error"><?php echo $error_name['hd_video']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="upload_preview_data">
                                    <td class="left">
                                        <?php echo $entry_upload_preview; ?>
                                    </td>
                                    <td>
                                    	<?php if($preview_image) { ?>
                                        <div id="previewChange">
                                        <input type="text" name="preview_image" value="<?php echo $preview_image; ?>"/>
                                        <input type="button" id="preview_image_change" value="Change" onclick="changeUpload(this.id);" />
                                        </div>
                                        <input type="file" id="preview_image" name="preview_image" style="display:none" />
                                        <?php }else { ?>
                                        <input type="file" name="preview_image" />
                                        <?php } ?>
                                        <?php if (isset($error_name['preview_image'])) { ?>
                                        <span class="error"><?php echo $error_name['preview_image']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="upload_thumb_data">
                                    <td class="left">
                                        <?php echo $entry_upload_thump; ?>
                                    </td>
                                    <td>
                                    	<?php if($thumb_image) { ?>
                                        <div id="thumbChange">
                                        <input type="text" name="thumb_image" value="<?php echo $thumb_image; ?>"/>
                                        <input type="button" id="thumb_image_change" value="Change" onclick="changeUpload(this.id);" />
                                        </div>
                                        <input type="file" id="thumb_image" name="thumb_image" style="display:none" />
                                        <?php }else { ?>
                                        <input type="file" name="thumb_image" />
                                        <?php } ?>
                                        <?php if (isset($error_name['thumb_image'])) { ?>
                                        <span class="error"><?php echo $error_name['thumb_image']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="video_url_data">
                                    <td class="left">
                                        <?php echo $entry_video; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="video" size="60" value="<?php echo $video ?>" />
                                        <?php if (isset($error_name['video'])) { ?>
                                        <span class="error"><?php echo $error_name['video']; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr id="hd_url_data">
                                    <td class="left">
                                        <?php echo $entry_hd_video; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="hd_video" size="60" value="<?php echo $hd_video ?>" />
                                    </td>
                                </tr>
                                <tr id="preview_url_data">
                                    <td class="left">
                                        <?php echo $entry_preview; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="preview_image" size="60" value="<?php echo $preview_image ?>" />
                                    </td>
                                </tr>
                                <tr id="thumb_url_data">
                                    <td class="left">
                                        <?php echo $entry_thumb; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="thumb_image" size="60" value="<?php echo $thumb_image ?>" />
                                    </td>
                                </tr>
                                <tr id="token_data">
                                    <td class="left">
                                        <?php echo $entry_security; ?>
                                    </td>
                                    <td>
                                        <input type="text" name="token" size="60" value="<?php echo $token ?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <?php echo $entry_category; ?>
                                    </td>
                                    <td>
                                        <select id="category" name="category" >
                                            <?php if($categories) { ?>
                                            <?php foreach($categories as $cate) { ?>
                                            <?php if($category == $cate['id']) { ?>
                                            <option value="<?php echo $cate['id']; ?>" selected="selected"><?php echo $cate['name']; ?></option>
                                            <?php }else { ?>
                                            <option value="<?php echo $cate['id']; ?>"><?php echo $cate['name']; ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php } ?>
                                            <?php if($category == "") { ?>
                                            <option value="" selected="selected" ><?php echo $text_uncategorised; ?></option>
                                            <?php }else { ?>
                                            <option value=""><?php echo $text_uncategorised; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <?php echo $entry_publish; ?>
                                    </td>
                                    <td>
                                        <?php if($publish) { ?>
                                        <input type="checkbox" name="publish" value="1" checked="checked" />
                                        <?php } else { ?>
                                        <input type="checkbox" name="publish" value="1"/>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <div class="content" >
                                <fieldset class="adminform" style="display: block; ">
                                    <legend style=" padding: 0.2em 0.5em; border:1px solid black; font-size:100%; text-align:left;">
                                        <?php echo $entry_seo_settings; ?>
                                    </legend>
                                    <table class="form">
                                        <tbody>
                                            <tr>
                                                <td class="left">
                                                    <?php echo $entry_meta_keywords; ?>
                                                </td>
                                                <td>
                                                    <input type="text" name="meta_keywords" size="60" value="" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="left">
                                                    <?php echo $entry_meta_description; ?>
                                                </td>
                                                <td>
                                                    <textarea name="meta_description" rows="5" cols="50" >
                                                    </textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </fieldset>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
            </div>
        </form>
    </div>
    </div>
</div>
<script type="text/javascript">
    <!--
    $('#tabs a').tabs();
    //-->
</script>
<?php echo $footer; ?>
<script type="text/javascript">
    //changeType('General Upload');
    var v = document.getElementById('type').value;
    cType(v);
    function cType(v){
    if (v != "")
            {
                changeType(v);
            }else {
                changeType('General Upload');
            }
    }
function changeType(v) {
    document.getElementById('dvr').style.display="none";
    document.getElementById('stream_data').style.display="none";
    document.getElementById('upload_video_data').style.display="none";
    document.getElementById('upload_hd_data').style.display="none";
    document.getElementById('upload_preview_data').style.display="none";
    document.getElementById('upload_thumb_data').style.display="none";
    document.getElementById('video_url_data').style.display="none";
    document.getElementById('hd_url_data').style.display="none";
    document.getElementById('preview_url_data').style.display="none";
    document.getElementById('thumb_url_data').style.display="none";
    document.getElementById('token_data').style.display="none";
    switch(v) {
        case 'General Upload':
            document.getElementById('upload_video_data').style.display="";
            document.getElementById('upload_hd_data').style.display="";
            document.getElementById('upload_preview_data').style.display="";
            document.getElementById('upload_thumb_data').style.display="";
            break;
        case 'FFMPEG Upload':
            document.getElementById('upload_video_data').style.display="";
            break;
        case 'Lighttpd Videos':
        case 'Direct URL':
            document.getElementById('video_url_data').style.display="";
            document.getElementById('hd_url_data').style.display="";
            document.getElementById('preview_url_data').style.display="";
            document.getElementById('thumb_url_data').style.display="";
            break;
        case 'Youtube Videos':
            document.getElementById('video_url_data').style.display="";
            break;
        case 'Dailymotion Videos':
        case 'SMIL':
            document.getElementById('video_url_data').style.display="";
            document.getElementById('preview_url_data').style.display="";
            document.getElementById('thumb_url_data').style.display="";
            break;
        case 'RTMP Streams':
            document.getElementById('stream_data').style.display="";
            document.getElementById('video_url_data').style.display="";
            document.getElementById('preview_url_data').style.display="";
            document.getElementById('thumb_url_data').style.display="";
            document.getElementById('token_data').style.display="";
            break;
        case 'Bitgravity Videos':
            document.getElementById('dvr').style.display="";
            document.getElementById('video_url_data').style.display="";
            document.getElementById('hd_url_data').style.display="";
            document.getElementById('preview_url_data').style.display="";
            document.getElementById('thumb_url_data').style.display="";
            break;
    }
}
function changeUpload(up){
    switch(up){
    case 'video_change':
        document.getElementById('videoChange').style.display="none";
        document.getElementById('video').style.display="block";
        break;
    case 'hd_video_change':
    	document.getElementById('hdvideoChange').style.display="none";
        document.getElementById('hd_video').style.display="block";
        break;
    case 'preview_image_change':
    	document.getElementById('previewChange').style.display="none";
        document.getElementById('preview_image').style.display="block";
        break;
    case 'thumb_image_change':
    	document.getElementById('thumbChange').style.display="none";
        document.getElementById('thumb_image').style.display="block";
        break;
    }
}
</script>
