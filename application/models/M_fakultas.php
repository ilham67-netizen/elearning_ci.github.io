<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_fakultas extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('fakultas');
        if($id != null) {
            $this->db->where('kd_fakultas', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['kd_fakultas'] = $post['kd_fakultas'];
        $params['nama_fakultas'] = $post['nama_fakultas'];
        $this->db->insert('fakultas', $params);
    }

    public function edit($post)
    {
        $params['kd_fakultas'] = $post['kd_fakultas'];
        $params['nama_fakultas'] = $post['nama_fakultas'];
        $this->db->where('kd_fakultas', $post['kd_fakultas']);
        $this->db->update('fakultas', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_fakultas', $id);
        $this->db->delete('fakultas');
    }

}