<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_pemasukan extends CI_Controller
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
        $this->load->model('M_pemasukan');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        $data['kategori'] = $this->db->get_where('tb_kategori', array('kategori_role =' => 1))->result();
        if ($this->session->userdata('user_role') == 2) {
            $this->load->view('role2/template/header.php', $data);
            $this->load->view('role2/template/sidebar.php', $data);
            $this->load->view('role2/template/topbar.php', $data);
            $this->load->view('role2/pemasukan.php', $data);
            $this->load->view('role2/template/footer.php', $data);
        } else {
            $this->load->view('404.php');
        }
    }

    public function get_data()
    {
        $data = $this->M_pemasukan->get_data();
        echo json_encode($data, true);
    }

    public function get_data_by_id()
    {
        $pemasukan_id = $this->input->post('pemasukan_id');
        $data = $this->M_pemasukan->get_data_by_id($pemasukan_id);
        echo json_encode($data, true);
    }

    public function get_data_by_date()
    {
        header('Content-Type: application/json');

        try {
            $this->load->model('M_pemasukan');

            var_dump($this->input->post('datefrom'));
            die;

            // Get and sanitize input
            $from = $this->input->post('datefrom', true) ?? date('Y-m-d');
            $to = $this->input->post('dateto', true) ?? date('Y-m-d');

            $data = $this->M_pemasukan->get_data_by_date($from, $to);

            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } catch (Exception $e) {
            log_message('error', 'Controller Error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to retrieve data'
            ]);
        }

        exit;
    }

    public function add()
    {
        // Force JSON response even for errors
        header('Content-Type: application/json');

        try {
            // Check if form is submitted
            if ($this->input->post()) {
                // Validate required fields
                $this->form_validation->set_rules('pemasukan_kategori', 'Kategori', 'required');
                $this->form_validation->set_rules('pemasukan_total', 'Total', 'required|numeric');

                if ($this->form_validation->run() == FALSE) {
                    // Show validation errors
                    $errors = validation_errors();
                    echo $errors;
                    die();
                } else {
                    // Get kategori safely
                    $kategori_id = $this->input->post('pemasukan_kategori');
                    $kategori = $this->db->get_where('tb_kategori', ['kategori_id' => $kategori_id])->row_array();

                    // Check if kategori exists
                    if (!$kategori) {
                        echo "Error: Kategori tidak ditemukan!";
                        die();
                    }

                    // Prepare data
                    $data = [
                        'pemasukan_kategori'   => $kategori_id,
                        'pemasukan_tgl'         => $this->input->post('pemasukan_tgl'),
                        'pemasukan'             => $kategori['kategori'] . ' - ' . $this->input->post('pemasukan_sumber'),
                        'pemasukan_sumber'     => $this->input->post('pemasukan_sumber'),
                        'pemasukan_total'       => $this->input->post('pemasukan_total'),
                        'pemasukan_keterangan' => $this->input->post('pemasukan_keterangan'),
                        'created_at'           => date('Y-m-d H:i:s'),
                        'updated_at'           => date('Y-m-d H:i:s'),
                        'pemasukan_status'     => "Approved"
                    ];
                }
            }
            if ($this->M_pemasukan->add($data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan'
                ]);
            } else {
                throw new Exception('Gagal menyimpan ke database');
            }
        } catch (Exception $e) {
            log_message('error', 'Insert Failed: ' . $message);
            echo json_encode([
                'status' => 'error',
                'message' => 'Database Error: ' . $message // 👈 Show exact error
            ]);
        }
        exit;
    }

    public function edit()
    {
        $pengeluaran_id = $this->input->post('pengeluaran_id');
        $data = [
            'username'  => $this->input->post('username'),
            'user_pin'  => $this->input->post('user_pin'),
            'user_role' => $this->input->post('user_role')
        ];

        $this->M_pemasukan->edit($pengeluaran_id, $data);
    }

    public function delete()
    {
        $pemasukan_id = $this->input->post('pemasukan_id');
        $this->M_pemasukan->delete($pemasukan_id);
    }
}
