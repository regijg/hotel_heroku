<?php

class TamuModel extends CI_Model{

    private $table = 'tbl_tamu';

    function __construct() {
        parent::__construct ();
    }

    function getkodeunik($table) {
        $tahun = date('y');
        $q = $this->db->query("SELECT MAX(RIGHT(tamu_kode,4)) AS idmax FROM ".'tbl_tamu');
        $kd = ""; //kode awal
          if($q->num_rows()>0){ //jika data ada
            foreach($q->result() as $k){
                $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%04s", $tmp); //kode ambil 4 karakter terakhir
            }
          }else{ //jika data kosong diset ke kode awal
                $kd = "0001";
          }
          $kar = "GS"; //karakter depan kodenya
            //gabungkan string dengan kode yang telah dibuat tadi
          return $kar.$tahun.$kd;
    }

    // function get_negara(){
    //     $result = $this->db->get('tbl_negara')->result();
    //     $id = array('0');
    //     $name = array('Select Country');
    //     for ($i = 0; $i < count($result); $i++)
    //     {
    //         array_push($id, $result[$i]->kode);
    //         array_push($name, $result[$i]->nama_negara);
    //     }
    //     return array_combine($id, $name);
    // }
    //
    // function get_provinsi($negara_prov_id=NULL){
    //     $result = $this->db->where('kode_negara', $negara_prov_id)->get('tbl_provinsi')->result();
    //     $id = array('0');
    //     $name = array('Select Region');
    //     for ($i=0; $i<count($result); $i++)
    //     {
    //         array_push($id, $result[$i]->kode);
    //         array_push($name, $result[$i]->nama_provinsi);
    //     }
    //     return array_combine($id, $name);
    // }
    //
    // function get_kota($kota_id=NULL){
    //     $result = $this->db->where('kota_kode_provinsi', $kota_id)->get('tbl_kota')->result();
    //     $id = array('0');
    //     $name = array('Select City');
    //     for ($i=0; $i<count($result); $i++)
    //     {
    //         array_push($id, $result[$i]->kota_kode);
    //         array_push($name, $result[$i]->kota_nama);
    //     }
    //     return array_combine($id, $name);
    // }

    public function get_provinsi(){
    $result = $this->db->get('tbl_provinsi')->result();
    $id = array('0');
    $name = array('Select Provinsi');
    for($i = 0; $i < count($result); $i++){
      array_push($id, $result[$i]->kode);
      array_push($name, $result[$i]->nama_provinsi);
    }
    return array_combine($id, $name);
   }

    public function get_kabupaten($kode_provinsi=NULL){
      $result = $this->db->where('kode_provinsi', $kode_provinsi)->get('tbl_kabupaten')->result();
      $id = array('0');
      $name = array('Select Kabupaten');
      for ($i=0; $i < count($result); $i++) {
          array_push($id, $result[$i]->kode);
          array_push($name, $result[$i]->nama_kabupaten);
      }
      return array_combine($id, $name);
    }

    function showDataMasterTamu($param = array()){
    	if (isset($param)) {
    		$param = ( object ) $param;
    	}
    	// Set Id
    	if (isset($param->id)) {
    		$setId = $param->id;
    		$this->db->where ( 'tamu_id', $setId );
    	}
    	// Set Order
    	if (isset($param->order)) {
    		$setOrder = $param->order;
    		$sortColumn = 'insert_date';
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
    		//     if ($param->filter != 'all'){
    		//     $this->db->where ( 'jenis_barang_id', $param->filter );
    		//     }
    		// }

    	// Join
    // 	$this->db->join ( 'tbl_satuan_obat tso', 'to.obat_id = tso.satuan_obat_obat_id');
    //	$this->db->join ( 'tbl_tamu tjo', ' tjo.jenis_barang_id = to.barang_jenis_barang_id');

    	$this->db->select ( '
    			tt.tamu_id,
    			tt.tamu_kode,
    			tt.tamu_nama,
    			tt.tamu_identitas_number,
          tt.tamu_kelamin,
    			tt.tamu_alamat,
    			tt.tamu_email,
               	');
    	//    (select saldo_awal_obat_id from tbl_saldo_awal_obat where saldo_awal_obat_satuan_id=satuan_obat_obat_id) as nama_dokter,

    	$this->db->protect_identifiers=false;

    	// Set Limit Offset
    	if (isset($param->limit)) {
    		$limitData = explode ( ',', $param->limit );
    		return $this->db->get ( "tbl_tamu tt", $limitData [0] ,  $limitData [1]);

    	} else {
    		return $this->db->get ( "tbl_tamu tt" );

    	}
    }

  function simpan_tamu($a = NUll){
      $this->db->trans_start();
      $this->db->insert('tbl_tamu', $a);
      $this->db->trans_complete();
  }

  function edit_tamu($id, $data){
      $this->db->where('reg_id', $id);
      $this->db->update('tr_registrasi', $data);
   }

  function delete_tamu($id){
      $this->db->trans_start();
      $this->db->where('tamu_id',$id);
      $this->db->delete('tbl_tamu');
      $this->db->trans_complete();
   }
}
