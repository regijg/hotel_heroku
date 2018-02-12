<?php

class EditProfileModel extends CI_Model{

    private $table = 'tbl_room';

    function __construct() {
        parent::__construct ();
    }

    function user_list($username){
        $query=$this->db->query('select * from tbl_user where username = "'.$username.'"');
        return $query;
    }

    public function add_user($user = NULL){
      $this->db->trans_start();
      $this->db->insert('tbl_user', $user);
      $this->db->trans_complete();
    }

    public function edit_user($id, $data){
      $this->db->where('user_id', $id);
      $this->db->update('tbl_user', $data);
    }

    function userlevelList(){
      return $this->db->query('select * from userlevel');
    }

}
