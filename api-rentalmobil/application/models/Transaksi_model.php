<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Transaksi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_count_transaksi($id)
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('tb_item_transaksi');
        $this->db->where('id_transaksi', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    function get_data($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_user', $id_user);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_byidmobil($idMobil)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_mobil', $idMobil);
        $this->db->where('status', 2);
        $this->db->or_where('status', 4);
        $query = $this->db->get();
        return $query->row_array();
    }

    function get_data_transaksi_produk($id_pinjam)
    {
        $this->db->select('*');
        $this->db->from('tb_item_transaksi');
        $this->db->where('id_transaksi', $id_pinjam);
        $this->db->order_by('id_item', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_detail_perpanjang($id)
    {
        $this->db->select('*');
        $this->db->from('tb_perpanjangan');
        $this->db->where('id_transaksi', $id);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->row_array();
        // return $this->db->get_where('tb_transaksi', array('id_transaksi' => $id))->row_array();
    }

    function get_data_detail_transaksi($id)
    {
        return $this->db->get_where('tb_transaksi', array('id_transaksi' => $id))->row_array();
    }

    public function add_transaksi($params)
    {
        return $this->db->insert('tb_transaksi', $params);
    }

    public function add_transaksi_perpanjang($params)
    {
        return $this->db->insert('tb_perpanjangan', $params);
    }

    function get_data_id($id)
    {
        return $this->db->get_where('tb_transaksi', array('id_transaksi' => $id))->row_array();
    }
}
