<?php

class ControllerModuleHdwplayerGallery extends Controller {

	protected function index($setting) {

		$this->language->load('module/hdwplayer_gallery');
		$node = '';
		$flashvers = '';

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['width']=$setting['player_width'];
		$this->data['height']=$setting['player_height'];
		$this->data['title']=$setting['title'];
		$this->data['img_width']=$setting['img_width'];
		$this->data['img_height']=$setting['img_height'];
		
		$this->load->model('catalog/hdwplayer');
		$logo = $this->model_catalog_hdwplayer->getComPlayer();
		$query = $this->Player();
		if($logo['logo'] != '')
		{
			$flashvers .= '&logo='.$logo['logo'];
			$flashvers .= '&logoPosition='.$logo['logo_position'];
			$flashvers .= '&logoAlpha='.$logo['logo_alpha'];
			$flashvers .= '&logoTarget='.$logo['logo_target'];
			$flashvers .= ($logo['licence_key'] == '') ? '' : '&license='.$logo['licence_key'];
		}
		$flashvers .= ($query['autoplay'] == 0) ? '&autoStart=false' : '&autoStart=true';
		$flashvers .= '&skinMode='.$query['skin_mode'];
		$flashvers .= '&stretch='.$query['stretch_type'];
		$flashvers .= ($query['volume_level'] == '') ? '&volumeLevel=50' :'&volumeLevel='.$query['volume_level'];
		$flashvers .= ($query['buffer_time'] == '') ? '&buffer=3' :'&buffer='.$query['buffer_time'];
		$flashvers .= ($query['playlist_autoplay'] == 0) ? '&playlistAutoStart=false' : '&playlistAutoStart=true';
		$flashvers .= ($query['playlist_open'] == 0) ? '&playlistOpen=false' : '&playlistOpen=true';
		$flashvers .= ($query['random_playlist'] == 0) ? '&randomPlaylist=false' : '&randomPlaylist=true';
		$flashvers .= '&skinXml='.$this->url->link('module/hdwplayer_gallery/getSkin');
		$flashvers .= '&playlistXml='.$this->url->link('module/hdwplayer/getPlaylist%26category_id='.$setting['category_id']);

		$node .= '<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="'.$setting['player_width'].'" height="'.$setting['player_height'].'">';
		$node .= '<param name="movie" value="player.swf" />';
		$node .= '<param name="wmode" value="opaque" />';
		$node .= '<param name="bgcolor" value="#000000" />';
		$node .= '<param name="allowfullscreen" value="true" />';
		$node .= '<param name="allowscriptaccess" value="always" />';
		$node .= '<param name="flashvars" value="'.$flashvers.'" />';
		$node .= '<object type="application/x-shockwave-flash" data="player.swf" width="'.$setting['player_width'].'" height="'.$setting['player_height'].'">';
		$node .= '<param name="movie" value="player.swf" />';
		$node .= '<param name="wmode" value="opaque" />';
		$node .= '<param name="bgcolor" value="#000000" />';
		$node .= '<param name="allowfullscreen" value="true" />';
		$node .= '<param name="allowscriptaccess" value="always" />';
		$node .= '<param name="flashvars" value="'.$flashvers.'" />';
		$node .= '</object>';
		$node .= '</object>';
		$this->data['node'] = $node;

		$total_video = $this->model_catalog_hdwplayer->getGalleryVideo($setting['category_id']);
		$this->data['videos'] = array();
		foreach($total_video as $video){
			$playlist = $this->url->link('module/hdwplayer/getPlaylist%26video_id='.$video['video_id'] . '%26category_id='.$setting['category_id']);
			$this->data['videos'][] = array(
									'id' 	=> $video['video_id'],
									'title'    => $video['title'],
									'preview_image' => $video['preview_image'],
									'thumb_image' => $video['thumb_image'],
									'embed' => $this->getPlayer($playlist,$this->data['width'],$this->data['height']),
			);
		}
		
		
		
		
		$this->data['category_name'] = $setting['category_name'];
		$this->id = 'hdwplayer_gallery';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/hdwplayer_gallery.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/hdwplayer_gallery.tpl';
		} else {
			$this->template = 'default/template/module/hdwplayer_gallery.tpl';
		}
		$this->render();
	}
	private function player(){
		$query = array();
		$query = array (
		'autoplay' => ($this->config->get('hgautoplay'))? $this->config->get('hgautoplay'):0,
		'skin_mode' => ($this->config->get('hgskin_mode'))? $this->config->get('hgskin_mode'):"float",
		'stretch_type' => ($this->config->get('hgstretch_type'))? $this->config->get('hgstretch_type'):"uniform",
		'volume_level' => ($this->config->get('hgvolume_level'))? $this->config->get('hgvolume_level'):"50",
		'buffer_time' => ($this->config->get('hgbuffer_time'))? $this->config->get('hgbuffer_time'):"3",
		'playlist_autoplay' => ($this->config->get('hgplaylist_autoplay'))? $this->config->get('hgplaylist_autoplay'):0,
		'playlist_open' => ($this->config->get('hgplaylist_open'))? $this->config->get('hgplaylist_open'):0,
		'random_playlist' => ($this->config->get('hgrandom_playlist'))? $this->config->get('hgrandom_playlist'):0,
		);
		return $query;
	}
	public function getSkin(){
		$query = array();
		$query = array (
		'control_bar' => ($this->config->get('hgcontrol_bar'))? $this->config->get('hgcontrol_bar'):0,
		'play_pause' => ($this->config->get('hgplay_pause'))? $this->config->get('hgplay_pause'):0,
		'progress_bar' => ($this->config->get('hgprogress_bar'))? $this->config->get('hgprogress_bar'):0,
		'timer' => ($this->config->get('hgtimer'))? $this->config->get('hgtimer'):0,
		'share' => ($this->config->get('hgshare'))? $this->config->get('hgshare'):0,
		'volume' => ($this->config->get('hgvolume'))? $this->config->get('hgvolume'):0,
		'full_screen' => ($this->config->get('hgfull_screen'))? $this->config->get('hgfull_screen'):0,
		'play_dock' => ($this->config->get('hgplay_dock'))? $this->config->get('hgplay_dock'):0,
		'play_list' => ($this->config->get('hgplay_list'))? $this->config->get('hgplay_list'):0,		
		);
		$this->createSkinXml($query);
	}
	function createSkinXml($data){
		$br = "\n";
		header("content-type:text/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>'.$br;
		echo '<skin>'.$br;
		echo '<controlbar>'.$br;
		echo '<display>'.$this->isBoolean($data["control_bar"]) .'</display>'.$br;
		echo '</controlbar>'.$br;
		echo '<playpause>'.$br;
		echo '<display>'.$this->isBoolean($data["play_pause"]).'</display>'.$br;
		echo '</playpause>'.$br;
		echo '<progressbar>'.$br;
		echo '<display>'.$this->isBoolean($data["progress_bar"]).'</display>'.$br;
		echo '</progressbar>'.$br;
		echo '<timer>'.$br;
		echo '<display>'.$this->isBoolean($data["timer"]).'</display>'.$br;
		echo '</timer>'.$br;
		echo '<share>'.$br;
		echo '<display>'.$this->isBoolean($data["share"]).'</display>'.$br;
		echo '</share>'.$br;
		echo '<volume>'.$br;
		echo '<display>'.$this->isBoolean($data["volume"]).'</display>'.$br;
		echo '</volume>'.$br;
		echo '<fullscreen>'.$br;
		echo '<display>'.$this->isBoolean($data["full_screen"]).'</display>'.$br;
		echo '</fullscreen>'.$br;
		echo '<playdock>'.$br;
		echo '<display>'.$this->isBoolean($data["play_dock"]).'</display>'.$br;
		echo '</playdock>'.$br;
		echo '<videogallery>'.$br;
		echo '<display>'.$this->isBoolean($data["play_list"]).'</display>'.$br;
		echo '</videogallery>'.$br;
		echo '</skin>'.$br;
		exit();
	}
	function isBoolean($data){
		if($data == 1){
			return 'true';
		}else {
			return 'false';
		}
	}
public function getPlayer($playlist,$width = null,$height = null){
		$flashvers = '';
		$this->load->model('catalog/hdwplayer');
				$logo = $this->model_catalog_hdwplayer->getComPlayer();
				$query = $this->Player();
				if($logo['logo'] != '')
				{
					$flashvers .= '&logo='.$logo['logo'];
					$flashvers .= '&logoPosition='.$logo['logo_position'];
					$flashvers .= '&logoAlpha='.$logo['logo_alpha'];
					$flashvers .= '&logoTarget='.$logo['logo_target'];
					$flashvers .= ($logo['licence_key'] == '') ? '' : '&license='.$logo['licence_key'];
				}

		if(isset($width) && $width != "" && isset($height) && $height != ""){
			$query['width'] = $width;
			$query['height'] = $height;
		}
		$node = '';
		$flashvers .= ($query['autoplay'] == 0) ? '&autoStart=false' : '&autoStart=true';
		$flashvers .= '&skinMode='.$query['skin_mode'];
		$flashvers .= '&stretch='.$query['stretch_type'];
		$flashvers .= ($query['volume_level'] == '') ? '&volumeLevel=50' :'&volumeLevel='.$query['volume_level'];
		$flashvers .= ($query['buffer_time'] == '') ? '&buffer=3' :'&buffer='.$query['buffer_time'];
		$flashvers .= ($query['playlist_autoplay'] == 0) ? '&playlistAutoStart=false' : '&playlistAutoStart=true';
		$flashvers .= ($query['playlist_open'] == 0) ? '&playlistOpen=false' : '&playlistOpen=true';
		$flashvers .= ($query['random_playlist'] == 0) ? '&randomPlaylist=false' : '&randomPlaylist=true';
		
		$flashvers .= '&skinXml='.$this->url->link('module/hdwplayer_gallery/getSkin');;
		$flashvers .= '&playlistXml='.$playlist;
			
		$node .= '<object id="player" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" name="player" width="' . $query['width'] .'" height="' . $query['height'] .'">';
		$node .= '<param name="movie" value="player.swf" />';
		$node .= '<param name="wmode" value="opaque" />';
		$node .= '<param name="bgcolor" value="#000000" />';
		$node .= '<param name="allowfullscreen" value="true" />';
		$node .= '<param name="allowscriptaccess" value="always" />';
		$node .= '<param name="flashvars" value="'.$flashvers.'" />';
		$node .= '<object type="application/x-shockwave-flash" data="player.swf" width="' . $query['width'] .'" height="' . $query['height'] .'">';
		$node .= '<param name="movie" value="player.swf" />';
		$node .= '<param name="wmode" value="opaque" />';
		$node .= '<param name="bgcolor" value="#000000" />';
		$node .= '<param name="allowfullscreen" value="true" />';
		$node .= '<param name="allowscriptaccess" value="always" />';
		$node .= '<param name="flashvars" value="'.$flashvers.'" />';
		$node .= '</object>';
		$node .= '</object>';
		return $node;
	}
}
?>
