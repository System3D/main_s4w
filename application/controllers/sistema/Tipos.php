<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('template/Template_model', 'crud');
        $this->crud->setTable('tipoCliente', 'tipoClienteID');
    }

    public function cadastrar()
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $data['pagina'] = 'tipos-cadastro';
        $this->load->view('sistema/index', $data, FALSE);
    }

    public function editar($id)
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $data['pagina'] = 'tipos-cadastro';
        $data['tipoClienteID'] = strip_tags(trim($id));
        $data['tipoCliente'] = $this->crud->get_by_id($data['tipoClienteID']);
        $data['edicao'] = true;
        $this->load->view('sistema/index', $data, FALSE);
    }

    public function listar()
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $data['pagina'] = 'tipos-listar';
        $data['tipoClientes'] = $this->crud->get_all();
        $this->load->view('sistema/index', $data, FALSE);
    }

    public function gravar() {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome'] = ucwords(strip_tags(trim($this->input->post('tipo'))));
            if(isset($dados['nome']) && $dados['nome'] != '') {

                $attributes = array('nome' => $dados['nome']);

                $tipoClienteID = $this->crud->insert($attributes);

                if($tipoClienteID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    public function gravarEdicao() {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome'] = ucwords(strip_tags(trim($this->input->post('tipo'))));
            $dados['tipoClienteID'] = strip_tags(trim($this->input->post('idtipo')));

            if(isset($dados['nome']) && $dados['nome'] != '') {

                $attributes = array('nome' => $dados['nome']);

                $tipoClienteID = $this->crud->update($dados['tipoClienteID'], $attributes);

                if($tipoClienteID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }
}