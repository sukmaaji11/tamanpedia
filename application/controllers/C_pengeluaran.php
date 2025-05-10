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

    public function add()
    {
        header('Content-Type: application/json');

        try {
            // Verify CSRF token from POST data
            $postedToken = $this->input->post($this->security->get_csrf_token_name());
            $currentToken = $this->security->get_csrf_hash();

            if ($postedToken !== $currentToken) {
                throw new Exception("Security token mismatch. Please refresh the page.");
            }

            // File Upload Configuration
            $uploadPath = FCPATH . 'assets/uploads/pengeluaran/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $config = [
                'upload_path'   => $uploadPath,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 2048,
                'encrypt_name'  => TRUE,
            ];

            $this->load->library('upload', $config);

            // Validation
            $this->form_validation->set_rules('pengeluaran_kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('pengeluaran_total', 'Total', 'required|numeric');

            if (!$this->form_validation->run()) {
                throw new Exception(strip_tags(validation_errors()));
            }

            // File Upload
            $filename = null;
            if (!empty($_FILES['pengeluaran_img_filename']['name'])) {
                if (!$this->upload->do_upload('pengeluaran_img_filename')) {
                    throw new Exception($this->upload->display_errors());
                }
                $filename = $this->upload->data('file_name');
            }

            // Database Insertion
            $data = [
                'pengeluaran_kategori'    => $this->input->post('pengeluaran_kategori', true),
                'pengeluaran_tgl'         => $this->input->post('pengeluaran_tgl', true),
                'pengeluaran'             => $this->input->post('pengeluaran', true),
                'pengeluaran_total'       => $this->input->post('pengeluaran_total', true),
                'pengeluaran_img_filename' => $filename,
                'pengeluaran_keterangan'  => $this->input->post('pengeluaran_keterangan', true),
                'created_at'              => date('Y-m-d H:i:s'),
                'pengeluaran_status'      => "Approved"
            ];

            if ($this->M_pengeluaran->add($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Data saved']);
            } else {
                throw new Exception('Database save failed');
            }
            // Return success with new token
            echo json_encode([
                'status' => 'success',
                'message' => 'Data saved',
                'new_csrf' => $this->security->get_csrf_hash() // Send new token
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'new_csrf' => $this->security->get_csrf_hash()
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
