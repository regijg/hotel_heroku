<?php

class UserModel extends CI_Model{

    private $table = 'tbl_user';

    function __construct() {
        parent::__construct ();
    }

    // public function login_user($username,$pass){
    //
    //   $this->db->select('*');
    //   $this->db->from('tbl_user');
    //   $this->db->where('username',$username);
    //   $this->db->where('password',$pass);
    //   $query=$this->db->get();
    //   if($query->num_rows()==1){
    //       return $query->result();
    //   }else{
    //     return false;
    //   }
    // }

    function login_user($username,$password){
        $query=$this->db->query('select * from tbl_user where username = "'.$username.'" and password=md5("'.$password.'")');
        return $query;
    }

    function userlevelList(){
      return $this->db->query('select * from userlevel');
    }

    function showDataUser($param = array()){
    	if (isset($param)) {
    		$param = ( object ) $param;
    	}
    	// Set Id
    	if (isset($param->id)) {
    		$setId = $param->id;
    		$this->db->where ( 'username', $setId );
    	}
    	// Set Order
    	if (isset($param->order)) {
    		$setOrder = $param->order;
    		$sortColumn = 'user_id';
    		if (isset($param->order_column)) {
    			$sortColumn = $param->order_column != NULL ? $param->order_column : $sortColumn;
    		}
    		$this->db->order_by ( $sortColumn, $setOrder );
    	}

    	// Search
    		if (isset($param->search)) {
    		    foreach ($param->search as $key => $col) {
    		        $this->db->or_like($key, $col);
    		    }
    		}
        // Join
  	  // $this->db->join ( 'tr_resvdet tresvdet', 'tresv.resv_id = tresvdet.resvdet_resv_id');

      $this->db->select ( '
    			user_id,
    			first_name,
    			last_name,
    			alamat,
    			telpon,
    			username,
    			email,
          group_id,
               	');

    	$this->db->protect_identifiers=false;

    	// Set Limit Offset
    	if (isset($param->limit)) {
    		$limitData = explode ( ',', $param->limit );
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tbl_user", $limitData [0] ,  $limitData [1]);

    	} else {
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tbl_user" );

    	}
    }

    // function login_user($username,$password){
    //     $query=$this->db->query('SELECT * FROM dosen WHERE nip='$username' AND pass=MD5('$password') LIMIT 1');
    //     return $query;
    // }

    public function add_user($user = NULL){
      $this->db->trans_start();
      $this->db->insert('tbl_user', $user);
      $this->db->trans_complete();
    }

    public function edit_user($id, $data){
      $this->db->where('user_id', $id);
      $this->db->update('tbl_user', $data);
    }

    function getDataUser($id) {
    	return $this->db->query("
    		select
    			  user_id,
     			  username,
            first_name,
            last_name,
            telpon,
    			  alamat,
    			  email,
    				group_id
    			from
            tbl_user
    			where user_id = '".$id."'
          ");
    }

    function delete_user($id){
      $this->db->trans_start();
      $this->db->where('user_id',$id);
      $this->db->delete('tbl_user');
      $this->db->trans_complete();
    }

    function do_upload(){
      $config['upload_path']          = './tpl/sb-admin/user-image/';
      $config['allowed_types']        = 'gif|jpg|png';
      // $config['file_name']            = $_FILES['photo_file']['name'];
      $config['max_size']             = 10000;
      $config['max_width']            = 5000;
      $config['max_height']           = 5000;

      $this->load->library('upload', $config);
      $this->upload->do_upload('photo_file');
    }

    function update_foto($nm_foto){
     $user_id = $this->input->post('user_id');
     $foto = $nm_foto;
     $data = array(

      'photo_file' => $foto,

     );
     $this->db->where('user_id',$user_id);
     $this->db->update('tbl_user',$data);
    }
}
