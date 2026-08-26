<?php
namespace Opencart\Admin\Controller\Extension\ProbgServices\Module;

class ProbgServices extends \Opencart\System\Engine\Controller {
    public function index(): void {
        $this->load->language('extension/probg_services/module/probg_services');
        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = [];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        ];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
        ];
        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/probg_services/module/probg_services', 'user_token=' . $this->session->data['user_token'])
        ];

        $data['save'] = $this->url->link('extension/probg_services/module/probg_services.save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');
        $data['module_probg_services_status'] = (bool)$this->config->get('module_probg_services_status');
        $data['module_probg_services_cache_status'] = $this->config->get('module_probg_services_cache_status') !== null ? (bool)$this->config->get('module_probg_services_cache_status') : true;
        $data['module_probg_services_limit'] = (int)($this->config->get('module_probg_services_limit') ?: 12);
        $data['version'] = '2.0.0-dev';
        $data['stage'] = '11';
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/probg_services/module/probg_services', $data));
    }

    public function save(): void {
        $this->load->language('extension/probg_services/module/probg_services');
        $json = [];

        if (!$this->user->hasPermission('modify', 'extension/probg_services/module/probg_services')) {
            $json['error'] = $this->language->get('error_permission');
        }

        $limit = (int)($this->request->post['module_probg_services_limit'] ?? 0);
        if (!$json && ($limit < 1 || $limit > 100)) {
            $json['error'] = $this->language->get('error_limit');
        }

        if (!$json) {
            $this->request->post['module_probg_services_version'] = '2.0.0-dev';
            $this->load->model('setting/setting');
            $this->model_setting_setting->editSetting('module_probg_services', $this->request->post);
            $this->cache->delete('probg_services');
            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function install(): void {
        $this->load->model('extension/probg_services/module/probg_services');
        $this->model_extension_probg_services_module_probg_services->install();
    }

    public function uninstall(): void {
        $this->load->model('extension/probg_services/module/probg_services');
        $this->model_extension_probg_services_module_probg_services->uninstall();
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('module_probg_services');
    }
}
