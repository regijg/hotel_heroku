<?php

class DashboardModel extends CI_Model{

    private $table = 'tbl_tamu';

    function __construct() {
        parent::__construct ();
    }

    function countDataRegistrasi(){
      $this->db->from('tr_registrasi');
      $this->db->where('status = 1');
      return $this->db->count_all_results();
    }

    function countDataCheckin(){
      $this->db->from('tr_registrasi');
      // $this->db->where('DATE(in_date)', $curr_date);
      $this->db->where('status = 1');
      $this->db->where('DATE(in_date) = CURDATE()');
      return $this->db->count_all_results();
    }

    function countDataCheckout(){
      $this->db->from('tr_registrasi');
      // $this->db->where('DATE(in_date)', $curr_date);
      $this->db->where('status = 2');
      $this->db->where('DATE(out_date) = CURDATE()');
      return $this->db->count_all_results();
    }

    function countDataReservasi(){
      $this->db->from('tr_resv');
      // $this->db->where('DATE(in_date)', $curr_date);
      $this->db->where('DATE(resv_date) = CURDATE()');
      return $this->db->count_all_results();
    }

    function rencanaCheckinHariIni(){
      // $resv_id = '';
      // $this->db->select('trs.room_number, tr.nama_pemesan, tr.resv_status_checkin', FALSE);
      // $this->db->from('tr_registrasi treg');
      // $this->db->join('tr_resv tr', 'tr.resv_id = treg.resv_id', 'left');
      // $this->db->join('tr_resvdet trs', 'trs.resvdet_resv_id = tr.resv_id', 'left');
      // $this->db->where('tr.resv_status = 2');
      // $this->db->where('treg.status != 2');
      // $this->db->where('DATE(tr.resv_in) = CURDATE()');
      // $query = $this->db->get();
      // return $query;
      $this->db->select('trs.room_number, tp.nama_pemesan, tp.resv_status_checkin', FALSE);
      $this->db->from('tr_resv tp');
      $this->db->join('tr_resvdet trs', 'trs.resvdet_resv_id = tp.resv_id', 'left');
      $this->db->where('resv_status = 2');
      $this->db->where('DATE(resv_in) = CURDATE()');
      $query = $this->db->get();
      return $query;
    }

    function countDataReservasiCheckinHariIni(){
      $this->db->from('tr_resv');
      $this->db->where('resv_status = 2');
      $this->db->where('DATE(resv_in) = CURDATE()');
      return $this->db->count_all_results();
    }

    function rencanaCheckoutHariIni(){
      $resv_id = '';
      $this->db->select('trs.room_number, tr.nama_pemesan', FALSE);
      $this->db->from('tr_registrasi treg');
      $this->db->join('tr_resv tr', 'tr.resv_id = treg.resv_id', 'left');
      $this->db->join('tr_resvdet trs', 'trs.resvdet_resv_id = tr.resv_id', 'left');
      $this->db->where('treg.status = 1');
      $this->db->where('treg.resv_id != '.$resv_id.' ');
      $this->db->where('DATE(treg.out_date) = CURDATE()');
      $query = $this->db->get();
      return $query;
    }

    function countDataReservasiCheckoutHariIni(){
      // $this->db->from('tr_resv');
      // $this->db->where('resv_status = 2');
      // $this->db->where('DATE(resv_out) = CURDATE()');
      $resv_id = '';
      $this->db->select('trs.room_number, tr.nama_pemesan', FALSE);
      $this->db->from('tr_registrasi treg');
      $this->db->join('tr_resv tr', 'tr.resv_id = treg.resv_id', 'left');
      $this->db->join('tr_resvdet trs', 'trs.resvdet_resv_id = tr.resv_id', 'left');
      $this->db->where('treg.status = 1');
      $this->db->where('treg.resv_id != '.$resv_id.' ');
      $this->db->where('DATE(treg.out_date) = CURDATE()');
      return $this->db->count_all_results();
    }

    function jumlahKamarTipeSuperiorRoom(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 1');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }

    function jumlahKamarTipeDeluxeRoom(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 2');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }

    function jumlahKamarTipeJuniorSuite(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 3');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }

    function jumlahKamarTipeExecutiveSuite(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 4');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }
    function jumlahKamarTipeDeluxeRoomRoyal(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 5');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }
    function jumlahKamarTipeJuniorSuiteRoyal(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 6');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }
    function jumlahKamarTipeExecutiveSuiteRoyal(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 7');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }
    function jumlahKamarTipeDiplomaticSuite(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 8');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }
    function jumlahKamarTipePresidentialSuite(){
      $this->db->from('tbl_room');
      $this->db->where('rate_id = 9');
      $this->db->where('room_status = 1');
      return $this->db->count_all_results();
    }


    function jumlahKamarKotor(){
      $this->db->from('tbl_room');
      $this->db->where('room_status = 3');
      return $this->db->count_all_results();
    }

    function jumlahKamarRusak(){
      $this->db->from('tbl_room');
      $this->db->where('room_status = 4');
      return $this->db->count_all_results();
    }
}
