<?php
class ControllerExtensionModuleProbgServices extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/module/probg_services');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('module_probg_services', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/probg_services', 'user_token=' . $this->session->data['user_token'], true));
        }

        $data['error_warning'] = isset($this->error['warning']) ? $this->error['warning'] : '';
        $data['success'] = isset($this->session->data['success']) ? $this->session->data['success'] : '';
        unset($this->session->data['success']);

        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true));
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_extension'), 'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/module/probg_services', 'user_token=' . $this->session->data['user_token'], true));

        $data['action'] = $this->url->link('extension/module/probg_services', 'user_token=' . $this->session->data['user_token'], true);
        $data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

        $fields = array('module_probg_services_status', 'module_probg_services_cache_status');
        foreach ($fields as $field) {
            if (isset($this->request->post[$field])) {
                $data[$field] = $this->request->post[$field];
            } else {
                $data[$field] = $this->config->get($field);
            }
        }

        $data['version'] = '0.1.0-dev';
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/probg_services', $data));
    }

    public function install() {
        $this->load->model('extension/module/probg_services');
        $this->model_extension_module_probg_services->install();

        $this->load->model('user/user_group');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/module/probg_services');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/module/probg_services');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/probg_services/category');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/probg_services/category');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/probg_services/service');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/probg_services/service');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'extension/probg_services/enquiry');
        $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'extension/probg_services/enquiry');
    }

    public function uninstall() {
        $this->load->model('extension/module/probg_services');
        $this->model_extension_module_probg_services->uninstall();
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('module_probg_services');
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/probg_services')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        return !$this->error;
    }
}
