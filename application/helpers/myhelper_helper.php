<?php
//menu super admin
function menu_cmb($name, $table, $field, $pk, $selected) {
    $ci = get_instance();
    $ci->db->order_by('judul','ASC');
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get_where($table,array('isparent'=>0))->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//menu admin
function cmb_dinamis($name, $table, $field, $pk, $selected) {
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$pk . "'";
        $cmb .= $selected == $d->$pk ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function fakultas($name, $table, $field, $id, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='$name' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
//jurusan
function jurusan($name, $table, $field, $id, $selected, $id_fak) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='$name' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get_where($table,array('id_fakultas'=>$id_fak))->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function provinsi($name, $table, $field, $pk_prov, $selected) {
    $ci = get_instance();
    $cmb = "<select id='provinsi' name='provinsi' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by('name','ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$pk_prov . "'";
        $cmb .= $selected == $d->$pk_prov ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
//kab
function kabupaten($name, $table, $field, $selected, $id, $id_prov) {
    $ci = get_instance();
    $cmb = "<select id='kab' name='kab' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by('name','ASC');
    $data = $ci->db->get_where($table,array('province_id'=>$id_prov))->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//kec
function kecamatan($name, $table, $field, $selected, $id, $id_kab) {
    $ci = get_instance();
    $cmb = "<select id='kec' name='kec' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by('name','ASC');
    $data = $ci->db->get_where($table,array('regency_id'=>$id_kab))->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
//desa
function deso($name, $table, $field, $selected, $id, $id_kec) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='$name' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by('name','ASC');
    $data = $ci->db->get_where($table,array('district_id'=>$id_kec))->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//kamar
function kamar_ikhwan($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='kamar' name='kamar' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by('kamar','ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$field . "'";
        $cmb .= $selected == $d->$field ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}
function kamar_akhwat($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='kamar' name='kamar' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    //$ci->db->order_by($name,'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id_kamar . "'";
        $cmb .= $selected == $d->$id_kamar ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//kondisi kamar
function kondisi($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='kondisi[]' class='select2_multiple form-control' multiple='multiple'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get_where($table)->result();
    foreach ($data as $d) {

        $cmb .="<option value='" . $d->$field . "'";
        //$cmb .=set_select('perlengkapan', $d->$field);
        $cmb .= $selected == $d->$field ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function kondisi_update($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='kondisi[]' class='select2_multiple form-control' multiple='multiple'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get_where($table)->result();
    foreach ($data as $d) {

        $cmb .="<option value='" . $d->$field . "'";

        if(empty($selected)){
            $select='';
        }else{
            $select=in_array($d->$field, $selected) ? " selected='selected'" : '';
        }

        $cmb .= $select;
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//kelengkapan kamar
function kelengkapan($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='perlengkapan[]' class='select2_multiple form-control' multiple='multiple'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$field . "'";
        //$cmb .=set_select('perlengkapan', $d->$field);
        $cmb .= $selected == $d->$field ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

function kelengkapan_update($name, $table, $field, $id_kamar, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='perlengkapan[]' class='select2_multiple form-control' multiple='multiple'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$field . "'";

        if(empty($selected)){
            $select='';
        }else{
            $select=in_array($d->$field, $selected) ? " selected='selected'" : '';
        }

        $cmb .= $select;
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//semester
function semester($name, $table, $field, $id, $selected) {
    $ci = get_instance();
    $cmb = "<select id='$name' name='$name' class='form-control'>";    
    $cmb .= "<option value=''>--Pilih--</option>";
    $ci->db->order_by($field,'ASC');
    $data = $ci->db->get($table)->result();
    foreach ($data as $d) {
        $cmb .="<option value='" . $d->$id . "'";
        $cmb .= $selected == $d->$id ? " selected='selected'" : '';
        $cmb .=">" . strtoupper($d->$field) . "</option>";
    }
    $cmb .="</select>";
    return $cmb;
}

//hobi
function bahasa($name, $selected) {/*
       
    $data = array('Arab','Inggris');
    foreach ($data as $d) {
        $cmb = "<input type='checkbox' id='$name' name='$name' class='flat'"; 
        $cmb .="value='" . $d . "'";
        $cmb .= $selected == $d ? " checked='checked'" : '';
        $cmb .=">"
    }
    return $cmb;*/
}
//
function waktu() {
    date_default_timezone_set('Asia/Jakarta');
    return date("Y-m-d H:i:s");
}

function chek_login() {
    $ci = get_instance();
    $ci->load->library(array('ion_auth'));
    if (!$ci->ion_auth->logged_in()) {
        redirect('auth/login');
    }
}

//admin
function cek_admin(){
    $ci = get_instance();
    $ci->load->library(array('ion_auth'));
    if (!$ci->ion_auth->is_admin()){
	return show_error('You must be an administrator to view this page.');
    }
}

//super admin
function cek_super_admin() {
    $ci = get_instance();
    $ci->load->library(array('ion_auth'));
    if (!$ci->ion_auth->is_super_admin()){
	return show_error('You must be an super administrator to view this page.');
    }
}

//date
    function tgl_indo($tanggal){
                $bulan = array (
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                );
                $pecahkan = explode('-', $tanggal);
                
                // variabel pecahkan 0 = tanggal
                // variabel pecahkan 1 = bulan
                // variabel pecahkan 2 = tahun
             
                return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

//cari bulan
function cari_bulan($tgl, $id_mhs){
    $ci = get_instance();
    if($tgl=='1')
        return $cari=$ci->Pembayaran_model->januari($id_mhs);
    elseif($tgl=='2')
        return $cari=$ci->Pembayaran_model->februari($id_mhs);
    elseif($tgl=='3')
        return $cari=$ci->Pembayaran_model->maret($id_mhs);
    elseif($tgl=='4')
        return $cari=$ci->Pembayaran_model->april($id_mhs);
    elseif($tgl=='5')
        return $cari=$ci->Pembayaran_model->mei($id_mhs);
    elseif($tgl=='6')
        return $cari=$ci->Pembayaran_model->juni($id_mhs);
    elseif($tgl=='7')
        return $cari=$ci->Pembayaran_model->juli($id_mhs);
    elseif($tgl=='8')
        return $cari=$ci->Pembayaran_model->agustus($id_mhs);
    elseif($tgl=='9')
        return $cari=$ci->Pembayaran_model->september($id_mhs);
    elseif($tgl=='10')
        return $cari=$ci->Pembayaran_model->oktober($id_mhs);
    elseif($tgl=='11')
        return $cari=$ci->Pembayaran_model->november($id_mhs);
    elseif($tgl=='12')
        return $cari=$ci->Pembayaran_model->desember($id_mhs);
        
}