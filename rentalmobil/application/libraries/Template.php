<?php if (!defined('BASEPATH')) exit ('No Direct Script Access Alowed');

class template{
    
    protected $_ci;
    function __construct() {
        
        $this->_ci=&get_instance();
    }
    
    function display($template, $data=NULL){
        $data['_content'] = $this->_ci->load->view($template, $data, TRUE);
        $data['_header'] = $this->_ci->load->view('/admin/header', $data, TRUE);
        $data['_menu'] = $this->_ci->load->view('/admin/menu', $data, TRUE);
        $data['_footer'] = $this->_ci->load->view('/admin/footer', $data, TRUE);
        $this->_ci->load->view('/admin/vutama.php',$data, TRUE);
    }
    
}
