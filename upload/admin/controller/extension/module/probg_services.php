<?php
class ControllerExtensionModuleProbgServices extends Controller {
    private $error=array();
    public function index(){
        $this->load->language('extension/module/probg_services');$this->document->setTitle($this->language->get('heading_title'));$this->load->model('setting/setting');
        if($this->request->server['REQUEST_METHOD']=='POST'&&$this->validate()){$this->model_setting_setting->editSetting('module_probg_services',$this->request->post);$this->session->data['success']=$this->language->get('text_success');$this->response->redirect($this->url->link('extension/module/probg_services','user_token='.$this->session->data['user_token'],true));}
        $data['error_warning']=$this->error['warning']??'';$data['success']=$this->session->data['success']??'';unset($this->session->data['success']);
        $data['breadcrumbs']=array(array('text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard','user_token='.$this->session->data['user_token'],true)),array('text'=>$this->language->get('text_extension'),'href'=>$this->url->link('marketplace/extension','user_token='.$this->session->data['user_token'].'&type=module',true)),array('text'=>$this->language->get('heading_title'),'href'=>$this->url->link('extension/module/probg_services','user_token='.$this->session->data['user_token'],true)));
        $data['action']=$this->url->link('extension/module/probg_services','user_token='.$this->session->data['user_token'],true);$data['cancel']=$this->url->link('marketplace/extension','user_token='.$this->session->data['user_token'].'&type=module',true);
        foreach(array('module_probg_services_status','module_probg_services_cache_status') as $field)$data[$field]=$this->request->post[$field]??$this->config->get($field);
        $data['version']='0.3.0-dev';$data['header']=$this->load->controller('common/header');$data['column_left']=$this->load->controller('common/column_left');$data['footer']=$this->load->controller('common/footer');$this->response->setOutput($this->load->view('extension/module/probg_services',$data));
    }
    public function install(){$this->load->model('extension/module/probg_services');$this->model_extension_module_probg_services->install();$this->load->model('user/user_group');foreach(array('extension/module/probg_services','extension/probg_services/category','extension/probg_services/service','extension/probg_services/enquiry') as $route){$this->model_user_user_group->addPermission($this->user->getGroupId(),'access',$route);$this->model_user_user_group->addPermission($this->user->getGroupId(),'modify',$route);}}
    public function uninstall(){$this->load->model('extension/module/probg_services');$this->model_extension_module_probg_services->uninstall();$this->load->model('setting/setting');$this->model_setting_setting->deleteSetting('module_probg_services');}
    protected function validate(){if(!$this->user->hasPermission('modify','extension/module/probg_services'))$this->error['warning']=$this->language->get('error_permission');return !$this->error;}
}
