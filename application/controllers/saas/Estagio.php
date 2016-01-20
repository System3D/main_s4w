<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estagio extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'saas/login', 'refresh');
        }

        $this->load->model('importacao/Importacao_model', 'import');
        $this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('tbhandle','id');
        
    }

    public function listar(){
        $data['titulo'] = 'Steel4Web - Administrador';

        $data['imp'] = $this->import->get_all_list();

        $pagina = 'imp-list';
        $this->render($data, $pagina);
    }

    public function teste(){
        $data = strip_tags(trim($this->input->post('username')));
        dbugnd($_POST);
        die('success');
    }

    public function conjuntos($id){
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['importacao'] = $this->import->get_by_id($id);
        $data['conjuntos'] = $this->import->getConjuntos($id);
        $pagina = 'conj-list';
        $this->render($data, $pagina);
    }

    public function avancar($marID, $qtd = 1){
       $dd =  $this->import->getCoords($marID, $qtd);
       foreach($dd as $da){
        $nextLvl = (int) $da->fkestagio + 1;
        $dat = array('fkestagio' => $nextLvl);
        $this->fil->update($da->id, $dat);
       }
       redirect("saas/estagio/conjuntos/".$dd[0]->fkImportacao, 'refresh');
    }

      private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }

}