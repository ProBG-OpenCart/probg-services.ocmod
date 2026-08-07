<?php
class ControllerExtensionProbgServicesCategory extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('extension/probg_services/category');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/probg_services/category');
        $this->getList();
    }

    public function add() {
        $this->load->language('extension/probg_services/category');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/probg_services/category');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_extension_probg_services_category->addCategory($this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/probg_services/category', 'user_token=' . $this->session->data['user_token'], true));
        }
        $this->getForm();
    }

    public function edit() {
        $this->load->language('extension/probg_services/category');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('extension/probg_services/category');
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            $this->model_extension_probg_services_category->editCategory((int)$this->request->get['category_id'], $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/probg_services/category', 'user_token=' . $this->session->data['user_token'], true));
        }
        $this->getForm();
    }

    public function delete() {
        $this->load->language('extension/probg_services/category');
        $this->load->model('extension/probg_services/category');
        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $category_id) $this->model_extension_probg_services_category->deleteCategory((int)$category_id);
            $this->session->data['success'] = $this->language->get('text_success_delete');
        }
        $this->response->redirect($this->url->link('extension/probg_services/category', 'user_token=' . $this->session->data['user_token'], true));
    }

    protected function getList() {
        $filter_name = $this->request->get['filter_name'] ?? '';
        $filter_status = $this->request->get['filter_status'] ?? '';
        $filter_parent_id = $this->request->get['filter_parent_id'] ?? '';
        $sort = $this->request->get['sort'] ?? 'c.sort_order';
        $order = $this->request->get['order'] ?? 'ASC';
        $page = max(1, (int)($this->request->get['page'] ?? 1));
        $url = '';
        foreach (array('filter_name','filter_status','filter_parent_id','sort','order','page') as $key) if (isset($this->request->get[$key])) $url .= '&' . $key . '=' . urlencode($this->request->get[$key]);
        $data['breadcrumbs'] = array(
            array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)),
            array('text' => 'ProBG Services', 'href' => $this->url->link('extension/module/probg_services', 'user_token=' . $this->session->data['user_token'], true)),
            array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/probg_services/category', 'user_token=' . $this->session->data['user_token'] . $url, true))
        );
        $data['add'] = $this->url->link('extension/probg_services/category/add', 'user_token=' . $this->session->data['user_token'], true);
        $data['delete'] = $this->url->link('extension/probg_services/category/delete', 'user_token=' . $this->session->data['user_token'], true);
        $filter_data = array('filter_name'=>$filter_name,'filter_status'=>$filter_status,'filter_parent_id'=>$filter_parent_id,'sort'=>$sort,'order'=>$order,'start'=>($page-1)*$this->config->get('config_limit_admin'),'limit'=>$this->config->get('config_limit_admin'));
        $total = $this->model_extension_probg_services_category->getTotalCategories($filter_data);
        $data['categories'] = array();
        foreach ($this->model_extension_probg_services_category->getCategories($filter_data) as $result) {
            $data['categories'][] = array('category_id'=>$result['category_id'],'name'=>$result['name'],'parent_name'=>$result['parent_name'],'sort_order'=>$result['sort_order'],'status'=>$result['status'],'edit'=>$this->url->link('extension/probg_services/category/edit','user_token=' . $this->session->data['user_token'] . '&category_id=' . $result['category_id'],true));
        }
        $data['parents'] = $this->model_extension_probg_services_category->getCategories(array('sort'=>'cd.name','order'=>'ASC'));
        $data['filter_name']=$filter_name; $data['filter_status']=$filter_status; $data['filter_parent_id']=$filter_parent_id;
        $data['error_warning']=$this->error['warning'] ?? ''; $data['success']=$this->session->data['success'] ?? ''; unset($this->session->data['success']);
        $pagination = new Pagination(); $pagination->total=$total; $pagination->page=$page; $pagination->limit=$this->config->get('config_limit_admin'); $pagination->url=$this->url->link('extension/probg_services/category','user_token=' . $this->session->data['user_token'] . '&page={page}',true);
        $data['pagination']=$pagination->render(); $data['results']=sprintf($this->language->get('text_pagination'),($total)?(($page-1)*$pagination->limit)+1:0,((($page-1)*$pagination->limit)>($total-$pagination->limit))?$total:((($page-1)*$pagination->limit)+$pagination->limit)),$total,ceil($total/$pagination->limit));
        $data['header']=$this->load->controller('common/header'); $data['column_left']=$this->load->controller('common/column_left'); $data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/probg_services/category_list',$data));
    }

    protected function getForm() {
        $category_id = (int)($this->request->get['category_id'] ?? 0);
        $data['text_form'] = $category_id ? $this->language->get('text_edit') : $this->language->get('text_add');
        $data['error_warning']=$this->error['warning'] ?? ''; $data['error_name']=$this->error['name'] ?? array(); $data['error_meta_title']=$this->error['meta_title'] ?? array(); $data['error_keyword']=$this->error['keyword'] ?? array();
        $data['breadcrumbs']=array(array('text'=>$this->language->get('text_home'),'href'=>$this->url->link('common/dashboard','user_token='.$this->session->data['user_token'],true)),array('text'=>'ProBG Services','href'=>$this->url->link('extension/module/probg_services','user_token='.$this->session->data['user_token'],true)),array('text'=>$this->language->get('heading_title'),'href'=>$this->url->link('extension/probg_services/category','user_token='.$this->session->data['user_token'],true)));
        $data['action']=$category_id?$this->url->link('extension/probg_services/category/edit','user_token='.$this->session->data['user_token'].'&category_id='.$category_id,true):$this->url->link('extension/probg_services/category/add','user_token='.$this->session->data['user_token'],true);
        $data['cancel']=$this->url->link('extension/probg_services/category','user_token='.$this->session->data['user_token'],true);
        $category_info=$category_id?$this->model_extension_probg_services_category->getCategory($category_id):array();
        $this->load->model('localisation/language'); $data['languages']=$this->model_localisation_language->getLanguages();
        $this->load->model('setting/store'); $data['stores']=$this->model_setting_store->getStores();
        $this->load->model('tool/image');
        $fields=array('parent_id'=>0,'image'=>'','icon'=>'','sort_order'=>0,'status'=>1); foreach($fields as $field=>$default) $data[$field]=$this->request->post[$field]??($category_info[$field]??$default);
        $data['category_description']=$this->request->post['category_description']??($category_id?$this->model_extension_probg_services_category->getCategoryDescriptions($category_id):array());
        $data['category_store']=$this->request->post['category_store']??($category_id?$this->model_extension_probg_services_category->getCategoryStores($category_id):array(0));
        $data['category_seo_url']=$this->request->post['category_seo_url']??($category_id?$this->model_extension_probg_services_category->getCategorySeoUrls($category_id):array());
        $data['parents']=array_filter($this->model_extension_probg_services_category->getCategories(array('sort'=>'cd.name','order'=>'ASC')),function($row) use($category_id){return (int)$row['category_id']!==$category_id;});
        $data['thumb']=$data['image']&&is_file(DIR_IMAGE.$data['image'])?$this->model_tool_image->resize($data['image'],100,100):$this->model_tool_image->resize('no_image.png',100,100); $data['placeholder']=$this->model_tool_image->resize('no_image.png',100,100);
        $data['header']=$this->load->controller('common/header'); $data['column_left']=$this->load->controller('common/column_left'); $data['footer']=$this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/probg_services/category_form',$data));
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify','extension/probg_services/category')) $this->error['warning']=$this->language->get('error_permission');
        foreach (($this->request->post['category_description']??array()) as $language_id=>$value) {
            if (utf8_strlen(trim($value['name']))<1 || utf8_strlen($value['name'])>255) $this->error['name'][$language_id]=$this->language->get('error_name');
            if (trim($value['meta_title'])!=='' && utf8_strlen($value['meta_title'])>255) $this->error['meta_title'][$language_id]=$this->language->get('error_meta_title');
        }
        foreach (($this->request->post['category_seo_url']??array()) as $store_id=>$languages) foreach($languages as $language_id=>$keyword) if(trim($keyword)!=='') {
            $found=$this->model_extension_probg_services_category->getSeoUrlByKeyword(trim($keyword),$store_id,$language_id);
            $expected='extension/probg_services/category&category_id='.(int)($this->request->get['category_id']??0);
            if($found && $found['query']!==$expected) $this->error['keyword'][$store_id][$language_id]=$this->language->get('error_keyword');
        }
        return !$this->error;
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify','extension/probg_services/category')) $this->error['warning']=$this->language->get('error_permission');
        return !$this->error;
    }
}
