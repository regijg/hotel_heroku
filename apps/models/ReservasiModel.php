<?php

class ReservasiModel extends CI_Model{

    private $table = 'tbl_room';

    function __construct() {
        parent::__construct ();
    }

    function getkodeunik($table) {
          $tahun = date('y');
          $q = $this->db->query("SELECT MAX(RIGHT(resv_no,4)) AS idmax FROM ".'tr_resv');
          $kd = ""; //kode awal
          if($q->num_rows()>0){ //jika data ada
              foreach($q->result() as $k){
                  $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                  $kd = sprintf("%05s", $tmp); //kode ambil 4 karakter terakhir
              }
          }else{ //jika data kosong diset ke kode awal
              $kd = "00001";
          }
          $kar = "RV"; //karakter depan kodenya
          //gabungkan string dengan kode yang telah dibuat tadi
          return $kar.$tahun.$kd;
     }

    function roomList(){
      return $this->db->query('select * from tbl_room where room_status = 1');
    }

    function getRoomNumber($id){
      return $this->db->query("
 			select
 			room_number,
 			tbl_rate.rate_name,
 			tbl_rate.rate_normal
 			from tbl_room
      left join tbl_rate on tbl_rate.rate_id = tbl_room.rate_id
 			where
 			room_number = '".$id."' ");
    }

    function booking_add($resv, $resvdet){
  		$this->db->trans_begin();
  		$this->db->insert('tr_resv',$resv);
  		$juml = count($resvdet);
  		for ($i=0;$i<$juml;$i++){
  			$this->db->insert('tr_resvdet',$resvdet[$i]);
  	  }
  		if ($this->db->trans_status() === FALSE){
  			$this->db->trans_rollback();
  		}else{
  			$this->db->trans_commit();
  		}
  	 }

     function edit_booking($head, $detail){
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
      // if ($detail['flag_status'] == 'add'){
			// 		unset($detail['flag_status']);
			// 		$this->db->insert('tr_resvdet',$detail);
			//      } else if ($detail['flag_status'] == 'edit'){
			// 		//echo '<pre>';
      // if ($detail['flag_status'] == 'edit') {
					// unset($detail['flag_status']);
					// $this->db->where('row_id',$detail['row_id']);
					// $this->db->update('tr_resvdet',$detail);
      // }
			// }
			// $juml = count($detail);
			// for ($i=0;$i<$juml;$i++){
			// 	if ($detail[$i]['flag_status'] == 'add'){
			// 		unset($detail[$i]['flag_status']);
			// 		$this->db->insert('trx_order_detail',$detail[$i]);
			// 	} else if ($detail[$i]['flag_status'] == 'edit'){
			// 		//echo '<pre>';
			// 		unset($detail[$i]['flag_status']);
					// $this->db->where('row_id',$detail['row_id']);
					// $this->db->update('tr_resvdet',$detail);
				// }

			// }
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

    function editBookingResv($id,$data){
    	$this->db->where('resv_id',$id);
    	$this->db->update('tr_resv',$data);
    }

    function showDataBooking($param = array()){
    	if (isset($param)) {
    		$param = ( object ) $param;
    	}
    	// Set Id
    	if (isset($param->id)) {
    		$setId = $param->id;
    		$this->db->where ( 'nama_pemesan', $setId );
    	}
    	// Set Order
    	if (isset($param->order)) {
    		$setOrder = $param->order;
    		$sortColumn = 'resv_no';
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
  	  $this->db->join ( 'tr_resvdet tresvdet', 'tresv.resv_id = tresvdet.resvdet_resv_id');

      $this->db->select ( '
    			tresv.resv_id,
    			tresv.resv_no,
    			tresvdet.room_number,
    			tresv.resv_date,
    			tresv.nama_pemesan,
    			tresv.nama_perusahaan,
    			tresvdet.rate_name,
    			tresv.resv_in,
    			tresvdet.person,
          tresv.resv_status,
          tresv.resv_status_checkin,
               	');

    	$this->db->protect_identifiers=false;

    	// Set Limit Offset
    	if (isset($param->limit)) {
    		$limitData = explode ( ',', $param->limit );
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tr_resv tresv", $limitData [0] ,  $limitData [1]);

    	} else {
        // $this->db->where( "room_status = '5'");
    		return $this->db->get ( "tr_resv tresv" );

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

    function getDataConfirm($id){
      $this->db->select('*', FALSE);
      $this->db->from('tr_resv tp');
      $this->db->join('tr_resvdet trs', 'trs.resvdet_resv_id = tp.resv_id', 'left');
      $this->db->where('resv_id = "'.$id.'"');
      // $this->db->where('business_name like "%'.$q.'%" and business_location like "%'.$map.'%" or profile_name like "%'.$q.'%" and business_location like "%'.$map.'%"');
      $query = $this->db->get();
      return $query;
      // return $this->db->query('select * from tr_resv where resv_id = "'.$id.'" ');
    }

    function getDataBooking($id) {
    	return $this->db->query("
    		select
    			  resv_id,
     			  resv_no,
            date_format(resv_date, '%d-%m-%Y') as resv_date,
            resv_in,
            resv_out,
    			  deposit_type,
    			  deposit,
    				subtotal,
      			resv_status,
      			customer_type,
      			nama_pemesan,
      			alamat,
      			telpon,
      			nama_perusahaan,

    			  row_id,
      			resvdet_resv_id,
      			rate_name,
      			room_number,
      			person,
      			in_date,
      			out_date,
      			in_time,
      			room_price
    			from
    			tr_resv
    			join
    			tr_resvdet
    			on
    			resv_id = resvdet_resv_id
    			where resv_id = '".$id."' and resv_status = 1");
    }

    function cancelBooking($head, $detail, $id){
			$this->db->trans_begin();

			$this->db->where('resv_id',$id);
			$this->db->update('tr_resv',$head );

			$this->db->where('resvdet_resv_id',$id);
			$this->db->update('tr_resvdet',$detail );

			if ($this->db->trans_status() === FALSE)
			{
				$this->db->trans_rollback();
			}
			else
			{
				$this->db->trans_commit();
			}
		}

    function edit_room($id,$data){
      	$this->db->where('room_number',$id);
      	$this->db->update('tbl_room',$data);
    }

}
