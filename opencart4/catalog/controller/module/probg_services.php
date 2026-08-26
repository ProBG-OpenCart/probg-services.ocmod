<?php
namespace Opencart\Catalog\Controller\Extension\ProbgServices\Module;

class ProbgServices extends \Opencart\System\Engine\Controller {
    public function index(array $setting = []): string {
        $this->load->language('extension/probg_services/module/probg_services');

        if (!$this->config->get('module_probg_services_status')) {
            return '';
        }

        $limit = (int)($setting['limit'] ?? $this->config->get('module_probg_services_limit') ?? 12);
        $limit = max(1, min(100, $limit));

        $this->load->model('extension/probg_services/module/probg_services');
        $services = $this->model_extension_probg_services_module_probg_services->getLatestServices($limit);
        $categories = $this->model_extension_probg_services_module_probg_services->getCategories();

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_categories'] = $this->language->get('text_categories');
        $data['text_services'] = $this->language->get('text_services');
        $data['text_empty'] = $this->language->get('text_empty');
        $data['categories'] = $categories;
        $data['services'] = [];

        foreach ($services as $service) {
            $data['services'][] = [
                'service_id' => (int)$service['service_id'],
                'name' => $service['name'],
                'subtitle' => $service['subtitle'],
                'description_short' => html_entity_decode($service['description_short'], ENT_QUOTES, 'UTF-8'),
                'price_text' => $service['price_text'],
                'show_price' => (bool)$service['show_price'],
                'price' => $service['show_price'] ? $this->currency->format((float)$service['price'], $this->session->data['currency']) : '',
                'href' => $this->url->link('extension/probg_services/module/probg_services.service', 'service_id=' . (int)$service['service_id'])
            ];
        }

        return $this->load->view('extension/probg_services/module/probg_services', $data);
    }

    public function service(): void {
        $this->response->redirect($this->url->link('extension/probg_services/module/probg_services'));
    }
}
