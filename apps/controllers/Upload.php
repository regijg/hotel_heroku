<?php

class Upload extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->helper(array('form', 'url'));
            $this->load->model('UserModel','',TRUE);
        }

        public function index(){
                $this->load->tpl('v_upload', array('error' => ' ' ));
        }

        public function do_upload(){
            $config['upload_path']          = './tpl/sb-admin/user-image/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('photo_file')){
                $error = array('error' => $this->upload->display_errors());

                // $this->load->tpl('v_upload', $error);
            }else{
                $data = array('upload_data' => $this->upload->data());

                // $this->load->tpl('v_upload', $data);
            }
        }

        // public function do_upload(){
        //     if (!$this->UserModel->do_upload('photo_file')) {
        //       $photo_file = '';
        //     }else {
        //       // $uploadData = $this->upload->data();
        //       // $photo_file = $uploadData['file_name'];
        //       //
        //       // $this->load->tpl('v_upload', $photo_file);
        //       $data = array('upload_data' => $this->upload->data());
        //       $this->load->tpl('v_upload', $data);
        //     }
        // }
}
