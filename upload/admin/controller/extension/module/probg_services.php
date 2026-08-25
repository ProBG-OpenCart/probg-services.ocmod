<?php
class ControllerExtensionModuleProbgServices extends Controller {
    private $error=array();

    public function index(){
        $this->load->language('extension/module/probg_services');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        $this->load->model('extension/probg_services/category');
        $this->load->model('extension/probg_services/service');

        if($this->request->server['REQUEST_METHOD']=='POST'&&$this->validate()){
            $post=$this->request->post;
            $post['module_probg_services_version']='1.1.0-dev';
            $this->model_setting_setting->editSetting('module_probg_services',$post);
            $this->session->data['success']=$this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/module/probg_services','user_token='.$this->session->data['user_token'],true));
        }

        $data['error_warning']=$this->error['warning']??'';
        $data['error_limit']=$this->error['limit']??'';
        $data['success']=$this->session->data['success']??'';
        unset($this->session->data['success']);

        $token='user_token='.$this->session->data['user_token'];
        $data['breadcrumbs']=array(
            array('text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard',$token,true)),
            array('text'=>$this->language->get('text_extension'),'href'=>$this->url->link('marketplace/extension',$token.'&type=module',true)),
            array('text'=>$this->language->get('heading_title'),'href'=>$this->url->link('extension/module/probg_services',$token,true))
        );

        $data['action']=$this->url->link('extension/module/probg_services',$token,true);
        $data['settings_url']=$data['action'];
        $data['categories_url']=$this->url->link('extension/probg_services/category',$token,true);
        $data['services_url']=$this->url->link('extension/probg_services/service',$token,true);
        $data['cancel']=$this->url->link('marketplace/extension',$token.'&type=module',true);
        $data['total_categories']=$this->model_extension_probg_services_category->getTotalCategories();
        $data['total_services']=$this->model_extension_probg_services_service->getTotalServices();

        $defaults=array(
            'module_probg_services_status'=>0,
            'module_probg_services_limit'=>12,
            'module_probg_services_cache_status'=>1,
            'module_probg_services_sitemap'=>1
        );
        foreach($defaults as $field=>$default){
            if(isset($this->request->post[$field]))$data[$field]=$this->request->post[$field];
            else{$value=$this->config->get($field);$data[$field]=$value!==null?$value:$default;}
        }

        $data['version']='1.1.0-dev';
        $data['stage']='4';
        $data['header']=$this->load->controller('common/header');
        $data['column_left']=$this->load->controller('common/column_left');
        $data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/probg_services',$data));
    }

    public function install(){
        $this->load->model('extension/module/probg_services');
        $this->model_extension_module_probg_services->install();
        $this->load->model('user/user_group');
        foreach(array('extension/module/probg_services','extension/probg_services/category','extension/probg_services/service','extension/probg_services/enquiry') as $route){
            $this->model_user_user_group->addPermission($this->user->getGroupId(),'access',$route);
            $this->model_user_user_group->addPermission($this->user->getGroupId(),'modify',$route);
        }
    }

    public function uninstall(){
        $this->load->model('extension/module/probg_services');
        $this->model_extension_module_probg_services->uninstall();
        $this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('module_probg_services');
    }

    protected function validate(){
        if(!$this->user->hasPermission('modify','extension/module/probg_services'))$this->error['warning']=$this->language->get('error_permission');
        $limit=isset($this->request->post['module_probg_services_limit'])?(int)$this->request->post['module_probg_services_limit']:0;
        if($limit<1||$limit>100)$this->error['limit']=$this->language->get('error_limit');
        return !$this->error;
    }
}
