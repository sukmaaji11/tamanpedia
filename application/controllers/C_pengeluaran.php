<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pengeluaran extends CI_Controller
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
            $this->load->view('role2/pengeluaran.php', $data);
            $this->load->view('role2/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
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

    public function add()
    {
        $data = [
            'pengeluaran'   => $this->input->post('pengeluaran'),
            'pengeluaran_kategori'   => $this->input->post('kategori'),
            'pengeluaran_tgl'  => $this->input->post('tgl_pengeluaran'),
            'pengeluaran_jenis_barang' => $this->input->post('jenis_barang'),
            'pengeluaran_jumlah'  => $this->input->post('jumlah_barang'),
            'pengeluaran_harga_satuan' => $this->input->post('harga_satuan'),
            'pengeluaran_total' => $this->input->post('total'),
            'pengeluaran_keterangan' => $this->input->post('keterangan')
        ];
        
        $this->M_pengeluaran->add($data);
    }

    public function edit()
    {
        $pengeluaran_id = $this->input->post('pengeluaran_id');
        $data = [
            'username'  => $this->input->post('username'),
            'user_pin'  => $this->input->post('user_pin'),
            'user_role' => $this->input->post('user_role')
        ];

        $this->M_pengeluaran->edit($pengeluaran_id, $data);
    }

    public function delete()
    {
        $pengeluaran_id = $this->input->post('pengeluaran_id');
        $this->M_pengeluaran->delete($pengeluaran_id);
    }
}
