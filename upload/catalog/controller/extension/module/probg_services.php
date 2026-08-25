<?php
class ControllerExtensionModuleProbgServices extends Controller {
    private static $full_page_rendering = false;

    public function index($setting = array()) {
        if (!$this->config->get('module_probg_services_status')) return '';

        $this->load->language('extension/module/probg_services');
        $this->load->model('extension/probg_services/service');
        $this->load->model('tool/image');

        $category_id = isset($this->request->get['probg_service_category_id']) ? (int)$this->request->get['probg_service_category_id'] : 0;
        $service_id = isset($this->request->get['probg_service_id']) ? (int)$this->request->get['probg_service_id'] : 0;
        $route = isset($this->request->get['route']) ? (string)$this->request->get['route'] : '';
        $is_request = ($route === 'extension/module/probg_services' || $category_id > 0 || $service_id > 0);

        if (!$is_request || self::$full_page_rendering) return $this->module(is_array($setting) ? $setting : array());

        self::$full_page_rendering = true;
        if ($service_id) $output = $this->service($service_id, $category_id);
        elseif ($category_id) $output = $this->category($category_id);
        else $output = $this->listing();
        self::$full_page_rendering = false;

        return $output;
    }

    private function listing() {
        $page = max(1, isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1);
        $limit = max(1, (int)($this->config->get('module_probg_services_limit') ?: 12));
        $title = $this->language->get('heading_title');
        $this->document->setTitle($title);
        $canonical = $this->url->link('extension/module/probg_services', $page > 1 ? 'page=' . $page : '', true);
        $this->document->addLink($canonical, 'canonical');

        $data = $this->layoutData();
        $data['heading_title'] = $title;
        $data['breadcrumbs'] = $this->breadcrumbs();
        $data['categories'] = array();
        foreach ($this->model_extension_probg_services_service->getCategories() as $category) {
            $data['categories'][] = array(
                'name' => $category['name'],
                'subtitle' => $category['subtitle'],
                'description' => html_entity_decode($category['description_short'], ENT_QUOTES, 'UTF-8'),
                'count' => (int)$category['service_count'],
                'href' => $this->url->link('extension/module/probg_services', 'probg_service_category_id=' . (int)$category['category_id'], true)
            );
        }
        $total = $this->model_extension_probg_services_service->getTotalServices();
        $data['services'] = $this->cards($this->model_extension_probg_services_service->getServices(array('start' => ($page - 1) * $limit, 'limit' => $limit)));
        $this->pagination($data, $total, $page, $limit, '');
        return $this->render('probg_services_list', $data);
    }

    private function category($category_id) {
        $category = $this->model_extension_probg_services_service->getCategory($category_id);
        if (!$category) return $this->notFound();

        $page = max(1, isset($this->request->get['page']) ? (int)$this->request->get['page'] : 1);
        $limit = max(1, (int)($this->config->get('module_probg_services_limit') ?: 12));
        $this->meta($category, $category['name']);
        $canonical = $this->url->link('extension/module/probg_services', 'probg_service_category_id=' . $category_id . ($page > 1 ? '&page=' . $page : ''), true);
        $this->document->addLink($canonical, 'canonical');

        $data = $this->layoutData();
        $data['heading_title'] = $category['name'];
        $data['subtitle'] = $category['subtitle'];
        $data['description'] = html_entity_decode($category['description'], ENT_QUOTES, 'UTF-8');
        $data['breadcrumbs'] = $this->breadcrumbs(array(array('text' => $category['name'], 'href' => $canonical)));
        $total = $this->model_extension_probg_services_service->getTotalServices($category_id);
        $data['services'] = $this->cards($this->model_extension_probg_services_service->getServices(array('category_id' => $category_id, 'start' => ($page - 1) * $limit, 'limit' => $limit)));
        $this->pagination($data, $total, $page, $limit, 'probg_service_category_id=' . $category_id);
        return $this->render('probg_services_category', $data);
    }

    private function service($service_id, $requested_category = 0) {
        $service = $this->model_extension_probg_services_service->getService($service_id);
        if (!$service) return $this->notFound();

        $canonical = $this->url->link('extension/module/probg_services', 'probg_service_category_id=' . (int)$service['category_id'] . '&probg_service_id=' . $service_id, true);
        if ($requested_category && $requested_category != (int)$service['category_id']) {
            $this->response->redirect($canonical, 301);
            return '';
        }

        $this->meta($service, $service['name']);
        $this->document->addLink($canonical, 'canonical');

        $data = $this->layoutData();
        $data['heading_title'] = $service['name'];
        $data['subtitle'] = $service['subtitle'];
        $data['short_description'] = html_entity_decode($service['description_short'], ENT_QUOTES, 'UTF-8');
        $data['description'] = html_entity_decode($service['description'], ENT_QUOTES, 'UTF-8');
        $data['image'] = $this->image($service['image'], 900, 600);
        $data['price'] = $service['show_price'] ? $this->currency->format($service['price'], $this->session->data['currency']) : false;
        $data['price_text'] = $service['price_text'];
        $data['button_text'] = $service['button_text'] ? $service['button_text'] : $this->language->get('button_enquiry');
        $data['enquiry_status'] = (int)$service['enquiry_status'];
        $data['category'] = array('name' => $service['category_name'], 'href' => $this->url->link('extension/module/probg_services', 'probg_service_category_id=' . (int)$service['category_id'], true));
        $data['breadcrumbs'] = $this->breadcrumbs(array(array('text' => $service['category_name'], 'href' => $data['category']['href']), array('text' => $service['name'], 'href' => $canonical)));
        $data['images'] = array();
        foreach ($this->model_extension_probg_services_service->getServiceImages($service_id) as $image) {
            if ($image['image'] && is_file(DIR_IMAGE . $image['image'])) {
                $data['images'][] = array('thumb' => $this->model_tool_image->resize($image['image'], 300, 220), 'popup' => HTTP_SERVER . 'image/' . $image['image']);
            }
        }
        $related = array();
        foreach ($this->model_extension_probg_services_service->getRelatedServices($service_id) as $related_id) {
            $row = $this->model_extension_probg_services_service->getService($related_id);
            if ($row) $related[] = $row;
        }
        $data['related'] = $this->cards($related);
        return $this->render('probg_services_service', $data);
    }

    private function module($setting) {
        $limit = max(1, min(100, isset($setting['limit']) ? (int)$setting['limit'] : 4));
        $data['heading_title'] = !empty($setting['name']) ? $setting['name'] : $this->language->get('heading_title');
        $data['services_url'] = $this->url->link('extension/module/probg_services', '', true);
        $data['services'] = $this->cards($this->model_extension_probg_services_service->getServices(array('limit' => $limit)));
        return $this->load->view('extension/module/probg_services', $data);
    }

    private function cards($rows) {
        $items = array();
        foreach ($rows as $row) {
            $items[] = array(
                'service_id' => $row['service_id'],
                'name' => $row['name'],
                'subtitle' => $row['subtitle'],
                'description' => utf8_substr(trim(strip_tags(html_entity_decode($row['description_short'], ENT_QUOTES, 'UTF-8'))), 0, 180),
                'image' => $this->image($row['image'], 480, 320),
                'price' => $row['show_price'] ? $this->currency->format($row['price'], $this->session->data['currency']) : false,
                'price_text' => $row['price_text'],
                'href' => $this->url->link('extension/module/probg_services', 'probg_service_category_id=' . (int)$row['category_id'] . '&probg_service_id=' . (int)$row['service_id'], true)
            );
        }
        return $items;
    }

    private function layoutData() {
        return array(
            'column_left' => $this->load->controller('common/column_left'),
            'column_right' => $this->load->controller('common/column_right'),
            'content_top' => $this->load->controller('common/content_top'),
            'content_bottom' => $this->load->controller('common/content_bottom'),
            'text_no_results' => $this->language->get('text_no_results'),
            'text_read_more' => $this->language->get('text_read_more'),
            'text_related' => $this->language->get('text_related'),
            'text_price' => $this->language->get('text_price')
        );
    }

    private function breadcrumbs($extra = array()) {
        return array_merge(array(
            array('text' => $this->language->get('text_home'), 'href' => $this->url->link('common/home', '', true)),
            array('text' => $this->language->get('heading_title'), 'href' => $this->url->link('extension/module/probg_services', '', true))
        ), $extra);
    }

    private function pagination(&$data, $total, $page, $limit, $query) {
        $pagination = new Pagination();
        $pagination->total = $total;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('extension/module/probg_services', ($query ? $query . '&' : '') . 'page={page}', true);
        $data['pagination'] = $pagination->render();
        $data['results'] = sprintf($this->language->get('text_pagination'), $total ? (($page - 1) * $limit) + 1 : 0, min($total, $page * $limit), $total, ceil($total / $limit));
    }

    private function meta($row, $fallback) {
        $this->document->setTitle(!empty($row['meta_title']) ? $row['meta_title'] : $fallback);
        if (!empty($row['meta_description'])) $this->document->setDescription($row['meta_description']);
        if (!empty($row['meta_keyword'])) $this->document->setKeywords($row['meta_keyword']);
    }

    private function image($path, $width, $height) {
        return ($path && is_file(DIR_IMAGE . $path)) ? $this->model_tool_image->resize($path, $width, $height) : '';
    }

    private function render($view, $data) {
        $data['header'] = $this->load->controller('common/header');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('extension/module/' . $view, $data));
        return '';
    }

    private function notFound() {
        $this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');
        $this->document->setTitle($this->language->get('text_not_found'));
        $data = $this->layoutData();
        $data['heading_title'] = $this->language->get('text_not_found');
        $data['breadcrumbs'] = $this->breadcrumbs();
        return $this->render('probg_services_not_found', $data);
    }
}
