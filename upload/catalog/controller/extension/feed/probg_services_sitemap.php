<?php
class ControllerExtensionFeedProbgServicesSitemap extends Controller {
    public function index(){if(!$this->enabled())return;$this->response->addHeader('Content-Type: application/xml; charset=utf-8');$this->response->setOutput('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$this->nodes().'</urlset>');}
    public function googleSitemap(){return $this->enabled()?$this->nodes():'';}
    private function enabled(){return $this->config->get('module_probg_services_status')&&$this->config->get('module_probg_services_sitemap');}
    private function nodes(){
        $this->load->model('extension/probg_services/service');$data=$this->model_extension_probg_services_service->getSitemapData();$freq=$this->config->get('module_probg_services_sitemap_changefreq')?:'weekly';
        $out=$this->urlNode($this->url->link('extension/module/probg_services','',true),date('c'),$freq,$this->priority('section','0.8'));
        foreach($data['categories'] as $c)$out.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$c['category_id'],true),$c['date_modified'],$freq,$this->priority('category','0.7'));
        foreach($data['services'] as $s)$out.=$this->urlNode($this->url->link('extension/module/probg_services','probg_service_category_id='.(int)$s['category_id'].'&probg_service_id='.(int)$s['service_id'],true),$s['date_modified'],$freq,$this->priority('service','0.8'));
        return $out;
    }
    private function priority($type,$default){$v=(float)$this->config->get('module_probg_services_sitemap_priority_'.$type);if($v<0||$v>1)$v=(float)$default;return number_format($v,1,'.','');}
    private function urlNode($loc,$lastmod,$freq,$priority){$allowed=array('always','hourly','daily','weekly','monthly','yearly','never');if(!in_array($freq,$allowed,true))$freq='weekly';return '<url><loc>'.htmlspecialchars($loc,ENT_QUOTES,'UTF-8').'</loc><lastmod>'.date('c',strtotime($lastmod)).'</lastmod><changefreq>'.$freq.'</changefreq><priority>'.$priority.'</priority></url>';}
}
