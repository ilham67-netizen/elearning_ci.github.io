<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dosen extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('dosen.*, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('dosen');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = dosen.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = dosen.prodi');
        if ($id != null) {
            $this->db->where('nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['nip_dosen'] = $post['nip'];
        $params['nama_dosen'] = $post['nama_dosen'];
        $params['fakultas'] = $post['fakultas'];
        $params['prodi'] = $post['prodi'];
        $params['no_telp'] = $post['no_telp'];
        $params['tgl_lahir'] = $post['tgl_lahir'];
        $params['tempat_lahir'] = $post['tempat_lahir'];
        $params['alamat'] = $post['alamat'];
        $params['password'] = sha1($post['password']);
        $this->db->insert('dosen', $params);
    }

    public function edit($post)
    {
        $params['nip_dosen'] = $post['nip'];
        $params['nama_dosen'] = $post['nama_dosen'];
        if ($post['fakultas'] && $post['prodi'] != null) {
            $params['fakultas'] = $post['fakultas'];
            $params['prodi'] = $post['prodi'];
        }
        $params['no_telp'] = $post['no_telp'];
        $params['tgl_lahir'] = $post['tgl_lahir'];
        $params['tempat_lahir'] = $post['tempat_lahir'];
        $params['alamat'] = $post['alamat'];
        if ($post['password'] != null) {
            $params['password'] = sha1($post['password']);
        }
        $this->db->where('nip_dosen', $post['nip']);
        $this->db->update('dosen', $params);
    }

    public function del($id)
    {
        $this->db->where('nip_dosen', $id);
        $this->db->delete('dosen');
    }
    public function get_prod($id = null)
    {

        $this->db->from('prodi');
        if ($id != null) {
            $this->db->where('fakultas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_fakultas($id = null)
    {
        $this->db->from('fakultas');
        if ($id != null) {
            $this->db->where('kd_fakultas <>', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_prodi($id = null)
    {
        $this->db->from('prodi');
        if ($id != null) {
            $this->db->where('kd_prodi <>', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}
