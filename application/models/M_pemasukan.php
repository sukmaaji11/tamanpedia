<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pemasukan extends CI_Model
{
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tb_pemasukan');
        $this->db->order_by('pemasukan_tgl', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_by_id($pemasukan_id)
    {
        $this->db->where('pemasukan_id', $pemasukan_id);
        return $this->db->get('tb_pemasukan')->result();
    }

    public function get_data_by_date($from, $to)
    {
        $this->db->where('pemasukan_tgl >=', $from);
        $this->db->where('pemasukan_tgl <=', $to);
        return $this->db->get('tb_pemasukan')->result();
    }

    public function add($data)
    {
        $this->db->insert('tb_pemasukan', $data);
    }

    public function edit($pemasukan_id, $data)
    {
        $this->db->where('pemasukan_id', $pemasukan_id);
        $this->db->update('tb_pemasukan', $data);
    }

    public function delete($pemasukan_id)
    {
        $this->db->where('pemasukan_id', $pemasukan_id);
        $this->db->delete('tb_pemasukan');
    }
}
