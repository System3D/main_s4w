<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $this->load->model('template/Template_model', 'loc');
        $this->loc->setTable('locatarios', 'locatarioID');
        $data['qtdLocatarios'] = count($this->loc->get_all());
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['pagina'] = 'dash-admin';
        $this->render($data);
    }

    private function render($data)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-adm', $data, FALSE);
        $this->load->view('sistema/paginas-admin/dash-admin', $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}