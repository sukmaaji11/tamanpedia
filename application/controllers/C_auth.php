<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('user_id', 'Password', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            session_destroy();
            $this->load->view('auth');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $user_id = $this->input->post('user_id');
        $password = $user_id;
        $user = $this->db->get_where('tb_user', ['user_id' => $user_id])->row_array();

        if ($user) {
            if ($user['user_pin'] = $password) {
                $data = [
                    'username' => $user['username'],
                    'user_role' => $user['user_role'],
                ];
                if ($data['user_role'] == 1) {
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } elseif ($data['user_role'] == 2) {
                    $this->session->set_userdata($data);
                    redirect('app');
                } else {
                    echo "Hellow Woerld";
                }
            } else {
                error_log($php_errormsg);
                $this->session->set_flashdata('message', '<div class="alert alert-danger text-center p" role="alert"><b>Password Salah<b>, Silahkan Coba Lagi !</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger text-center p" role="alert"><b>Login Gagal<b>, Pengguna Belum Terdaftar !</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $data['user'] = $this->db->get_where('tb_user', ['user_role' => $this->session->userdata('user_role')])->row_array();
        if ($this->session->userdata('user_role') == 1) {
            $this->session->sess_destroy();
            redirect('auth');
        } elseif ($this->session->userdata('user_role') == 2) {
            $this->session->sess_destroy();
            redirect('auth');
        } else {
            redirect('auth');
        }
    }
}
