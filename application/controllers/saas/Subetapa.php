<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subetapa extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'saas/login', 'refresh');
        }
        $this->load->model('etapas/Etapas_model', 'etapas');
        $this->load->model('subetapa/Subetapas_model', 'subetapas');

        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

    public function listar($obraID, $etapaID)
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $pagina = 'subetapas-cadastro';
        $data['etapaID'] = $etapaID;
        $data['obraID']  = $obraID;
        $data['etapa'] = $this->etapas->get_by_id($etapaID);
        $data['subetapas'] = $this->subetapas->get_all($etapaID);
        $this->render($data, $pagina);
    }

    public function cadastrar($obraID=null)
    {
        if ($obraID===null) {
            echo "<script>javascript:history.back(-2)</script>";
            die();
        }
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['obraID'] = $obraID;
        $pagina = 'etapas-cadastro';

        $this->render($data, $pagina);
    }

    public function excluir($obraID, $etapaID, $subetapaID)
    {
        $log = 'Exclusão subetapa - subetapaID: ' . $subetapaID . ' - IP: ' . $this->input->ip_address();
        $this->logs->gravar($log);

        $this->subetapas->delete($subetapaID);
        redirect('saas/subetapa/listar/' . $obraID . '/' . $etapaID);
    }

    public function editar($obraID, $etapaID)
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['obraID'] = $obraID;
        $pagina = 'etapas-cadastro';
        $data['edicao'] = true;
        $data['etapa']  = $this->etapas->get_by_id($etapaID);

        $this->render($data, $pagina);
    }

    public function gravar()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['codigoSubetapa'] = strip_tags(trim($this->input->post('codigoSubetapa')));
            $dados['peso']           = strip_tags(trim($this->input->post('peso')));
            $dados['tipo']           = strip_tags(trim($this->input->post('tipo')));
            $dados['observacao']     = strip_tags(trim($this->input->post('observacao')));
            $dados['etapaID']        = strip_tags(trim($this->input->post('etapaID')));


            if(isset($dados['etapaID'])) {

                $attributes = array(
                    'codigoSubetapa' => $dados['codigoSubetapa'],
                    'peso'           => $dados['peso'],
                    'tipo'           => $dados['tipo'],
                    'observacao'     => $dados['observacao'],
                    'etapaID'        => $dados['etapaID']

                );

                $etapaID = $this->subetapas->insert($attributes);

                $log = 'Cadastro etapa - etapaID: ' . $etapaID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($etapaID){
                    redirect(base_url() . 'saas/subetapa/listar/' . $this->input->post('obraID') . '/' . $dados['etapaID']);
                }
            }
            echo "<script>javascript:history.back()</script>";
        }
    }

    public function gravarEdicao()
    {
        header('Access-Control-Allow-Origin: *');
        if($_POST){
            $dados['codigoSubetapa'] = strip_tags(trim($this->input->post('codigoSubetapa')));
            $dados['peso']           = strip_tags(trim($this->input->post('peso')));
            $dados['tipo']           = strip_tags(trim($this->input->post('tipo')));
            $dados['observacao']     = strip_tags(trim($this->input->post('observacao')));
            $dados['etapaID']        = strip_tags(trim($this->input->post('etapaID')));
            $dados['subetapaID']     = $this->input->post('subetapaID');

            if(isset($dados['obraID']) && isset($dados['etapaID'])) {

                $attributes = array(
                    'codigoSubetapa' => $dados['codigoSubetapa'],
                    'peso'           => $dados['peso'],
                    'tipo'           => $dados['tipo'],
                    'observacao'     => $dados['observacao'],
                    'etapaID'        => $dados['etapaID']

                );

                $etapaID = $this->etapas->update($dados['subetapaID'], $attributes);

                $log = 'Edição etapa - etapaID: ' . $etapaID . ' - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                if($etapaID){
                     echo "<script>javascript:history.back()</script>";
                }
            }
             echo "<script>javascript:history.back()</script>";
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