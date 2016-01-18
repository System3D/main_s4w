<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locatarios extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('template/Template_model', 'crud');
        $this->crud->setTable('locatarios', 'locatarioID');
    }

    public function listar()
    {
        $data['titulo'] = 'Steel4Web - Listar Locatários';
        $pagina = 'locatarios-listar';
        $data['locatarios'] = $this->crud->get_all();
        $this->render($data, $pagina);
    }

    public function cadastrar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados'] = $this->end->getEstados();
        $data['titulo'] = 'Steel4Web - Cadastrar Locatário';
        $pagina = 'locatario-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados'] = $this->end->getEstados();
        $data['titulo'] = 'Steel4Web - Editar Locatário';
        $pagina = 'locatario-cadastro';
        $data['locatarioID'] = strip_tags(trim($id));
        $data['locatario'] = $this->crud->get_by_id($data['locatarioID']);
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

        $mudancaStatus = $this->crud->update($id, $attributes);
        redirect('sistema/locatarios/listar');
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['razao']     = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']  = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['tipo']      = strip_tags(trim($this->input->post('tipo')));
            $dados['documento'] = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['telefone']  = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']  = strip_tags(trim($this->input->post('cidade')));
            $dados['inscricao'] = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['endereco']  = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']       = strip_tags(trim($this->input->post('cep')));
            $dados['email']     = strip_tags(strtolower(trim($this->input->post('email'))));

            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID'])) {

                $attributes = array(
                    'razao'     => $dados['razao'],
                    'fantasia'  => $dados['fantasia'],
                    'tipo'      => $dados['tipo'],
                    'documento' => $dados['documento'],
                    'fone'      => $dados['telefone'],
                    'cidadeID'  => $dados['cidadeID'],
                    'inscricao' => $dados['inscricao'],
                    'endereco'  => $dados['endereco'],
                    'cep'       => $dados['cep'],
                    'email'     => $dados['email'],
                    'data'      => date('Y-m-d H:i:s')
                );

                $locatarioID = $this->crud->insert($attributes);

                if($locatarioID){
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
            $dados['razao']       = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']    = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['tipo']        = strip_tags(trim($this->input->post('tipo')));
            $dados['documento']   = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['telefone']    = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']    = strip_tags(trim($this->input->post('cidade')));
            $dados['locatarioID'] = strip_tags(trim($this->input->post('locatarioID')));
            $dados['inscricao']   = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['endereco']    = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']         = strip_tags(trim($this->input->post('cep')));
            $dados['email']       = strip_tags(strtolower(trim($this->input->post('email'))));


            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID']) && isset($dados['locatarioID'])) {

                $attributes = array(
                    'razao'     => $dados['razao'],
                    'fantasia'  => $dados['fantasia'],
                    'tipo'      => $dados['tipo'],
                    'documento' => $dados['documento'],
                    'fone'      => $dados['telefone'],
                    'cidadeID'  => $dados['cidadeID'],
                    'inscricao' => $dados['inscricao'],
                    'endereco'  => $dados['endereco'],
                    'cep'       => $dados['cep'],
                    'email'     => $dados['email']
                );

                $locatarioID = $this->crud->update($dados['locatarioID'],$attributes);

                if($locatarioID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-adm', $data, FALSE);
        $this->load->view('sistema/paginas-admin/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}