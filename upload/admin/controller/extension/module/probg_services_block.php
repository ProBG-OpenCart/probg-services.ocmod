<?php
class ControllerExtensionModuleProbgServicesBlock extends Controller {
    private $error=array();
    public function index(){
        $this->load->language('extension/module/probg_services_block');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/module');
        $module_id=(int)($this->request->get['module_id']??0);
        if($this->request->server['REQUEST_METHOD']==='POST'&&$this->validate()){
            if($module_id)$this->model_setting_module->editModule($module_id,$this->request->post);else $this->model_setting_module->addModule('probg_services_block',$this->request->post);
            $this->session->data['success']=$this->language->get('text_success');
            $this->response->redirect($this->url->link('marketplace/extension','user_token='.$this->session->data['user_token'].'&type=module',true));return;
        }
        $info=$module_id?$this->model_setting_module->getModule($module_id):array();
        $data['error_warning']=$this->error['warning']??'';$data['error_name']=$this->error['name']??'';$data['error_limit']=$this->error['limit']??'';
        $data['user_token']=$this->session->data['user_token'];
        $data['action']=$this->url->link('extension/module/probg_services_block','user_token='.$data['user_token'].($module_id?'&module_id='.$module_id:''),true);
        $data['cancel']=$this->url->link('marketplace/extension','user_token='.$data['user_token'].'&type=module',true);
        $this->load->model('localisation/language');$data['languages']=$this->model_localisation_language->getLanguages();
        $this->load->model('extension/probg_services/category');$data['categories']=$this->model_extension_probg_services_category->getCategories(array('sort'=>'cd.name','order'=>'ASC'));
        $this->load->model('extension/probg_services/service');
        foreach(array('name'=>'','mode'=>'latest','category_id'=>0,'limit'=>4,'width'=>480,'height'=>320,'status'=>1) as $k=>$v)$data[$k]=$this->request->post[$k]??($info[$k]??$v);
        $data['block_description']=$this->request->post['block_description']??($info['block_description']??array());
        $data['service_ids']=$this->request->post['service_ids']??($info['service_ids']??array());$data['selected_services']=array();foreach((array)$data['service_ids'] as $id){$row=$this->model_extension_probg_services_service->getService((int)$id);if($row)$data['selected_services'][]=$row;}
        $data['breadcrumbs']=array(array('text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard','user_token='.$data['user_token'],true)),array('text'=>$this->language->get('text_extension'),'href'=>$this->url->link('marketplace/extension','user_token='.$data['user_token'].'&type=module',true)),array('text'=>$this->language->get('heading_title'),'href'=>$data['action']));
        $data['header']=$this->load->controller('common/header');$data['column_left']=$this->load->controller('common/column_left');$data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/probg_services_block',$data));
    }
    protected function validate(){if(!$this->user->hasPermission('modify','extension/module/probg_services_block'))$this->error['warning']=$this->language->get('error_permission');if(utf8_strlen(trim($this->request->post['name']??''))<3||utf8_strlen($this->request->post['name']??'')>64)$this->error['name']=$this->language->get('error_name');$limit=(int)($this->request->post['limit']??0);if($limit<1||$limit>100)$this->error['limit']=$this->language->get('error_limit');return !$this->error;}
}
