<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class MobilRental_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data_count_mobil()
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('tb_mobil');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    function get_data_count($idRental)
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('tb_mobil');
        $this->db->where('id_rental', $idRental);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    function get_data()
    {
        $this->db->select('*');
        $this->db->from('tb_mobil');
        $this->db->order_by('id_mobil', 'asc');
        $this->db->where('id_rental', $_SESSION['id']);
        if (isset($_SESSION['search'])) {
            $kf = $_SESSION['search'];
            $this->db->like('nama_mobil', $kf);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_mobil_byrental($idRental)
    {
        $this->db->select('*');
        $this->db->from('tb_mobil');
        $this->db->where('id_rental', $idRental);
        $this->db->order_by('id_mobil', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_id($id)
    {
        return $this->db->get_where('tb_mobil', array('id_mobil' => $id))->row_array();
    }

    function add_mobil($params)
    {
        $this->db->insert('tb_mobil', $params);
        return $this->db->insert_id();
    }

    function delete_admin($id)
    {
        return $this->db->delete('tb_administrator', array('id' => $id));
    }
}
