<?php

Class Select extends CI_Controller

{


function __construct(){

parent::__construct();

$this->load->database();

$this->load->helper(array('url'));

$this->load->model('model_select');


}


function index(){


$data['provinsi']=$this->model_select->provinsi();

//$this->load->view('testing',$data);
$this->template->load('template','testing',$data);

}

    function ambil_data(){

        $modul=$this->input->post('modul');
        $id=$this->input->post('id');

        if($modul=="kabupaten"){
            echo $this->model_select->kabupaten($id);
        }
        else if($modul=="kecamatan"){
            echo $this->model_select->kecamatan($id);
        }
        else if($modul=="kelurahan"){
            echo $this->model_select->kelurahan($id);
        }
        //jurusan
        elseif($modul=="jurusan"){
            echo $this->model_select->jurusan($id);
        }
        //kamar
        elseif($modul=="kamar_ikhwan"){
            echo $this->model_select->kamar_ikhwan();
        }
        elseif($modul=="kamar_akhwat"){
            echo $this->model_select->kamar_akhwat();
        }

        elseif($modul=="ikhwan"){
            echo $this->model_select->cek_npm($id);
        }
    }

    function session()
    {
        $this->session->set_flashdata('pembayaran', $_POST['pembayaran']);
    }
}
