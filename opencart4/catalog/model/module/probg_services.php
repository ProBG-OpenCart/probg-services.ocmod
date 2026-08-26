<?php
namespace Opencart\Catalog\Model\Extension\ProbgServices\Module;

class ProbgServices extends \Opencart\System\Engine\Model {
    public function getCategories(int $limit = 0): array {
        $sql = "SELECT c.category_id, c.image, c.icon, cd.name, cd.subtitle, cd.description_short FROM `" . DB_PREFIX . "probg_service_category` c LEFT JOIN `" . DB_PREFIX . "probg_service_category_description` cd ON (c.category_id = cd.category_id) LEFT JOIN `" . DB_PREFIX . "probg_service_category_to_store` c2s ON (c.category_id = c2s.category_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1' ORDER BY c.sort_order ASC, cd.name ASC";

        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }

        return $this->db->query($sql)->rows;
    }

    public function getLatestServices(int $limit = 12): array {
        $sql = "SELECT s.service_id, s.category_id, s.image, s.price, s.show_price, sd.name, sd.subtitle, sd.description_short, sd.price_text FROM `" . DB_PREFIX . "probg_service` s LEFT JOIN `" . DB_PREFIX . "probg_service_description` sd ON (s.service_id = sd.service_id) LEFT JOIN `" . DB_PREFIX . "probg_service_to_store` s2s ON (s.service_id = s2s.service_id) WHERE sd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND s2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND s.status = '1' AND (s.date_available IS NULL OR s.date_available <= CURDATE()) ORDER BY s.date_added DESC, s.sort_order ASC, sd.name ASC LIMIT " . max(1, min(100, $limit));

        return $this->db->query($sql)->rows;
    }
}
