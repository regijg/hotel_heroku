<?php

class HouseKeepingModel extends CI_Model{

    private $table = 'tbl_room';

    function __construct() {
        parent::__construct ();
    }

    function roomList(){
      return $this->db->query('select * from tbl_room where room_status = 3');
    }

    function getRoomNumber($id){
      return $this->db->query("
 			select
      fasilitas1,
      fasilitas2,
      fasilitas3,
      fasilitas4,
      fasilitas5,
      fasilitas6,
      fasilitas7,
      kamar_mandi,
      dinding,
      atap_plafon,
      pintu,
      lain_lain,
      kondisi_kerusakan
 			from tbl_room
 			where
 			room_number = '".$id."' ");
    }

    function simpan_roomcheck($a = NULL){
      	$this->db->trans_start();
      	$this->db->insert('tr_roomcheck',$a);
      	$this->db->trans_complete();
    }

     function edit_order($head, $detail){
			$this->db->trans_begin();
			$this->db->where('resv_id',$head['resv_id']);
			$this->db->update('tr_resv', $head);

      $juml = count($detail);
      for ($i=0;$i<$juml;$i++){
				if ($detail[$i]['flag_status'] == 'add'){
					unset($detail[$i]['flag_status']);
					$this->db->insert('tr_resvdet',$detail[$i]);
				} else if ($detail[$i]['flag_status'] == 'edit'){
					//echo '<pre>';
					unset($detail[$i]['flag_status']);
					$this->db->where('row_id',$detail[$i]['row_id']);
					$this->db->update('tr_resvdet',$detail[$i] );
				}

			}

			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
			}else{
				$this->db->trans_commit();
			}
		}

    function editBookingResvdet($id,$data){
    	$this->db->where('row_id',$id);
    	$this->db->update('tr_resv_det',$data);
    }

    function showDataRoomCheck($param = array()){
    	if (isset($param)) {
    		$param = ( object ) $param;
    	}
    	// Set Id
    	if (isset($param->id)) {
    		$setId = $param->id;
    		$this->db->where ( 'room_number', $setId );
    	}
    	// Set Order
    	if (isset($param->order)) {
    		$setOrder = $param->order;
    		$sortColumn = 'check_id';
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
    			tr.check_id,
    			tr.check_date,
    			tr.room_number,
    			tr.keterangan,
    			tr.user_name
               	');

    	$this->db->protect_identifiers=false;

    	// Set Limit Offset
    	if (isset($param->limit)) {
    		$limitData = explode ( ',', $param->limit );
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tr_roomcheck tr", $limitData [0] ,  $limitData [1]);

    	} else {
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tr_roomcheck tr" );

    	}
    }



    function get_booking_room($floor=NULL){
        $result = $this->db->where('floor', $floor)->get('tbl_room')->result();
        $id = array('0');
        $name = array('Select a Room');
        for ($i=0; $i<count($result); $i++){
            if ($result[$i]->room_status == 1) {
               array_push($id, $result[$i]->room_number);
               array_push($name, $result[$i]->room_number.' - '.'Check In');
             }
         }
       return array_combine($id, $name);
    }

    function showDataRoom(){
      return $this->db->query('select * from tbl_room where room_status = 1');
    }

    function edit_room($id,$data){
      	$this->db->where('room_number',$id);
      	$this->db->update('tbl_room',$data);
    }

}
