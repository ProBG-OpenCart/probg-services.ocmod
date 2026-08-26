<?php
namespace Opencart\Admin\Controller\Extension\ProbgServices\Module;

class ProbgServices extends \Opencart\System\Engine\Controller {
    public function index(): void {
        $this->load->language('extension/probg_services/module/probg_services');
        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');
        $data['text_stage'] = $this->language->get('text_stage');
        $data['version'] = '2.0.0-dev';
        $data['stage'] = '11';
        $data['user_token'] = $this->session->data['user_token'];
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/probg_services/module/probg_services', $data));
    }

    public function install(): void {
        // Stage 11: schema and events will be added through the OpenCart 4 integration layer.
    }

    public function uninstall(): void {
        // Business and enquiry data will be preserved by default, matching the OpenCart 3 policy.
    }
}
