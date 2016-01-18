<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocatariosUsuarios extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('template/Template_model', 'locUser');
        $this->locUser->setTable('usuariosLocatarios', 'usuarioLocatarioID');
        $this->load->model('template/Template_model', 'loc');
        $this->loc->setTable('locatarios', 'locatarioID');
    }

    public function listar($id)
    {
        # Dados do locatário
        $locatarioID = (int) strip_tags(trim($id));

        $data['locatario'] = $this->loc->get_by_id($locatarioID);
        # Fim dados do locatário

        $data['titulo'] = 'Steel4Web - Listar Usuários Locatários';
        $pagina = 'locatariosusuarios-listar';
        $data['locatariosUsuarios'] = $this->locUser->get_by_field('locatarioID', $locatarioID);
        $this->render($data, $pagina);
    }

    public function cadastrar($id)
    {
         # Dados do locatário
        $locatarioID = (int) strip_tags(trim($id));
        $data['locatario'] = $this->loc->get_by_id($locatarioID);
        # Fim dados do locatário

        $data['titulo'] = 'Steel4Web - Cadastrar Usuário do Locatário';
        $pagina = 'locatariousuario-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $data['titulo'] = 'Steel4Web - Editar Usuário do Locatário';
        $pagina = 'locatariousuario-cadastro';
        $data['usuarioLocatarioID'] = strip_tags(trim($id));
        $data['usuarioLocatario'] = $this->locUser->get_by_id($data['usuarioLocatarioID']);
        $data['locatario'] = $this->loc->get_by_id($data['usuarioLocatario']->locatarioID);
        $data['edicao'] = true;
        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['nome']          = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['email']         = strip_tags(trim($this->input->post('email')));
            $dados['senha']         = strip_tags(trim($this->input->post('senha')));
            $dados['locatarioID']   = $this->input->post('locatarioID');
            $dados['tipoUsuarioID'] = $this->input->post('tipoUsuarioID');

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha']) && isset($dados['locatarioID']) && isset($dados['tipoUsuarioID'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d'),
                    'status'        => 1,
                    'locatarioID'   => $dados['locatarioID'],
                    'tipoUsuarioID' => $dados['tipoUsuarioID']
                );

                $locatarioUsuarioID = $this->locUser->insert($attributes);

                if($locatarioUsuarioID){
                    die('sucesso');
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
            $dados['locatarioID']        = $this->input->post('locatarioID');
            $dados['usuarioLocatarioID'] = $this->input->post('usuarioLocatarioID');
            $dados['tipoUsuarioID']      = $this->input->post('tipoUsuarioID');

            if(isset($dados['nome']) && isset($dados['email']) && isset($dados['senha']) && isset($dados['locatarioID']) && isset($dados['usuarioLocatarioID']) && isset($dados['tipoUsuarioID'])) {

                $attributes = array(
                    'nome'          => $dados['nome'],
                    'email'         => $dados['email'],
                    'senha'         => sha1('web3d@' . $dados['senha'] . '@web3d'),
                    'status'        => 1,
                    'locatarioID'   => $dados['locatarioID'],
                    'tipoUsuarioID' => $dados['tipoUsuarioID']
                );

                $locatarioUsuarioID = $this->locUser->update($dados['usuarioLocatarioID'], $attributes);

                if($locatarioUsuarioID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    public function editarStatus($locatarioID, $id, $status)
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

        $mudancaStatus = $this->locUser->update($id, $attributes);
        redirect('sistema/locatariosUsuarios/listar/' . $locatarioID);
    }

    public function excluir($locatarioID,$id)
    {
        $mudancaStatus = $this->locUser->delete($id);
        redirect('sistema/locatariosUsuarios/listar/' . $locatarioID);
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-adm', $data, FALSE);
        $this->load->view('sistema/paginas-admin/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}