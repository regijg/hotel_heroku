<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/controllers/Widget.php';

/**
 * @author RegiJG
 */
class Peserta extends arisoft_id_core {

	private $widget;
	public function __construct() {
		parent::__construct ();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('PesertaModel','',TRUE);
		// $this->load->model('ProvinsiKabModel','',TRUE);
		$this->load->model('PerusahaanModel','',TRUE);
		$this->widget = new Widget ();
	}

	/**
	 * Index view
	 * --------------------------------------------------------------------------------------------------------
	 */

		 public function list_data_peserta() {

		 				$rows = $this->input->get('rows');
		 				$pageOri = $this->input->get('page');
		 				$sortCol = $this->input->get ( 'sidx' );
		 				$orderType = $this->input->get ( 'sord' );
		 				$callback = $this->input->get ( 'callback' );
		 				$filters =$this->input->get ( 'filters' );
		 				$key =$this->input->get ( 'key' );

		 				if ($key != NULL) {
		 						$search_col['lower("tp"."full_name")'] = strtolower($key);
		 						$param['search'] = $search_col;
		 				}
		 				// Filters
		 				if ($filters != NULL) {
		 					$getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
		 					$search_col = array ();
		 					foreach ( $getFilter->rules as $row ) {
		 						$search_col [$row->field] = $row->data;
		 					}
		 					$param['search'] = $search_col;
		 				}
		 				$page = $pageOri == 1 ? 0 : $pageOri - 1;
		 				$showData = $rows;
		 				$getOffset = $page > 0 ? ($showData * $page)  : 0;

		 				//$param['id'] = "";
		 				$param['order'] = "desc";
		 				$param['order_column'] = "pesertaID";
		 				$param['limit'] = $showData.",".$getOffset;
		 				//$param ['order'] = $orderType;
		 				$param ['order_column'] = $sortCol;
		 				$queryData =  $this->PesertaModel->showDataPeserta($param)->result();
		 				$queryOriData =  $this->PesertaModel->showDataPeserta()->result();
		 				$total  = count($queryOriData) != 0 ?  ceil(count($queryOriData) / (int)$showData)  : 0;
		 				$data['record'] = "1";
		 				$data['page'] = (int)$pageOri;
		 				$data['total'] =  $total;
		 				$data['rows'] = $queryData;

		 				exit($callback."(".json_encode($data).")");
		 			}

		function list_data_vlookup_peserta() {
			$rows = $this->input->get('rows');
			$pageOri = $this->input->get('page');
			$sortCol = $this->input->get ( 'sidx' );
			$orderType = $this->input->get ( 'sord' );
			$callback = $this->input->get ( 'callback' );
			$filters =$this->input->get ( 'filters' );
			$key =$this->input->get ( 'key' );
			$id_kode =$this->input->get ( 'id_kode' );

			if ($key != NULL) {
					$search_col ['lower("nama_peserta")'] = strtolower($key);
					$search_col ['lower("pesertaID")'] = strtolower($key);
					$param['search'] = $search_col;
			}

										// Filters
			if ($filters != NULL) {
					$getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
					$search_col = array ();
					foreach ( $getFilter->rules as $row ) {
					$search_col [$row->field] = $row->data;
			}
					$param['search'] = $search_col;
			}

			$page = $pageOri == 1 ? 0 : $pageOri - 1;
			$showData = $rows;
			$getOffset = $page > 0 ? ($showData * $page)  : 0;

							//$param['id'] = "";
			$param['order'] = "asc";
			$param['order_column'] = "pesertaID";
			$param['limit'] = $showData.",".$getOffset;
			$param ['order'] = $orderType;
			$param ['order_column'] = $sortCol;
			$queryData =  $this->PesertaModel->showDataVlookPeserta($param)->result();
			$queryOriData =  $this->PesertaModel->showDataVlookPeserta()->result();

			foreach ($queryData as $row) {
							$col['pesertaID'] = $row->pesertaID;
							$col['nip_register'] = $row->nip_register;
							$col['nama_peserta'] = $row->nama_peserta;
							$col['alamat_rumah'] = $row->alamat_rumah;
							$col['nama_provinsi'] = $row->nama_provinsi;
							$col['nama_kabupaten'] = $row->nama_kabupaten;
							$col['id_kode'] = $id_kode;
							$getcol[] =$col;
			}

			$total  = count($queryOriData) != 0 ?  ceil(count($queryOriData) / (int)$showData)  : 0;
			$data['record'] = "1";
			$data['page'] = (int)$pageOri;
			$data['total'] =  $total;
			$data['rows'] = $getcol;

			exit($callback."(".json_encode($data).")");
		}

		function list_data_vlookup_perusahaan() {
					$rows = $this->input->get('rows');
					$pageOri = $this->input->get('page');
					$sortCol = $this->input->get ( 'sidx' );
					$orderType = $this->input->get ( 'sord' );
					$callback = $this->input->get ( 'callback' );
					$filters =$this->input->get ( 'filters' );
					$key =$this->input->get ( 'key' );
					$id_kode =$this->input->get ( 'id_kode' );

					if ($key != NULL) {
							$search_col ['lower("nama_perusahaan")'] = strtolower($key);
							$search_col ['lower("perusahaanID")'] = strtolower($key);
							$param['search'] = $search_col;
						}

							// Filters
					if ($filters != NULL) {
							$getFilter = json_decode ( urldecode ( urldecode ( $filters ) ) );
							$search_col = array ();
							foreach ( $getFilter->rules as $row ) {
								$search_col [$row->field] = $row->data;
							}
							$param['search'] = $search_col;
							}

							$page = $pageOri == 1 ? 0 : $pageOri - 1;
							$showData = $rows;
							$getOffset = $page > 0 ? ($showData * $page)  : 0;

							//$param['id'] = "";
							$param['order'] = "asc";
							$param['order_column'] = "perusahaanID";
							$param['limit'] = $showData.",".$getOffset;
							$param ['order'] = $orderType;
							$param ['order_column'] = $sortCol;
							$queryData =  $this->PesertaModel->showDataVlookPerusahaan($param)->result();
							$queryOriData =  $this->PesertaModel->showDataVlookPerusahaan()->result();

							foreach ($queryData as $row) {
								$col['perusahaanID'] = $row->perusahaanID;
								$col['kode'] = $row->kode;
								$col['nama_perusahaan'] = $row->nama_perusahaan;
								$col['alamat'] = $row->alamat;
								$col['nama_provinsi'] = $row->nama_provinsi;
								$col['nama_kabupaten'] = $row->nama_kabupaten;
								$col['id_kode'] = $id_kode;
								$getcol[] =$col;
							}

							$total  = count($queryOriData) != 0 ?  ceil(count($queryOriData) / (int)$showData)  : 0;
							$data['record'] = "1";
							$data['page'] = (int)$pageOri;
							$data['total'] =  $total;
							$data['rows'] = $getcol;

							exit($callback."(".json_encode($data).")");
						}

			function ambilDataPeserta() {
					$kode = $this->input->get('kode');
					$idfield = $this->input->get('idfield');
					$rate = $this->PesertaModel->getDataPeserta($kode)->result();
					$temp = $this->PesertaModel->getDataPeserta($kode)->row();

					$response ['pesertaID'] = $temp->pesertaID;
					$response ['nip_register'] = $temp->nip_register;
					// $response ['title1'] = $temp->title1;
					// $response ['title2'] = $temp->title2;
					$response ['nama_peserta'] = $temp->title1.''.$temp->nama_peserta.''.$temp->title2;
					$response ['alamat_rumah'] = $temp->alamat_rumah;
					$response ['telpon'] = $temp->telpon;
					$response ['nama_perusahaan'] = $temp->nama_perusahaan;
					$response ['no_registrasi'] = $temp->no_registrasi;
					// $response ['perusahaanID'] = $temp->perusahaanID;
					$response ['n'] = 'ss';
			 		$response ['m'] = 'Suksess';
					exit ( json_encode ( $response ) );
			}
}
