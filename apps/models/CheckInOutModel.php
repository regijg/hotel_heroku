<?php

class CheckInOutModel extends CI_Model{

  private $table = 'tbl_room';

  function __construct() {
      parent::__construct ();
  }

  function showDataRoomSuperiorRoom(){
    return $this->db->query('select * from tbl_room where rate_name = "Superior Room" ');
  }

  function showDataRoomDeluxeRoom(){
    return $this->db->query('select * from tbl_room where rate_name = "Deluxe Room" ');
  }

  function showDataRoomJuniorSuite(){
    return $this->db->query('select * from tbl_room where rate_name = "Junior Suite" ');
  }

  function showDataRoomExecutiveSuite(){
    return $this->db->query('select * from tbl_room where rate_name = "Executive Suite" ');
  }

  function showDataRoomDeluxeRoyalRoom(){
    return $this->db->query('select * from tbl_room where rate_name = "Deluxe Royal Room" ');
  }

  function showDataRoomJuniorSuiteRoyal(){
    return $this->db->query('select * from tbl_room where rate_name = "Junior Suite Royal" ');
  }

  function showDataRoomExecutiveSuiteRoyal(){
    return $this->db->query('select * from tbl_room where rate_name = "Executive Suite Royal" ');
  }

  function showDataRoomDiplomaticSuite(){
    return $this->db->query('select * from tbl_room where rate_name = "Diplomatic Suite" ');
  }

  function showDataRoomPresidentialSuite(){
    return $this->db->query('select * from tbl_room where rate_name = "Presidential Suite" ');
  }

  function getDataRoom($id){
    return $this->db->query("
      select
      rate_id,
      rate_name,
      from tbl_room troom
      join tbl_rate trate on trate.rate_id = troom.rate_id
      where troom.room_number = '".$id."'
    ");
  }

  function getByIdCheckinDateNull($id = 102){
    return $this->db->query("
      select *
      from tbl_room troom
      join tr_registrasi treg on treg.room_number = troom.room_number
      where troom.room_number = '".$id."'
    ");
   }

  function getByIdCheckin($id){
      $this->db->where('room_number', $id);
      $query = $this->db->get('tbl_room');
      return $query->row();
   }

   function getHargaByRate($id){
     return $this->db->query("
			select
			rate_id,
			rate_name,
			rate_normal
			from
			tbl_rate
			where
			rate_id = ".$id." ");
   }

  function simpan_room($a = NULL){
    	$this->db->trans_start();
    	$this->db->insert('tbl_room',$a);
    	$this->db->trans_complete();
  }

  function simpan_registrasi($a = NULL){
    	$this->db->trans_start();
    	$this->db->insert('tr_registrasi',$a);
    	$this->db->trans_complete();
  }

  function edit_room($id,$data){
    	$this->db->where('room_number',$id);
    	$this->db->update('tbl_room',$data);
  }

  function edit_registrasi($id,$data){
    	$this->db->where('reg_id',$id);
    	$this->db->update('tr_registrasi',$data);
  }


  // PROSES PEMBAYARAN or BILLING START
  function showDataMenu(){
    return $this->db->query('select * from tbl_menu_order');
  }

  function getDataLayanan($id) {
   	return $this->db->query("
   			select
   			id_order,
   			order_menu,
   			price_menu
   			from
   			tbl_menu_order
   			where order_menu = '".$id."'
        " );
   	}

  function getkodeunik($table) {
        $tahun = date('y');
        $q = $this->db->query("SELECT MAX(RIGHT(billing_no,4)) AS idmax FROM ".'tr_billing');
        $kd = ""; //kode awal
        if($q->num_rows()>0){ //jika data ada
            foreach($q->result() as $k){
                $tmp = ((int)$k->idmax)+1; //string kode diset ke integer dan ditambahkan 1 dari kode terakhir
                $kd = sprintf("%05s", $tmp); //kode ambil 4 karakter terakhir
            }
        }else{ //jika data kosong diset ke kode awal
            $kd = "00001";
        }
        $kar = "B"; //karakter depan kodenya
        //gabungkan string dengan kode yang telah dibuat tadi
        return $kar.$tahun.$kd;
   }

   function getkoderegistrasidiklat($table) {
         $tahun = date('y');
         $q = $this->db->query("SELECT MAX(RIGHT(reg_no,4)) AS idmax FROM ".'tr_registrasi');
         $kd = "";
         if($q->num_rows()>0){
             foreach($q->result() as $k){
                 $tmp = ((int)$k->idmax)+1;
                 $kd = sprintf("%05s", $tmp);
             }
         }else{
             $kd = "00001";
         }
         $kar = "PD";
         return $kar.$tahun.$kd;
    }

    function getkoderegistrasiumum($table) {
          $tahun = date('y');
          $q = $this->db->query("SELECT MAX(RIGHT(reg_no,4)) AS idmax FROM ".'tr_registrasi');
          $kd = "";
          if($q->num_rows()>0){
              foreach($q->result() as $k){
                  $tmp = ((int)$k->idmax)+1;
                  $kd = sprintf("%05s", $tmp);
              }
          }else{
              $kd = "00001";
          }
          $kar = "UM";
          return $kar.$tahun.$kd;
     }

  function generateNoOrder($id) {
  	if ($id=='1') {
  		  $q = $this->db->query("select MAX(RIGHT(billing_no,4)) as kd_max from tr_billing where SUBSTRING(billing_no,6,1) = '1' ");
  	} else {
  		  $q = $this->db->query("select MAX(RIGHT(billing_no,4)) as kd_max from tr_billing where SUBSTRING(billing_no,6,1) = '2' ");
  	}
  	$kd = "";
  	if($q->num_rows()>0){
  		foreach($q->result() as $k){
  			$tmp = ((int)$k->kd_max)+1;
  			$kd = sprintf("%04s", $tmp);
  		}
  	}else{
  		$kd = "0001";
  	}
  	return $kd;
  }

  function billing($head, $detail){
		$this->db->trans_begin();
		$this->db->insert('tr_billing',$head);
		$juml = count($detail);
		for ($i=0;$i<$juml;$i++){
			$this->db->insert('tr_billingdet',$detail[$i]);
	  }
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		}else{
			$this->db->trans_commit();
		}
	 }

  // PROSES PEMBAYARAN or BILLING END

  function getBillingId($id){
    return $this->db->query('
    select case when total_tagihan = 0 then 0 else concat("Rp.  ", format(total_tagihan, 0)) end as total_tagihan,
    case when payment_total = 0 then concat("Rp.  ", format(0, 0)) else concat("Rp.  ", format(payment_total, 0)) end as payment_total,
    case when kembalian = 0 then concat("Rp.  ", format(0, 0)) else concat("Rp.  ", format(kembalian, 0)) end as kembalian
    from tr_billing where billing_id = "'.$id.'" ');
  }
}
