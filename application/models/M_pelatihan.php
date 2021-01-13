<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelatihan extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('pelatihan.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.kelas, matkul.semester, kelas.kd_kelas, TIMEDIFF(pelatihan.tanggal_pelatihan,NOW()) as jam_tersisa, DATEDIFF(pelatihan.tanggal_pelatihan,CURDATE()) as hari_tersisa');
        $this->db->from('pelatihan');
        $this->db->join('matkul', 'matkul.kd_matkul = pelatihan.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('pelatihan.kd_pelatihan', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get2($id = null)
    {
        $this->db->select('pelatihan.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.kelas, matkul.semester, kelas.kd_kelas');
        $this->db->from('pelatihan');
        $this->db->join('matkul', 'matkul.kd_matkul = pelatihan.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('pelatihan.nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get3($id = null)
    {
        $this->db->select('pelatihan.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.kelas, matkul.semester, kelas.kd_kelas, TIMEDIFF(pelatihan.tanggal_pelatihan,NOW()) as jam_tersisa, DATEDIFF(pelatihan.tanggal_pelatihan,CURDATE()) as hari_tersisa');
        $this->db->from('pelatihan');
        $this->db->join('matkul', 'matkul.kd_matkul = pelatihan.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get4($id = null)
    {
        $this->db->select('pelatihan.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.kelas, matkul.semester, kelas.kd_kelas');
        $this->db->from('pelatihan');
        $this->db->join('matkul', 'matkul.kd_matkul = pelatihan.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('matkul.prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($data)
    {
        $this->db->insert('pelatihan', $data);
    }

    public function edit($data)
    {
        $this->db->where('kd_pelatihan', $data['kd_pelatihan']);
        $this->db->update('pelatihan', $data);
    }

    public function del($id)
    {
        $this->db->where('kd_pelatihan', $id);
        $this->db->delete('pelatihan');
    }
    public function kode_pelatihan()
    {
        $this->db->select_max('kd_pelatihan');
        $query = $this->db->get('pelatihan');
        $hasil = $query->row();
        return $hasil->kd_pelatihan;
    }
}
