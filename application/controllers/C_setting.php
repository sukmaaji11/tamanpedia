<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_kategori');
    }
}
