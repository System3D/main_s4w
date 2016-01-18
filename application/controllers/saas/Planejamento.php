<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Planejamento extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['titulo'] = 'Steel4Web - Planejamento';
        $data['pagina'] = 'dash-admin';
        $this->render($data);
    }

    private function render($data)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/dash-admin', $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}