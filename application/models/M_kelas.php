<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelas extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('kelas.*, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('kelas');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = kelas.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = kelas.prodi');
        if($id != null) {
            $this->db->where('kd_kelas', $id);
        }
        $this->db->order_by('kd_kelas ASC');
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['kd_kelas'] = $post['kd_kelas'];
        $params['nama_kelas'] = $post['nama_kelas'];
        $params['fakultas'] = $post['fakultas'];
        $params['prodi'] = $post['prodi'];
        $this->db->insert('kelas', $params);
    }

    public function edit($post)
    {
        $params['kd_kelas'] = $post['kd_kelas'];
        $params['nama_kelas'] = $post['nama_kelas'];
        $params['fakultas'] = $post['fakultas'];
        $params['prodi'] = $post['prodi'];   
        $this->db->where('kd_kelas', $post['kd_kelas']);
        $this->db->update('kelas', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_kelas', $id);
        $this->db->delete('kelas');
    }
    public function kode_kelas(){
        $this->db->select_max('kd_kelas');
        $query = $this->db->get('kelas');
        $hasil = $query->row();
        return $hasil->kd_kelas;
    }

}