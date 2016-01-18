<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obras extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'saas/login', 'refresh');
        }
        $this->load->model('obras/Obras_model', 'obras');
        $this->load->model('clientes/Clientes_model', 'clientes');

        $sections = array(
                     'config'  => TRUE,
                     'queries' => TRUE
                     );
        
    }

    public function listar()
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $pagina = 'obras-listar';
        $data['obras'] = $this->obras->get_all();
        $this->render($data, $pagina);
    }

    public function ver($id)
    {
        $this->load->model('etapas/Etapas_model', 'etapas');
        $this->load->model('subetapa/Subetapas_model', 'subetapas');

        $data['titulo'] = 'Steel4Web - Administrador';
        $pagina = 'obras-perfil';
        $data['obra']         = $this->obras->get_by_id($id);
        $data['cliente']      = $this->clientes->get_by_id($data['obra']->clienteID);
        $data['construtora']  = $this->clientes->get_by_id($data['obra']->construtoraID);
        $data['gerenciadora'] = $this->clientes->get_by_id($data['obra']->gerenciadoraID);
        $data['calculista']   = $this->clientes->get_by_id($data['obra']->calculistaID);
        $data['detalhamento'] = $this->clientes->get_by_id($data['obra']->detalhamentoID);
        $data['montagem']     = $this->clientes->get_by_id($data['obra']->montagemID);
        $data['etapas']       = $this->etapas->get_all($id);
        $cont = sizeof($data['etapas']) - 1;

        for ($i=0; $i < $cont; $i++) {
            $data['etapas'][$i]->subetapas = $this->subetapas->get_all($data['etapas'][$i]->etapaID);
        }

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

        $mudancaStatus = $this->obras->update($id, $attributes);
        $log = 'Mudança status usuário - usuarioID: ' . $id . ' - Status: ' . $status . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);
        redirect('saas/obras/listar/' . $this->session->userdata('locatarioID'));
    }

    public function cadastrar()
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']       = $this->end->getEstados();
        $data['titulo']        = 'Steel4Web - Cadastrar Obras';
        $data['clientes']      = $this->clientes->get_by_field('cliente', 1);
        $data['construtoras']  = $this->clientes->get_by_field('construtora', 1);
        $data['gerenciadoras'] = $this->clientes->get_by_field('gerenciadora', 1);
        $data['calculistas']   = $this->clientes->get_by_field('calculista', 1);
        $data['detalhamentos'] = $this->clientes->get_by_field('detalhamento', 1);
        $data['montagens']     = $this->clientes->get_by_field('montagem', 1);
        $data['status']       = 1;
        $pagina = 'obras-cadastro';
        $this->render($data, $pagina);
    }

    public function editar($id)
    {
        $this->load->model('enderecos/Enderecos_model', 'end');
        $data['estados']   = $this->end->getEstados();
        $data['titulo']    = 'Steel4Web - Editar Obras';
        $pagina            = 'obras-cadastro';
        $data['obraID'] = strip_tags(trim($id));
        $data['clientes']      = $this->clientes->get_by_field('cliente', 1);
        $data['construtoras']  = $this->clientes->get_by_field('construtora', 1);
        $data['gerenciadoras'] = $this->clientes->get_by_field('gerenciadora', 1);
        $data['calculistas']   = $this->clientes->get_by_field('calculista', 1);
        $data['detalhamentos'] = $this->clientes->get_by_field('detalhamento', 1);
        $data['montagens']     = $this->clientes->get_by_field('montagem', 1);
        $data['obra']   = $this->obras->get_by_id($data['obraID']);
        if ($data['obra']->locatarioID != $this->session->userdata('locatarioID')) {
            redirect('saas/obras/listar/');
        }
        $data['edicao'] = true;

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['codigo']       = strip_tags(trim($this->input->post('codigo')));
            $dados['nome']         = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['descricao']    = strip_tags(trim($this->input->post('descricao')));
            $dados['cidade']       = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']     = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']          = strip_tags(trim($this->input->post('cep')));
            $dados['clienteID']    = strip_tags(trim($this->input->post('clienteID')));
            $dados['construtora']  = strip_tags(trim($this->input->post('construtora')));
            $dados['gerenciadora'] = strip_tags(trim($this->input->post('gerenciadora')));
            $dados['calculista']   = strip_tags(trim($this->input->post('calculista')));
            $dados['detalhamento'] = strip_tags(trim($this->input->post('detalhamento')));
            $dados['montagem']     = strip_tags(trim($this->input->post('montagem')));

            if(isset($dados['nome']) && isset($dados['clienteID'])) {

                $attributes = array(
                    'codigo'         => $dados['codigo'],
                    'nome'           => $dados['nome'],
                    'descricao'      => $dados['descricao'],
                    'cidadeID'       => $dados['cidade'],
                    'endereco'       => $dados['endereco'],
                    'cep'            => $dados['cep'],
                    'clienteID'      => $dados['clienteID'],
                    'construtoraID'  => $dados['construtora'],
                    'gerenciadoraID' => $dados['gerenciadora'],
                    'calculistaID'   => $dados['calculista'],
                    'detalhamentoID' => $dados['detalhamento'],
                    'montagemID'     => $dados['montagem'],
                    'data'           => date('Y-m-d H:i:s')
                );


                $obraID = $this->obras->insert($attributes);

                $log = 'Cadastro obra - ObraID: ' . $obraID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($obraID){
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
            $dados['codigo']       = strip_tags(trim($this->input->post('codigo')));
            $dados['nome']         = ucwords(strip_tags(trim($this->input->post('nome'))));
            $dados['descricao']    = strip_tags(trim($this->input->post('descricao')));
            $dados['cidade']       = strip_tags(trim($this->input->post('cidade')));
            $dados['endereco']     = strip_tags(trim($this->input->post('endereco')));
            $dados['cep']          = strip_tags(trim($this->input->post('cep')));
            $dados['clienteID']    = strip_tags(trim($this->input->post('clienteID')));
            $dados['construtora']  = strip_tags(trim($this->input->post('construtora')));
            $dados['gerenciadora'] = strip_tags(trim($this->input->post('gerenciadora')));
            $dados['calculista']   = strip_tags(trim($this->input->post('calculista')));
            $dados['detalhamento'] = strip_tags(trim($this->input->post('detalhamento')));
            $dados['montagem']     = strip_tags(trim($this->input->post('montagem')));
            $dados['obraID']       = strip_tags(trim($this->input->post('obraID')));

            if(isset($dados['nome']) && isset($dados['clienteID'])) {

                $attributes = array(
                    'codigo'         => $dados['codigo'],
                    'nome'           => $dados['nome'],
                    'descricao'      => $dados['descricao'],
                    'cidadeID'       => $dados['cidade'],
                    'endereco'       => $dados['endereco'],
                    'cep'            => $dados['cep'],
                    'clienteID'      => $dados['clienteID'],
                    'construtoraID'  => $dados['construtora'],
                    'gerenciadoraID' => $dados['gerenciadora'],
                    'calculistaID'   => $dados['calculista'],
                    'detalhamentoID' => $dados['detalhamento'],
                    'montagemID'     => $dados['montagem'],
                );

                $obraID = $this->obras->update($dados['obraID'],$attributes);

                $log = 'Edição obra - ObraID: ' . $obraID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($obraID){
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