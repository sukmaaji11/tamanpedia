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
        // Validate date formats first
        if (!$this->validateDate($from) || !$this->validateDate($to)) {
            log_message('error', 'Invalid date format received: ' . $from . ' / ' . $to);
            return [];
        }

        try {
            $this->db->where('pemasukan_tgl >=', $from);
            $this->db->where('pemasukan_tgl <=', $to);
            $query = $this->db->get('tb_pemasukan');

            // Debugging: Log the generated SQL
            log_message('debug', 'Generated SQL: ' . $this->db->last_query());

            if (!$query) {
                $error = $this->db->error();
                log_message('error', 'Database Error: ' . $error['message']);
                return [];
            }

            return $query->result();
        } catch (Exception $e) {
            log_message('error', 'Model Error: ' . $e->getMessage());
            return [];
        }
    }

    public function get_yearly_total($year)
    {
        $this->db->select_sum('pemasukan_total');
        $this->db->where('YEAR(pemasukan_tgl)', $year);
        $query = $this->db->get('tb_pemasukan');
        return $query->row()->pemasukan_total ?? 0;
    }

    public function add($data)
    {
        $this->db->insert('tb_pemasukan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            // Get detailed error
            $error = $this->db->error();
            log_message('error', 'DB Error: ' . $error['message']);
            return false;
        }
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

    // Helper
    // Add this helper method to your model
    private function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
}
