<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('mahasiswa.*,dosen.nama_dosen, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('mahasiswa');
        $this->db->join('dosen', 'dosen.nip_dosen = mahasiswa.dosbing_akad');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = mahasiswa.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = mahasiswa.prodi');
        if ($id != null) {
            $this->db->where('mahasiswa.nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu($id = null)
    {
        $this->db->select('mhs_krs.*, mahasiswa.nama_mhs, matkul.nama_matkul, dosen.nama_dosen, matkul.nip_dosen, mahasiswa.no_telp, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('mhs_krs');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = mahasiswa.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = mahasiswa.prodi');
        if ($id != null) {
            $this->db->where('dosen.nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_mhs($id = null)
    {
        $this->db->select('mahasiswa.*,dosen.nama_dosen');
        $this->db->from('mahasiswa');
        $this->db->join('dosen', 'dosen.nip_dosen = mahasiswa.dosbing_akad');
        $this->db->join('fakultas', 'fakultas.kd_fakultas = mahasiswa.fakultas');
        $this->db->join('prodi', 'prodi.kd_prodi = mahasiswa.prodi');
        if ($id != null) {
            $this->db->where('mahasiswa.prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }


    public function add($post)
    {
        $params['nim'] = $post['nim'];
        $params['nama_mhs'] = $post['nama_mhs'];
        $params['no_telp'] = $post['no_telp'];
        $params['tgl_lahir'] = $post['tgl_lahir'];
        $params['tempat_lahir'] = $post['tempat_lahir'];
        $params['alamat'] = $post['alamat'];
        $params['email'] = $post['email'];
        $params['fakultas'] = $post['kd_fakultas'];
        $params['prodi'] = $post['kd_prodi'];
        $params['password'] = sha1($post['password']);
        $params['dosbing_akad'] = $post['dosbing_akad'];
        $this->db->insert('mahasiswa', $params);
    }

    public function edit($post)
    {
        $params['nim'] = $post['nim'];
        $params['nama_mhs'] = $post['nama_mhs'];
        $params['no_telp'] = $post['no_telp'];
        $params['tgl_lahir'] = $post['tgl_lahir'];
        $params['tempat_lahir'] = $post['tempat_lahir'];
        $params['alamat'] = $post['alamat'];
        $params['email'] = $post['email'];
        if ($post['password'] != null) {
            $params['password'] = sha1($post['password']);
        }
        $params['dosbing_akad'] = $post['dosbing_akad'];
        $this->db->where('nim', $post['nim']);
        $this->db->update('mahasiswa', $params);
    }

    public function del($id)
    {
        $this->db->where('nim', $id);
        $this->db->delete('mahasiswa');
    }
}
