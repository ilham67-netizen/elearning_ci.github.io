<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_krs extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        if ($id != null) {
            $this->db->where('mhs_krs.id_krs', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function cek_krs($kd_matkul, $nim)
    {
        $this->db->from('mhs_krs');
        $this->db->where('kd_matkul', $kd_matkul);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function get_krsmhs($id = null)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_krsmhs2($id = null)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as waktu_tersisa');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('tugas', 'tugas.kd_matkul = matkul.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_krsmhs3($id = null)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as jam_tersisa, DATEDIFF(tugas.batas_waktu,CURDATE()) as hari_tersisa');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('tugas', 'tugas.kd_matkul = matkul.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
            $this->db->where('DATEDIFF(tugas.batas_waktu,CURDATE()) >=0');
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_krsmhs4($nim, $kd_tugas)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as jam_tersisa, DATEDIFF(tugas.batas_waktu,CURDATE()) as hari_tersisa');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('tugas', 'tugas.kd_matkul = matkul.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        $this->db->where('mhs_krs.nim', $nim);
        $this->db->where('tugas.kd_tugas', $kd_tugas);
        $query = $this->db->get();
        return $query;
    }
    public function get_krsmhs5($nim, $kd_tugas)
    {
        $this->db->select('mhs_krs.*,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as waktu_tersisa');
        $this->db->from('mhs_krs');
        $this->db->join('matkul', 'matkul.kd_matkul = mhs_krs.kd_matkul');
        $this->db->join('tugas', 'tugas.kd_matkul = matkul.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_krs.nim');
        $this->db->where('mhs_krs.nim', $nim);
        $this->db->where('tugas.kd_tugas', $kd_tugas);
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['nim'] = $post['nim'];
        $params['kd_matkul'] = $post['kd_matkul'];
        $this->db->insert('mhs_krs', $params);
    }

    public function edit($post)
    {
        $params['nim'] = $post['nim'];
        $params['kd_matkul'] = $post['kd_matkul'];
        $this->db->update('mhs_krs', $params);
    }

    public function del($id)
    {
        $this->db->where('id_krs', $id);
        $this->db->delete('mhs_krs');
    }
}
