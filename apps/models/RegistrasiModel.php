<?php

class RegistrasiModel extends CI_Model{

    private $table = 'tbl_tamu';

    function __construct() {
        parent::__construct ();
    }

    function listDataTamuMenginap(){
      $this->db->select('*');
      $this->db->from('tr_registrasi');
      $this->db->where('status = 1');
      $query = $this->db->get();
      return $query->result();
    }

    function listDataTamuCheckin(){
      $this->db->select('*');
      $this->db->from('tr_registrasi');
      $this->db->where ( 'status = 1');
      $this->db->where('DATE(in_date) = CURDATE()');
      $query = $this->db->get();
      return $query->result();
    }

    function roomList(){
      return $this->db->query('select * from tbl_room where room_status = 1');
    }

    function showDataMasterHistoryRegistrasi($param = array()){
    	if (isset($param)) {
    		$param = ( object ) $param;
    	}
    	// Set Id
    	if (isset($param->id)) {
    		$setId = $param->id;
    		$this->db->where ( 'reg_id', $setId );
    	}
    	// Set Order
    	if (isset($param->order)) {
    		$setOrder = $param->order;
    		$sortColumn = 'reg_id';
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

      // if (isset($param->filter)) {
  		//     if ($param->filter != ''){
  		//     $this->db->where ( 'tt.nama like "%'.$param->filter.'%" ');
  		//     //$this->db->like($param->search);
  		//     }
  		// }
      if (isset($param->in_date_start)) {
  		    if ($param->in_date_start != ''){
  		    $this->db->where ( 'tt.in_date between str_to_date("'.$param->in_date_start.'", "%d %b %Y") and str_to_date("'.$param->in_date_end.'", "%d %b %Y") ');
  		    //$this->db->like($param->search);
  		    }
  		}

    	$this->db->select ( '
    			tt.reg_id,
    			tt.reg_no,
    			tt.nama,
    			tt.alamat,
          tt.telpon,
    			tt.room_number,
    			tt.floor,
    			tt.judul_diklat,
    			tt.status,
    			tt.in_date,
               	');

    	$this->db->protect_identifiers=false;

    	// Set Limit Offset
    	if (isset($param->limit)) {
    		$limitData = explode ( ',', $param->limit );
    		return $this->db->get ( "tr_registrasi tt", $limitData [0] ,  $limitData [1]);

    	} else {
    		return $this->db->get ( "tr_registrasi tt" );

    	}
    }

    function getDataRegistrasi($id) {
    	return $this->db->query("
    		select
    			  reg_id,
            reg_no,
            tipe_tamu,
            nama,
            nama2,
            no_induk,
            no_induk2,
            kode_diklat,
            judul_diklat,
            sumber_dana,
            alamat,
            alamat2,
            telpon,
            telpon2,
            nama_perusahaan,
            nama_perusahaan2,
      			person,
            room_number,
            rate_name,
            price,
            rate_id,
            floor
    			from
    			tr_registrasi
    			where reg_id = '".$id."' and status = 1");
    }

    function getRoomNumber($id){
      return $this->db->query("
 			select
 			room_number,
 			tbl_rate.rate_name,
 			tbl_rate.tarif_umum,
 			tbl_rate.tarif_dinas,
 			tbl_room.floor
 			from tbl_room
      left join tbl_rate on tbl_rate.rate_id = tbl_room.rate_id
 			where
 			room_number = '".$id."' ");
    }

    function edit_tamu($id, $data){
        $this->db->where('reg_id', $id);
        $this->db->update('tr_registrasi', $data);
     }

     function edit_room($id,$data){
       	$this->db->where('room_number',$id);
       	$this->db->update('tbl_room',$data);
     }
}
