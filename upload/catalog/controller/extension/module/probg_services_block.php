<?php
class ControllerExtensionModuleProbgServicesBlock extends Controller {
    public function index($setting){
        if(empty($setting['status']))return '';
        $this->load->language('extension/module/probg_services');
        $this->load->model('extension/probg_services/service');
        $this->load->model('tool/image');
        $language_id=(int)$this->config->get('config_language_id');
        $title=trim($setting['block_description'][$language_id]['title']??'');
        $data['heading_title']=$title!==''?$title:$this->language->get('heading_title');
        $limit=max(1,min(100,(int)($setting['limit']??4)));
        $mode=$setting['mode']??'latest';
        if($mode==='featured')$rows=$this->model_extension_probg_services_service->getServicesByIds(array_slice((array)($setting['service_ids']??array()),0,$limit));
        elseif($mode==='category')$rows=$this->model_extension_probg_services_service->getServices(array('category_id'=>(int)($setting['category_id']??0),'limit'=>$limit));
        else $rows=$this->model_extension_probg_services_service->getServices(array('sort'=>'latest','limit'=>$limit));
        $width=max(1,(int)($setting['width']??480));$height=max(1,(int)($setting['height']??320));$data['services']=array();
        foreach($rows as $r)$data['services'][]=array('service_id'=>$r['service_id'],'name'=>$r['name'],'subtitle'=>$r['subtitle'],'description'=>utf8_substr(trim(strip_tags(html_entity_decode($r['description_short'],ENT_QUOTES,'UTF-8'))),0,180),'image'=>$r['image']&&is_file(DIR_IMAGE.$r['image'])?$this->model_tool_image->resize($r['image'],$width,$height):'','price'=>$r['show_price']?$this->currency->format($r['price'],$this->session->data['currency']):false,'price_text'=>$r['price_text'],'href'=>$this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$r['category_id'].'&probg_service_id='.(int)$r['service_id'],true));
        if(!$data['services'])return '';
        return $this->load->view('extension/module/probg_services_block',$data);
    }
}
