<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Kategori_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_kategori()
    {
        $this->db->select('*');
        $this->db->from('tb_kategori');
        $this->db->order_by('id_kategori', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_peminjaman($params)
    {
        return $this->db->insert('tb_peminjaman', $params);
    }

    function get_data_id($id)
    {
        return $this->db->get_where('tb_kategori', array('id_kategori' => $id))->row_array();
    }

    function get_data_satuan_id($id)
    {
        return $this->db->get_where('tb_satuan', array('id_satuan' => $id))->row_array();
    }
}
