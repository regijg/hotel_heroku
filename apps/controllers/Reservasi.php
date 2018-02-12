<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

/**
 * @author regiJG
 */
class Reservasi extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->model('ReservasiModel','',TRUE);
    $this->load->model('CheckInOutModel','',TRUE);
		$this->widget = new Widget ();
		$this->uuid = new Uuid ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */
	public function index() {

		$widget = array (
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside()
		);
		$data['widget'] = ( object ) $widget;
		$table = 'tr_billing';
		$data['kodeunik'] = $this->ReservasiModel->getkodeunik($table);
		$data['rooms'] = $this->ReservasiModel->get_booking_room();
		$data['roomList'] = $this->ReservasiModel->roomList()->result();
		$this->load->tpl ( 'v_reservasi', $data );
	}


  public function list_data() {

		$rows = $this->input->get ( 'rows' );
		$pageOri = $this->input->get ( 'page' );
		$sortCol = $this->input->get ( 'sidx' );
		$orderType = $this->input->get ( 'sord' );
		$callback = $this->input->get ( 'callback' );
		$filters = $this->input->get ( 'filters' );
		$key = $this->input->get ( 'key' );

		if ($key != NULL) {
			$search_col ['lower(tresv.nama_pemesan)'] = strtolower ( $key );
			$search_col ['lower(tresv.resv_no)'] = strtolower ( $key );
			$search_col ['lower(tresv.resv_date)'] = strtolower ( $key );
			$param ['search'] = $search_col;
		}

		// Filters
		if ($filters != NULL) {
			$getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
			$search_col = array ();
			foreach ( $getFilter->rules as $row ) {
				$search_col [$row->field] = $row->data;
			}
			$param ['search'] = $search_col;
		}

		$page = $pageOri == 1 ? 0 : $pageOri - 1;
		$showData = $rows;
		$getOffset = $page > 0 ? ($showData * $page) : 0;

		// $param['id'] = "";
		$param ['order'] = "desc";
		$param ['order_column'] = "resv_no";
		$param ['limit'] = $showData . "," . $getOffset;
		//$param ['order'] = $orderType;
		$param ['order_column'] = $sortCol;
		$queryData = $this->ReservasiModel->showDataBooking ( $param )->result ();
		$queryOriData = $this->ReservasiModel->showDataBooking ()->result ();

		$total = count ( $queryOriData ) != 0 ? ceil ( count ( $queryOriData ) / ( int ) $showData ) : 0;
		$data ['record'] = "1";
		$data ['page'] = ( int ) $pageOri;
		$data ['total'] = $total;
		$data ['rows'] = $queryData;

		exit ( $callback . "(" . json_encode ( $data ) . ")" );
	}

	public function prosess_booking() {
		$id = $this->input->post ( 'resv_id_switch' );
		if ($id) {
			exit ( $this->edit_booking ( $id ) );
		} else {
			exit ( $this->create_booking () );
		}
	}

	public function create_booking() {
		$post = $this->input->post ();

		$data ['resv_no'] = $post ['resv_no'];
		$data ['resv_date'] = date("Y-m-d",strtotime($post ['resv_date']));
		$data ['resv_in'] = date("Y-m-d",strtotime($post ['resv_in']));
		if ($post ['resv_out'] == NULL) {
			$data ['resv_out'] =  '';
		}else {
			$data ['resv_out'] =  date("Y-m-d ",strtotime($post ['resv_out']));
		}
		$data ['deposit_type'] = $post ['deposit_type'];
		$data ['deposit'] = (float) $post ['deposit'];
		$data ['subtotal'] = (float) $post ['subtotal'];
		$data ['resv_status'] = $post ['resv_status'];
		$data ['resv_status_checkin'] = 0;
		// $data ['customer_type'] = $post ['customer_type'];
		$data ['nama_pemesan'] = $post ['nama_pemesan'];
		$data ['alamat'] = $post ['alamat'];
		$data ['telpon'] = $post ['telpon'];
		// $data ['nama_perusahaan'] = $post ['nama_perusahaan'];
		$data ['user_name'] = $this->session->userdata('auth_data');


		$data ['resv_id'] = $this->uuid->v4();

		$dataResvdet ['row_id'] = $this->uuid->v4 ();
		$dataResvdet ['resvdet_resv_id'] = $data ['resv_id'];
		$dataResvdet ['room_number'] = $post ['room_number'];
		$dataResvdet ['rate_name'] = $post ['rate_name'];
		$dataResvdet ['person'] = $post ['person'];
		$dataResvdet ['in_date'] = $data ['resv_in'];
		$dataResvdet ['out_date'] = $data ['resv_out'];
		$dataResvdet ['in_time'] = $post ['in_time'];
		$dataResvdet ['room_price'] = (float) $post ['tarif_umum'];

		$dataDetail[] = $dataResvdet;

		$response ['id'] = $data ['resv_id'];
		$response ['n'] = 'ss';
		$response ['m'] = 'Thank You';
				// }

		if ($post['resv_status'] == 2) {
			if ($post ['room_number'] != ""){
					$dataroom ['room_number'] =$post ['room_number'];
					$dataroom ['room_status'] = 5;
					$this->ReservasiModel->edit_room ($dataroom ['room_number'],$dataroom);
			}
		}
				// if ($post ['reg_id'] != "") {
				// 		$dataregis ['reg_id'] = $post ['reg_id'];
				// 		$dataregis ['out_date'] = $post ['out_date'];
				// 		$dataregis ['out_time'] = $post ['out_time'];
				// 		$this->CheckInOutModel->edit_registrasi ($dataregis ['reg_id'],$dataregis);
				// }
		$this->ReservasiModel->booking_add ( $data, $dataDetail);
		exit( json_encode ( $response ));
	 }

	 public function edit_booking($id) {
			$post = $this->input->post ();


			$data ['resv_id'] = $id;

			$data ['resv_no'] = $post ['resv_no'];
			$data ['resv_date'] = date("Y-m-d",strtotime($post ['resv_date']));
			$data ['resv_in'] = date("Y-m-d",strtotime($post ['resv_in']));
			if ($post ['resv_out'] == NULL) {
				$data ['resv_out'] =  '';
			}else {
				$data ['resv_out'] =  date("Y-m-d ",strtotime($post ['resv_out']));
			}
			$data ['deposit_type'] = $post ['deposit_type'];
			$data ['deposit'] = (float) $post ['deposit'];
			$data ['subtotal'] = (float) $post ['subtotal'];
			$data ['resv_status'] = $post ['resv_status'];
			$data ['resv_status_checkin'] = 0;
			// $data ['customer_type'] = $post ['customer_type'];
			$data ['nama_pemesan'] = $post ['nama_pemesan'];
			$data ['alamat'] = $post ['alamat'];
			$data ['telpon'] = $post ['telpon'];
			// $data ['nama_perusahaan'] = $post ['nama_perusahaan'];
			$data ['user_name'] = $this->session->userdata('auth_data');

			$dataFlag = array();
			$dataResvdet ['row_id'] = $post ['row_id'];
			$dataResvdet ['resvdet_resv_id'] = $data ['resv_id'];
			$dataResvdet ['room_number'] = $post ['room_number'];
			$dataResvdet ['rate_name'] = $post ['rate_name'];
			$dataResvdet ['person'] = $post ['person'];
			$dataResvdet ['in_date'] = $data ['resv_in'];
			$dataResvdet ['out_date'] = $data ['resv_out'];
			$dataResvdet ['in_time'] = $post ['in_time'];
			$dataResvdet ['room_price'] = (float) $post ['tarif_umum'];
			$dataResvdet ['flag_status'] = $post ['flag_'];
			$dataResvdet ['flag_status'] = $post ['flag_'];

			if ($post ['flag_'] == 'add') {
					$dataResvdet ['order_detail_id'] = $this->uuid->v4 ();
			}

			if ($post['resv_status'] == 2) {
				if ($post ['room_number'] != ""){
						$dataroom ['room_number'] =$post ['room_number'];
						$dataroom ['room_status'] = 5;
						$this->ReservasiModel->edit_room ($dataroom ['room_number'],$dataroom);
				}
			}

			$dataDetail[] = $dataResvdet;
			$dataFlagAll[] = $dataFlag;

			$dataAll = array_values(array_filter(array_merge($dataDetail,$dataFlagAll))) ;

			$response ['n'] = 'ss';
			$response ['m'] = 'Data berhasil disimpan';
			$this->ReservasiModel->edit_booking ( $data, $dataAll);
			exit( json_encode ( $response ));
	}

	public function simpan_reservasi_umum(){
			$post = $this->input->post ();

	    $tablereg = 'tr_registrasi';
			$id=$this->input->get('id');
			$resv = $this->ReservasiModel->getDataConfirm($id)->row();

			$data ['resv_id'] = $id;
			// if($orderHead->resv_status == 2) {
			$data ['reg_no'] = $this->CheckInOutModel->getkoderegistrasiumum($tablereg);
			$data ['nama'] = $resv->nama_pemesan;
			$data ['deposit_type'] = $resv->deposit_type;
			$data ['deposit'] = $resv->deposit;
			$data ['in_date'] =  $resv->resv_in;
			if ($resv->resv_out == '0000-00-00') {
				$data ['out_date'] =  '';
			}else {
				$data ['out_date'] =  date("Y-m-d ",strtotime($resv->resv_out));
			}
			$data ['tipe_tamu'] = $resv->customer_type;
			$data ['alamat'] = $resv->alamat;
			$data ['telpon'] = $resv->telpon;
			// $data ['nama_perusahaan'] = $resv->nama_perusahaan;
			$data ['room_number'] = $resv->room_number;
			$data ['rate_name'] = $resv->rate_name;
			$data ['person'] = $resv->person;
			$data ['price'] = $resv->room_price;
			$data ['in_time'] = $resv->in_time;
			$data ['status'] = 1;
			$data ['user_name'] = $this->session->userdata('auth_data');
			$data ['last_update'] = date("Y-m-d H:i:s");

			$data ['reg_id'] = $this->uuid->v4();
			$this->CheckInOutModel->simpan_registrasi ( $data );

			if ($resv->room_number != ""){
					$dataroom ['room_number'] =$resv->room_number;
					$dataroom ['room_status'] = 2;
					$this->CheckInOutModel->edit_room ($dataroom ['room_number'],$dataroom);
			}

			if ($id != NULL) {
					$dataresv ['resv_status_checkin'] = 1;
					$this->ReservasiModel->editBookingResv ($id, $dataresv);
			}

			$response ['n'] = 'ss';
			$response ['m'] = 'Checkin success';

			exit ( json_encode ( $response ) );
		// }
	}

	// PROSES BOOKING ROOM START
	function populate_booking_room() {
		$id = $this->input->post('room_number');
		echo(json_encode($this->ReservasiModel->get_booking_room($id)));
	}

	function ambilRoomNumber() {
		$kode = $this->input->get('kode');
		$idfield = $this->input->get('idfield');
		$rate = $this->ReservasiModel->getRoomNumber($kode)->result();
		$temp = $this->ReservasiModel->getRoomNumber($kode)->row();

		$response ['room_number'] = $temp->room_number;
		$response ['rate_name'] = $temp->rate_name;
		$response ['rate_normal'] = $temp->rate_normal;
		$response ['n'] = 'ss';
 		$response ['m'] = 'Suksess';
 		exit ( json_encode ( $response ) );
	}

	function detailDataBooking(){
		$id=$this->input->get('id');
		$orderHead= $this->ReservasiModel->getDataBooking($id)->row();

		$response ['resv_id'] = $orderHead->resv_id;
		$response ['resv_no'] = $orderHead->resv_no;
		$response ['resv_date'] = $orderHead->resv_date;
		$response ['resv_in'] = $orderHead->resv_in;
		$response ['resv_out'] = $orderHead->resv_out;
		$response ['deposit_type'] = $orderHead->deposit_type;
		$response ['deposit'] = $orderHead->deposit;
		$response ['subtotal'] = $orderHead->subtotal;
		$response ['resv_status'] = $orderHead->resv_status;
		// $response ['customer_type'] = $orderHead->customer_type;
		$response ['nama_pemesan'] = $orderHead->nama_pemesan;
		$response ['nama_perusahaan'] = $orderHead->nama_perusahaan;
		$response ['alamat'] = $orderHead->alamat;
		$response ['telpon'] = $orderHead->telpon;

		$response ['row_id'] = $orderHead->row_id;
		$response ['room_number'] = $orderHead->room_number;
		$response ['rate_name'] = $orderHead->rate_name;
		$response ['person'] = $orderHead->person;
		$response ['in_time'] = $orderHead->in_time;
		$response ['room_price'] = $orderHead->room_price;

		// $response ['in_date'] = $orderHead->order_head_reduksi;
		// $response ['out_date'] = $orderHead->order_head_reduksi;

		// $response ['tabel'] = $this->tabelDetailBarang($id);
		$response ['n'] = 'ss';
		$response ['m'] = 'Suksess';

		exit ( json_encode ( $response ) );

	}

	function cancelBooking() {
		// $user = $this->session->userdata('auth_data');
		$id=$this->input->get('id');

		$orderHead= $this->ReservasiModel->getDataBooking($id)->row();
		//$bayar = $this->PenjualanModel->cekTagihanDetailBayar($id)->row();

		if($orderHead->resv_status == 1) {
			$head['resv_status'] = 3;
			// $head['update_by'] = $user['username'];
			// $head['update_date'] = date("Y-m-d H:i:s");

			$detail['description'] = 'Dibatalkan euy teu boga duit';
			// $detail['update_by'] = $user['username'];
			// $detail['update_date'] = date("Y-m-d H:i:s");

			$response ['n'] = 'ss';
			$response ['m'] = 'Booking data berhasil dicancel';
			$this->ReservasiModel->cancelBooking($head,$detail,$id);

			exit( json_encode ( $response ));
		} else {
			$response ['n'] = 'ss';
			$response ['m'] = 'Data penjualan sudah dibayar, tidak dapat dicancel';
			exit( json_encode ( $response ));
		}
	}

	// private function tplRowLayanan($i, $kode, $nama) {
	// 	$roomList = $this->ReservasiModel->showDataRoom()->result();
	// 	// $orderDetail= $this->PenjualanModel->getDataOrder($id)->result();
	// 	$tplRowLayanan = '
	// 			<tr id="row_'.$i .'">
	// 			<td style="width: 200px;">
	// 			<select name="satuan_barang_[]" id="satuan_barang_'.$i .'" class="form-control" onchange="ambilHargaBarang(this.value,this.id)">
	// 			</select>
	// 			</td>
	// 			<td><input class="form-control" type="text" style="text-align: right" name="price_menu_[]" id="price_menu_'.$i.'"  placeholder="Tipe Kamar"></td>
	// 			<td><input class="form-control" type="text" style="text-align: right" name="qty_[]" id="qty_pesanan_'.$i.'" onchange="hitungQty(this.id)"></td>
	// 			<input type="hidden" name="rowTambahan_[]" id="rowTambahan_'.$i .'">
	// 			<td><button title="hapus layanan"  type="button" id="butrow_'.$i .'" onclick="removeRow(this.id, this.value)" style="margin-top: 4px"class="btn btn-sm btn-danger">x</button></td>
	// 			</tr>
	// 	';
	// 	$tabeli['tabel'] = $tplRowLayanan;
	// 	$tabeli['i'] = $i;
	// 	return  $tabeli;
	// }
  //
	// function tambahRowLayanan() {
  //
	// 	$i=$this->input->get('id');
	// 	$kode=$this->input->get('kode');
	// 	$nama=$this->input->get('nama');
  //
	// 	$tplTableData = $this->tplRowLayanan($i, $kode, $nama);
	// 	$response ['n'] = 'ss';
	// 	$response ['m'] = 'Suksess';
	// 	$response ['d'] = base64_encode ( $tplTableData['tabel'] );
	// 	$response ['iterasi'] =  $tplTableData['i'];
  //
	// 	exit ( json_encode ( $response ) );
  //
	// }

	// function table_cr_booking() {
	// 	$roomList = $this->ReservasiModel->showDataRoom()->result();
	// 	$tplLayanan = '
	// 	<div id="table-template-booking">
	// 	<table class="table table-striped" id="table_booking">
	// 	<thead>
	// 	<tr>
	// 		<th>No. Kamar</th>
	// 		<th>Tipe Kamar</th>
	// 		<th style="text-align:center">Booking To</th>
	// 		<th><button title="tambah row" class="btn btn-sm btn-success" type="button" onclick="tambahRowLayanan()" style="margin-top: 3px">+</button></th>
	// 	</tr>
	// 	</thead>
	// 	<tbody id="row_layanan">';
	// 	for ($i=0;$i<1;$i++) {
	// 		$tplLayanan .= '<tr id="row_'.$i .'">
	// 													<td style="width: 200px;">
	// 													<input class="form-control" type="hidden" name="id_order_[]" id="id_order_'.$i.'">
	// 													<input class="form-control" type="hidden" name="nama_satuan_[]" id="nama_satuan_'.$i .'" >
	// 													<select name="room_number_[]" id="room_number_'.$i .'" class="form-control" onchange="ambilHargaBarang(this.value,this.id)">
	// 													<option value="">--</option>
	// 													';
	// 													foreach ($roomList as $row) {
	// 														$tplLayanan .=	 '<option value="' . $row->room_number . '">'. $row->room_number .' - Lantai '.$row->floor. ' - Kosong '. ' </option>';
	// 													}
	// 			    $tplLayanan .= '</select>
	// 													</td>
	// 													<td><input class="form-control" type="text" style="text-align: right" name="price_menu_[]" id="price_menu_'.$i.'"  placeholder="Tipe Kamar"></td>
	// 													<td><input class="form-control" type="text" style="text-align: right" name="qty_[]" id="qty_pesanan_'.$i.'" onchange="hitungQty(this.id)"></td>
	// 													<td><button title="hapus row"  type="button" id="butrow_'.$i .'" onclick="removeRow(this.id, this.value)" style="margin-top: 4px"class="btn btn-sm btn-danger">x</button></td>
  //
	// 													<td id ="div_hapus">
	// 													<input type="hidden" name="order_detail_id_[]" id="order_detail_id_'.$i .'">
	// 													<input type="hidden" name="data_layanandel_[]" id="data_layanandel_'.$i .'">
	// 													<input type="hidden" name="flag_[]" id="flag_'.$i .'">
	// 													<input type="hidden" name="kode_layanandel_[]" id="kode_layanandel_'.$i .'">
	// 													</td>
	// 															</tr>';
	// 	}
	// 	$tplLayanan .= '</tbody></table></div>';
  //
	// 	$response ['table'] = $tplLayanan;
  //
	// 	$response ['n'] = 'ss';
	// 	$response ['m'] = 'Suksess';
	// 	exit ( json_encode ( $response ) );
	// }
	// PROSES BOOKING ROOM END

}
