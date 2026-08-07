<?php
class ModelExtensionProbgServicesCategory extends Model {
    public function addCategory($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "probg_service_category SET parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape($data['image']) . "', icon = '" . $this->db->escape($data['icon']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_added = NOW(), date_modified = NOW()");
        $category_id = $this->db->getLastId();
        $this->saveDescriptions($category_id, $data);
        $this->saveStores($category_id, $data);
        $this->saveSeoUrls($category_id, $data);
        return $category_id;
    }

    public function editCategory($category_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "probg_service_category SET parent_id = '" . (int)$data['parent_id'] . "', image = '" . $this->db->escape($data['image']) . "', icon = '" . $this->db->escape($data['icon']) . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "probg_service_category_description WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "probg_service_category_to_store WHERE category_id = '" . (int)$category_id . "'");
        $this->deleteSeoUrls($category_id);
        $this->saveDescriptions($category_id, $data);
        $this->saveStores($category_id, $data);
        $this->saveSeoUrls($category_id, $data);
    }

    public function deleteCategory($category_id) {
        $this->db->query("UPDATE " . DB_PREFIX . "probg_service_category SET parent_id = '0' WHERE parent_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "probg_service_category WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "probg_service_category_description WHERE category_id = '" . (int)$category_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "probg_service_category_to_store WHERE category_id = '" . (int)$category_id . "'");
        $this->deleteSeoUrls($category_id);
    }

    public function getCategory($category_id) {
        $query = $this->db->query("SELECT c.*, cd.name FROM " . DB_PREFIX . "probg_service_category c LEFT JOIN " . DB_PREFIX . "probg_service_category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE c.category_id = '" . (int)$category_id . "'");
        return $query->row;
    }

    public function getCategories($data = array()) {
        $sql = "SELECT c.*, cd.name, pcd.name AS parent_name FROM " . DB_PREFIX . "probg_service_category c LEFT JOIN " . DB_PREFIX . "probg_service_category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "') LEFT JOIN " . DB_PREFIX . "probg_service_category_description pcd ON (c.parent_id = pcd.category_id AND pcd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE 1";
        if (!empty($data['filter_name'])) $sql .= " AND cd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        if (isset($data['filter_status']) && $data['filter_status'] !== '') $sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
        if (isset($data['filter_parent_id']) && $data['filter_parent_id'] !== '') $sql .= " AND c.parent_id = '" . (int)$data['filter_parent_id'] . "'";
        $sort_data = array('cd.name','pcd.name','c.sort_order','c.status');
        $sort = isset($data['sort']) && in_array($data['sort'], $sort_data, true) ? $data['sort'] : 'c.sort_order';
        $order = isset($data['order']) && $data['order'] === 'DESC' ? 'DESC' : 'ASC';
        $sql .= " ORDER BY " . $sort . " " . $order . ", cd.name ASC";
        if (isset($data['start']) || isset($data['limit'])) {
            $start = max(0, (int)($data['start'] ?? 0)); $limit = max(1, (int)($data['limit'] ?? 20));
            $sql .= " LIMIT " . $start . "," . $limit;
        }
        return $this->db->query($sql)->rows;
    }

    public function getTotalCategories($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "probg_service_category c LEFT JOIN " . DB_PREFIX . "probg_service_category_description cd ON (c.category_id = cd.category_id AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE 1";
        if (!empty($data['filter_name'])) $sql .= " AND cd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
        if (isset($data['filter_status']) && $data['filter_status'] !== '') $sql .= " AND c.status = '" . (int)$data['filter_status'] . "'";
        if (isset($data['filter_parent_id']) && $data['filter_parent_id'] !== '') $sql .= " AND c.parent_id = '" . (int)$data['filter_parent_id'] . "'";
        return (int)$this->db->query($sql)->row['total'];
    }

    public function getCategoryDescriptions($category_id) {
        $data = array();
        foreach ($this->db->query("SELECT * FROM " . DB_PREFIX . "probg_service_category_description WHERE category_id = '" . (int)$category_id . "'")->rows as $row) $data[$row['language_id']] = $row;
        return $data;
    }

    public function getCategoryStores($category_id) {
        return array_column($this->db->query("SELECT store_id FROM " . DB_PREFIX . "probg_service_category_to_store WHERE category_id = '" . (int)$category_id . "'")->rows, 'store_id');
    }

    public function getCategorySeoUrls($category_id) {
        $data = array();
        $query = $this->db->query("SELECT store_id, language_id, keyword FROM " . DB_PREFIX . "seo_url WHERE query = 'extension/probg_services/category&category_id=" . (int)$category_id . "'");
        foreach ($query->rows as $row) $data[$row['store_id']][$row['language_id']] = $row['keyword'];
        return $data;
    }

    public function getSeoUrlByKeyword($keyword, $store_id, $language_id) {
        return $this->db->query("SELECT seo_url_id, query FROM " . DB_PREFIX . "seo_url WHERE keyword = '" . $this->db->escape($keyword) . "' AND store_id = '" . (int)$store_id . "' AND language_id = '" . (int)$language_id . "' LIMIT 1")->row;
    }

    private function saveDescriptions($category_id, $data) {
        foreach ($data['category_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "probg_service_category_description SET category_id = '" . (int)$category_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', subtitle = '" . $this->db->escape($value['subtitle']) . "', description_short = '" . $this->db->escape($value['description_short']) . "', description = '" . $this->db->escape($value['description']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
        }
    }

    private function saveStores($category_id, $data) {
        foreach (($data['category_store'] ?? array(0)) as $store_id) $this->db->query("INSERT INTO " . DB_PREFIX . "probg_service_category_to_store SET category_id = '" . (int)$category_id . "', store_id = '" . (int)$store_id . "'");
    }

    private function saveSeoUrls($category_id, $data) {
        foreach (($data['category_seo_url'] ?? array()) as $store_id => $languages) foreach ($languages as $language_id => $keyword) if (trim($keyword) !== '') $this->db->query("INSERT INTO " . DB_PREFIX . "seo_url SET store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', query = 'extension/probg_services/category&category_id=" . (int)$category_id . "', keyword = '" . $this->db->escape(trim($keyword)) . "'");
    }

    private function deleteSeoUrls($category_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "seo_url WHERE query = 'extension/probg_services/category&category_id=" . (int)$category_id . "'");
    }
}
