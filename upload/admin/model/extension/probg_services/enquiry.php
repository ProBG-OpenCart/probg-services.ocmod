<?php
class ModelExtensionProbgServicesEnquiry extends Model {
    public function getEnquiries($data=array()) {
        $language_id=(int)$this->config->get('config_language_id');
        $sql="SELECT e.*,sd.name AS service_name,CONCAT(u.firstname,' ',u.lastname) AS assigned_user FROM `".DB_PREFIX."probg_service_enquiry` e LEFT JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=e.service_id AND sd.language_id='".$language_id."') LEFT JOIN `".DB_PREFIX."user` u ON(u.user_id=e.assigned_user_id) WHERE 1";
        if(!empty($data['filter_name']))$sql.=" AND e.name LIKE '%".$this->db->escape($data['filter_name'])."%'";
        if(!empty($data['filter_email']))$sql.=" AND e.email LIKE '%".$this->db->escape($data['filter_email'])."%'";
        if(!empty($data['filter_service_id']))$sql.=" AND e.service_id='".(int)$data['filter_service_id']."'";
        if(isset($data['filter_status_id'])&&$data['filter_status_id']!=='')$sql.=" AND e.status_id='".(int)$data['filter_status_id']."'";
        if(isset($data['filter_assigned_user_id'])&&$data['filter_assigned_user_id']!=='')$sql.=" AND e.assigned_user_id='".(int)$data['filter_assigned_user_id']."'";
        if(!empty($data['filter_date_from']))$sql.=" AND DATE(e.date_added)>='".$this->db->escape($data['filter_date_from'])."'";
        if(!empty($data['filter_date_to']))$sql.=" AND DATE(e.date_added)<='".$this->db->escape($data['filter_date_to'])."'";
        $sql.=" ORDER BY e.date_added DESC,e.enquiry_id DESC";
        $start=max(0,(int)($data['start']??0));$limit=max(1,(int)($data['limit']??20));$sql.=" LIMIT ".$start.",".$limit;
        return $this->db->query($sql)->rows;
    }
    public function getTotalEnquiries($data=array()) {
        $sql="SELECT COUNT(*) AS total FROM `".DB_PREFIX."probg_service_enquiry` e WHERE 1";
        if(!empty($data['filter_name']))$sql.=" AND e.name LIKE '%".$this->db->escape($data['filter_name'])."%'";
        if(!empty($data['filter_email']))$sql.=" AND e.email LIKE '%".$this->db->escape($data['filter_email'])."%'";
        if(!empty($data['filter_service_id']))$sql.=" AND e.service_id='".(int)$data['filter_service_id']."'";
        if(isset($data['filter_status_id'])&&$data['filter_status_id']!=='')$sql.=" AND e.status_id='".(int)$data['filter_status_id']."'";
        if(isset($data['filter_assigned_user_id'])&&$data['filter_assigned_user_id']!=='')$sql.=" AND e.assigned_user_id='".(int)$data['filter_assigned_user_id']."'";
        if(!empty($data['filter_date_from']))$sql.=" AND DATE(e.date_added)>='".$this->db->escape($data['filter_date_from'])."'";
        if(!empty($data['filter_date_to']))$sql.=" AND DATE(e.date_added)<='".$this->db->escape($data['filter_date_to'])."'";
        return (int)$this->db->query($sql)->row['total'];
    }
    public function getEnquiry($enquiry_id) {$language_id=(int)$this->config->get('config_language_id');return $this->db->query("SELECT e.*,sd.name AS service_name,CONCAT(u.firstname,' ',u.lastname) AS assigned_user FROM `".DB_PREFIX."probg_service_enquiry` e LEFT JOIN `".DB_PREFIX."probg_service_description` sd ON(sd.service_id=e.service_id AND sd.language_id='".$language_id."') LEFT JOIN `".DB_PREFIX."user` u ON(u.user_id=e.assigned_user_id) WHERE e.enquiry_id='".(int)$enquiry_id."'")->row;}
    public function getFiles($enquiry_id){return $this->db->query("SELECT * FROM `".DB_PREFIX."probg_service_enquiry_file` WHERE enquiry_id='".(int)$enquiry_id."' ORDER BY enquiry_file_id ASC")->rows;}
    public function getHistory($enquiry_id){return $this->db->query("SELECT h.*,CONCAT(u.firstname,' ',u.lastname) AS user_name FROM `".DB_PREFIX."probg_service_enquiry_history` h LEFT JOIN `".DB_PREFIX."user` u ON(u.user_id=h.user_id) WHERE h.enquiry_id='".(int)$enquiry_id."' ORDER BY h.date_added DESC,h.enquiry_history_id DESC")->rows;}
    public function getUsers(){return $this->db->query("SELECT user_id,username,firstname,lastname FROM `".DB_PREFIX."user` WHERE status='1' ORDER BY firstname,lastname,username")->rows;}
    public function updateAssignment($enquiry_id,$user_id){$this->db->query("UPDATE `".DB_PREFIX."probg_service_enquiry` SET assigned_user_id='".(int)$user_id."',date_modified=NOW() WHERE enquiry_id='".(int)$enquiry_id."'");}
    public function addHistory($enquiry_id,$status_id,$comment,$user_id,$notify=0){$this->db->query("UPDATE `".DB_PREFIX."probg_service_enquiry` SET status_id='".(int)$status_id."',date_modified=NOW() WHERE enquiry_id='".(int)$enquiry_id."'");$this->db->query("INSERT INTO `".DB_PREFIX."probg_service_enquiry_history` SET enquiry_id='".(int)$enquiry_id."',status_id='".(int)$status_id."',user_id='".(int)$user_id."',comment='".$this->db->escape($comment)."',notify='".(int)$notify."',date_added=NOW()");}
    public function deleteEnquiry($enquiry_id){$this->db->query("DELETE FROM `".DB_PREFIX."probg_service_enquiry_history` WHERE enquiry_id='".(int)$enquiry_id."'");$this->db->query("DELETE FROM `".DB_PREFIX."probg_service_enquiry_file` WHERE enquiry_id='".(int)$enquiry_id."'");$this->db->query("DELETE FROM `".DB_PREFIX."probg_service_enquiry` WHERE enquiry_id='".(int)$enquiry_id."'");}
}
