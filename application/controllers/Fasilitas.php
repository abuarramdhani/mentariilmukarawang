<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {

    private $role_user, $id_sekolah, $kondisi;
    private $nama_tabel = 'tbl_fasilitas';

    function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('id_user')) {
            redirect('Login');
        }
        else{            
            $id_user = $this->session->userdata('id_user');
            $this->role_user = $this->session->userdata('role_user');
            $this->id_sekolah = $this->session->userdata('id_sekolah');
        }        
        if ($this->role_user === '2') { 
            $kondisi = "AND ".$this->nama_tabel.".id_sekolah = '".$this->id_sekolah."'";
            $this->kondisi = $kondisi;
        }
        else{
            $this->kondisi = '';
        }
    }

	public function index()
	{
        $data['data_sekolah'] = $this->DataHandle->getAllWhere('tbl_sekolah', '*', "status = '1' AND id_sekolah != '0'");          
        $data['data_fasilitas'] = $this->DataHandle->other_query("SELECT tbl_sekolah.nama as nama_sekolah,".$this->nama_tabel.".* FROM ".$this->nama_tabel." INNER JOIN tbl_sekolah ON ".$this->nama_tabel.".id_sekolah = tbl_sekolah.id_sekolah WHERE tbl_fasilitas.`status` = '1' ".$this->kondisi." ");		
        $this->template->back_end('back_end/v_data_fasilitas', $data);
    }

    public function form_add()
    {
        $data['id_sekolah'] = $this->id_sekolah;
        $data['data_sekolah'] = $this->DataHandle->getAllWhere('tbl_sekolah', '*', "status = '1' AND id_sekolah != '0'");
        $this->template->back_end('back_end/v_add_fasilitas', $data);
    }

    public function add(){
        $this->load->library('upload'); //pemanggilan library upload
        $id_user = $this->session->userdata('id_user');
        $nama_fasilitas = $this->input->post('nama_fasilitas');
        $id_sekolah = $this->input->post('id_sekolah');

        // KONDISI GAMBAR ADA
        if ($_FILES['userfile']['name'] != NULL) {
            $dataInfo = array();
            $files = $_FILES;
            $_FILES['userfile']['name']= $files['userfile']['name'];
            $_FILES['userfile']['type']= $files['userfile']['type'];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
            $_FILES['userfile']['error']= $files['userfile']['error'];
            $_FILES['userfile']['size']= $files['userfile']['size']; 

            $this->upload->initialize($this->set_upload_options());
            if ($this->upload->do_upload()) {
                $dataInfo = $this->upload->data(); 
                if ($dataInfo['file_size'] > 1024) {
                    $this->resize($dataInfo['file_name']);

                }             
                // DATA INPUT FASILITAS
                $input_data = array(
                    'id_sekolah' => $id_sekolah,
                    'nama_fasilitas' => $nama_fasilitas,
                    'status' => 1,
                    'created_by' => $id_user,
                    'value' => $dataInfo['file_name']
                 );
                $this->DataHandle->insert('tbl_fasilitas', $input_data);    
  
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                    <i class="fa fa-check m-l-5"></i> Data Berhasil Ditambahkan ... 
                </div>');  
                redirect('Fasilitas');   

            }
            else{
                $this->session->set_flashdata('msg', '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                    <i class="fa fa-check m-l-5"></i> Gambar Bermasalah !!!!
                </div>');  

                redirect('Fasilitas');
            }
            
        }
        // KONDISI GAMBAR KOSONG
        else{
            // DATA INPUT ARTIKEL
            $input_data = array(
                'id_sekolah' => $id_sekolah,
                'nama_fasilitas' => $nama_fasilitas,
                'status' => 1,
                'created_by' => $id_user
             );
            $this->DataHandle->insert('tbl_fasilitas', $input_data); 
            $this->session->set_flashdata('msg', '
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                &times;</button>
                <i class="fa fa-check m-l-5"></i> Data Berhasil Ditambahkan ... 
            </div>');  
            redirect('Fasilitas');   
        }    
    }

    public function delete($id_fasilitas)
    {
        $id_user = $this->session->userdata('id_user');
        $data = array(
            'status' => '0',
            'updated_by' => $id_user
         );
        $where = array(
            'id_fasilitas' => $id_fasilitas
         );
        $this->DataHandle->edit('tbl_fasilitas', $data, $where);

        $this->session->set_flashdata('msg', '
        <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            &times;</button>
            <i class="fa fa-check m-l-5"></i> Data Berhasil Dihapus ... 
        </div>');  

        redirect('Fasilitas');     
    }

    public function get_data($id_fasilitas){
        $data['id_sekolah_sess'] = $this->id_sekolah;
        $data['data_sekolah'] = $this->DataHandle->getAllWhere('tbl_sekolah', '*', "status = '1' AND id_sekolah != '0'"); 
        $where = array(
            'id_fasilitas' => $id_fasilitas
         );
        $data['data_fasilitas'] = $this->DataHandle->other_query("SELECT tbl_sekolah.nama as nama_sekolah, tbl_fasilitas.id_fasilitas, tbl_sekolah.id_sekolah, tbl_fasilitas.nama_fasilitas,  tbl_fasilitas.`status`, tbl_fasilitas.`value` FROM tbl_fasilitas INNER JOIN tbl_sekolah ON tbl_fasilitas.id_sekolah = tbl_sekolah.id_sekolah WHERE tbl_fasilitas.`status` = '1' AND tbl_fasilitas.id_fasilitas ='".$id_fasilitas."'");
        $this->template->back_end('back_end/v_edit_fasilitas', $data);
    }

    public function edit(){
        $this->load->library('upload'); //pemanggilan library upload
        $id_user = $this->session->userdata('id_user');
        $nama_fasilitas = $this->input->post('nama_fasilitas');
        $id_sekolah = $this->input->post('id_sekolah'); 
        $id_fasilitas = $this->input->post('id_fasilitas');

        // KONDISI GAMBAR ADA
        if ($_FILES['userfile']['name'] != NULL) {
            $gambar_lama = $this->input->post('gambar_lama');
            $dataInfo = array();
            $files = $_FILES;
            $_FILES['userfile']['name']= $files['userfile']['name'];
            $_FILES['userfile']['type']= $files['userfile']['type'];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'];
            $_FILES['userfile']['error']= $files['userfile']['error'];
            $_FILES['userfile']['size']= $files['userfile']['size']; 

            $this->upload->initialize($this->set_upload_options());
            if ($this->upload->do_upload()) {
                $dataInfo = $this->upload->data(); 

                // JIKA GAMBAR TIDAK ADA
                if ($gambar_lama == "") { 
                    if ($dataInfo['file_size'] > 1024) {
                        $this->resize($dataInfo['file_name']);

                    }             
                    // DATA EDIT FASILITAS
                    $edit_data = array(
                        'id_sekolah' => $id_sekolah,
                        'value' => $dataInfo['file_name'],
                        'nama_fasilitas' => $nama_fasilitas,
                        'updated_by' => $id_user
                     );
                    $where = array(
                        'id_fasilitas' => $id_fasilitas
                     );
                    $this->DataHandle->edit('tbl_fasilitas', $edit_data, $where);
                }
                // JIKA GAMBAR ADA
                else{
                    if ($dataInfo['file_size'] > 1024) {
                        $this->resize($dataInfo['file_name']);

                    }             
                    // DATA EDIT FASILITAS
                    $edit_data = array(
                        'id_sekolah' => $id_sekolah,
                        'value' => $dataInfo['file_name'],
                        'nama_fasilitas' => $nama_fasilitas,
                        'updated_by' => $id_user
                     );
                    $where = array(
                        'id_fasilitas' => $id_fasilitas
                     );
                    $this->DataHandle->edit('tbl_fasilitas', $edit_data, $where);
                }   
                // HAPUS GAMBAR LAMA   
                $this->session->set_flashdata('msg', '
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                <i class="fa fa-check m-l-5"></i> Data Berhasil Perbaharui ... 
                </div>');  
                redirect('Fasilitas');   

            }
            else{
                $this->session->set_flashdata('msg', '
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                    <i class="fa fa-check m-l-5"></i> Gambar Bermasalah !!!!
                </div>');  

                redirect('Fasilitas'); 
            }
            
        }
        // KONDISI GAMBAR KOSONG
        else{
            // DATA EDIT Fasilitas
        $edit_data = array(
            'id_sekolah' => $id_sekolah,
            'nama_fasilitas' => $nama_fasilitas,
            'updated_by' => $id_user
         );
        $where = array(
            'id_fasilitas' => $id_fasilitas
         );
        $this->DataHandle->edit('tbl_fasilitas', $edit_data, $where);

        $this->session->set_flashdata('msg', '
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            &times;</button>
            <i class="fa fa-check m-l-5"></i> Data Berhasil Diperbaharui ... 
        </div>');  

        redirect('Fasilitas'); 
        }
    }    

    private function set_upload_options(){
        $config['upload_path'] = './assets/plugins/images/image';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
        $config['max_size'] = 0;
        $config['encrypt_name'] = TRUE;
        $config['overwrite']     = FALSE;

        return $config;        
    }
    private function resize($nama_file_baru){
        $this->load->library('image_lib');

        $conf['image_library']='gd2';
        $conf['source_image']='./assets/plugins/images/image/'.$nama_file_baru;
        $conf['create_thumb']= FALSE;
        $conf['maintain_ratio']= TRUE;
        $conf['quality']= '60%';
        $conf['width']= 1200;
        $conf['height']= 900;
        $conf['new_image']= './assets/plugins/images/image/'.$nama_file_baru;

        $this->image_lib->clear();
        $this->image_lib->initialize($conf);
        $this->image_lib->resize();

    }
}
