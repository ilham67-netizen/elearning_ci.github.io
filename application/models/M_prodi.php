<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prodi extends CI_Model
{

    public function get($id = null)
    {
        $this->db->from('prodi');
        if($id != null) {
            $this->db->where('kd_prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['kd_prodi'] = $post['kd_prodi'];
        $params['nama_prodi'] = $post['nama_prodi'];
        $params['fakultas'] = $post['fakultas'];
        $this->db->insert('prodi', $params);
    }

    public function edit($post)
    {
       
        $params['nama_prodi'] = $post['nama_prodi'];
        $params['fakultas'] = $post['fakultas'];
        $this->db->where('kd_prodi', $post['kd_prodi']);
        $this->db->update('prodi', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_prodi', $id);
        $this->db->delete('prodi');
    }

}