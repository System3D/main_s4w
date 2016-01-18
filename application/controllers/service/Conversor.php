<?php
ini_set('max_execution_time', 600);//10minutos
//Server win empresa do garcia, nao mostra erros e infos
ini_set('display_errors', 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Conversor extends CI_Controller {

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

    public function converteIfc($importacaoID)
    {
        $this->load->model('importacao/Importacao_model', 'import');
        $dados = $this->import->get_by_id($importacaoID);

        $path = 'C:/wamp/www/s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" . $dados->etapaID . "/" . $dados->subetapaID . "/" . $dados->importacaoNr . "/";

        $Ifc_File = $path . $dados->arquivo;

        $IFC_convert_exe = 'C:/wamp/www/s4w/exe/ifcconvert.exe';

        $arquivo = explode('.', $dados->arquivo);
        $ifcfile = $arquivo[0] . "_ifc.obj";
        $Ifc_Destino = $path . $ifcfile;

        exec("$IFC_convert_exe --use-object-type --convert-back-units $Ifc_File $Ifc_Destino");

        if(file_exists($Ifc_Destino)) {
            $attibutes = array(
                'arquivo'      => $ifcfile,
                'locatarioID'  => $dados->locatarioID,
                'clienteID'    => $dados->clienteID,
                'obraID'       => $dados->obraID,
                'etapaID'      => $dados->etapaID,
                'subetapaID'   => $dados->subetapaID,
                'importacaoNr' => $dados->importacaoNr,
                'observacoes'  => 'Convertido pelo sistema'
                );

            $importacaoID = $this->import->insert($attibutes);
            echo "Arquivo convertido com sucesso!<br />Pode fechar a página e atualizar a listagem de importações.";
        }
    }

    public function converteFbx($importacaoID)
    {
        $this->load->model('importacao/Importacao_model', 'import');

        $dados = $this->import->get_by_id($importacaoID);

        $path = 'C:/wamp/www/s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" . $dados->etapaID . "/" . $dados->subetapaID . "/" . $dados->importacaoNr . "/";

        $Fbx_File = $path . $dados->arquivo;

        $FBX_convert_exe = 'C:/wamp/www/s4w/exe/FbxConverter.exe';

        $arquivo = explode('.', $dados->arquivo);
        $fbxfile = $arquivo[0] . "_fbx.obj";
        $Fbx_Destino = $path . $fbxfile;

        exec("$FBX_convert_exe $Fbx_File $Fbx_Destino");

        if(file_exists($Fbx_Destino)){
            $attibutes = array(
                    'arquivo'      => $fbxfile,
                    'locatarioID'  => $dados->locatarioID,
                    'clienteID'    => $dados->clienteID,
                    'obraID'       => $dados->obraID,
                    'etapaID'      => $dados->etapaID,
                    'subetapaID'   => $dados->subetapaID,
                    'importacaoNr' => $dados->importacaoNr,
                    'observacoes'  => 'Convertido pelo sistema'
                    );

            $importacaoID = $this->import->insert($attibutes);
            echo "Arquivo convertido com sucesso!<br />Pode fechar a página e atualizar a listagem de importações.";
        }
    }
}