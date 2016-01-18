<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('template/Template_model', 'admin');
        $this->admin->setTable('usuariosAdmin', 'usuarioAdminID');
    }

    public function cadastrar()
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $pagina = 'admin-cadastro';
        $this->render($data, $pagina);
    }

    public function listar()
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $pagina = 'admin-listar';
        $data['admins'] = $this->admin->get_all();
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $data['titulo'] = 'WEB3D - Administrador';
        $pagina = 'admin-cadastro';
        $data['usuario'] = $this->admin->get_by_id($id);
        $data['edicao'] = true;
        $this->render($data, $pagina);
    }

    public function editarStatus($id, $status)
    {
        $status = strip_tags(trim($status));

        if ($status == 'ativar') {
            $codStatus = 1;
        } else {
            $codStatus = 0;
        }

        $attributes = array(
            'status'  => $codStatus
        );

        $mudancaStatus = $this->admin->update($id, $attributes);
        redirect('sistema/usuarios/listar/');
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome']          = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['email']         = strip_tags(trim($this->input->post('email')));
            $dados['senha']         = strip_tags(trim($this->input->post('senha')));

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d')
                );

                $verificaEmail = $this->admin->get_by_field('email', $dados['email']);

                if ($verificaEmail) {
                    die('erro');
                } else {
                    $locatarioUsuarioID = $this->admin->insert($attributes);
                    if($locatarioUsuarioID){
                        die('sucesso');
                    }
                }
            }
            die('erro');
        }
    }

    public function gravarEdicao()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome']               = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['email']              = strip_tags(trim($this->input->post('email')));
            $dados['senha']              = strip_tags(trim($this->input->post('senha')));
            $dados['usuarioAdminID']     = $this->input->post('usuarioAdminID');

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha'])&& isset($dados['usuarioAdminID'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d')
                );

                $locatarioUsuarioID = $this->admin->update($dados['usuarioAdminID'], $attributes);

                if($locatarioUsuarioID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    public function excluir($id)
    {
        $excluir = $this->admin->delete($id);
        redirect('sistema/usuarios/listar/');
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-adm', $data, FALSE);
        $this->load->view('sistema/paginas-admin/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}