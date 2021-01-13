<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_matkul extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('matkul.*, kelas.nama_kelas, dosen.nama_dosen, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = matkul.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = matkul.prodi');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('kd_matkul', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get2($id = null)
    {
        $this->db->select('matkul.*, kelas.nama_kelas, dosen.nama_dosen, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = matkul.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = matkul.prodi');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('matkul.prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get3($kd_prodi = null, $kd_matkul)
    {
        $this->db->select('matkul.*, kelas.nama_kelas, dosen.nama_dosen, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = matkul.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = matkul.prodi');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($kd_prodi != null && $kd_matkul != null) {
            $this->db->where('matkul.prodi', $kd_prodi);
            $this->db->where('matkul.kd_matkul <>', $kd_matkul);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['nama_matkul'] = $post['nama_matkul'];
        $params['kelas'] = $post['kelas'];
        $params['nip_dosen'] = $post['dosen'];
        $params['fakultas'] = $post['fakultas'];
        $params['prodi'] = $post['prodi'];
        $params['semester'] = $post['semester'];
        $this->db->insert('matkul', $params);
    }

    public function edit($post)
    {
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['nama_matkul'] = $post['nama_matkul'];
        $params['kelas'] = $post['kelas'];
        $params['nip_dosen'] = $post['dosen'];
        $params['fakultas'] = $post['fakultas'];
        $params['prodi'] = $post['prodi'];
        $params['semester'] = $post['semester'];
        $this->db->where('kd_matkul', $post['kd_matkul']);
        $this->db->update('matkul', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_matkul', $id);
        $this->db->delete('matkul');
    }
    public function kode_matkul()
    {
        $this->db->select_max('kd_matkul');
        $query = $this->db->get('matkul');
        $hasil = $query->row();
        return $hasil->kd_matkul;
    }
    public function get_kelas($prodi = NULL)
    {
        $this->db->from('kelas');
        $this->db->where('prodi', $prodi);
        $query = $this->db->get();
        return $query;
    }
    public function get_dosen($prodi = NULL)
    {
        $this->db->from('dosen');
        $this->db->where('prodi', $prodi);
        $query = $this->db->get();
        return $query;
    }
    public function get_prodi($fakultas, $prodi)
    {

        $this->db->from('prodi');
        $this->db->where('fakultas', $fakultas);
        $this->db->where('kd_prodi <>', $prodi);
        $query = $this->db->get();
        return $query;
    }
    public function get_dosen2($prodi, $dosen)
    {

        $this->db->from('dosen');
        $this->db->where('prodi', $prodi);
        $this->db->where('nip_dosen <>', $dosen);
        $query = $this->db->get();
        return $query;
    }
    public function get_matkul($prodi = NULL)
    {
        $this->db->from('matkul');
        $this->db->where('prodi', $prodi);
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu($nip = NULL)
    {
        $this->db->select('matkul.*, kelas.nama_kelas, dosen.nama_dosen, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = matkul.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = matkul.prodi');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->where('matkul.nip_dosen', $nip);
        $query = $this->db->get();
        return $query;
    }
}
