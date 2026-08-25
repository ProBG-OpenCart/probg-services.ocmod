<?php
class ControllerExtensionProbgServicesEnquiry extends Controller {
    private $error=array();
    private $statuses=array(1=>'new',2=>'viewed',3=>'needs_info',4=>'quote_sent',5=>'in_progress',6=>'accepted',7=>'rejected',8=>'completed',9=>'spam');

    public function index(){
        $this->load->language('extension/probg_services/enquiry');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/probg_services/enquiry');
        $this->getList();
    }

    public function info(){
        $this->load->language('extension/probg_services/enquiry');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/probg_services/enquiry');
        $enquiry_id=(int)($this->request->get['enquiry_id']??0);
        $enquiry=$this->model_extension_probg_services_enquiry->getEnquiry($enquiry_id);
        if(!$enquiry){$this->response->redirect($this->url->link('extension/probg_services/enquiry','user_token='.$this->session->data['user_token'],true));return;}

        if($this->request->server['REQUEST_METHOD']==='POST'&&$this->validateModify()){
            $status_id=(int)($this->request->post['status_id']??$enquiry['status_id']);
            $comment=trim($this->request->post['comment']??'');
            $this->model_extension_probg_services_enquiry->addHistory($enquiry_id,$status_id,$comment,$this->user->getId());
            $this->session->data['success']=$this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/probg_services/enquiry/info','user_token='.$this->session->data['user_token'].'&enquiry_id='.$enquiry_id,true));return;
        }

        $data=$this->baseData();
        $data['text_form']=sprintf($this->language->get('text_form'),$enquiry_id);
        $data['enquiry']=$enquiry;
        $data['status_name']=$this->statusName((int)$enquiry['status_id']);
        $data['statuses']=$this->statusOptions();
        $data['files']=$this->model_extension_probg_services_enquiry->getFiles($enquiry_id);
        $data['history']=array();
        foreach($this->model_extension_probg_services_enquiry->getHistory($enquiry_id) as $row){$row['status_name']=$this->statusName((int)$row['status_id']);$data['history'][]=$row;}
        $data['action']=$this->url->link('extension/probg_services/enquiry/info','user_token='.$this->session->data['user_token'].'&enquiry_id='.$enquiry_id,true);
        $data['cancel']=$this->url->link('extension/probg_services/enquiry','user_token='.$this->session->data['user_token'],true);
        $data['header']=$this->load->controller('common/header');$data['column_left']=$this->load->controller('common/column_left');$data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/probg_services/enquiry_form',$data));
    }

    public function delete(){
        $this->load->language('extension/probg_services/enquiry');$this->load->model('extension/probg_services/enquiry');
        if(!empty($this->request->post['selected'])&&$this->validateModify())foreach($this->request->post['selected'] as $id)$this->model_extension_probg_services_enquiry->deleteEnquiry((int)$id);
        $this->session->data['success']=$this->language->get('text_success_delete');
        $this->response->redirect($this->url->link('extension/probg_services/enquiry','user_token='.$this->session->data['user_token'],true));
    }

    private function getList(){
        $filters=array('filter_name'=>$this->request->get['filter_name']??'','filter_email'=>$this->request->get['filter_email']??'','filter_service_id'=>$this->request->get['filter_service_id']??'','filter_status_id'=>$this->request->get['filter_status_id']??'','filter_date_from'=>$this->request->get['filter_date_from']??'','filter_date_to'=>$this->request->get['filter_date_to']??'');
        $page=max(1,(int)($this->request->get['page']??1));$limit=(int)$this->config->get('config_limit_admin');$query=$filters+array('start'=>($page-1)*$limit,'limit'=>$limit);
        $total=$this->model_extension_probg_services_enquiry->getTotalEnquiries($query);
        $data=$this->baseData();$data['enquiries']=array();
        foreach($this->model_extension_probg_services_enquiry->getEnquiries($query) as $row){$row['status_name']=$this->statusName((int)$row['status_id']);$row['view']=$this->url->link('extension/probg_services/enquiry/info','user_token='.$this->session->data['user_token'].'&enquiry_id='.(int)$row['enquiry_id'],true);$data['enquiries'][]=$row;}
        foreach($filters as $k=>$v)$data[$k]=$v;
        $data['statuses']=$this->statusOptions();$data['delete']=$this->url->link('extension/probg_services/enquiry/delete','user_token='.$this->session->data['user_token'],true);
        $pagination=new Pagination();$pagination->total=$total;$pagination->page=$page;$pagination->limit=$limit;$pagination->url=$this->url->link('extension/probg_services/enquiry','user_token='.$this->session->data['user_token'].'&page={page}',true);$data['pagination']=$pagination->render();$data['results']=sprintf($this->language->get('text_pagination'),$total?(($page-1)*$limit)+1:0,min($total,$page*$limit),$total,ceil($total/$limit));
        $data['header']=$this->load->controller('common/header');$data['column_left']=$this->load->controller('common/column_left');$data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/probg_services/enquiry_list',$data));
    }

    private function baseData(){
        $token='user_token='.$this->session->data['user_token'];
        return array('user_token'=>$this->session->data['user_token'],'error_warning'=>$this->error['warning']??'','success'=>$this->session->data['success']??'','settings_url'=>$this->url->link('extension/module/probg_services',$token,true),'categories_url'=>$this->url->link('extension/probg_services/category',$token,true),'services_url'=>$this->url->link('extension/probg_services/service',$token,true),'enquiries_url'=>$this->url->link('extension/probg_services/enquiry',$token,true),'breadcrumbs'=>array(array('text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard',$token,true)),array('text'=>$this->language->get('heading_title'),'href'=>$this->url->link('extension/probg_services/enquiry',$token,true))));
    }
    private function statusName($id){$key=$this->statuses[$id]??'new';return $this->language->get('status_'.$key);}
    private function statusOptions(){$out=array();foreach($this->statuses as $id=>$key)$out[]=array('status_id'=>$id,'name'=>$this->language->get('status_'.$key));return $out;}
    private function validateModify(){if(!$this->user->hasPermission('modify','extension/probg_services/enquiry'))$this->error['warning']=$this->language->get('error_permission');return !$this->error;}
}
