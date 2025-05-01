<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_user extends CI_Controller
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

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_user');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        if ($this->session->userdata('user_role') == 1) {
            $this->load->view('role1/template/header.php', $data);
            $this->load->view('role1/template/sidebar.php', $data);
            $this->load->view('role1/template/topbar.php', $data);
            $this->load->view('role1/user.php', $data);
            $this->load->view('role1/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
    }

    public function get_data()
    {
        $data = $this->M_user->get_data();
        echo json_encode($data, true);
    }

    public function get_data_by_id()
    {
        $user_id = $this->input->post('user_id');
        $data = $this->M_user->get_data_by_id($user_id);
        echo json_encode($data, true);
    }

    public function add()
    {
        $data = [
            'user_id'   => $this->input->post('user_id'),
            'username'  => $this->input->post('username'),
            'user_pin'  => $this->input->post('user_pin'),
            'user_role' => $this->input->post('user_role')
        ];

        $this->M_user->add($data);

        redirect('user');
    }

    public function edit()
    {
        $user_id = $this->input->post('user_id');
        $data = [
            'username'  => $this->input->post('username'),
            'user_pin'  => $this->input->post('user_pin'),
            'user_role' => $this->input->post('user_role')
        ];

        $this->M_user->edit($user_id, $data);
    }

    public function delete()
    {
        $user_id = $this->input->post('user_id');
        $this->M_user->delete($user_id);
    }
}
