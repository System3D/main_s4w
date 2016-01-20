<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importacoes extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('tipoUsuarioID') != 1 && $this->session->userdata('tipoUsuarioID') != 2) {
            redirect(base_url() . 'saas/login', 'refresh');
        }

        $this->load->model('importacao/Importacao_model', 'import');

        // $sections = array(
        //              'config'  => TRUE,
        //              'queries' => TRUE
        //              );
        // $this->output->set_profiler_sections($sections);
        // $this->output->enable_profiler(TRUE);
    }

    public function listar($subEtapaID)
    {
        $data['titulo'] = 'Steel4Web - Administrador';
        $data['dados'] = $this->import->get_dados($subEtapaID);

        $data['importacoes'] = $this->import->get_by_field('subetapaID', $subEtapaID);

        $pagina = 'importacoes-cadastro';
        $this->render($data, $pagina);
    }

    public function todeletedbf($id){
        $dbf = $this->import->get_by_id($id);
        $dbfName = $dbf->importacaoNr;
        $this->session->set_flashdata('todelete', $dbfName."&xx&".$id);
        redirect("saas/importacoes/listar/".$dbf->subetapaID, 'refresh');
    }

    public function excluirdbf($id){
        $this->load->model('template/Template_model', 'fil');
        $this->load->model('template/Template_model', 'fil2');
        $this->fil->setTable('tbhandle','fkImportacao');
        $this->fil2->setTable('importacoes','importacaoNr');
        $dbf = $this->import->get_by_id($id);
        $path = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dbf->locatarioID . '/' . $dbf->clienteID . '/' . $dbf->obraID . '/' . $dbf->etapaID . '/' . $dbf->subetapaID . 
        '/' . $dbf->importacaoNr;
        $del = $this->fil2->delete($dbf->importacaoNr);
        $del2 = $this->fil->delete($id);
        $this->rrmdir($path);
        $log = 'Exclusão de Importacao - Usuario: ' . $this->session->userdata['nomeUsuario'] . ' - IP: ' . $this->input->ip_address().' - Importacao: '.$dbf->clienteID . '/' . $dbf->obraID . '/' . $dbf->etapaID . '/' . $dbf->subetapaID . 
        '/' . $dbf->importacaoNr.'/';
        $this->logs->gravar($log);
        $this->session->set_flashdata('success', "Importação <strong>". $dbf->importacaoNr."</strong> removida com sucesso!");
        redirect("saas/importacoes/listar/".$dbf->subetapaID, 'refresh');
    }

    public function gravar()
    {
    
        $subEtapaID = $this->input->post('subetapaID');
         if($this->session->userdata('converting') != false){
            $data['erro'] = 'Aguarde o final da Importação atual para realizar uma nova Importação.';
            $this->session->set_flashdata('danger', $data['erro']);
            redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
        }
        // Pega todos os dados necessários
        $dados = $this->import->get_dados($subEtapaID);
        $importacao1 = $this->import->nro_importacao($subEtapaID);
        $extDone = array();
        $files = $_FILES['files'];
        $_UP['extensoes'] = array('dbf', 'ifc', 'fbx');

        foreach($_FILES['files']['name'] as $names){
           
            if(!empty($names)){
                list($nam, $ext) = explode('.',$names);
                $ext = strtolower($ext);
                if(!in_array($ext, $_UP['extensoes'])){

                     $data['erro'] = 'Falha na Importação, Envie somente arquivos dbf, ifc ou fbx.';
                    $this->session->set_flashdata('danger', $data['erro']);
                    redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
                }elseif(in_array($ext, $extDone)){

                    $data['erro'] = 'Falha na Importação, Envie somente um arquivo de cada tipo.';
                    $this->session->set_flashdata('danger', $data['erro']);
                    redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
                }else{
                    $extDone[] = $ext;
                }
            }
        }     
     //   dbug($importacao1->importacaoNr);
        if(!isset($importacao1->importacaoNr)){
            if(count($extDone) < 2){
                    $data['erro'] = 'Arquivos dbf e ifc obrigatorios na primeira Importação.';
                    $this->session->set_flashdata('danger', $data['erro']);
                    redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
            }elseif(!in_array('dbf', $extDone)){
                $data['erro'] = 'Arquivos dbf e ifc obrigatorios na primeira Importação.';
                $this->session->set_flashdata('danger', $data['erro']);
                redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
            }elseif(!in_array('ifc', $extDone)){
                $data['erro'] = 'Arquivos dbf e ifc obrigatorios na primeira Importação.';
                $this->session->set_flashdata('danger', $data['erro']);
               redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
            }
        }  
         

        // Verifica se já foi feita alguma importação nesta subetapa
        $importacao = $this->import->nro_importacao($subEtapaID);
        $nroImportacao = (isset($importacao->importacaoNr)) ? ($importacao->importacaoNr+1) : 1;
        $path = "C:/xampp/htdocs/new_s4w/arquivos/";

        try {
            $path = $path . $dados->locatarioID . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $path = $path . $dados->clienteID . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $path = $path . $dados->obraID . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $path = $path . $dados->etapaID . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $path = $path . $dados->subetapaID . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $path = $path . $nroImportacao . "/";
            if(!file_exists($path)):
                mkdir($path, 0777);
            endif;

            $html = "<html><head><title>403 Forbidden</title></head><body><p>Directory access is forbidden.</p></body></html>";

            $arquivoIndex = $path . "index.html";

            if(!file_exists($arquivoIndex)):
                file_put_contents($arquivoIndex, $html);
            endif;

            // Pasta onde o arquivo vai ser salvo
            $_UP['pasta'] = $path;
            // Tamanho máximo do arquivo (em Bytes)
            $_UP['tamanho'] = 1024 * 1024 * 10; // 10Mb
            // Array com as extensões permitidas
           
            // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
            $_UP['renomeia'] = false;
            // Array com os tipos de erros de upload do PHP
            $_UP['erros'][0] = 'Não houve erro';
            $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
            $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
            $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
            $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

            $contador = 0;

           $tamanhoArray = count($_FILES['files']['name']);

           for ($i=0; $i < $tamanhoArray; $i++) {
                if($_FILES['files']['name'][$i] == '') {
                    unset($_FILES['files']['name'][$i]);
                    unset($_FILES['files']['type'][$i]);
                    unset($_FILES['files']['tmp_name'][$i]);
                    unset($_FILES['files']['error'][$i]);
                    unset($_FILES['files']['size'][$i]);
                }
           }

            while($contador < $tamanhoArray){

                if(isset($_FILES['files']['name'][$contador]) && $_FILES['files']['name'][$contador] != '') {
                    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
                    if ($_FILES['files']['error'][$contador] != 0) {
                       $data['erro'] = "Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['files']['error'][$contador]];
                       $this->session->set_flashdata('danger', $data['erro']);
                    }
                    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
                    // Faz a verificação da extensão do arquivo
                    // $extensao = strtolower(end(explode('.', $_FILES['files']['name'][$contador])));

                    $extensao = explode('.', $_FILES['files']['name'][$contador]);
                    $extensao = strtolower(end($extensao));

                    if (array_search($extensao, $_UP['extensoes']) === false) {
                      echo "Por favor, envie arquivos com as seguintes extensões: dat, dbf, ifc ou fbx";
                      // exit;
                    }
                    // Faz a verificação do tamanho do arquivo
                    if ($_UP['tamanho'] < $_FILES['files']['size'][$contador]) {
                      echo "O arquivo enviado é muito grande, envie arquivos de até 10Mb.";
                      exit;
                    }
                    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
                    // Primeiro verifica se deve trocar o nome do arquivo
                    if ($_UP['renomeia'] == true) {
                      // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                      $nome_final = md5(time()).'.jpg';
                    } else {
                      // Mantém o nome original do arquivo
                      $nome_final = $_FILES['files']['name'][$contador];
                    }

                    // Depois verifica se é possível mover o arquivo para a pasta escolhida
                    if (!move_uploaded_file($_FILES['files']['tmp_name'][$contador], $_UP['pasta'] . $nome_final)) {
                        $data['erro'] = 'Erro ao persistir na pasta';
                        $this->session->set_flashdata('danger', $data['erro']);
                    } else {
                        // Aqui será gravado as informações no banco
                        $attibutes = array(
                            'arquivo'      => $nome_final,
                            'locatarioID'  => $dados->locatarioID,
                            'clienteID'    => $dados->clienteID,
                            'obraID'       => $dados->obraID,
                            'etapaID'      => $dados->etapaID,
                            'subetapaID'   => $dados->subetapaID,
                            'importacaoNr' => $nroImportacao,
                            'observacoes'  => $this->input->post('observacoes'),
                            'sentido'      => $this->input->post('sentido')
                            );

                        $importacaoID = $this->import->insert($attibutes);

                        if (!$importacaoID) {
                            $arquivoParaDeletar = $_UP['pasta'] . $nome_final;
                            unset($arquivoParaDeletar);
                        } else {
                            if($extensao == 'dbf'){
                                # Grava DBF no banco de dados
                                if($nroImportacao == 1){
                                if(!$this->savedbf($importacaoID)){
                                        $arquivoParaDeletar = $_UP['pasta'] . $nome_final;
                                        $this->rrmdir($_UP['pasta']);
                                        $this->import->delete($importacaoID);
                                        $data['erro'] = 'Erro ao cadastara banco dbf<strong>  ' . $nome_final."</strong><br>  Certifique-se de que ele segue o padrão previsto.";
                                        $this->session->set_flashdata('danger', $data['erro']);
                                        redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
                                    }
                                }else{
                                    $lastID = $this->savedbftemp($importacaoID);
                                    if(!$lastID){
                                        $arquivoParaDeletar = $_UP['pasta'] . $nome_final;
                                        $this->rrmdir($_UP['pasta']);
                                        $this->import->delete($importacaoID);
                                        $data['erro'] = 'Erro ao cadastara banco dbf<strong>  ' . $nome_final."</strong><br>  Certifique-se de que ele segue o padrão previsto.";
                                        $this->session->set_flashdata('danger', $data['erro']);
                                        redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
                                    }
                                    $tempCheck = $this->checkTemp($importacaoID);
                                    $this->load->model('template/Template_model', 'temph');
                                    $this->temph->setTable('temp_tbhandle','fkImportacao');
                                    if($tempCheck == 'ok'){
                                        $this->insertTemp($importacaoID);
                                        $this->temph->delete($importacaoID);
                                    }else{
                                        $arquivoParaDeletar = $_UP['pasta'] . $nome_final;
                                        $this->rrmdir($_UP['pasta']);
                                        $this->import->delete($importacaoID);
                                        $this->temph->delete($importacaoID);
                                        $this->session->set_flashdata('copy', $tempCheck);
                                        redirect("saas/importacoes/listar/".$subEtapaID, 'refresh'); 
                                    }
                                }
                            } elseif ($extensao == 'fbx') {
                               $this->converteFbx($importacaoID);
                            } elseif ($extensao == 'ifc') {
                                $this->session->set_flashdata('toConvert', $importacaoID);
                                $this->session->set_userdata('converting','converting');
                               
                            }
                        }
                    }
                }
                $contador++;
            }
            $log = 'Importação de arquivos - SubEtapa: ' . $subEtapaID . ' - IP: ' . $this->input->ip_address();
            $this->logs->gravar($log);
            if(!empty($this->session->flashdata('toConvert'))){
                $data['success'] = 'Importação realizada com sucesso! Aguarde o encerramento da conversão do arquivo .ifc';
            }else{
               $data['success'] = 'Importação realizada com sucesso!'; 
            }
            $this->session->set_flashdata('success', $data['success']);
            redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');

        } catch (Exception $e) {
            $data['erro'] = 'Erro ao importar: ' . $e->getMessage();
            $this->session->set_flashdata('danger', $data['erro']);
            redirect("saas/importacoes/listar/".$subEtapaID, 'refresh');
        }

    }


private function checkTemp($importacaoID){
    $this->load->model('template/Template_model', 'temph');
    $this->temph->setTable('temp_tbhandle','id');
    $this->load->model('template/Template_model', 'fil');
    $this->fil->setTable('tbhandle','id');
    $dados = $this->temph->get_by_field('fkimportacao',$importacaoID);
    $here = $this->fil->get_by_field('fkestagio',$dados[0]->fkestagio);
    $xyz = array();
    $x=0;
    foreach($dados as $dado){
        if($dado->FLG_REC == 3 && $dado->NUM_COM != 'MATHEUS' && $dado->NUM_DIS != 'TESTANDO'){
            foreach($here as $hr){
                if($hr->FLG_REC == 3){
                    if($dado->X == $hr->X && $dado->Y == $hr->Y && $dado->Z == $hr->Z){
                        $tempxyz = $dado->MAR_PEZ.'&'.str_replace(' ', '', $dado->X).'&'.str_replace(' ', '', $dado->Y).'&'.str_replace(' ', '', $dado->Z);
                        if(!in_array($tempxyz, $xyz)){
                            $xyz[] = $tempxyz;
                        }
                    }
                }
            }
        }
    }
   $xyz = !empty($xyz[0]) ? $xyz : 'ok';
   return $xyz;
}

private function insertTemp($importacaoID){
    $this->load->model('template/Template_model', 'temph');
    $this->temph->setTable('temp_tbhandle','id');
    $this->load->model('template/Template_model', 'fil');
    $this->fil->setTable('tbhandle','id');
    $dados = $this->temph->get_by_field('fkimportacao',$importacaoID);
    foreach($dados as $dado){
        unset($dado->id);
        $importID = $this->fil->insert($dado);
    }
    if(!empty($importID)){
        return $importID;
    }else{
        return false;
    }
}



private function savedbf($importacaoID) {
        $this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('tbhandle','id');
        $check = true;
        $table = $this->db->escape_str('tbhandle');
        $sql = "DESCRIBE `$table`";
        $descrition = $this->db->query($sql)->result();
        $this->db->escape('tbhandle');
        $desc = array();
        foreach($descrition as $dd){
            $desc[] = $dd->Field;
        }
        $dados = $this->import->get_by_id($importacaoID);
        $arquivo = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" 
        . $dados->etapaID . "/" . $dados->subetapaID . "/" . $dados->importacaoNr . "/" . $dados->arquivo;
        $fdbf = fopen($arquivo,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8));
        $goon = true; 
    $unpackString=''; 
    while ($goon && !feof($fdbf)) { // read fields: 
        $buf = fread($fdbf,32); 
        if (substr($buf,0,1)==chr(13)) {$goon=false;} // end of field list 
        else { 
            $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18));
                $unpackString.="A$field[fieldlen]$field[fieldname]/"; 
                array_push($fields, $field);}} 
        fseek($fdbf, $header['FirstRecord']+1); // move back to the start of the first record (after the field definitions)
        for ($i=1; $i<=$header['RecordCount']; $i++) { 
            $buf = fread($fdbf,$header['RecordLength']); 
            $record=unpack($unpackString,$buf);

            $record['obra']         = $dados->obraID;
            $record['id']           = 0;
            $record['fklote']       = 0;
            $record['fkestagio']    = 1;
            $record['fketapa']      = $dados->etapaID;
            $record['fkImportacao'] = $importacaoID;
            $record['fkpreparacao'] = 0;
            $record['fkmedicao']    = 0;

        if($record['NUM_COM'] != 'MATHEUS' && $record['NUM_DIS'] != 'TESTANDO'){

        if(!isset($chekc)){
          $RKeys = array_keys($record);
              foreach($RKeys as $key){
                if(in_array($key, $desc)){
                    $check = $check;
                }else{
                    $check = false;
                }
              }
              foreach($desc as $ddd){
                if(in_array($ddd, $RKeys)){
                    $check = $check;
                }else{
                    $check = false;
                }
              }
              if($check === false){
                fclose($fdbf);
                return false;
              }else{
                $chekc = 1;
              }
              
         }
         
           $importID = $this->fil->insert($record);
       }
        }
        if(!empty($importID)){
            fclose($fdbf);
            return $importID;
        }else{
            fclose($fdbf);
            return false;
        }
         
    }



    private function savedbftemp($importacaoID) {
        $this->load->model('template/Template_model', 'fil');
        $this->fil->setTable('temp_tbhandle','id');
        $check = true;
        $table = $this->db->escape_str('tbhandle');
        $sql = "DESCRIBE `$table`";
        $descrition = $this->db->query($sql)->result();
        $this->db->escape('tbhandle');
        $desc = array();
        foreach($descrition as $dd){
            $desc[] = $dd->Field;
        }
        $dados = $this->import->get_by_id($importacaoID);
        $arquivo = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" 
        . $dados->etapaID . "/" . $dados->subetapaID . "/" . $dados->importacaoNr . "/" . $dados->arquivo;
        $fdbf = fopen($arquivo,'r'); 
        $fields = array(); 
        $buf = fread($fdbf,32); 
        $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8));
        $goon = true; 
    $unpackString=''; 
    while ($goon && !feof($fdbf)) { // read fields: 
        $buf = fread($fdbf,32); 
        if (substr($buf,0,1)==chr(13)) {$goon=false;} // end of field list 
        else { 
            $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18));
                $unpackString.="A$field[fieldlen]$field[fieldname]/"; 
                array_push($fields, $field);}} 
        fseek($fdbf, $header['FirstRecord']+1); // move back to the start of the first record (after the field definitions)
        for ($i=1; $i<=$header['RecordCount']; $i++) { 
            $buf = fread($fdbf,$header['RecordLength']); 
            $record=unpack($unpackString,$buf);

            $record['obra']         = $dados->obraID;
            $record['id']           = 0;
            $record['fklote']       = 0;
            $record['fkestagio']    = $dados->subetapaID;
            $record['fketapa']      = $dados->etapaID;
            $record['fkImportacao'] = $importacaoID;
            $record['fkpreparacao'] = 0;
            $record['fkmedicao']    = 0;
        if($record['NUM_COM'] != 'MATHEUS' && $record['NUM_DIS'] != 'TESTANDO'){
        if(!isset($chekc)){
          $RKeys = array_keys($record);
              foreach($RKeys as $key){
                if(in_array($key, $desc)){
                    $check = $check;
                }else{
                    $check = false;
                }
              }
              foreach($desc as $ddd){
                if(in_array($ddd, $RKeys)){
                    $check = $check;
                }else{
                    $check = false;
                }
              }
              if($check === false){
                fclose($fdbf);
                return false;
              }else{
                $chekc = 1;
              }
              
         }
     
         
           $importID = $this->fil->insert($record);

        }
        }
        if(!empty($importID)){
            fclose($fdbf);
            return  $importID;
        }else{
            fclose($fdbf);
            return false;
        }
         
    }


    private function keys_are_equal($array1, $array2) {
        return !array_diff_key($array1, $array2) && !array_diff_key($array2, $array1);
    }

    public function getIfc(){

        $impId      = strip_tags(trim($this->input->post('id')));
        $this->converteIfc($impId);
            
    }

    private function converteIfc($importacaoID)
    {
        // try {
        //     // ob_start();
        //     $out = file_get_contents(base_url() . 'service/conversor/converteIfc/' . $importacaoID);
        //     // $out = ob_get_contents();
        //     // ob_end_clean();
        //     echo $out;
        //     die();
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }
        $this->load->model('importacao/Importacao_model', 'import');
        $dados = $this->import->get_by_id($importacaoID);

        $path = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" . $dados->etapaID . "/" 
        . $dados->subetapaID . "/" . $dados->importacaoNr . "/";

        $Ifc_File = $path . $dados->arquivo;

        $IFC_convert_exe = 'C:/xampp/htdocs/new_s4w/exe/ifcconvert.exe';

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
            $this->session->set_userdata('converting','success');
            die('success');
        }
        $this->session->set_userdata('converting','error');
        die('error');
    }

    private function converteFbx($importacaoID)
    {
        // try {
        //     // ob_start();
        //     $caminho = base_url() . 'service/conversor/converteFbx/' . $importacaoID;

        //     $out = file_get_contents($caminho);
        //     // $out = ob_get_contents();
        //     // ob_end_clean();
        //     echo $out;
        //     die();
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }
        $this->load->model('importacao/Importacao_model', 'import');

        $dados = $this->import->get_by_id($importacaoID);

        $path = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" . $dados->etapaID . "/" 
        . $dados->subetapaID . "/" . $dados->importacaoNr . "/";

        $Fbx_File = $path . $dados->arquivo;

        $FBX_convert_exe = 'C:/xampp/htdocs/new_s4w/exe/FbxConverter.exe';

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
            return true;
        }
        return false;
    }

    public function changeConvert(){
        $this->session->set_userdata('converting', false);
    }

     private function rrmdir($dir) { 
   if (is_dir($dir)) {
     $objects = scandir($dir); 
     
     foreach ($objects as $object) { 
       if ($object != "." && $object != "..") { 
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
       } 
     } 
     reset($objects); 
     rmdir($dir); 
   } 
} 

    private function render($data, $pagina)
    {
        $this->load->view('sistema/includes/header', $data, FALSE);
        $this->load->view('sistema/includes/menus-saas-adm', $data, FALSE);
        $this->load->view('sistema/paginas-saas/' . $pagina, $data, FALSE);
        $this->load->view('sistema/includes/footer', $data, FALSE);
    }

        private function gravaDbf($importacaoID)
    {
        $this->load->model('tbhandle/Handle_model', 'handle');
        $dados = $this->import->get_by_id($importacaoID);
        $arquivo = 'C:/xampp/htdocs/new_s4w/arquivos/' . $dados->locatarioID . "/" . $dados->clienteID . "/" . $dados->obraID . "/" . $dados->etapaID . "/" 
        . $dados->subetapaID . "/" . $dados->importacaoNr . "/" . $dados->arquivo;

        $dbcon = dbase_open($arquivo, 0) or die ("Não foi possível abrir o arquivo dbf");
        $n=0;
        $dbrows = dbase_numrecords($dbcon);
        for ($c = 1; $c <= $dbrows; $c++) {
           $dbreg = dbase_get_record($dbcon,$c); // pega o contéudo da linha (registro)

           $attibutes[$c] = array(
                    'PROJETO'      => 1,
                    'HANDLE'       => 'NÃO SEI',
                    'FLG_REC'      => $dbreg[0],
                    'NUM_COM'      => $dbreg[1],
                    'DES_COM'      => $dbreg[2],
                    'LOT_COM'      => $dbreg[3],
                    'DLO_COM'      => $dbreg[4],
                    'CLI_COM'      => $dbreg[5],
                    'IND_COM'      => $dbreg[6],
                    'DT1_COM'      => $dbreg[7],
                    'DT2_COM'      => $dbreg[8],
                    'NUM_DIS'      => $dbreg[9],
                    'DES_DIS'      => $dbreg[10],
                    'NOM_DIS'      => $dbreg[11],
                    'REV_DIS'      => $dbreg[12],
                    'DAT_DIS'      => $dbreg[13],
                    'TRA_PEZ'      => $dbreg[14],
                    'SBA_PEZ'      => $dbreg[15],
                    'DES_SBA'      => $dbreg[16],
                    'TIP_PEZ'      => $dbreg[17],
                    'MAR_PEZ'      => $dbreg[18],
                    'MBU_PEZ'      => $dbreg[19],
                    'DES_PEZ'      => $dbreg[20],
                    'POS_PEZ'      => $dbreg[21],
                    'NOT_PEZ'      => $dbreg[22],
                    'ING_PEZ'      => $dbreg[23],
                    'MAX_LEN'      => $dbreg[24],
                    'QTA_PEZ'      => $dbreg[25],
                    'QT1_PEZ'      => $dbreg[26],
                    'MCL_PEZ'      => $dbreg[27],
                    'COD_PEZ'      => $dbreg[28],
                    'COS_PEZ'      => $dbreg[29],
                    'NOM_PRO'      => $dbreg[30],
                    'LUN_PRO'      => $dbreg[31],
                    'LAR_PRO'      => $dbreg[32],
                    'SPE_PRO'      => $dbreg[33],
                    'MAT_PRO'      => $dbreg[34],
                    'TIP_BUL'      => $dbreg[35],
                    'DIA_BUL'      => $dbreg[36],
                    'LUN_BUL'      => $dbreg[37],
                    'PRB_BUL'      => $dbreg[38],
                    'PUN_LIS'      => $dbreg[39],
                    'SUN_LIS'      => $dbreg[40],
                    'PRE_LIS'      => $dbreg[41],
                    'FLG_DWG'      => $dbreg[42],
                    'obra'         => $dados->obraID,
                    'id'           => 0,
                    'fklote'       => 0,
                    'fkestagio'    => $dados->subetapaID,
                    'grp'          => $dbreg[46],
                    'nome_file1'   => $dados->arquivo,
                    'nome_file2'   => '',
                    'nome_file3'   => '',
                    'nome_file4'   => '',
                    'fketapa'      => $dados->etapaID,
                    'CATEPERFIL'   => $dbreg[48],
                    'fkImportacao' => $importacaoID,
                    'fkpreparacao' => 0,
                    'fkmedicao'    => 0,
                    );
        }
        if ($this->handle->insert($attibutes)) {
            return true;
        }
        return false;
    }






}