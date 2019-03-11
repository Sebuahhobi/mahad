<?php

Class Model_select extends CI_Model
{

function __construct(){

parent::__construct();

}


function provinsi(){
    $this->db->order_by('name','ASC');
    $provinces= $this->db->get('provinces');
return $provinces->result_array();
}


function kabupaten($provId){

$kabupaten="<option value='0'>--Pilih--</pilih>";

$this->db->order_by('name','ASC');
$kab= $this->db->get_where('regencies',array('province_id'=>$provId));

foreach ($kab->result_array() as $data ){
$kabupaten.= "<option value='$data[id]'>$data[name]</option>";
}

return $kabupaten;

}

function kecamatan($kabId){
$kecamatan="<option value='0'>--Pilih--</pilih>";

$this->db->order_by('name','ASC');
$kec= $this->db->get_where('districts',array('regency_id'=>$kabId));

foreach ($kec->result_array() as $data ){
$kecamatan.= "<option value='$data[id]'>$data[name]</option>";
}

return $kecamatan;
}

    function kelurahan($kecId){
        $this->db->order_by('name','ASC');
        $kelurahan= $this->db->get_where('villages',array('district_id'=>$kecId));
        $kel .="<option value='0'>--Pilih--</pilih>";
        foreach ($kelurahan->result_array() as $data ){
            $kel.= "<option value='$data[id]'>$data[name]</option>";
        }
    return $kel;
    }
    
    function fakultas(){
        $this->db->order_by('nama_fakultas','ASC');
        $fak= $this->db->get('fakultas');
    return $fak->result_array();
    }
    
    function jurusan($fakId){
        $this->db->order_by('nama_jurusan','ASC');
        $jur= $this->db->get_where('jurusan',array('id_fakultas'=>$fakId));
        $jurusan="<option value='0'>--Pilih--</pilih>";
        foreach ($jur->result_array() as $data ){
            $jur1.= "<option value='$data[id]'>".strtoupper($data[nama_jurusan])."</option>";
        }
    return $jur1;
    }
    
    function kamar_akhwat(){
        $kamar="<option value='0'>--pilih--</pilih>";

        $this->db->order_by('id','ASC');
        $jur= $this->db->get_where('kamar_akhwat',array('status'=> 't_p'));

        foreach ($jur->result_array() as $data ){
            $kamar.= "<option value='$data[id]'>$data[kamar]</option>";
        }
    return $kamar;
    }
    function kamar_ikhwan(){
        $kamar="<option value='0'>--pilih--</pilih>";

        $this->db->order_by('kamar','ASC');
        $jur= $this->db->get_where('kamar_ikhwan',array('status'=> 't_p'));
        foreach ($jur->result_array() as $data ){
            $kamar.= "<option value='$data[id]'";
            $kamar.= $data[$id] ? " selected='selected'" : '';
            $kamar.= ">".$data[kamar]."</option>";
        }
    return $kamar;
    }

    function cek_npm($npm){
        //cari banyak kamar
        $this->db->select('isi_max, j_k');
        $this->db->from('mhs_kamar_ikhwan');
        $this->db->join('daftar_mhs', 'daftar_mhs.id=mhs_kamar_ikhwan.id_mhs');
        $this->db->join('kamar_ikhwan', 'mhs_kamar_ikhwan.id_kamar=kamar_ikhwan.id');
        $this->db->where('npm',$npm);
        $cek=$this->db->get()->result();
        foreach ($cek as $key) {
              $key1=$key->isi_max;
        }

        //cari harga
        $this->db->select('harga');
        $this->db->from('set_pembayaran');
        $this->db->where('banyak_mhs', $key1);
        $this->db->where('j_k', $key->j_k);
        $harga=$this->db->get()->result();
        foreach ($harga as $bayar) {
            
        }
          return $bayar->harga;
    }

}