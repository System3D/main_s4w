<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handle_model extends CI_Model{

    private $table   = 'tbhandle';
    private $tableID = 'projeto';

    function __construct()
    {
        parent::__construct();
    }

    public function insert($attributes)
    {
        if($this->db->insert_batch($this->table, $attributes)):
            return $this->db->insert_id();
        endif;
    }
}