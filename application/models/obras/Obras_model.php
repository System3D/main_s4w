<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obras_model extends CI_Model{

    private $table   = 'obras';
    private $tableID = 'obraID';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')
                    ->from($this->table)
                    ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
                    ->where($this->tableID, $id)
                    ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));

        $query = $this->db->get();

        if($query->num_rows() > 0):
            return $query->row();
        endif;

        return false;
    }

    public function get_by_field($field, $value, $limit = null)
    {
        #Method Chaining APENAS PHP >= 5
        $this->db->select('*')->from($this->table)
                            ->where($field, $value)
                            ->where('locatarioID', $this->session->userdata('locatarioID'));

        if(!$limit == null){
            $this->db->limit($limit);
        }

        $query = $this->db->get();

        if($limit == 1):
            return $query->row();
        else:
            return $query->result();
        endif;

        return false;
    }

    public function get_all()
    {
        $this->db->select('obras.obraID, obras.codigo AS codigoObra, obras.nome AS nomeObra, obras.data, clientes.razao, clientes.fantasia, status')
                        ->from($this->table)
                        ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
                        ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));
        $query = $this->db->get();
        return $query->result();
    }

     public function get_all_order()
    {
        $this->db->select('obras.obraID, obras.codigo AS codigoObra, obras.nome AS nomeObra, obras.data, clientes.razao, clientes.fantasia, status')
                        ->from($this->table)
                        ->join('clientes', 'clientes.clienteID = obras.clienteID', 'left')
                        ->where('clientes.locatarioID', $this->session->userdata('locatarioID'))
                        ->order_by('status', 'DESC')->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_right(){
        $this->db->select('*')
                ->from($this->table)
                ->join('clientes', 'clientes.clienteID = obras.clienteID')
                ->where('clientes.locatarioID', $this->session->userdata('locatarioID'));
        $query = $this->db->get();
        return $query->result();
    }

    public function insert($attributes)
    {
        if($this->db->insert($this->table, $attributes)):
            return $this->db->insert_id();
        endif;
    }

    public function update($id, $attributes)
    {
        $this->db->where($this->tableID, $id)->limit(1);

        if($this->db->update($this->table, $attributes)):
            return $this->db->affected_rows();
        endif;
        return false;
    }

    public function delete($id, $limit = null)
    {
        $this->db->where($this->tableID, $id);

        if(!$limit == null){
            $this->db->limit($limit);
        }

        if($this->db->delete($this->table)):
            return true;
        endif;
    }
}