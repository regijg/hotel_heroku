<?php

class PesertaModel extends CI_Model{

    private $table = 'tbl_peserta';
    private $DB2;

    function __construct() {
        parent::__construct ();
        // $DB2 = &get_instance();
        $this->DB2 = $this->load->database('db2', TRUE);
    }

    public function getPesertaList(){
        // return $this->DB2->query('select * from tbl_peserta');
        $this->DB2->select('*');
        $this->DB2->from('tbl_peserta');
        $query = $this->DB2->get();
        return $query->result();
    }

    public function get_by_id($id){
      $this->DB2->from($this->table);
      $this->DB2->where('pesertaID', $id);
      $query = $this->DB2->get();

      return $query->row();
    }

    public function get_provinsi(){
    $result = $this->DB2->get('tbl_provinsi')->result();
    $id = array('0');
    $name = array('Select Provinsi');
    for($i = 0; $i < count($result); $i++){
      array_push($id, $result[$i]->kode);
      array_push($name, $result[$i]->nama_provinsi);
    }
    return array_combine($id, $name);
  }

  public function get_kabupaten($kode_provinsi=NULL){
    $result = $this->DB2->where('kode_provinsi', $kode_provinsi)->get('tbl_kabupaten')->result();
    $id = array('0');
    $name = array('Select Kabupaten');
    for ($i=0; $i < count($result); $i++) {
        array_push($id, $result[$i]->kode);
        array_push($name, $result[$i]->nama_kabupaten);
    }
    return array_combine($id, $name);
  }

    function get_list_negara(){
      return $this->DB2->query('select * from tbl_negara');
    }

    function getDataProvinsi($id) {
     return $this->DB2->query("
         select
         nama_provinsi
         from
         tbl_provinsi
         where kode = '".$id."'" );
    }

    function getDataKabupaten($id) {
     return $this->DB2->query("
         select
         nama_kabupaten
         from
         tbl_kabupaten
         where kode = '".$id."'" );
    }

    public function insertPeserta($param = null){
        $res = $this->DB2->insert($this->table, $param);
        return $res;
    }

    public function updatePeserta($where, $data){
        $this->DB2->update($this->table, $data, $where);
        return $this->DB2->affected_rows();
    }

    function simpan($a = NULL){
    	$this->DB2->trans_start();
    	$this->DB2->insert('tbl_peserta',$a);
    	$this->DB2->trans_complete();
    }

    function getDataPeserta($id){
      return $this->DB2->query("
        select pesertaID,
        nip_register,
        no_registrasi,
        title1,
        title2,
        nama_peserta,
        alamat_rumah,
        telpon,
        nama_perusahaan
        from tbl_registrasi
        where no_registrasi = '".$id."'
      ");
    }

function showDataPeserta($param = array()) {
    if (isset($param)) {
      $param = ( object ) $param;
    }
    // Set Id
    if (isset($param->id)) {
      $setId = $param->id;
      $this->DB2->where ( 'pesertaID', $setId );
    }
    // Set Order
    if (isset($param->order)) {
      $setOrder = $param->order;
      $sortColumn = '';
      if (isset($param->order_column)) {
        $sortColumn = $param->order_column != NULL ? $param->order_column : $sortColumn;
      }
      $this->DB2->order_by ( $sortColumn, $setOrder );
    }

    // Search
    if (isset($param->search)) {
      $this->DB2->like($param->search);
    }

    $this->DB2->select ( 'tp.pesertaID,
              tp.nip_register,
              tp.full_name,
              tp.nama_perusahaan,
              tp.jabatan,
              tp.email,
              tp.nama_kabupaten,
              tp.nama_provinsi
    ');

    $this->DB2->protect_identifiers=false;

    // Set Limit Offset
    if (isset($param->limit)) {
      $limitData = explode ( ',', $param->limit );
      return $this->DB2->get ( "tbl_peserta tp", $limitData [0] ,  $limitData [1]);

    } else {
      return $this->DB2->get ( "tbl_peserta tp" );

    }
  }

  function showDataVlookPeserta($param = array()) {
  	if (isset($param)) {
  		$param = ( object ) $param;
  	}
  	// Set Id
  	if (isset($param->id)) {
  		$setId = $param->id;
  		$this->DB2->where ( 'nama_peserta', $setId );
  	}
  	// Set Order
  	if (isset($param->order)) {
  		$setOrder = $param->order;
  		$sortColumn = 'pesertaID';
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
              pesertaID,
  			      nip_register,
  			      nama_peserta,
  			      alamat_rumah,
              nama_provinsi,
              nama_kabupaten
  	");


  	$this->DB2->protect_identifiers=false;

  	// Set Limit Offset
  	if (isset($param->limit)) {
  		$limitData = explode ( ',', $param->limit );
  		return $this->DB2->get ( "tbl_peserta", $limitData [0] ,  $limitData [1]);

  	} else {
  		return $this->DB2->get ( "tbl_peserta" );

  	}
  }


  function showDataVlookPerusahaan($param = array()) {
  	if (isset($param)) {
  		$param = ( object ) $param;
  	}
  	// Set Id
  	if (isset($param->id)) {
  		$setId = $param->id;
  		$this->DB2->where ( 'nama_perusahaan', $setId );
  	}
  	// Set Order
  	if (isset($param->order)) {
  		$setOrder = $param->order;
  		$sortColumn = 'perusahaanID';
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
              perusahaanID,
  			      kode,
  			      nama_perusahaan,
  			      alamat,
              nama_provinsi,
              nama_kabupaten
  	");


  	$this->DB2->protect_identifiers=false;

  	// Set Limit Offset
  	if (isset($param->limit)) {
  		$limitData = explode ( ',', $param->limit );
  		return $this->DB2->get ( "tbl_perusahaan", $limitData [0] ,  $limitData [1]);

  	} else {
  		return $this->DB2->get ( "tbl_perusahaan" );

  	}
  }
}
