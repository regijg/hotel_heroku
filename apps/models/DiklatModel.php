<?php

class DiklatModel extends CI_Model{

  private $table = 'tbl_room';

  function __construct() {
      parent::__construct ();
      $this->DB2 = $this->load->database('db2', TRUE);
  }

  function getDataDiklat($id){
    return $this->DB2->query("
      select diklatID,
      kode_diklat,
      full_name,
      sumber_dana,
      date_format(rencana_selesai, '%d-%m-%Y') as rencana_selesai
      from tbl_diklat
      where kode_diklat = '".$id."'
    ");
  }

  function showDataVlookDiklat($param = array()) {
  	if (isset($param)) {
  		$param = ( object ) $param;
  	}
  	// Set Id
  	if (isset($param->id)) {
  		$setId = $param->id;
  		$this->DB2->where ( 'kode_diklat', $setId );
  	}
  	// Set Order
  	if (isset($param->order)) {
  		$setOrder = $param->order;
  		$sortColumn = 'diklatID';
  		if (isset($param->order_column)) {
  			$sortColumn = $param->order_column != NULL ? $param->order_column : $sortColumn;
  		}
  		$this->DB2->order_by ( $sortColumn, $setOrder );
  	}

  	// Search
  	if (isset($param->search)) {
  	    foreach ($param->search as $key => $col) {
  	        $this->DB2->or_like($key, $col);
  	    }
  	}

  	$this->DB2->select ( "
  			      kode_diklat,
  			      judul_diklat,
  			      sumber_dana
  	");


  	$this->DB2->protect_identifiers=false;

  	// Set Limit Offset
  	if (isset($param->limit)) {
  		$limitData = explode ( ',', $param->limit );
  		return $this->DB2->get ( "tbl_diklat", $limitData [0] ,  $limitData [1]);

  	} else {
  		return $this->DB2->get ( "tbl_diklat" );

  	}
  }

  function get_diklat(){
           $result = $this->DB2->get('tbl_registrasi')->result();
           $id = array('0');
           $name = array('Select Provinsi');
           for ($i = 0; $i < count($result); $i++){
               array_push($id, $result[$i]->provinsi_id);
               // array_push($name, $result[$i]->provinsi_nama);
           }
           return array_combine($id);
    }

    function get_peserta_diklat($kode_diklat=NULL){
           $result = $this->db->where('kode_diklat', $kode_diklat)->get('tbl_registrasi')->result();
           $id = array('0');
           $name = array('Select Kota');
           for ($i=0; $i<count($result); $i++){
               array_push($id, $result[$i]->kode_diklat);
               array_push($name, $result[$i]->nama_peserta);
           }
           return array_combine($id);
   }


}
