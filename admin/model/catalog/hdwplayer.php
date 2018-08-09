<?php

class ModelCatalogHdwplayer extends Model {

    public function addPlayer($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_settings SET width = '" . (int) $data['width'] . "', height = '" . (int) $data['height'] . "', skin_mode = '" . $data['skin_mode'] . "', stretch_type = '" . $data['stretch_type'] . "', buffer_time = '" . (int) $data['buffer_time'] . "', volume_level = '" . (int) $data['volume_level'] . "', autoplay = '" . (int) $data['autoplay'] . "', playlist_autoplay = '" . (int) $data['playlist_autoplay'] . "', playlist_open = '" . (int) $data['playlist_open'] . "', random_playlist = '" . (int) $data['random_playlist'] . "'");
        $player_id = $this->db->getLastId();
        $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_skins SET control_bar = '" . (int) $data['control_bar'] . "', play_pause = '" . (int) $data['play_pause'] . "', progress_bar = '" . (int) $data['progress_bar'] . "', timer = '" . (int) $data['timer'] . "', share = '" . (int) $data['share'] . "', volume = '" . (int) $data['volume'] . "', full_screen = '" . (int) $data['full_screen'] . "', play_dock = '" . (int) $data['play_dock'] . "', play_list = '" . (int) $data['play_list'] . "', player_id = '" . (int) $player_id . "'");
        $this->cache->delete('hdwplayer_settings');
    }

    public function addVideo($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_videos SET token = '" . $data['token'] . "', title = '" . $data['title'] . "', video_type = '" . $data['video_type'] . "', streamer = '" . $data['streamer'] . "', dvr = '" . (int) $data['dvr'] . "', video = '" . $data['video'] . "', hd_video = '" . $data['hd_video'] . "', category = '" . $data['category'] . "', publish = '" . (int) $data['publish'] . "', meta_description = '" . $data['meta_description'] . "', keywords = '" . $data['keywords'] . "'");
        $video_id = $this->db->getLastId();
        if (isset($data['preview_image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET preview_image = '" . $data['preview_image'] . "' WHERE video_id = '" . (int) $video_id . "'");
        }
        if (isset($data['thumb_image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET thumb_image = '" . $data['thumb_image'] . "' WHERE video_id = '" . (int) $video_id . "'");
        }
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_category SET name = '" . $data['name'] . "', image = '" . $data['image'] . "', image_type = '" . $data['image_type'] . "', publish = '" . $data['publish'] . "', keywords = '" . $data['keywords'] . "', description = '" . $data['description'] . "'");
    }

    public function getPlayer($id) {
        if ($id == "1") {
            $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "hdwplayer_settings s LEFT JOIN " . DB_PREFIX . "hdwplayer_skins sk ON (s.player_id = sk.player_id) WHERE s.player_id = 1");
        } elseif ($id == "2") {
            $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "hdwplayer_settings s LEFT JOIN " . DB_PREFIX . "hdwplayer_skins sk ON (s.player_id = sk.player_id) WHERE s.player_id = 2");
        }

        return $query->row;
    }

    public function viewFilterCategory($data) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_category WHERE LCASE(name) LIKE '%" . $this->db->escape(utf8_strtolower($data)) . "%' ORDER BY name");
        return $query->rows;
    }

    public function getVideos($data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE video_id=video_id";
        if (!empty($data['search'])) {
            $sql .= " AND LCASE(title) LIKE '%" . $this->db->escape(utf8_strtolower($data['search'])) . "%'";
        }
        $sql .= " ORDER BY title";
        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        $query = $this->db->query($sql);
        return $query->rows;
    }

    public function getProductVideos($data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE publish = 1";

        if (!empty($data['filter_name']) AND trim($data['filter_name'], ' ') != '') {
            $sql .= " AND LCASE(title) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }

        $sql .= " ORDER BY title";

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getVideoCategory($data) {
        $sql = "SELECT * FROM " . DB_PREFIX . "hdwplayer_category WHERE publish = 1";

        if (!empty($data['filter_name']) AND trim($data['filter_name'], ' ') != '') {
            $sql .= " AND LCASE(name) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }
        $sort_data = array(
            'name',
            'orders'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalVideo($data) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "hdwplayer_videos WHERE video_id=video_id";
        if (!empty($data['search'])) {
            $sql .= " AND LCASE(title) LIKE '%" . $this->db->escape(utf8_strtolower($data['search'])) . "%'";
        }
        $query = $this->db->query($sql);
        return $query->row['total'];
    }

    public function getVideo($video_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_videos WHERE video_id = '" . $video_id . "'");
        return $query->row;
    }

    public function getCategories() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_category ORDER BY name ASC");
        return $query->rows;
    }

    public function getVideoCategories() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_category WHERE publish=1");
        return $query->rows;
    }

    public function getCategory($category_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_category WHERE category_id = " . $category_id);
        return $query->row;
    }

    public function editPlayer($data, $id) {
        if ($id == "1") {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id =  1");
            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_settings SET logo = '" . $data['logo'] . "', width = '" . $data['width'] . "', height = '" . $data['height'] . "', licence_key = '" . $data['licence_key'] . "', logo_position = '" . $data['logo_position'] . "', logo_alpha = '" . $data['logo_alpha'] . "', logo_target = '" . $data['logo_target'] . "', skin_mode = '" . $data['skin_mode'] . "', stretch_type = '" . $data['stretch_type'] . "', buffer_time = '" . $data['buffer_time'] . "', volume_level = '" . $data['volume_level'] . "', autoplay = '" . $data['autoplay'] . "', playlist_autoplay = '" . $data['playlist_autoplay'] . "', playlist_open = '" . $data['playlist_open'] . "', random_playlist = '" . $data['random_playlist'] . "', ffmpeg = '" . $data['ffmpeg'] . "', flvtool2 = '" . $data['flvtool2'] . "' WHERE player_id = 1");
                $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_skins SET control_bar = '" . $data['control_bar'] . "', play_pause = '" . $data['play_pause'] . "', progress_bar = '" . $data['progress_bar'] . "', timer = '" . $data['timer'] . "', share = '" . $data['share'] . "', volume = '" . $data['volume'] . "', full_screen = '" . $data['full_screen'] . "', play_dock = '" . $data['play_dock'] . "', play_list = '" . $data['play_list'] . "' WHERE skin_id = 1");
            } else {
                $this->addPlayer($data);
            }
        } elseif ($id == "2") {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id =  2");
            if ($query->row) {
                $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_settings SET width = '" . $data['width'] . "', height = '" . $data['height'] . "', skin_mode = '" . $data['skin_mode'] . "', stretch_type = '" . $data['stretch_type'] . "', buffer_time = '" . $data['buffer_time'] . "', volume_level = '" . $data['volume_level'] . "', autoplay = '" . $data['autoplay'] . "', playlist_autoplay = '" . $data['playlist_autoplay'] . "', playlist_open = '" . $data['playlist_open'] . "', random_playlist = '" . $data['random_playlist'] . "' WHERE player_id = 2");
                $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_skins SET control_bar = '" . $data['control_bar'] . "', play_pause = '" . $data['play_pause'] . "', progress_bar = '" . $data['progress_bar'] . "', timer = '" . $data['timer'] . "', share = '" . $data['share'] . "', volume = '" . $data['volume'] . "', full_screen = '" . $data['full_screen'] . "', play_dock = '" . $data['play_dock'] . "', play_list = '" . $data['play_list'] . "' WHERE player_id = 2");
            } else {
                $this->addPlayer($data);
            }
        }
        $this->cache->delete('hdwplayer_settings');
    }

    public function editVideo($video_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET token = '" . $data['token'] . "', title = '" . $data['title'] . "',preview_image ='" . $data['preview_image'] . "', thumb_image = '" . $data['thumb_image'] . "', video = '" . $data['video'] . "', video_type = '" . $data['video_type'] . "', streamer = '" . $data['streamer'] . "', dvr = '" . (int) $data['dvr'] . "', hd_video = '" . $data['hd_video'] . "', category = '" . $data['category'] . "', publish = '" . (int) $data['publish'] . "', meta_description = '" . $data['meta_description'] . "', keywords = '" . $data['keywords'] . "' WHERE video_id = '" . (int) $video_id . "'");
        
    }

    public function editCategory($category_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_category SET name = '" . $data['name'] . "', image = '" . $data['image'] . "', image_type = '" . $data['image_type'] . "', orders = '" . $data['order'] . "', publish = '" . $data['publish'] . "', keywords = '" . $data['keywords'] . "', description = '" . $data['description'] . "' WHERE category_id = " . (int) $category_id);
    }

    public function publishCategory($category_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_category SET publish = '1' WHERE category_id = '" . $category_id . "'");
    }

    public function unpublishCategory($category_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_category SET publish = '0' WHERE category_id = '" . $category_id . "'");
    }

    public function publishVideo($video_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET publish = '1' WHERE video_id = '" . $video_id . "'");
    }

    public function unpublishVideo($video_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET publish = '0' WHERE video_id = '" . $video_id . "'");
    }

    public function deleteVideo($video_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "hdwplayer_videos WHERE video_id = '" . (int) $video_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_video WHERE video_id = '" . (int) $video_id . "'");
    }

    public function deleteCategory($category_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "hdwplayer_category WHERE category_id = '" . (int) $category_id . "'");
        $this->db->query("UPDATE " . DB_PREFIX . "hdwplayer_videos SET category = '' WHERE category = '" . (int) $category_id . "'");
    }

    public function getCategoryName($category_id) {
        $query = mysql_query("SELECT name FROM " . DB_PREFIX . "hdwplayer_category WHERE category_id = '" . (int) $category_id . "'");
        $query1 = mysql_fetch_array($query);
        return $query1['name'];
    }
	
    public function createTable() {
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "hdwplayer_settings 
            (player_id INT(4) NOT NULL AUTO_INCREMENT, 
            PRIMARY KEY(player_id), 
            width INT(4) DEFAULT 640, 
            height INT(4) DEFAULT 360, 
            licence_key VARCHAR(100),
            logo VARCHAR(300),
            logo_position VARCHAR(15),
            logo_alpha INT(3),
            logo_target VARCHAR(300),
            skin_mode VARCHAR(10),
            stretch_type VARCHAR(10),
            buffer_time INT(4),
            volume_level INT(4),
            autoplay TINYINT(4),
            playlist_autoplay TINYINT(4),
            playlist_open TINYINT(4),
            random_playlist TINYINT(4),
            ffmpeg VARCHAR(300),
            flvtool2 VARCHAR(300))");
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "hdwplayer_skins
            (skin_id INT(4) NOT NULL AUTO_INCREMENT,
            control_bar TINYINT(4),
            play_pause TINYINT(4),
            progress_bar TINYINT(4),
            timer TINYINT(4),
            share TINYINT(4),
            volume TINYINT(4),
            full_screen TINYINT(4),
            play_dock TINYINT(4),
            play_list TINYINT(4),
            player_id INT(4),
            PRIMARY KEY(skin_id))");
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "hdwplayer_settings WHERE player_id = 1");
        if (!$query->row) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_settings SET width = 640, height = 360, licence_key = '', logo_position = '', logo_alpha = 0, logo_target = '', skin_mode = '', stretch_type = '', buffer_time = 0, volume_level = 0, autoplay = 0, playlist_autoplay = 1, playlist_open = 0, random_playlist = 0, ffmpeg = '/usr/bin/ffmpeg/', flvtool2 = '/usr/bin/flvtool2/'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "hdwplayer_skins SET control_bar = 1, play_pause = 1, progress_bar = 1, timer = 1, share = 1, volume = 1, full_screen = 1, play_dock = 1, play_list = 1, player_id = 1");
        }
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "hdwplayer_videos(
            video_id INT(4) NOT NULL AUTO_INCREMENT,
            title VARCHAR(200),
            video_type VARCHAR(20),
            streamer VARCHAR(300),
            dvr TINYINT(4),
            video VARCHAR(300),
            token VARCHAR(300),
            hd_video VARCHAR(300),
            preview_image VARCHAR(300),
            thumb_image VARCHAR(300),
            category VARCHAR(300),
            publish TINYINT(4),
            meta_description TEXT,
            keywords VARCHAR(255),
            PRIMARY KEY(video_id))");
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "hdwplayer_category(
            category_id INT(4) NOT NULL AUTO_INCREMENT,
            name VARCHAR(255),
            image VARCHAR(255),
            image_type VARCHAR(255),
            publish INT(4),
            orders INT(4),
            keywords VARCHAR(255),
            description TEXT,
            PRIMARY KEY(category_id)
            )");
        $this->db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "product_video(
            product_id INT(4),
            video_id INT(4),
            width INT(4),
            height INT(4),
            position VARCHAR(15),
            status INT(4),
            sort_order INT(4)
            )");
        $this->cache->delete('hdwplayer_settings');
    }

}

?>
