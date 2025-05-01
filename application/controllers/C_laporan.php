<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_laporan extends CI_Controller
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
        $this->load->model('M_pengeluaran');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        if ($this->session->userdata('user_role') == 2) {
            $this->load->view('role2/template/header.php', $data);
            $this->load->view('role2/template/sidebar.php', $data);
            $this->load->view('role2/template/topbar.php', $data);
            $this->load->view('role2/laporan.php', $data);
            $this->load->view('role2/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
    }

    public function preview()
    {
        $data = [
            'month' => $this->uri->segment(3),
            'year' => $this->uri->segment(4),
        ];

        $this->load->view('preview.php', $data);
    }

    public function get_data()
    {
        $data = $this->M_pengeluaran->get_data();
        echo json_encode($data, true);
    }

    public function get_data_by_id()
    {
        $pengeluaran_id = $this->input->post('pengeluaran_id');
        $data = $this->M_pengeluaran->get_data_by_id($pengeluaran_id);
        echo json_encode($data, true);
    }

    public function get_data_by_date()
    {
        $from = $this->input->post('datefrom');
        $to = $this->input->post('dateto');
        $data = $this->M_pengeluaran->get_data_by_date($from, $to);
        echo json_encode($data, true);
    }
}
