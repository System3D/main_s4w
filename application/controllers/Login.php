<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('America/Sao_Paulo');
        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);

    }

    public function saas()
    {
        if($this->session->userdata('logado')){
            redirect(base_url() . 'saas/admin', 'refresh');
        }
        $this->load->view('sistema/login-saas');
    }

    public function admin()
    {
        $this->load->view('sistema/login-admin');
    }

    public function acessarAdmin()
    {
        if($_POST){
            /* PEGAR DADOS DO FORM */
            $email    = strtolower(strip_tags(trim($this->input->post('email'))));
            $password = strtolower(strip_tags(trim($this->input->post('password'))));

            $this->load->model('usuarios/Login_model', 'login');

            $dadosLogin = $this->login->logarAdmin($email, $password);

            if(count($dadosLogin) == 1){

                $dadosUsuario = array(
                                    'logado' => true,
                                    'nomeUsuario' => $dadosLogin->nome,
                                    'email' => $dadosLogin->email,
                                    'admin' => true,
                                    'data' => date('H:i:s d/m/Y'),
                                    );
                $this->session->set_userdata($dadosUsuario);
                redirect('sistema/dashboard');

            } else {
                redirect(base_url() . 'admin/login', 'refresh');
            }
        }
    }

    public function acessarSaas()
    {

        if($_POST){
            /* PEGAR DADOS DO FORM */
            $email    = strtolower(strip_tags(trim($this->input->post('email'))));
            $password = strtolower(strip_tags(trim($this->input->post('password'))));

            $this->load->model('usuarios/Login_model', 'login');

            $dadosLogin = $this->login->logarSaas($email, $password);

            if(count($dadosLogin) == 1){

                $dadosUsuario = array(
                                    'logado'        => true,
                                    'usuarioID'     => $dadosLogin->usuarioLocatarioID,
                                    'nomeUsuario'   => $dadosLogin->nome,
                                    'email'         => $dadosLogin->email,
                                    'tipoUsuarioID' => $dadosLogin->tipoUsuarioID,
                                    'locatarioID'   => $dadosLogin->locatarioID,
                                    'ip'            => $this->input->ip_address(),
                                    'data'          => date('H:i:s d/m/Y'),
                                    'converting'    => false
                                    );
                $this->session->set_userdata($dadosUsuario);

                $log = 'LOGIN - IP: ' . $this->input->ip_address();
                $this->logs->gravar($log);

                switch ($dadosLogin->tipoUsuarioID) {
                    case 1:
                        # Administrador
                        redirect('saas/admin');
                        break;
                    case 2:
                        # Planejamento
                        redirect('saas/planejamento');
                        break;
                    case 3:
                        # Engenharia
                        redirect('saas/engenharia');
                        break;
                    case 4:
                        # PCP
                        redirect('saas/pcp');
                        break;
                    case 5:
                        # Apontador
                        redirect('saas/apontador');
                        break;
                    case 6:
                        # Montagem
                        redirect('saas/montagem');
                        break;
                    case 7:
                        # Qualidade
                        redirect('saas/qualidade');
                        break;
                    case 8:
                        # Almoxarifado
                        redirect('saas/almoxarifado');
                        break;
                    case 9:
                        # Gestor
                        redirect('saas/gestor');
                        break;
                    default:
                        redirect(base_url() . 'saas/login', 'refresh');
                        break;
                }
            } else {
                redirect(base_url() . 'saas/login', 'refresh');
            }
        }
    }

    public function logout()
    {
        if(!empty($this->session->userdata('usuarioID'))) {
            $log = 'LOGOUT - IP: ' . $this->input->ip_address();
            $this->logs->gravar($log);
        }
        $this->session->sess_destroy();
        redirect(base_url() . 'saas/login', 'refresh');
    }
}