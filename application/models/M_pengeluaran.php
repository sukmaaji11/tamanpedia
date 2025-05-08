<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengeluaran extends CI_Model
{
    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('tb_pengeluaran');
        $this->db->order_by('pengeluaran_tgl', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_data_by_id($pengeluaran_id)
    {
        $this->db->where('pengeluaran_id', $pengeluaran_id);
        return $this->db->get('tb_pengeluaran')->result();
    }

    public function get_data_by_date($from, $to)
    {
        $this->db->where('pengeluaran_tgl >=', $from);
        $this->db->where('pengeluaran_tgl <=', $to);
        return $this->db->get('tb_pengeluaran')->result();
    }

    public function add($data)
    {
        $this->db->insert('tb_pengeluaran', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            // Get detailed error
            $error = $this->db->error();
            log_message('error', 'DB Error: ' . $error['message']);
            return false;
        }
    }

    public function edit($pengeluaran_id, $data)
    {
        $this->db->where('pengeluaran_id', $pengeluaran_id);
        $this->db->update('tb_pengeluaran', $data);
    }

    public function delete($pengeluaran_id)
    {
        $this->db->where('pengeluaran_id', $pengeluaran_id);
        $this->db->delete('tb_pengeluaran');
    }
}
