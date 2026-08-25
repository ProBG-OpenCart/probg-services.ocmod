<?php
class ModelExtensionProbgServicesEnquiry extends Model {
    public function addEnquiry($data) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "probg_service_enquiry` SET store_id='" . (int)$this->config->get('config_store_id') . "', service_id='" . (int)$data['service_id'] . "', customer_id='" . (int)$data['customer_id'] . "', status_id='1', assigned_user_id='0', name='" . $this->db->escape($data['name']) . "', email='" . $this->db->escape($data['email']) . "', telephone='" . $this->db->escape($data['telephone']) . "', company='" . $this->db->escape($data['company']) . "', website='" . $this->db->escape($data['website']) . "', subject='" . $this->db->escape($data['subject']) . "', message='" . $this->db->escape($data['message']) . "', budget='" . $this->db->escape($data['budget']) . "', desired_deadline='" . $this->db->escape($data['desired_deadline']) . "', ip='" . $this->db->escape($data['ip']) . "', user_agent='" . $this->db->escape($data['user_agent']) . "', email_sent='0', date_added=NOW(), date_modified=NOW()");

        $enquiry_id = (int)$this->db->getLastId();
        $this->addHistory($enquiry_id, 1, 'Enquiry created from storefront.', 0);
        return $enquiry_id;
    }

    public function addFile($enquiry_id, $data) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "probg_service_enquiry_file` SET enquiry_id='" . (int)$enquiry_id . "', name='" . $this->db->escape($data['name']) . "', filename='" . $this->db->escape($data['filename']) . "', mime_type='" . $this->db->escape($data['mime_type']) . "', size='" . (int)$data['size'] . "', date_added=NOW()");
    }

    public function markEmailSent($enquiry_id) {
        $this->db->query("UPDATE `" . DB_PREFIX . "probg_service_enquiry` SET email_sent='1', date_modified=NOW() WHERE enquiry_id='" . (int)$enquiry_id . "'");
    }

    public function addHistory($enquiry_id, $status_id, $comment, $notify = 0) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "probg_service_enquiry_history` SET enquiry_id='" . (int)$enquiry_id . "', status_id='" . (int)$status_id . "', user_id='0', comment='" . $this->db->escape($comment) . "', notify='" . (int)$notify . "', date_added=NOW()");
    }
}
