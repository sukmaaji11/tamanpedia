<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function get_data()
    {
        return $this->db->get('tb_user')->result();
    }

    public function get_data_by_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('tb_user')->result();
    }

    public function add($data)
    {
        $this->db->insert('tb_user', $data);
    }

    public function edit($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_user', $data);
    }

    public function delete($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('tb_user');
    }
}
