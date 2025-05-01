<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_app extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_kategori');
    }

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
        if ($this->session->userdata('user_role') == 2) {
            $data['kategori'] = json_decode(json_encode($this->M_kategori->get_data(), true));
            $this->load->view('role2/template/header.php', $data);
            $this->load->view('role2/template/sidebar.php', $data);
            $this->load->view('role2/template/topbar.php', $data);
            $this->load->view('role2/index.php', $data);
            $this->load->view('role2/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
    }

    //Kategori
    public function kategori()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        if ($this->session->userdata('user_role') == 2) {
            $this->load->view('role2/template/header.php', $data);
            $this->load->view('role2/template/sidebar.php', $data);
            $this->load->view('role2/template/topbar.php', $data);
            $this->load->view('role2/kategori.php', $data);
            $this->load->view('role2/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
    }

    public function get_data_kategori()
    {
        $data = $this->M_kategori->get_data();
        echo json_encode($data, true);
    }

    public function get_data_by_id_kategori()
    {
        $kategori_id = $this->input->post('kategori_id');
        $data = $this->M_kategori->get_data_by_id($kategori_id);
        echo json_encode($data, true);
    }

    public function add_kategori()
    {
        $data = [
            'kategori_id'   => $this->input->post('kategori_id'),
            'kategori'  => $this->input->post('kategori'),
            'kategori_role' => $this->input->post('kategori_role'),
        ];

        $this->M_kategori->add($data);

        redirect('app/kategori');
    }

    public function edit_kategori()
    {
        $kategori_id = $this->input->post('kategori_id');
        $data = [
            'kategori_id'   => $this->input->post('kategori_id'),
            'kategori'  => $this->input->post('kategori'),
        ];

        $this->M_kategori->edit($kategori_id, $data);
    }

    public function delete_kategori()
    {
        $kategori_id = $this->input->post('kategori_id');
        $this->M_kategori->delete($kategori_id);
    }
}
