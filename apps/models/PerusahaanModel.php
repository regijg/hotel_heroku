<?php

class PerusahaanModel extends CI_Model{

    private $table = 'tbl_perusahaan';

    function __construct() {
        parent::__construct ();
    }

    public function getPerusahaanList(){
        return $this->db->query('select * from tbl_perusahaan');
    }

    public function get_by_id($id){
      $this->db->from($this->table);
      $this->db->where('pesertaID', $id);
      $query = $this->db->get();

      return $query->row();
    }

    public function insertPerusahaan($param = null){
        $res = $this->db->insert($this->table, $param);
        return $res;
    }

    public function updatePerusahaan($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

}
