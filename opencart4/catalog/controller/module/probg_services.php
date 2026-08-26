<?php
namespace Opencart\Catalog\Controller\Extension\ProbgServices\Module;

class ProbgServices extends \Opencart\System\Engine\Controller {
    public function index(array $setting = []): string {
        $this->load->language('extension/probg_services/module/probg_services');

        if (!$this->config->get('module_probg_services_status')) {
            return '';
        }

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_stage'] = $this->language->get('text_stage');

        return $this->load->view('extension/probg_services/module/probg_services', $data);
    }
}
