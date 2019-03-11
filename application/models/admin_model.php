<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin_model extends CI_Model
{

    public $table = 'daftar_mhs';
    public $id = 'id';
    public $data_orang_tua = 'data_orang_tua';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function list_mhs(){
        $this->db->order_by('daftar_mhs.id', $this->order);
        return $this->db->get(array('daftar_mhs','data_orang_tua','fakultas','jurusan'))->result();
        //return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    //get by kamar
    function get_by_kamar($kamar)
    {
        $this->db->where($this->kamar, $kamar);
        return $this->db->get($this->table)->row();
    }
        
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('npm', $q);
	$this->db->or_like('fakultas', $q);
	$this->db->or_like('jurusan', $q);
	$this->db->or_like('semester', $q);
	$this->db->or_like('kamar', $q);
	$this->db->or_like('operator', $q);
	$this->db->or_like('noHP', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('nama', $q);
	$this->db->or_like('npm', $q);
	$this->db->or_like('fakultas', $q);
	$this->db->or_like('jurusan', $q);
	$this->db->or_like('semester', $q);
	$this->db->or_like('kamar', $q);
	$this->db->or_like('operator', $q);
	$this->db->or_like('noHP', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert_mhs($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update_mhs($id, $data)
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
    
 //function chain_ajax model_select

}
