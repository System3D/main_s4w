<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

 /*   public function index()
    {
        $this->load->model('clientes/Clientes_model', 'cliente');
        $this->load->model('obras/Obras_model', 'obra');
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['pagina'] = 'dash-admin';
        $data['qtdClientes'] = count($this->cliente->get_all('clientes'));
        $data['qtdObras']    = count($this->obra->get_all());
        $this->render($data);
    } */

     public function index()
    {
        $this->load->model('clientes/Clientes_model', 'cliente');
        $this->load->model('obras/Obras_model', 'obra');
        $this->load->model('usuarios/Usuarioslocatarios_model', 'users');
        $this->load->model('obras/Obras_model', 'obras');
        $this->load->model('importacao/Importacao_model', 'import');
        $this->load->model('importacao/Importacao_model', 'import');
        $this->load->helper('text');
        $data['titulo']           = 'Steel4Web - Administrador';
        $data['pagina']           = 'dash-admin';
        $data['clientes']         = $this->cliente->get_all_order('clientes');
        $data['obras']            = $this->obras->get_all_order();
        $data['users']            = $this->users->get_all_order();
        $data['imports']          = $this->import->get_all_order();
        $data['qtdClientes']      = count($this->cliente->get_all('clientes'));
        $data['qtdObras']         = count($this->obra->get_all());
        $data['qtdUsers']         = count($this->users->get_all());
        $data['qtdImport']        = count($this->import->get_all_count());
        for($x=0;$x<count($data['clientes']);$x++){
            $data['clientes'][$x]->razao = character_limiter($data['clientes'][$x]->razao,50);
        }
        for($y=0;$y<count($data['obras']);$y++){
            $data['obras'][$y]->nomeObra = character_limiter($data['obras'][$y]->nomeObra,50);
        } 
        for($h=0;$h<count( $data['users']);$h++){
           $data['users'][$h]->nome = character_limiter($data['users'][$h]->nome,50);
        }
        for($j=0;$j<count($data['imports']);$j++){
            $data['imports'][$j]->arquivo = character_limiter($data['imports'][$j]->arquivo,50);
        }
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