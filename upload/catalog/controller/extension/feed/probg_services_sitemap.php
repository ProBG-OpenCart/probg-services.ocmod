<?php
class ControllerExtensionFeedProbgServicesSitemap extends Controller {
    public function index(){
        if(!$this->config->get('module_probg_services_status'))return;
        $this->load->model('extension/probg_services/service');
        $data=$this->model_extension_probg_services_service->getSitemapData();
        $output='<?xml version="1.0" encoding="UTF-8"?>';
        $output.='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $output.=$this->urlNode($this->url->link('extension/module/probg_services','',true),date('c'));
        foreach($data['categories'] as $category){
            $output.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$category['category_id'],true),$category['date_modified']);
        }
        foreach($data['services'] as $service){
            $output.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$service['category_id'].'&probg_service_id='.(int)$service['service_id'],true),$service['date_modified']);
        }
        $output.='</urlset>';
        $this->response->addHeader('Content-Type: application/xml; charset=utf-8');
        $this->response->setOutput($output);
    }
    public function googleSitemap(){
        if(!$this->config->get('module_probg_services_status'))return '';
        $this->load->model('extension/probg_services/service');
        $data=$this->model_extension_probg_services_service->getSitemapData();$output='';
        $output.=$this->urlNode($this->url->link('extension/module/probg_services','',true),date('c'));
        foreach($data['categories'] as $category)$output.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$category['category_id'],true),$category['date_modified']);
        foreach($data['services'] as $service)$output.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$service['category_id'].'&probg_service_id='.(int)$service['service_id'],true),$service['date_modified']);
        return $output;
    }
    private function urlNode($loc,$lastmod){return '<url><loc>'.htmlspecialchars($loc,ENT_QUOTES,'UTF-8').'</loc><lastmod>'.date('c',strtotime($lastmod)).'</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>';}
}
