<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jadwal extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('matkul.prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_jadwal($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('jadwal.kd_jadwal', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester, TIMEDIFF(jadwal.waktu_mulai,NOW()) as jam_tersisa, DATEDIFF(jadwal.waktu_mulai,CURDATE()) as hari_tersisa');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('matkul.nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu_mhs($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu_mhs2($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester,TIMEDIFF(jadwal.waktu_mulai,NOW()) as jam_tersisa, DATEDIFF(jadwal.waktu_mulai,CURDATE()) as hari_tersisa');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
            $this->db->where('DATEDIFF(jadwal.waktu_mulai,CURDATE()) >= 0');
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu_mhs3($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester,TIMEDIFF(jadwal.waktu_mulai,NOW()) as jam_tersisa, DATEDIFF(jadwal.waktu_mulai,CURDATE()) as hari_tersisa');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
            $this->db->where('DATEDIFF(jadwal.waktu_mulai,CURDATE()) < 0');
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu_mhs4($id = null)
    {
        $this->db->select('jadwal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.semester,TIMEDIFF(jadwal.waktu_mulai,NOW()) as jam_tersisa, DATEDIFF(jadwal.waktu_mulai,CURDATE()) as hari_tersisa');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');
        if ($id != null) {
            $this->db->where('mhs_krs.nim', $id);
            $this->db->where('DATEDIFF(jadwal.waktu_mulai,CURDATE()) > 0');
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_absen($id = null)
    {
        $this->db->select('absensi.*, mahasiswa.nama_mhs, matkul.nama_matkul');
        $this->db->from('absensi');
        $this->db->join('jadwal', 'jadwal.kd_jadwal = absensi.kd_jadwal');
        $this->db->join('mahasiswa', 'mahasiswa.nim = absensi.nim');
        $this->db->join('matkul', 'matkul.kd_matkul = jadwal.kd_matkul');
        // $this->db->join('dosen', 'dosen.nip_dosen = tugas.nip_dosen');
        // $this->db->join('kelas', 'kelas.kd_kelas = tugas.kelas');
        if ($id != null) {
            $this->db->where('jadwal.kd_jadwal', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_file($id = null)
    {
        $this->db->from('upload_materi');
        if ($id != null) {
            $this->db->where('token', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_file2($id = null)
    {
        $this->db->from('upload_materi');
        if ($id != null) {
            $this->db->where('kd_jadwal', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['kd_jadwal'] = $post['kd_jadwal'];
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['nama_kuliah'] = $post['nama_kuliah'];
        $params['waktu_mulai'] = $post['waktu_mulai'];
        $params['link'] = $post['link1'] . $post['link2'];
        $params['status'] = "0";
        $params['allow_absen'] = "0";
        $this->db->insert('jadwal', $params);
    }
    public function add_upload($data)
    {
        $this->db->insert('upload_materi', $data);
    }

    public function check_update($status, $kd_jadwal)
    {
        $params['allow_absen'] = $status;
        $this->db->where('kd_jadwal', $kd_jadwal);
        $this->db->update('jadwal', $params);
    }
    public function kuliah_update($status, $kd_jadwal)
    {
        $params['status'] = $status;
        $this->db->where('kd_jadwal', $kd_jadwal);
        $this->db->update('jadwal', $params);
    }
    public function edit($post)
    {
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['nama_kuliah'] = $post['nama_kuliah'];
        $params['waktu_mulai'] = $post['waktu_mulai'];
        // if ($post['waktu_akhir'] != '') {
        //     $params['waktu_akhir'] = $post['waktu_akhir'];
        // }
        $params['link'] = $post['link1'] . $post['link2'];
        $this->db->where('kd_jadwal', $post['kd_jadwal']);
        $this->db->update('jadwal', $params);
    }
    public function update_waktu($waktu, $kd_jadwal)
    {
        $params['waktu_akhir'] = $waktu;
        $this->db->where('kd_jadwal', $kd_jadwal);
        $this->db->update('jadwal', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_jadwal', $id);
        $this->db->delete('jadwal');
    }
    public function delete_file($id)
    {
        $this->db->where('token', $id);
        $this->db->delete('upload_materi');
    }
    public function delete_file2($id)
    {
        $this->db->where('kd_jadwal', $id);
        $this->db->delete('upload_materi');
    }
    public function kode_jadwal()
    {
        $this->db->select_max('kd_jadwal');
        $query = $this->db->get('jadwal');
        $hasil = $query->row();
        return $hasil->kd_jadwal;
    }
    // public function get_kelas($prodi, $kd_kelas)
    // {
    //     $this->db->from('kelas');
    //     $this->db->where('prodi', $prodi);
    //     $this->db->where('kd_kelas <>', $kd_kelas);
    //     $query = $this->db->get();
    //     return $query;
    // }

    // public function get_dosen($prodi, $nip)
    // {
    //     $this->db->from('dosen');
    //     $this->db->where('prodi', $prodi);
    //     $this->db->where('nip_dosen <>', $nip);
    //     $query = $this->db->get();
    //     return $query;
    // }
    public function get_matkul($prodi, $matkul)
    {
        $this->db->from('matkul');
        $this->db->where('prodi', $prodi);
        $this->db->where('kd_matkul <>', $matkul);
        $query = $this->db->get();
        return $query;
    }
    public function get_matkul3($dosen, $matkul)
    {
        $this->db->select('matkul.*, kelas.nama_kelas');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->where('nip_dosen', $dosen);
        $this->db->where('kd_matkul <>', $matkul);
        $query = $this->db->get();
        return $query;
    }
    public function get_matkul2($dosen)
    {
        $this->db->select('matkul.*, kelas.nama_kelas');
        $this->db->from('matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->where('nip_dosen', $dosen);
        $query = $this->db->get();
        return $query;
    }
    public function get_absen_mhs($nim, $kd_jadwal)
    {
        $this->db->from('absensi');
        $this->db->where('nim', $nim);
        $this->db->where('kd_jadwal', $kd_jadwal);
        $query = $this->db->get();
        return $query;
    }
    public function add_absen($data)
    {
        $this->db->insert('absensi', $data);
    }
    // public function get_matkul2($prodi, $semester, $kelas)
    // {
    //     $this->db->from('matkul');
    //     $this->db->where('prodi', $prodi);
    //     $this->db->where('semester', $semester);
    //     $this->db->where('kelas', $kelas);
    //     $query = $this->db->get();
    //     return $query;
    // }
    // public function get_doskel($matkul)
    // {
    //     $this->db->from('matkul');
    //     $this->db->where('kd_matkul', $matkul);
    //     $query = $this->db->get();
    //     return $query;
    // }
}
