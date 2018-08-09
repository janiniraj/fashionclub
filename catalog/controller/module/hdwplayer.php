<?php

class ControllerModuleHdwplayer extends Controller {

	protected function index($setting) {

		$this->language->load('module/hdwplayer');
		$node = '';
		$flashvers = '';

		$this->data['heading_title'] = $this->language->get('heading_title');
		//$this->data['width']  = $setting['image_width'] ;
		//$this->data['height'] = $setting['image_height'] ;
		$this->data['width']=$setting['player_width'];
		$this->data['height']=$setting['player_height'];
		$this->data['title']=$setting['title'];
		$this->data['show_title']=$setting['show_title'];
		$this->load->model('catalog/hdwplayer');
		$logo = $this->model_catalog_hdwplayer->getComPlayer();
		$query = $this->model_catalog_hdwplayer->getModulePlayer();
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
		$flashvers .= '&skinXml='.$this->url->link('module/hdwplayer/getModuleSkin');
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


		$this->data['category_name'] = $setting['category_name'];
		$this->id = 'hdwplayer';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/hdwplayer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/hdwplayer.tpl';
		} else {
			$this->template = 'default/template/module/hdwplayer.tpl';
		}
		$this->render();
	}

	public function getPlaylist(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish=1");
		$videos = $query->rows;
		if(isset($this->request->get['product_id']))
		{
			$query = "SELECT * FROM " . DB_PREFIX . "product_video pv LEFT JOIN " . DB_PREFIX . "hdwplayer_videos v ON (pv.video_id = v.video_id) WHERE pv.product_id = '" . (int)$this->request->get['product_id'] . "' AND v.publish = 1 AND pv.status =1";
			if(isset($this->request->get['video_id'])){
				$query .= " AND pv.video_id='".(int)$this->request->get['video_id']."'";
			}
			$query = $this->db->query($query);
			$videos = $query->rows;
			if(isset($this->request->get['video_id'])){
				$query = "SELECT * FROM " . DB_PREFIX . "product_video pv LEFT JOIN " . DB_PREFIX . "hdwplayer_videos v ON (pv.video_id = v.video_id) WHERE pv.product_id = '" . (int)$this->request->get['product_id'] . "' AND v.publish = 1 AND pv.status =1";
				$query .= " AND pv.video_id!='".(int)$this->request->get['video_id']."'";
				$query = $this->db->query($query);
				$videos = array_merge($videos,$query->rows);
			}
		}elseif(isset($this->request->get['category_id']) && !isset($this->request->get['video_id'])){
			$query = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish=1 AND category=".(int)$this->request->get['category_id']." AND category NOT IN (SELECT category_id FROM " . DB_PREFIX . "hdwplayer_category WHERE publish=0 )";
			$query = $this->db->query($query);
			$videos = $query->rows;
		}elseif(isset($this->request->get['video_id'])){
			
				$query = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish = 1 AND video_id=".(int)$this->request->get['video_id'];
				$query = $this->db->query($query);
				$videos = $query->rows;
				if(isset($this->request->get['category_id']) && $this->request->get['category_id'] == ""){
					$query = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish= 1 AND video_id != '". (int)$this->request->get['video_id'] ."'  ORDER BY title";
					$query = $this->db->query($query);
					$videos = array_merge($videos,$query->rows);
				}elseif(isset($this->request->get['category_id']) && $this->request->get['category_id'] != ""){	
					$query = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish= 1 AND video_id != '". (int)$this->request->get['video_id'] ."' AND category IN (SELECT category_id FROM " . DB_PREFIX . "hdwplayer_category WHERE category_id IN ('".$this->request->get['category_id']."') AND publish=1) ORDER BY title";
					$query = $this->db->query($query);
					$videos = array_merge($videos,$query->rows);
				}
				
			
		}
		$this->createPlaylistXml($videos);
	}
	function createPlaylistXml($datas){
		$br = "\n";
		header("content-type:text/xml;charset=utf-8");
		echo '<?xml version="1.0" encoding="utf-8"?>'.$br;
		echo '<playlist>'.$br.$br;
		foreach ($datas as $data)
		{
			echo '<media>'.$br;
			echo '<id>'.$data["video_id"].'</id>'.$br;
			echo '<type>'.$this->getType($data["video_type"]).'</type>'.$br;
			echo '<video>'.$data["video"].'</video>'.$br;
			if($data["hd_video"]) {
				echo '<hd>'.$data["hd_video"].'</hd>'.$br;
			}
			echo '<streamer>'.$data["streamer"].'</streamer>'.$br;
			if($data["dvr"]) {
				echo '<dvr>'.$data["dvr"].'</dvr>'.$br;
			}
			echo '<thumb>'.$data["thumb_image"].'</thumb>'.$br;
			if($data["token"]) {
				echo '<token>'.$data["token"].'</token>'.$br;
			}
			echo '<preview>'.$data["preview_image"].'</preview>'.$br;
			echo '<title>'.$data["title"].'</title>'.$br;
			echo '<description><![CDATA['.$data["description"].']]></description>'.$br;
			echo '</media>'.$br.$br;
		}
		echo '</playlist>';
		exit();

	}
	function getType($data){
		switch($data) {
			case 'General Upload':
			case 'FFMPEG Upload':
			case 'Direct URL':
				return 'video';
				break;
			case 'Youtube Videos':
				return 'youtube';
				break;
			case 'Dailymotion Videos':
				return 'dailymotion';
				break;
			case 'RTMP Streams':
				return 'rtmp';
				break;
			case 'SMIL':
				return 'highwinds';
				break;
			case 'Lighttpd Videos':
				return 'lighttpd';
				break;
			case 'Bitgravity Videos':
				return 'bitgravity';
				break;
			default :
				return 'video';
		}
	}
	public function getSkin(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_skins WHERE skin_id = 1");
		$this->createSkinXml($query->row);
	}
	public function getModuleSkin(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_skins WHERE skin_id = 2");
		$this->createSkinXml($query->row);
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
}
?>
