<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_gallery extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */
    public function index()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        if ($this->session->userdata('user_role') == 1) {
            $this->load->view('role1/template/header.php', $data);
            $this->load->view('role1/template/sidebar.php', $data);
            $this->load->view('role1/template/topbar.php', $data);
            $this->load->view('role1/gallery.php', $data);
            $this->load->view('role1/template/footer.php', $data);
        } else {
            redirect('404.php');
        }
    }
}
