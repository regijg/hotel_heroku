<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';
require APPPATH . '/libraries/Uuid.php';

require 'assets/inc/phpjasperxml/tcpdf/tcpdf.php';
require 'assets/inc/phpjasperxml/PHPJasperXML.inc.php';

/**
 * @author regiJG
 */
class Checkinout extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->model('CheckInOutModel','',TRUE);
    // $this->load->model('PersertaModel','',TRUE);
		$this->widget = new Widget ();
		$this->uuid = new Uuid ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */
	public function index() {
		$param['showDataRoomSuperiorRoom'] = $this->CheckInOutModel->showDataRoomSuperiorRoom()->result();
		$param['showDataRoomDeluxeRoom'] = $this->CheckInOutModel->showDataRoomDeluxeRoom()->result();
		$param['showDataRoomJuniorSuite'] = $this->CheckInOutModel->showDataRoomJuniorSuite()->result();
		$param['showDataRoomExecutiveSuite'] = $this->CheckInOutModel->showDataRoomExecutiveSuite()->result();
		$param['showDataRoomDeluxeRoyalRoom'] = $this->CheckInOutModel->showDataRoomDeluxeRoyalRoom()->result();
		$param['showDataRoomJuniorSuiteRoyal'] = $this->CheckInOutModel->showDataRoomJuniorSuiteRoyal()->result();
		$param['showDataRoomExecutiveSuiteRoyal'] = $this->CheckInOutModel->showDataRoomExecutiveSuiteRoyal()->result();
		$param['showDataRoomDiplomaticSuite'] = $this->CheckInOutModel->showDataRoomDiplomaticSuite()->result();
		$param['showDataRoomPresidentialSuite'] = $this->CheckInOutModel->showDataRoomPresidentialSuite()->result();

		$widget = array (
				'header' => $this->widget->header(),
				'aside' => $this->widget->aside(),
				'list_room' =>$this->widget->list_room($param)
		);

		// Push Data
		$data['widget'] = ( object ) $widget;
    $table = 'tr_billing';
    $tablereg = 'tr_registrasi';
		$data['kodeunik'] = $this->CheckInOutModel->getkodeunik($table);
		$data['kodeunikregistrasidiklat'] = $this->CheckInOutModel->getkoderegistrasidiklat($tablereg);
		$data['kodeunikregistrasiumum'] = $this->CheckInOutModel->getkoderegistrasiumum($tablereg);
		$data['menus'] = $this->CheckInOutModel->showDataMenu()->result();
		$this->load->tpl ( 'v_checkinout', $data );
	}

	public function select_id_room() {
			$id = $this->input->get ( 'room_number' );
			$room = $this->db->get_where('tbl_room', array('room_number' => $id))->row();
			exit ( json_encode ( $room ) );
	}

	function ambilHargaRoom() {
		$kode = $this->input->get('kode');
		$idfield = $this->input->get('idfield');
		$rate = $this->CheckInOutModel->getHargaByRate($kode)->result();
		$temp = $this->CheckInOutModel->getHargaByRate($kode)->row();

		$response ['rate_id'] = $temp->rate_id;
		$response ['rate_name'] = $temp->rate_name;
		$response ['tarif_umum'] = $temp->rate_normal;
		$response ['n'] = 'ss';
 		$response ['m'] = 'Suksess';
 		exit ( json_encode ( $response ) );
	}

  public function simpan_checkinout_umum(){
		$user = $this->session->userdata('auth_data');
		$post = $this->input->post ();

		$data ['reg_no'] = $post ['reg_no'];
		$data ['nama'] = $post ['nama'];
		$data ['alamat'] = $post ['alamat'];
		$data ['no_identitas'] = $post ['no_identitas'];
		$data ['telpon'] = $post ['telpon'];
		$data ['in_date'] =  date("Y-m-d ",strtotime($post ['in_date']));
		$data ['in_time'] =  date("H:i",strtotime($post ['in_time']));
		if ($post ['out_date'] == NULL) {
			$data ['out_date'] =  '';
		}else {
			$data ['out_date'] =  date("Y-m-d ",strtotime($post ['out_date']));
		}
		// $data ['out_time'] =  $post ['out_time'];
		$data ['person'] = $post ['person'];
		$data ['room_number'] = $post ['room_number'];
		$data ['rate_id'] = $post ['rate_id'];
		$data ['rate_name'] = $post ['rate_name'];
		$data ['floor'] = $post ['floor'];
		$data ['price'] = $post ['price'];
		$data ['deposit'] = $post ['deposit'];
		$data ['deposit_type'] = $post ['deposit_type'];
		$data ['status'] = 1;

		$data ['user_name'] = $this->session->userdata('auth_data');
		$data ['last_update'] = date("Y-m-d H:i:s");

		$data ['reg_id'] = $this->uuid->v4();
		$this->CheckInOutModel->simpan_registrasi ( $data );

		if ($post ['room_number'] != ""){
				$dataroom ['room_number'] =$post ['room_number'];
				$dataroom ['room_status'] = 2;
				$this->CheckInOutModel->edit_room ($dataroom ['room_number'],$dataroom);
		}

		$response ['n'] = 'ss';
		$response ['m'] = 'Checkin success';

		exit ( json_encode ( $response ) );
	}

	function ambilDataLayanan() {
		$kode=strtolower($this->input->get('kode'));
		$idfield=$this->input->get('idfield');
		$id = explode('_',$idfield);
		$layanan = $this->CheckInOutModel->getDataLayanan($kode)->result();
		$layananRow = $this->CheckInOutModel->getDataLayanan($kode)->row();
		$response ['i'] = $id[2];
		$response ['id_order']= $layananRow->id_order;
		$response ['order_menu'] = $layananRow->order_menu;
		$response ['price_menu']= $layananRow->price_menu;
		// $tplRowLayanan = '';
		// foreach ($layanan as $isi) {
		// 	$tplRowLayanan .= '<option value="' . $isi->id_order . '">'. $isi->order_menu . ' ';
		// }
		// $tplRowLayanan .= '</option>';
		// $response ['data_satuan']= $tplRowLayanan;
		$response ['n'] = 'ss';
		$response ['m'] = 'Suksess';
		exit ( json_encode ( $response ) );
	}

	public function select_room_and_date() {
		$id = $this->input->get ( 'room_number' );
		$date = NULL;
		$status = 1;
		$room = $this->db->get_where('tr_registrasi', array('room_number' => $id, 'status' => 1))->row();
		$room_diklat = $this->db->get_where('tr_registrasi', array('room_number' => $id, 'status' => 1))->row();

		if ($room) {
			exit ( json_encode ( $room ) );
		}
		if ($room_diklat) {
			exit ( json_encode ( $room_diklat ) );
		}
	}

	function generateNoOrder(){
		$id = $this->input->get('id');

		$data = $this->CheckInOutModel->generateNoOrder($id);
		$response ['kode'] = $data;
		$response ['n'] = 'ss';
		$response ['m'] = 'Suksess';
		exit ( json_encode ( $response ) );
	}


		// PROSES PEMBAYARAN or BILLING START
		private function tplRowLayanan($i, $kode, $nama) {
			$menus = $this->CheckInOutModel->showDataMenu()->result();
			$tplRowLayanan = '
					<tr id="row_'.$i .'">
					<td>
						<input class="form-control" type="text" name="order_menu_[]" id="order_menu_layanan_<?=$i?>">
					</td>
					<td><input class="form-control" type="text" style="text-align: right" name="price_menu_[]" id="price_menu_'.$i.'"  placeholder="Harga"></td>
					<td><input class="form-control" type="text" style="text-align: right;width:70px" name="qty_[]" id="qty_pesanan_'.$i.'" placeholder="0" onchange="hitungQty(this.id)"></td>
					<td><input class="form-control" type="text" style="text-align: right" name="amount_[]" id="jumlah_pesanan_'.$i.'"  placeholder="Jumlah" readonly></td>
					<input type="hidden" name="rowTambahan_[]" id="rowTambahan_'.$i .'">
					<td><button title="hapus layanan"  type="button" id="butrow_'.$i .'" onclick="removeRow(this.id, this.value)" style="margin-top: 4px"class="btn btn-sm btn-danger">x</button></td>

														</tr>
			';
			$tabeli['tabel'] = $tplRowLayanan;
			$tabeli['i'] = $i;
			return  $tabeli;
		}

		function tambahRowLayanan() {

			$i=$this->input->get('id');
			$kode=$this->input->get('kode');
			$nama=$this->input->get('nama');

			$tplTableData = $this->tplRowLayanan($i, $kode, $nama);
			$response ['n'] = 'ss';
			$response ['m'] = 'Suksess';
			$response ['d'] = base64_encode ( $tplTableData['tabel'] );
			$response ['iterasi'] =  $tplTableData['i'];

			exit ( json_encode ( $response ) );

		}

		function table_cr_layanan() {
			$tplLayanan = '
			<div id="table-template-layanan-pembayaran">
			<table class="table table-striped" id="tabel_layanan">
			<thead>
			<tr>
				<th>Layanan Kamar</th>
				<th style="text-align:right">Harga</th>
				<th style="text-align:center">Qty</th>
				<th style="text-align:right">Jumlah</th>
				<th><button title="tambah row" class="btn btn-sm btn-success" type="button" onclick="tambahRowLayanan()" style="margin-top: 3px">+</button></th>
			</tr>
			</thead>
			<tbody id="row_layanan">';
			for ($i=0;$i<1;$i++) {
				$tplLayanan .= '<tr id="row_'.$i .'">
															<td>
															<input class="form-control" type="hidden" name="id_order_[]" id="id_order_'.$i.'">
															<input class="form-control" type="text" name="order_menu_[]" id="order_menu_layanan_'.$i.'">
															</td>
															<td><input class="form-control" type="text" style="text-align: right" name="price_menu_[]" id="price_menu_'.$i.'"  placeholder="Harga"></td>
															<td><input class="form-control" type="text" style="text-align: right;width:70px" name="qty_[]" id="qty_pesanan_'.$i.'" placeholder="0" onchange="hitungQty(this.id)"></td>
															<td><input class="form-control" type="text" style="text-align: right" name="amount_[]" id="jumlah_pesanan_'.$i.'"  placeholder="Jumlah" readonly></td>
															<td><button title="hapus row"  type="button" id="butrow_'.$i .'" onclick="removeRow(this.id, this.value)" style="margin-top: 4px"class="btn btn-sm btn-danger">x</button></td>

															<td id ="div_hapus">
															<input type="hidden" name="order_detail_id_[]" id="order_detail_id_'.$i .'">
															<input type="hidden" name="data_layanandel_[]" id="data_layanandel_'.$i .'">
															<input type="hidden" name="flag_[]" id="flag_'.$i .'">
															<input type="hidden" name="kode_layanandel_[]" id="kode_layanandel_'.$i .'">
															</td>
																	</tr>';
			}
			$tplLayanan .= '</tbody></table></div>';

			$response ['table'] = $tplLayanan;
			// $response ['toeslagh'] = $this->getParameterToeslaghUmum();
			// $response ['embalance'] = $this->getParameterEmbalane();
			$response ['n'] = 'ss';
			$response ['m'] = 'Suksess';
			exit ( json_encode ( $response ) );
		}



	public function prosess_pembayaran() {
			$id = $this->input->post ( 'id_penjualan_switch_pembayaran' );
			$this->create_pembayaran ( $id );
			// } else {
			// 	return false;
			// }
	}

	public function create_pembayaran() {
		$post = $this->input->post ();

		$data ['billing_no'] = $post ['billing_no_checkout_umum'];
		$data ['billing_date'] = date("Y-m-d H:i:s");
		$data ['reg_id'] = $post ['reg_id'];
		$data ['reg_no'] = $post ['reg_no'];
		$data ['nama_customer'] = $post ['nama_checkout_umum'];
		$data ['no_identitas'] = $post ['no_identitas_checkout_umum'];
		$data ['alamat'] = $post ['alamat_checkout_umum'];
		$data ['telpon'] = $post ['telpon_checkout_umum'];
		// $data ['perusahaan_id'] = $post ['perusahaan_id'];
		// $data ['nama_perusahaan'] = $post ['nama_perusahaan'];
		// $data ['customer_type'] = $post ['customer_type'];
		$data ['room_number'] = $post ['room_number'];
		$data ['rate_id'] = $post ['rate_id_checkout_umum'];
		$data ['rate_name'] = $post ['rate_name_checkout_umum'];
		$data ['tarif_kamar'] = $post ['price_checkout_umum'];
		$data ['hari'] = $post ['hari_checkout_umum'];
		$data ['customer_type'] = $post ['tamu_tipe'];

		// $data ['insert_by'] = $user['username'];
		// $data ['insert_date'] = date("Y-m-d H:i:s");
		// $data ['order_head_reduksi'] =  (float) $post ['reduksi'];
		$data ['total_tagihan'] = (float) $post ['billingdet_payment_total_checkout_umum'];
		$data ['billing_total'] = (float) $post ['billing_total_checkout_umum'];
		$data ['payment_methode'] = $post ['payment_methode'];
		$data ['payment_total'] = (float) $post ['payment_total_checkout_umum'];
		$data ['kembalian'] = (float) $post ['kembalian'];
		$data ['deposit_type'] = $post ['deposit_type'];
		$data ['deposit'] = (float) $post ['deposit'];
		$data ['sisa_deposit'] = (float) $post ['sisa_deposit'];

		$data ['user_name'] = $this->session->userdata('auth_data');
		$data ['last_update'] = date("Y-m-d H:i:s");
		//var_dump($data);


			$data ['billing_id'] = $this->uuid->v4();

				for($i = 0; $i < count ( $post ['order_menu_']); $i ++) {
					if ($post ['order_menu_'][$i] != ''){
						$dataBillingdet ['row_id'] = $this->uuid->v4 ();
						$dataBillingdet ['billingdet_billing_id'] = $data ['billing_id'];
						// $dataBillingdet ['billingdet_payment_total'] = (float) $post ['payment_total_checkout_umum'];
						// $dataBillingdet ['id_order'] = $post ['id_order_'] [$i];
						$dataBillingdet ['order_menu'] = $post ['order_menu_'] [$i];
						$dataBillingdet ['qty'] = $post ['qty_'] [$i];

						$formatRupiah = array('Rp', '.', ' ');
						$dataBillingdet ['price_menu'] = str_replace($formatRupiah, '',  $post ['price_menu_'] [$i]);
						$dataBillingdet ['amount'] = str_replace($formatRupiah, '',   $post ['amount_'] [$i]);

					}else if ($post ['order_menu_'][$i] == ''){
						$dataBillingdet ['row_id'] = $this->uuid->v4 ();
						$dataBillingdet ['billingdet_billing_id'] = $data ['billing_id'];
						// $dataBillingdet ['billingdet_payment_total'] = (float) $post ['payment_total_checkout_umum'];
						// $dataBillingdet ['id_order'] = $post ['id_order_'] [$i];
						$dataBillingdet ['order_menu'] = $post ['order_menu_'] [$i];
						$dataBillingdet ['qty'] = $post ['qty_'] [$i];

						$formatRupiah = array('Rp', '.', ' ');
						$dataBillingdet ['price_menu'] = str_replace($formatRupiah, '',  $post ['price_menu_'] [$i]);
						$dataBillingdet ['amount'] = str_replace($formatRupiah, '',   $post ['amount_'] [$i]);

					} else{
						break;
					}

					$dataDetail[] = $dataBillingdet;

					$response ['id'] = $data ['billing_id'];
					$response ['n'] = 'ss';
					$response ['m'] = 'Thank You';
				}

				if ($post ['room_number'] != ""){
						$dataroom ['room_number'] =$post ['room_number'];
						$dataroom ['room_status'] = 3;
						$this->CheckInOutModel->edit_room ($dataroom ['room_number'],$dataroom);
				}
				if ($post ['reg_id'] != "") {
						$dataregis ['reg_id'] = $post ['reg_id'];
						$dataregis ['out_date'] = date("Y-m-d ",strtotime($post ['out_date']));
						$dataregis ['status'] = 2;
						$dataregis ['out_time'] = $post ['out_time'];
						$this->CheckInOutModel->edit_registrasi ($dataregis ['reg_id'],$dataregis);
				}
				$this->CheckInOutModel->billing ( $data, $dataDetail);
				exit( json_encode ( $response ));
	 }
	// PROSES PEMBAYARAN or BILLING END


	function cetakNota($id){
		// $id= $_GET['billing_id_billing'];
		$user= $this->session->userdata('auth_data');
		$billingList = $this->CheckInOutModel->getBillingId($id)->row_array();
		$totalTagihan = $billingList['total_tagihan'];
		$uangDiterima = $billingList['payment_total'];
		$kembalian = $billingList['kembalian'];
		// $totalTagihanString = "Rp. ".$totalTagihan."";
		// var_dump($totalTagihanString);
		// exit();
		$PHPJasperXML = new PHPJasperXML();
		$PHPJasperXML->PHPJasperXMLBuild();
		$xml = simplexml_load_file('./assets/inc/report/cetak_nota_billing/billing.jrxml');
		$PHPJasperXML->arrayParameter=array(
				"billingIdBilling" => "'".$id."'",
				"paramDateNow" =>tgl_indo("Y-m-d"),
				"paramTotalTagihan" => $totalTagihan,
				"paramPaymentTotal" => $uangDiterima,
				"paramKembalian" => $kembalian,
				"namaPetugas" => $user
		);
		// var_dump($id);
		// exit();

		$PHPJasperXML->xml_dismantle($xml);
		$PHPJasperXML->transferDBtoArray("localhost", "root", "harrison91", "db_hotel", "mysql");
		$PHPJasperXML->outpage("I");
	}
}
