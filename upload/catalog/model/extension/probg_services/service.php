<?php
class ModelExtensionProbgServicesService extends Model {
    private function key($suffix){return 'probg_services.'.(int)$this->config->get('config_store_id').'.'.(int)$this->config->get('config_language_id').'.'.$suffix;}
    private function getCache($key){if(!$this->config->get('module_probg_services_cache_status'))return false;$value=$this->cache->get($key);return $value===null?false:$value;}
    private function setCache($key,$value){if($this->config->get('module_probg_services_cache_status'))$this->cache->set($key,$value);}

    public function getCategories(){
        $key=$this->key('categories');$cached=$this->getCache($key);if($cached!==false)return $cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $sql="SELECT c.*,cd.name,cd.subtitle,cd.description_short,cd.description,cd.meta_title,cd.meta_description,cd.meta_keyword,(SELECT COUNT(*) FROM `".DB_PREFIX."probg_service` s INNER JOIN `".DB_PREFIX."probg_service_to_store` s2s ON(s2s.service_id=s.service_id AND s2s.store_id='".$store_id."') INNER JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=s.service_id AND sd.language_id='".$language_id."') WHERE s.category_id=c.category_id AND s.status='1' AND (s.date_available IS NULL OR s.date_available<=CURDATE())) AS service_count FROM `".DB_PREFIX."probg_service_category` c INNER JOIN `".DB_PREFIX."probg_service_category_description` cd ON(cd.category_id=c.category_id AND cd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_category_to_store` c2s ON(c2s.category_id=c.category_id AND c2s.store_id='".$store_id."') WHERE c.status='1' ORDER BY c.sort_order ASC,cd.name ASC";
        $rows=$this->db->query($sql)->rows;$this->setCache($key,$rows);return $rows;
    }

    public function getCategory($category_id){
        $key=$this->key('category.'.(int)$category_id);$cached=$this->getCache($key);if($cached!==false)return $cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $row=$this->db->query("SELECT c.*,cd.name,cd.subtitle,cd.description_short,cd.description,cd.meta_title,cd.meta_description,cd.meta_keyword FROM `".DB_PREFIX."probg_service_category` c INNER JOIN `".DB_PREFIX."probg_service_category_description` cd ON(cd.category_id=c.category_id AND cd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_category_to_store` c2s ON(c2s.category_id=c.category_id AND c2s.store_id='".$store_id."') WHERE c.category_id='".(int)$category_id."' AND c.status='1'")->row;
        $this->setCache($key,$row);return $row;
    }

    public function getServices($data=array()){
        $key=$this->key('services.'.sha1(json_encode($data)));$cached=$this->getCache($key);if($cached!==false)return $cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $sql="SELECT s.*,sd.name,sd.subtitle,sd.description_short,sd.description,sd.price_text,sd.button_text,sd.meta_title,sd.meta_description,sd.meta_keyword,cd.name AS category_name FROM `".DB_PREFIX."probg_service` s INNER JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=s.service_id AND sd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_to_store` s2s ON(s2s.service_id=s.service_id AND s2s.store_id='".$store_id."') LEFT JOIN `".DB_PREFIX."probg_service_category_description` cd ON(cd.category_id=s.category_id AND cd.language_id='".$language_id."') WHERE s.status='1' AND (s.date_available IS NULL OR s.date_available<=CURDATE())";
        if(!empty($data['category_id']))$sql.=" AND s.category_id='".(int)$data['category_id']."'";
        $sql.=" ORDER BY s.sort_order ASC,s.date_added DESC,s.service_id DESC";
        $start=max(0,(int)($data['start']??0));$limit=max(1,(int)($data['limit']??12));$sql.=" LIMIT ".$start.",".$limit;
        $rows=$this->db->query($sql)->rows;$this->setCache($key,$rows);return $rows;
    }

    public function getTotalServices($category_id=0){
        $key=$this->key('total.'.(int)$category_id);$cached=$this->getCache($key);if($cached!==false)return (int)$cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $sql="SELECT COUNT(*) AS total FROM `".DB_PREFIX."probg_service` s INNER JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=s.service_id AND sd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_to_store` s2s ON(s2s.service_id=s.service_id AND s2s.store_id='".$store_id."') WHERE s.status='1' AND (s.date_available IS NULL OR s.date_available<=CURDATE())";if($category_id)$sql.=" AND s.category_id='".(int)$category_id."'";
        $total=(int)$this->db->query($sql)->row['total'];$this->setCache($key,$total);return $total;
    }

    public function getService($service_id){
        $key=$this->key('service.'.(int)$service_id);$cached=$this->getCache($key);if($cached!==false)return $cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $row=$this->db->query("SELECT s.*,sd.name,sd.subtitle,sd.description_short,sd.description,sd.price_text,sd.button_text,sd.meta_title,sd.meta_description,sd.meta_keyword,cd.name AS category_name FROM `".DB_PREFIX."probg_service` s INNER JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=s.service_id AND sd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_to_store` s2s ON(s2s.service_id=s.service_id AND s2s.store_id='".$store_id."') LEFT JOIN `".DB_PREFIX."probg_service_category_description` cd ON(cd.category_id=s.category_id AND cd.language_id='".$language_id."') WHERE s.service_id='".(int)$service_id."' AND s.status='1' AND (s.date_available IS NULL OR s.date_available<=CURDATE())")->row;
        $this->setCache($key,$row);return $row;
    }

    public function getServiceImages($service_id){$key=$this->key('images.'.(int)$service_id);$cached=$this->getCache($key);if($cached!==false)return $cached;$rows=$this->db->query("SELECT * FROM `".DB_PREFIX."probg_service_image` WHERE service_id='".(int)$service_id."' ORDER BY sort_order ASC,service_image_id ASC")->rows;$this->setCache($key,$rows);return $rows;}
    public function getRelatedServices($service_id){$ids=array();foreach($this->db->query("SELECT related_id FROM `".DB_PREFIX."probg_service_related` WHERE service_id='".(int)$service_id."' ORDER BY related_id ASC")->rows as $row)$ids[]=(int)$row['related_id'];return $ids;}

    public function getSitemapData(){
        $key=$this->key('sitemap');$cached=$this->getCache($key);if($cached!==false)return $cached;
        $language_id=(int)$this->config->get('config_language_id');$store_id=(int)$this->config->get('config_store_id');
        $categories=$this->db->query("SELECT c.category_id,c.date_modified FROM `".DB_PREFIX."probg_service_category` c INNER JOIN `".DB_PREFIX."probg_service_category_description` cd ON(cd.category_id=c.category_id AND cd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_category_to_store` c2s ON(c2s.category_id=c.category_id AND c2s.store_id='".$store_id."') WHERE c.status='1'")->rows;
        $services=$this->db->query("SELECT s.service_id,s.category_id,s.date_modified FROM `".DB_PREFIX."probg_service` s INNER JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=s.service_id AND sd.language_id='".$language_id."') INNER JOIN `".DB_PREFIX."probg_service_to_store` s2s ON(s2s.service_id=s.service_id AND s2s.store_id='".$store_id."') LEFT JOIN `".DB_PREFIX."probg_service_category` c ON(c.category_id=s.category_id) LEFT JOIN `".DB_PREFIX."probg_service_category_to_store` c2s ON(c2s.category_id=s.category_id AND c2s.store_id='".$store_id."') WHERE s.status='1' AND (s.date_available IS NULL OR s.date_available<=CURDATE()) AND (s.category_id='0' OR (c.status='1' AND c2s.store_id IS NOT NULL))")->rows;
        $result=array('categories'=>$categories,'services'=>$services);$this->setCache($key,$result);return $result;
    }
}
