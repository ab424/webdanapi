<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Transaksi_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_count_total_harga($id_transaksi)
    {
        $this->db->select_sum('P.harga');
        $this->db->select('P.*,T.*,K.*');
        $this->db->from('tb_transaksi AS T');
        $this->db->join('tb_item_transaksi AS K', 'T.id_transaksi = K.id_transaksi', 'left');
        $this->db->join('tb_produk AS P', 'K.id_produk = P.id_produk', 'left');
        $this->db->where('T.id_transaksi', $id_transaksi);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_count_transaksi()
    {
        $this->db->select('count(*) as allcount');
        $this->db->from('tb_transaksi');
        $this->db->where('status', 3);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0]['allcount'];
    }

    function get_data()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_rental', $_SESSION['id']);
        $this->db->where('status', 0);
        $this->db->or_where('status', 1);
        // $this->db->or_where('status', 2);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_proses()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_rental', $_SESSION['id']);
        $this->db->where('status', 2);
        $this->db->or_where('status', 4);
        $this->db->or_where('status', 5);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_batal()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_rental', $_SESSION['id']);
        $this->db->where('status', 6);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_selesai()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_rental', $_SESSION['id']);
        $this->db->where('status', 3);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_selesai_rental($idRental)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status', 3);
        $this->db->where('id_rental', $_SESSION['id']);
        if (isset($_POST['tgl_dari'])) {
            $kf = $_POST['tgl_dari'];
            $this->db->where('tgl_transaksi >=', $kf);
        }
        if (isset($_POST['tgl_sampai'])) {
            $kf = $_POST['tgl_sampai'];
            $this->db->where('tgl_transaksi <=', $kf);
        }
        // $this->db->where('id_rental', $idRental);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_transaksi($id)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_transaksi', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_transaksi_bymobil($id_mobil)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('id_mobil', $id_mobil);
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_detail_transaksi($id)
    {
        return $this->db->get_where('tb_transaksi', array('id_transaksi' => $id))->row_array();
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


    function get_data_laporan()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status', 3);
        $this->db->or_where('status', 4);
        if (isset($_POST['tgl_dari'])) {
            $kf = $_POST['tgl_dari'];
            $this->db->where('tgl_transaksi >=', $kf);
        }
        if (isset($_POST['tgl_sampai'])) {
            $kf = $_POST['tgl_sampai'];
            $this->db->where('tgl_transaksi <=', $kf);
        }
        $this->db->order_by('urutan', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_pengembalian()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status', 2);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_cancel()
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi');
        $this->db->where('status', 3);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_perbulan($month, $year)
    {
        $sql = "SELECT COUNT(id_transaksi) as y FROM tb_transaksi where month(tgl_transaksi) = $month AND year(tgl_transaksi) = $year AND status=4";
        $query = $this->db->query($sql);
        $data = $query->row_array();
        return $data;
    }

    function get_data_id($id)
    {
        return $this->db->get_where('tb_transaksi', array('id_transaksi' => $id))->row_array();
    }

    function add_transaksi($params)
    {
        $this->db->insert('tb_transaksi', $params);
        return $this->db->insert_id();
    }

    function add_transaksi_item($params)
    {
        $this->db->insert('tb_item_transaksi', $params);
        return $this->db->insert_id();
    }

    function get_data_retur()
    {
        $this->db->select('*');
        $this->db->from('tb_item_transaksi');
        $this->db->where('status', 1);
        $this->db->or_where('status', 2);
        $this->db->order_by('id_item', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_retur_by_id($idTransaksi)
    {
        $this->db->select('*');
        $this->db->from('tb_item_transaksi');
        $this->db->where('status', 2);
        $this->db->where('id_transaksi', $idTransaksi);
        $this->db->order_by('id_item', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_id_retur($id)
    {
        return $this->db->get_where('tb_retur', array('id_retur' => $id))->row_array();
    }

    function get_data_id_item($id)
    {
        return $this->db->get_where('tb_item_transaksi', array('id_retur' => $id))->row_array();
    }
}
