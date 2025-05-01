<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_kategori extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('tb_kategori')->result();
    }

    public function get_data_by_id($kategori_id)
    {
        $this->db->where('kategori_id', $kategori_id);
        return $this->db->get('tb_kategori')->result();
    }

    public function add($data)
    {
        $this->db->insert('tb_kategori', $data);
    }

    public function edit($kategori_id, $data)
    {
        $this->db->where('kategori_idz`', $kategori_id);
        $this->db->update('tb_kategori', $data);
    }

    public function delete($kategori_id)
    {
        $this->db->where('kategori_id', $kategori_id);
        $this->db->delete('tb_kategori');
    }
}
