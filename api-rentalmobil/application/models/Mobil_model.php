<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Mobil_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_count_mobilbyrental($idRental)
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('tb_mobil');
        $this->db->where('id_rental', $idRental);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    // function get_produk_filter($ids, $nama, $kategori)
    // {
    //     $new = str_replace('%20', ' ', $nama);

    //     $this->db->select('P.*,K.*,S.*');
    //     $this->db->from('tb_produk AS P');
    //     $this->db->join('tb_kategori AS K', 'P.id_kategori = K.id_kategori', 'left');
    //     $this->db->join('tb_satuan AS S', 'P.id_satuan = S.id_satuan', 'left');
    //     $this->db->order_by('P.id_produk', 'desc');

    //     if ($ids == "1") {
    //         // $this->db->like('B.judul_buku', $new);
    //         // $this->db->where('B.kategori', $kategori);
    //     } else if ($ids == "2") {
    //         $this->db->like('P.nama_produk', $new);
    //         $this->db->where('P.id_kategori', $kategori);
    //     } else if ($ids == "3") {
    //         $this->db->like('P.nama_produk', $new);
    //     }


    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    function get_mobil_search($nama)
    {
        $new = str_replace('%20', ' ', $nama);

        $this->db->select('M.*,R.*');
        $this->db->from('tb_mobil AS M');
        $this->db->join('tb_rental AS R', 'M.id_rental = R.id', 'left');
        $this->db->order_by('M.id_mobil', 'desc');

        $this->db->like('M.nama_mobil', $new);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_rental_mobil($id_rental)
    {
        $this->db->select('M.*,R.*');
        $this->db->from('tb_mobil AS M');
        $this->db->join('tb_rental AS R', 'M.id_rental = R.id', 'left');
        $this->db->where('M.id_rental', $id_rental);
        $this->db->order_by('M.id_mobil', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_rental()
    {
        $this->db->select('*');
        $this->db->from('tb_rental');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }


    function get_rental_detail($id_rental)
    {
        $this->db->select('*');
        $this->db->from('tb_rental');
        $this->db->where('id', $id_rental);

        $query = $this->db->get();
        return $query->row_array();

        // return $this->db->get_where('tb_produk', array('id_produk' => $id))->row_array();
    }

    function get_data_id($id)
    {
        $this->db->select('M.*,R.*');
        $this->db->from('tb_mobil AS M');
        $this->db->join('tb_rental AS R', 'M.id_rental = R.id', 'left');
        $this->db->where('M.id_mobil', $id);

        $query = $this->db->get();
        return $query->row_array();

        // return $this->db->get_where('tb_produk', array('id_produk' => $id))->row_array();
    }

    function get_data_ids($id)
    {
        return $this->db->get_where('tb_mobil', array('id_mobil' => $id))->row_array();
    }
}
