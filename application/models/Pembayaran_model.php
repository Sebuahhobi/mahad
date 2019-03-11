<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{

    public $table = 'pembayaran';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
    $this->db->or_like('jumlah_pembayaran', $q);
    $this->db->or_like('operator', $q);
    $this->db->or_like('tgl_hari_ini', $q);
    $this->db->or_like('tgl_pembayaran', $q);
    $this->db->or_like('id_mhs', $q);
    $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
    $this->db->or_like('jumlah_pembayaran', $q);
    $this->db->or_like('operator', $q);
    $this->db->or_like('tgl_hari_ini', $q);
    $this->db->or_like('tgl_pembayaran', $q);
    $this->db->or_like('id_mhs', $q);
    $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function get_data_mhs_by_id($id_mhs){
        return $this->db->get_where('daftar_mhs',array('id'=>$id_mhs))->result();
    }

    function get_kamar_mhs_ikhwan_by_id($id_kamar){
        return $this->db->get_where('kamar_ikhwan',array('id'=>$id_kamar))->result();
    }

    function get_kamar_mhs_akhwat_by_id($id_kamar){
        return $this->db->get_where('kamar_ikhwan',array('id'=>$id_kamar))->result();
    }

    function get_npm($npm){
        $this->db->get_where('daftar_mhs',array('npm'=>$npm));
        return $this->db->count_all_results();
    }

    //range 2018
    function januari($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-01-01');
        $this->db->where('tgl_pembayaran <=', '2018-01-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln1=$this->db->get('pembayaran');
        foreach ($bln1->result() as $januari1) {
            return $januari1->tgl;
        }
    }
    function februari($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-02-01');
        $this->db->where('tgl_pembayaran <=', '2018-02-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function maret($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-03-01');
        $this->db->where('tgl_pembayaran <=', '2018-03-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function april($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-04-01');
        $this->db->where('tgl_pembayaran <=', '2018-04-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function mei($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-05-01');
        $this->db->where('tgl_pembayaran <=', '2018-05-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function juni($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-06-01');
        $this->db->where('tgl_pembayaran <=', '2018-06-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function juli($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-07-01');
        $this->db->where('tgl_pembayaran <=', '2018-07-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function agustus($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-08-01');
        $this->db->where('tgl_pembayaran <=', '2018-08-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function september($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-09-01');
        $this->db->where('tgl_pembayaran <=', '2018-09-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function oktober($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-10-01');
        $this->db->where('tgl_pembayaran <=', '2018-10-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function november($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-11-01');
        $this->db->where('tgl_pembayaran <=', '2018-11-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }
    function desember($id_mhs){
        $this->db->select('count(*) as tgl');
        $this->db->where('tgl_pembayaran >=', '2018-12-01');
        $this->db->where('tgl_pembayaran <=', '2018-12-31');
        $this->db->where('id_mhs',$id_mhs);
        $bln=$this->db->get('pembayaran')->result();
        foreach ($bln as $key) {
            return $key->tgl;
        }
    }

    function get_innodb($id_mhs){
        return $this->db->get_where('pembayaran',array('id_mhs'=>$id_mhs))->result();
    }
}
