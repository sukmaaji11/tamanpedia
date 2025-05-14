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

        // Disable CSRF token regeneration
        $this->config->set_item('csrf_regenerate', FALSE);
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        $data['kategori'] = $this->db->get_where('tb_kategori', array('kategori_role =' => 2))->result();

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


    // In Pengeluaran.php controller
    public function get_report()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        // Get Category Summaries
        $this->db->select('tb_kategori.kategori, 
        SUM(tb_pengeluaran.pengeluaran_total) as total,
        COUNT(*) as transaction_count');
        $this->db->from('tb_pengeluaran');
        $this->db->join('tb_kategori', 'tb_pengeluaran.pengeluaran_kategori = tb_kategori.kategori_id');
        $this->db->where('pengeluaran_tgl >=', $start_date);
        $this->db->where('pengeluaran_tgl <=', $end_date);
        $this->db->group_by('tb_pengeluaran.pengeluaran_kategori');
        $summary = $this->db->get()->result_array();

        // Get Detailed Transactions
        $this->db->select('tb_pengeluaran.*, tb_kategori.kategori as kategori_name');
        $this->db->from('tb_pengeluaran');
        $this->db->join('tb_kategori', 'tb_pengeluaran.pengeluaran_kategori = tb_kategori.kategori_id');
        $this->db->where('pengeluaran_tgl >=', $start_date);
        $this->db->where('pengeluaran_tgl <=', $end_date);
        $details = $this->db->get()->result_array();

        echo json_encode([
            'summary' => $summary,
            'details' => $details
        ]);
    }

    public function add()
    {
        // Force JSON response even for errors
        header('Content-Type: application/json');

        try {
            if ($this->input->post()) {
                // Validate required fields
                $this->form_validation->set_rules('pengeluaran_kategori', 'Kategori', 'required');
                $this->form_validation->set_rules('pengeluaran_total', 'Total', 'required|numeric');

                if ($this->form_validation->run() == FALSE) {
                    // Show validation errors
                    $errors = validation_errors();
                    echo $errors;
                    die();
                } else {
                    // Get kategori safely
                    $kategori_id = $this->input->post('pengeluaran_kategori');
                    $kategori = $this->db->get_where('tb_kategori', ['kategori_id' => $kategori_id])->row_array();

                    // Check if kategori exists
                    if (!$kategori) {
                        echo "Error: Kategori tidak ditemukan!";
                        die();
                    }

                    // Database Insertion
                    $data = [
                        'pengeluaran_kategori'    => $this->input->post('pengeluaran_kategori', true),
                        'pengeluaran_tgl'         => $this->input->post('pengeluaran_tgl', true),
                        'pengeluaran'             => $this->input->post('pengeluaran', true),
                        'pengeluaran_total'       => $this->input->post('pengeluaran_total', true),
                        'pengeluaran_img_filename' => "Tes.png",
                        'pengeluaran_keterangan'  => $this->input->post('pengeluaran_keterangan', true),
                        'created_at'              => date('Y-m-d H:i:s'),
                        'updated_at'           => date('Y-m-d H:i:s'),
                        'pengeluaran_status'      => "Approved"
                    ];
                }
            }
            if ($this->M_pengeluaran->add($data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan'
                ]);
            } else {
                throw new Exception('Gagal menyimpan ke database');
            }
        } catch (Exception $e) {
            log_message('error', 'Controller Error: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
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

        $this->M_pengeluaran->edit($pengeluaran_id, $data);
    }

    public function delete()
    {
        $pengeluaran_id = $this->input->post('pengeluaran_id');
        $this->M_pengeluaran->delete($pengeluaran_id);
    }
}
