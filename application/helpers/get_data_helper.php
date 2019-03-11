<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_data($table, $nama_field, $where, $field_where) {
    $ci = get_instance();
    $get=$ci->db->get_where($table,array($field_where=>$where))->result();
    foreach ($get as $key) {
        return $key->$nama_field;
    }
}