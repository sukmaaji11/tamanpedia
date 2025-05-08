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

    public function add()
    {
        header('Content-Type: application/json');

        try {
            // Verify CSRF token
            if (!$this->security->csrf_verify()) {
                throw new Exception("Invalid CSRF token");
            }

            // File Upload Configuration
            $config['upload_path']   = '../../assets/uploads/pengeluaran';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048; // 2MB
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            // Validate required fields
            $this->form_validation->set_rules('pengeluaran_kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('pengeluaran_total', 'Total', 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                throw new Exception(validation_errors('<div class="error">', '</div>'));
            }

            // Handle file upload
            $filename = null;
            if (!empty($_FILES['pengeluaran_img_filename']['name'])) {
                if (!$this->upload->do_upload('pengeluaran_img_filename')) {
                    throw new Exception($this->upload->display_errors());
                }
                $upload_data = $this->upload->data();
                $filename = $upload_data['file_name'];
            }

            // Get and validate kategori
            $kategori_id = $this->input->post('pengeluaran_kategori');
            $kategori = $this->db->get_where('tb_kategori', ['kategori_id' => $kategori_id])->row_array();
            if (!$kategori) {
                throw new Exception("Kategori tidak ditemukan!");
            }

            // Prepare data
            $data = [
                'pengeluaran_kategori'    => $kategori_id,
                'pengeluaran_tgl'         => $this->input->post('pengeluaran_tgl'),
                'pengeluaran'             => $this->input->post('pengeluaran'),
                'pengeluaran_total'       => $this->input->post('pengeluaran_total'),
                'pengeluaran_img_filename' => $filename,
                'pengeluaran_keterangan'  => $this->input->post('pengeluaran_keterangan'),
                'created_at'              => date('Y-m-d H:i:s'),
                'updated_at'              => date('Y-m-d H:i:s'),
                'pengeluaran_status'      => "Approved"
            ];

            if ($this->M_pengeluaran->add($data)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'filename' => $filename
                ]);
            } else {
                throw new Exception('Gagal menyimpan ke database');
            }
        } catch (Exception $e) {
            log_message('error', 'Pengeluaran Error: ' . $e->getMessage());
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
