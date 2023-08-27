<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');
define("LOKASI_DOKUMEN", 'uploads/dokumen/');

class Laporan_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_data($id)
    {
        $this->db->select('*');
        $this->db->from('tb_laporan');
        $this->db->where('jenis_laporan', $id);
        $this->db->order_by('id_laporan', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_data_id($id)
    {
        return $this->db->get_where('tb_laporan', array('id_laporan' => $id))->row_array();
    }

    function add_dokumen($params)
    {
        $filename = $_FILES['file']['name'];
        $extensionList = array("pdf");
        $sliceName = explode(".", $filename);

        if (in_array($sliceName[1], $extensionList)) {
            $name = str_replace("-", "", $this->uuid->v4());
            $params['file'] = $name . "." . $sliceName[1];

            $this->upload_dokumen_file($name . "." . $sliceName[1], LOKASI_DOKUMEN, "file");

            $this->db->insert('tb_laporan', $params);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function update_dokumen($id, $params)
    {
        $filename = $_FILES['file']['name'];
        if (!empty($filename)) {
            $extensionList = array("pdf");
            $sliceName = explode(".", $filename);

            if (in_array($sliceName[1], $extensionList)) {
                $rowp = $this->db->get_where('tb_laporan', array('id_laporan' => $id))->row_array();

                $name = str_replace("-", "", $this->uuid->v4());
                $params['file'] = $name . "." . $sliceName[1];

                $this->update_dokumen_file($name . "." . $sliceName[1], $rowp['file'], LOKASI_DOKUMEN, "file");
                $this->db->where('id_laporan', $id);
                return $this->db->update('tb_laporan', $params);
            } else {
                return false;
            }
        } else {
            $this->db->where('id_laporan', $id);
            return $this->db->update('tb_laporan', $params);
        }
    }

    function delete_dokumen($id)
    {
        $rowp = $this->db->get_where('tb_laporan', array('id_laporan' => $id))->row_array();
        $this->delete_dokumen_file($rowp['file'], LOKASI_DOKUMEN);
        return $this->db->delete('tb_laporan', array('id_laporan' => $id));
    }

    function upload_dokumen_file($fupload_name, $lokasi, $filename)
    {

        $vfile_upload = $lokasi . $fupload_name;
        move_uploaded_file($_FILES[$filename]["tmp_name"], $vfile_upload);
    }

    function update_dokumen_file($fupload_name, $old_dokumen = "", $lokasi, $filename)
    {
        $vfile_upload = $lokasi . $fupload_name;
        move_uploaded_file($_FILES[$filename]["tmp_name"], $vfile_upload);
        unlink($lokasi . $old_dokumen);
    }

    function delete_dokumen_file($old_dokumen = "", $lokasi)
    {
        unlink($lokasi . $old_dokumen);
    }
}
