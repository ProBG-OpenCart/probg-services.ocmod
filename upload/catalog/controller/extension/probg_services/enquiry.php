<?php
class ControllerExtensionProbgServicesEnquiry extends Controller {
    private $errors = array();

    public function submit() {
        $this->load->language('extension/probg_services/enquiry');
        $this->load->model('extension/probg_services/service');
        $this->load->model('extension/probg_services/enquiry');

        if ($this->request->server['REQUEST_METHOD'] !== 'POST') {
            return $this->redirectToServices();
        }

        $service_id = (int)($this->request->post['service_id'] ?? 0);
        $service = $this->model_extension_probg_services_service->getService($service_id);
        if (!$service || !(int)$service['enquiry_status']) {
            return $this->redirectToServices();
        }

        if (!$this->validate()) {
            $this->session->data['probg_services_enquiry_errors'] = $this->errors;
            $this->session->data['probg_services_enquiry_data'] = $this->request->post;
            return $this->redirectToService($service);
        }

        $data = array(
            'service_id' => $service_id,
            'customer_id' => $this->customer->isLogged() ? (int)$this->customer->getId() : 0,
            'name' => trim($this->request->post['name']),
            'email' => trim($this->request->post['email']),
            'telephone' => trim($this->request->post['telephone'] ?? ''),
            'company' => trim($this->request->post['company'] ?? ''),
            'website' => trim($this->request->post['website'] ?? ''),
            'subject' => trim($this->request->post['subject'] ?? ''),
            'message' => trim($this->request->post['message']),
            'budget' => trim($this->request->post['budget'] ?? ''),
            'desired_deadline' => trim($this->request->post['desired_deadline'] ?? ''),
            'ip' => $this->request->server['REMOTE_ADDR'] ?? '',
            'user_agent' => substr($this->request->server['HTTP_USER_AGENT'] ?? '', 0, 512)
        );

        $enquiry_id = $this->model_extension_probg_services_enquiry->addEnquiry($data);
        $this->storeAttachments($enquiry_id);

        try {
            $this->sendNotification($enquiry_id, $service, $data);
            $this->model_extension_probg_services_enquiry->markEmailSent($enquiry_id);
            $this->model_extension_probg_services_enquiry->addHistory($enquiry_id, 1, 'Notification email sent successfully.', 0);
        } catch (Exception $e) {
            $this->model_extension_probg_services_enquiry->addHistory($enquiry_id, 1, 'Notification email failed: ' . $e->getMessage(), 0);
        }

        unset($this->session->data['probg_services_enquiry_errors'], $this->session->data['probg_services_enquiry_data']);
        $this->session->data['probg_services_enquiry_success'] = sprintf($this->language->get('text_success'), $enquiry_id);
        $this->redirectToService($service);
    }

    private function validate() {
        if (!isset($this->request->post['form_token'], $this->session->data['probg_services_enquiry_token']) || !hash_equals($this->session->data['probg_services_enquiry_token'], (string)$this->request->post['form_token'])) {
            $this->errors['warning'] = $this->language->get('error_token');
        }
        if (!empty($this->request->post['website_confirm'])) $this->errors['warning'] = $this->language->get('error_spam');
        if (utf8_strlen(trim($this->request->post['name'] ?? '')) < 2 || utf8_strlen(trim($this->request->post['name'] ?? '')) > 255) $this->errors['name'] = $this->language->get('error_name');
        if (!filter_var(trim($this->request->post['email'] ?? ''), FILTER_VALIDATE_EMAIL)) $this->errors['email'] = $this->language->get('error_email');
        if (utf8_strlen(trim($this->request->post['message'] ?? '')) < 10) $this->errors['message'] = $this->language->get('error_message');
        if (empty($this->request->post['privacy'])) $this->errors['privacy'] = $this->language->get('error_privacy');

        if ($this->config->get('config_captcha') && $this->config->get('captcha_' . $this->config->get('config_captcha') . '_status')) {
            $captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');
            if ($captcha) $this->errors['captcha'] = $captcha;
        }
        return !$this->errors;
    }

    private function storeAttachments($enquiry_id) {
        if (empty($this->request->files['attachments']['name']) || !is_array($this->request->files['attachments']['name'])) return;
        $allowed = array('pdf','doc','docx','xls','xlsx','jpg','jpeg','png','webp','txt');
        $count = min(count($this->request->files['attachments']['name']), 5);
        for ($i=0; $i<$count; $i++) {
            $name = $this->request->files['attachments']['name'][$i];
            $tmp = $this->request->files['attachments']['tmp_name'][$i];
            $size = (int)$this->request->files['attachments']['size'][$i];
            $error = (int)$this->request->files['attachments']['error'][$i];
            if ($error !== UPLOAD_ERR_OK || !$name || !is_uploaded_file($tmp) || $size > 5 * 1024 * 1024) continue;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed, true)) continue;
            $stored = 'probg_service_' . $enquiry_id . '_' . bin2hex(random_bytes(16)) . '.' . $ext;
            if (!move_uploaded_file($tmp, DIR_STORAGE . 'upload/' . $stored)) continue;
            $mime = function_exists('mime_content_type') ? (string)mime_content_type(DIR_STORAGE . 'upload/' . $stored) : '';
            $this->model_extension_probg_services_enquiry->addFile($enquiry_id, array('name'=>$name,'filename'=>$stored,'mime_type'=>$mime,'size'=>$size));
        }
    }

    private function sendNotification($enquiry_id, $service, $data) {
        $mail = new Mail($this->config->get('config_mail_engine'));
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
        $mail->setTo($this->config->get('config_email'));
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
        $mail->setReplyTo($data['email']);
        $mail->setSubject(sprintf($this->language->get('mail_subject'), $enquiry_id, $service['name']));
        $mail->setText(sprintf($this->language->get('mail_body'), $enquiry_id, $service['name'], $data['name'], $data['email'], $data['telephone'], $data['company'], $data['budget'], $data['desired_deadline'], $data['message']));
        $mail->send();
    }

    private function redirectToService($service) {
        $this->response->redirect($this->url->link('extension/module/probg_services', 'probg_service_category_id=' . (int)$service['category_id'] . '&probg_service_id=' . (int)$service['service_id'] . '#service-enquiry', true));
    }

    private function redirectToServices() {
        $this->response->redirect($this->url->link('extension/module/probg_services', '', true));
    }
}
