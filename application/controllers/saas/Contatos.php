<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contatos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'saas/login', 'refresh');
        }
        $this->load->model('clientes/Clientes_model', 'parceiros');
    }

    public function listar()
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['parceiros'] = $this->parceiros->get_all();
        $pagina = 'parceiros-listar';
        $this->render($data, $pagina);
    }

    public function cadastrar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados'] = $this->end->getEstados();
        $data['titulo'] = 'Steel4Web - Cadastrar Parceiros';
        $pagina = 'parceiros-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']   = $this->end->getEstados();
        $data['titulo']    = 'Steel4Web - Editar Parceiros';
        $pagina            = 'parceiros-cadastro';
        $data['clienteID'] = strip_tags(trim($id));
        $data['parceiro']   = $this->parceiros->get_by_id($data['clienteID']);
        $data['cidadeDados']   = $this->end->getCidadesById($data['parceiro']->cidadeID);
        $data['estadoDados']   = $this->end->getEstadosById($data['cidadeDados']->estado);
        if ($data['parceiro']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/contatos/listar/');
        }
        $data['edicao']    = true;

        $this->render($data, $pagina);
    }

    public function ver($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']   = $this->end->getEstados();
        $data['titulo']    = 'Steel4Web - Perfil Parceiros';
        $pagina            = 'parceiros-cadastro';
        $data['clienteID'] = strip_tags(trim($id));
        $data['parceiro']   = $this->parceiros->get_by_id($data['clienteID']);
        $data['cidadeDados']   = $this->end->getCidadesById($data['parceiro']->cidadeID);
        $data['estadoDados']   = $this->end->getEstadosById($data['cidadeDados']->estado);
        if ($data['parceiro']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/contatos/listar/');
        }
        $data['edicao'] = true;
        $data['disable'] = true;

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['razao']        = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']     = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['email']        = strtolower(strip_tags(trim($this->input->post('email'))));
            $dados['tipo']         = strip_tags(trim($this->input->post('tipo')));
            $dados['documento']    = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['inscricao']    = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['telefone']     = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']     = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']     = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']          = strip_tags(trim($this->input->post('cep')));
            $dados['locatarioID']  = $this->session->userdata('locatarioID');
            $dados['construtora']  = strip_tags(trim($this->input->post('construtora')));
            $dados['gerenciadora'] = strip_tags(trim($this->input->post('gerenciadora')));
            $dados['calculista']   = strip_tags(trim($this->input->post('calculista')));
            $dados['detalhamento'] = strip_tags(trim($this->input->post('detalhamento')));
            $dados['montagem']     = strip_tags(trim($this->input->post('montagem')));


            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID']) && isset($dados['locatarioID'])) {

                $attributes = array(
                    'razao'       => $dados['razao'],
                    'fantasia'    => $dados['fantasia'],
                    'email'       => $dados['email'],
                    'tipo'        => $dados['tipo'],
                    'documento'   => $dados['documento'],
                    'inscricao'   => $dados['inscricao'],
                    'fone'        => $dados['telefone'],
                    'cidadeID'    => $dados['cidadeID'],
                    'endereco'    => $dados['endereco'],
                    'cep'         => $dados['cep'],
                    'locatarioID' => $dados['locatarioID'],
                    'construtora'  => $dados['construtora'],
                    'gerenciadora' => $dados['gerenciadora'],
                    'calculista'   => $dados['calculista'],
                    'detalhamento' => $dados['detalhamento'],
                    'montagem'     => $dados['montagem']
                );

                $clienteID = $this->parceiros->insert($attributes);

                $log = 'Cadastro contato - ContatoID: ' . $clienteID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($clienteID){
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
             $dados['razao']        = ucwords(strip_tags(trim($this->input->post('razao'))));
            $dados['fantasia']     = ucwords(strip_tags(trim($this->input->post('fantasia'))));
            $dados['email']        = strtolower(strip_tags(trim($this->input->post('email'))));
            $dados['tipo']         = strip_tags(trim($this->input->post('tipo')));
            $dados['documento']    = $this->util->limpaString(strip_tags(trim($this->input->post('documento'))));
            $dados['inscricao']    = $this->util->limpaString(strip_tags(trim($this->input->post('inscricao'))));
            $dados['telefone']     = $this->util->limpaString(strip_tags(trim($this->input->post('telefone'))));
            $dados['cidadeID']     = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']     = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']          = strip_tags(trim($this->input->post('cep')));
            $dados['locatarioID']  = $this->session->userdata('locatarioID');
            $dados['construtora']  = strip_tags(trim($this->input->post('construtora')));
            $dados['gerenciadora'] = strip_tags(trim($this->input->post('gerenciadora')));
            $dados['calculista']   = strip_tags(trim($this->input->post('calculista')));
            $dados['detalhamento'] = strip_tags(trim($this->input->post('detalhamento')));
            $dados['montagem']     = strip_tags(trim($this->input->post('montagem')));
            $dados['clienteID']    = strip_tags(trim($this->input->post('clienteID')));


            if(isset($dados['razao']) && isset($dados['fantasia']) && isset($dados['tipo']) && isset($dados['documento']) && isset($dados['telefone']) && isset($dados['cidadeID']) && isset($dados['locatarioID']) && isset($dados['clienteID'])) {

                $attributes = array(
                    'razao'       => $dados['razao'],
                    'fantasia'    => $dados['fantasia'],
                    'email'       => $dados['email'],
                    'tipo'        => $dados['tipo'],
                    'documento'   => $dados['documento'],
                    'inscricao'   => $dados['inscricao'],
                    'fone'        => $dados['telefone'],
                    'cidadeID'    => $dados['cidadeID'],
                    'endereco'    => $dados['endereco'],
                    'cep'         => $dados['cep'],
                    'locatarioID' => $dados['locatarioID'],
                    'construtora'  => $dados['construtora'],
                    'gerenciadora' => $dados['gerenciadora'],
                    'calculista'   => $dados['calculista'],
                    'detalhamento' => $dados['detalhamento'],
                    'montagem'     => $dados['montagem']
                );

                $clienteID = $this->parceiros->update($dados['clienteID'],$attributes);

                $log = 'Edição contato - ContatoID: ' . $clienteID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($clienteID){
                    die('sucesso');
                }
            }
            die('erro');
        }
    }

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }
}