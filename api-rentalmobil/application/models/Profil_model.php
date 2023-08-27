<?php if (!defined('BASEPATH')) exit('No Direct Script Access Allowed');

class Profil_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function get_profil_id($id_user)
    {
        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->where('id', $id_user);

        $query = $this->db->get();
        return $query->row_array();
    }
}
