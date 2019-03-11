<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mhs_kamar_model extends CI_Model
{

    public $table = 'mhs_kamar_ikhwan';
    public $table2 = 'mhs_kamar_akhwat';
    public $id = 'id';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    // get data by id mhs
    function get_by_id_mhs($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('id_kamar', $q);
	$this->db->or_like('id_mhs', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('id_kamar', $q);
	$this->db->or_like('id_mhs', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert_ikhwan($data)
    {
        $this->db->insert($this->table, $data);
    }
    function insert_akhwat($data)
    {
        $this->db->insert($this->table2, $data);
    }

    // update data
    function update_ikhwan($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }
    function update_akhwat($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table2, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}