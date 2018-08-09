<?php
class ModelCatalogHdwplayer extends Model {
	public function getPlayer($playlist,$skin,$width = null,$height = null){
		$query = $this->getComPlayer();

		if(isset($width) && $width != "" && isset($height) && $height != ""){
			$query['width'] = $width;
			$query['height'] = $height;
		}
		$node = '';
		$flashvers  = ($query['autoplay'] == 0) ? '&autoStart=false' : '&autoStart=true';
		$flashvers .= '&skinMode='.$query['skin_mode'];
		$flashvers .= '&stretch='.$query['stretch_type'];
		$flashvers .= ($query['volume_level'] == '') ? '&volumeLevel=50' :'&volumeLevel='.$query['volume_level'];
		$flashvers .= ($query['buffer_time'] == '') ? '&buffer=3' :'&buffer='.$query['buffer_time'];
		$flashvers .= ($query['playlist_autoplay'] == 0) ? '&playlistAutoStart=false' : '&playlistAutoStart=true';
		$flashvers .= ($query['playlist_open'] == 0) ? '&playlistOpen=false' : '&playlistOpen=true';
		$flashvers .= ($query['random_playlist'] == 0) ? '&randomPlaylist=false' : '&randomPlaylist=true';
		if($query['logo'] != '')
		{
			$flashvers .= '&logo='.$query['logo'];
			$flashvers .= '&logoPosition='.$query['logo_position'];
			$flashvers .= '&logoAlpha='.$query['logo_alpha'];
			$flashvers .= '&logoTarget='.$query['logo_target'];
			$flashvers .= ($query['licence_key'] == '') ? '' : '&license='.$query['licence_key'];
		}
		$flashvers .= '&skinXml='.$skin;
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
	public function getModulePlayer(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id=2");
		return $query->row;
	}
	public function getComPlayer(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id=1");
		return $query->row;
	}
	public function getTotalVideos(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish= 1");
		return $query->rows;
	}
	
	public function getGalleryVideo($cat){
		
		if($cat == ""){
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish= 1 ORDER BY title");
		}else{
			
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish= 1 AND category IN (SELECT category_id FROM " . DB_PREFIX . "hdwplayer_category WHERE category_id IN ('".$cat."') AND publish=1) ORDER BY title");
		}
		return $query->rows;
	}

}




?>
