<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ujian extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('pengaturan_ujian.*,  kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, paket_soal.waktu_soal, paket_soal.jenis_soal, matkul.semester');
        $this->db->from('pengaturan_ujian');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = pengaturan_ujian.kd_paket');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('pengaturan_ujian.nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get3($jenis = null, $kd_prodi = null)
    {
        $this->db->select('pengaturan_ujian.*,  kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, paket_soal.waktu_soal, paket_soal.jenis_soal, matkul.semester');
        $this->db->from('pengaturan_ujian');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = pengaturan_ujian.kd_paket');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($jenis != null && $kd_prodi != null) {
            $this->db->where('paket_soal.jenis_soal', $jenis);
            $this->db->where('matkul.prodi', $kd_prodi);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_mhs($nim = null)
    {
        $this->db->select('pengaturan_ujian.*,  kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, paket_soal.waktu_soal, paket_soal.jenis_soal, matkul.semester, TIMEDIFF(pengaturan_ujian.tanggal_ujian,NOW()) as jam_tersisa, DATEDIFF(pengaturan_ujian.tanggal_ujian,CURDATE()) as hari_tersisa');
        $this->db->from('pengaturan_ujian');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = pengaturan_ujian.kd_paket');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('mhs_krs', 'mhs_krs.kd_matkul = matkul.kd_matkul');

        if ($nim != null) {
            $this->db->where('mhs_krs.nim', $nim);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get2($id = null)
    {
        $this->db->select('pengaturan_ujian.*,  kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, paket_soal.waktu_soal, paket_soal.jenis_soal, matkul.semester, paket_soal.kd_paket, matkul.nip_dosen as nip');
        $this->db->from('pengaturan_ujian');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = pengaturan_ujian.kd_paket');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($id != null) {
            $this->db->where('pengaturan_ujian.kd_pengawas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_nilai($nim, $kd_pengawas, $jenis)
    {
        if ($jenis == 1) {
            $this->db->from('nilai_essay');
            $this->db->where('nim', $nim);
            $this->db->where('kd_pengawas', $kd_pengawas);
        } elseif ($jenis == 2) {
            $this->db->from('nilai_pilgan');
            $this->db->where('nim', $nim);
            $this->db->where('kd_pengawas', $kd_pengawas);
        } elseif ($jenis == 3) {
            $this->db->from('nilai_koding');
            $this->db->where('nim', $nim);
            $this->db->where('kd_pengawas', $kd_pengawas);
        } elseif ($jenis == 4) {
            $this->db->from('nilai_pilgansay');
            $this->db->where('nim', $nim);
            $this->db->where('kd_pengawas', $kd_pengawas);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_nilai2($id_nilai, $jenis)
    {
        if ($jenis == 1) {
            $this->db->from('nilai_essay');
            $this->db->where('id_nilai', $id_nilai);
        } elseif ($jenis == 2) {
            $this->db->from('nilai_pilgan');
            $this->db->where('id_nilai', $id_nilai);
        } elseif ($jenis == 3) {
            $this->db->from('nilai_koding');
            $this->db->where('id_nilai', $id_nilai);
        } elseif ($jenis == 4) {
            $this->db->from('nilai_pilgansay');
            $this->db->where('id_nilai', $id_nilai);
        }
        $query = $this->db->get();
        return $query;
    }
    public function update_nilai_ujian($post)
    {
        $params['nilai'] = $post['nilai'];
        if ($post['jenis'] == 1) {
            $this->db->where('nim', $post['nim']);
            $this->db->where('kd_pengawas', $post['kd_pengawas']);
            $this->db->update('nilai_essay', $params);
        } elseif ($post['jenis'] == 2) {
            $this->db->where('nim', $post['nim']);
            $this->db->where('kd_pengawas', $post['kd_pengawas']);
            $this->db->update('nilai_pilgan', $params);
        } elseif ($post['jenis'] == 3) {
            $this->db->where('nim', $post['nim']);
            $this->db->where('kd_pengawas', $post['kd_pengawas']);
            $this->db->update('nilai_koding', $params);
        }
    }
    public function add_ujian($post)
    {
        $params['kd_pengawas'] = $post['kd_pengawas'];
        $params['nama_pengawas'] = $post['nama_pengawas'];
        $params['nama_ujian'] = $post['nama_ujian'];
        $params['kd_paket'] = $post['kd_paket'];
        $params['tanggal_ujian'] = $post['waktu_ujian'];
        $params['batas_telat'] = $post['batas_telat'];
        $params['password'] = sha1($post['password']);
        $params['nip_dosen'] = $post['nip_dosen'];
        $params['status'] = $post['status'];
        $this->db->insert('pengaturan_ujian', $params);
    }
    public function absen_ujian($data)
    {
        $this->db->insert('absen_ujian', $data);
    }
    public function edit_ujian($post)
    {
        $params['nama_pengawas'] = $post['nama_pengawas'];
        $params['nama_ujian'] = $post['nama_ujian'];
        $params['tanggal_ujian'] = $post['waktu_ujian'];
        $params['batas_telat'] = $post['batas_telat'];
        $params['nip_dosen'] = $post['nip_dosen'];
        $params['kd_paket'] = $post['kd_paket'];
        if ($post['password'] != null) {
            $params['password'] = sha1($post['password']);
        }
        $params['status'] = $post['status'];
        $this->db->where('kd_pengawas', $post['kd_pengawas']);
        $this->db->update('pengaturan_ujian', $params);
    }

    public function delete_ujian($id)
    {
        $this->db->where('kd_pengawas', $id);
        $this->db->delete('pengaturan_ujian');
    }
    public function kode_pengawas()
    {
        $this->db->select_max('kd_pengawas');
        $query = $this->db->get('pengaturan_ujian');
        $hasil = $query->row();
        return $hasil->kd_pengawas;
    }
    public function get_paket($id = null, $nip = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');

        if ($nip != null && $id != null) {
            $this->db->where('paket_soal.kd_paket <>', $id);
            $this->db->where('matkul.nip_dosen', $nip);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_paket2($id, $jenis, $prodi)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->where('paket_soal.kd_paket <>', $id);
        $this->db->where('paket_soal.jenis_soal', $jenis);
        $this->db->where('matkul.prodi', $prodi);
        $query = $this->db->get();
        return $query;
    }
    public function get_absen($kd_pengawas = null)
    {
        $this->db->select('absen_ujian.*, pengaturan_ujian.nama_pengawas, mahasiswa.nama_mhs');
        $this->db->from('absen_ujian');
        $this->db->join('pengaturan_ujian', 'pengaturan_ujian.kd_pengawas = absen_ujian.kd_pengawas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = absen_ujian.nim');
        if ($kd_pengawas != null) {
            $this->db->where('absen_ujian.kd_pengawas', $kd_pengawas);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_absen2($nim, $kd_pengawas, $kd_paket)
    {
        $this->db->from('absen_ujian');
        $this->db->where('absen_ujian.kd_pengawas', $kd_pengawas);
        $this->db->where('absen_ujian.nim', $nim);
        $this->db->where('absen_ujian.kd_paket', $kd_paket);
        $query = $this->db->get();
        return $query;
    }
}
