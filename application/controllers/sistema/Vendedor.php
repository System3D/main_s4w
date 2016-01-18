<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedor extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        $data['titulo'] = 'WEB3D - Vendedor';
        $data['pagina'] = 'dash-vendedor';
        $this->load->view('sistema/index', $data, FALSE);
    }
}