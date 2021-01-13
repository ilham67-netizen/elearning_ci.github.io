<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tugas extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('tugas.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul');
        $this->db->from('tugas');
        $this->db->join('kelas', 'kelas.kd_kelas = tugas.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = tugas.nip_dosen');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        if ($id != null) {
            $this->db->where('matkul.prodi', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_tugas2($id = null)
    {
        $this->db->select('tugas.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul');
        $this->db->from('tugas');
        $this->db->join('kelas', 'kelas.kd_kelas = tugas.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = tugas.nip_dosen');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        if ($id != null) {
            $this->db->where('matkul.nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_tugas($id = null)
    {
        $this->db->select('tugas.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul');
        $this->db->from('tugas');
        $this->db->join('kelas', 'kelas.kd_kelas = tugas.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = tugas.nip_dosen');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        // $this->db->join('upload_tugas', 'upload_tugas.kd_tugas = tugas.kd_tugas');
        if ($id != null) {
            $this->db->where('tugas.kd_tugas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_mhs_tugas($nim = null, $kd_tugas = null)
    {
        $this->db->select('mhs_tugas.*, mahasiswa.nama_mhs,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as jam_tersisa, DATEDIFF(tugas.batas_waktu,CURDATE()) as hari_tersisa');
        $this->db->from('mhs_tugas');
        $this->db->join('tugas', 'tugas.kd_tugas = mhs_tugas.kd_tugas');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_tugas.nim');
        if ($nim != null && $kd_tugas != null) {
            $this->db->where('mhs_tugas.nim', $nim);
            $this->db->where('tugas.kd_tugas', $kd_tugas);
        } elseif ($nim != null && $kd_tugas == null) {
            $this->db->where('mhs_tugas.nim', $nim);
        } elseif ($kd_tugas != null && $nim == null) {
            $this->db->where('mhs_tugas.kd_tugas', $kd_tugas);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_tugasbyid($id = null)
    {
        $this->db->select('mhs_tugas.*, mahasiswa.nama_mhs,dosen.nama_dosen, matkul.nama_matkul, matkul.semester, kelas.nama_kelas, tugas.tanggal_uplod, tugas.judul_tugas, tugas.batas_waktu, tugas.kd_tugas, TIMEDIFF(tugas.batas_waktu,NOW()) as jam_tersisa, DATEDIFF(tugas.batas_waktu,CURDATE()) as hari_tersisa');
        $this->db->from('mhs_tugas');
        $this->db->join('tugas', 'tugas.kd_tugas = mhs_tugas.kd_tugas');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_tugas.nim');
        $this->db->where('mhs_tugas.id', $id);
        $query = $this->db->get();
        return $query;
    }
    public function get_detail($id = null)
    {
        $this->db->select('mhs_tugas.*, mahasiswa.nama_mhs, matkul.nama_matkul, dosen.nama_dosen, kelas.nama_kelas, tugas.semester');
        $this->db->from('mhs_tugas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = mhs_tugas.nim');
        $this->db->join('tugas', 'tugas.kd_tugas = mhs_tugas.kd_tugas');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        if ($id != null) {
            $this->db->where('tugas.kd_tugas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_file($id = null)
    {
        $this->db->from('upload_tugas');
        if ($id != null) {
            $this->db->where('token', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_file_mhs($id = null)
    {
        $this->db->from('upload_tugas_mhs');
        if ($id != null) {
            $this->db->where('token', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_file_mhs2($nim, $kd_tugas)
    {
        $this->db->from('upload_tugas_mhs');
        $this->db->where('kd_tugas', $kd_tugas);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function get_file2($id = null)
    {
        $this->db->from('upload_tugas');
        if ($id != null) {
            $this->db->where('kd_tugas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['kd_tugas'] = $post['kd_tugas'];
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['judul_tugas'] = $post['judul_tugas'];
        $params['tanggal_uplod'] = $post['tanggal_uplod'];
        $params['batas_waktu'] = $post['batas_waktu'];
        $params['kelas'] = $post['kelas'];
        $params['nip_dosen'] = $post['nip_dosen'];
        $params['keterangan'] = $post['keterangan'];
        $params['semester'] = $post['semester'];
        $this->db->insert('tugas', $params);
    }
    public function add_tugas_mhs($post)
    {
        $params['kd_tugas'] = $post['kd_tugas'];
        $params['nim'] = $post['nim'];
        $params['tgl_uplod'] = date('Y-m-d H:i');
        $params['status'] = "Sudah Mengumpulkan";
        $this->db->insert('mhs_tugas', $params);
    }
    public function edit_tugas_mhs($post)
    {
        $params['nim'] = $post['nim'];
        $params['tgl_uplod'] = date('Y-m-d H:i');
        $params['status'] = "Sudah Mengumpulkan";
        $this->db->where('kd_tugas', $post['kd_tugas']);
        $this->db->update('mhs_tugas', $params);
    }
    public function add_upload($data)
    {
        $this->db->insert('upload_tugas', $data);
    }
    public function add_upload_mhs($data)
    {
        $this->db->insert('upload_tugas_mhs', $data);
    }

    public function edit($post)
    {
        $params['kd_matkul'] = $post['kd_matkul'];
        $params['judul_tugas'] = $post['judul_tugas'];
        $params['tanggal_uplod'] = $post['tanggal_uplod'];
        $params['batas_waktu'] = $post['batas_waktu'];
        $params['kelas'] = $post['kelas'];
        $params['nip_dosen'] = $post['nip_dosen'];
        $params['keterangan'] = $post['keterangan'];
        $params['semester'] = $post['semester'];
        $this->db->where('kd_tugas', $post['kd_tugas']);
        $this->db->update('tugas', $params);
    }

    public function del($id)
    {
        $this->db->where('kd_tugas', $id);
        $this->db->delete('tugas');
    }
    public function delete_file($id)
    {
        $this->db->where('token', $id);
        $this->db->delete('upload_tugas');
    }
    public function delete_file_mhs($id)
    {
        $this->db->where('token', $id);
        $this->db->delete('upload_tugas_mhs');
    }
    public function delete_tugas_mhs($nim, $kd_tugas)
    {
        $this->db->where('nim', $nim);
        $this->db->where('kd_tugas', $kd_tugas);
        $this->db->delete('mhs_tugas');
    }
    public function delete_file2($id)
    {
        $this->db->where('kd_tugas', $id);
        $this->db->delete('upload_tugas');
    }
    public function kode_tugas()
    {
        $this->db->select_max('kd_tugas');
        $query = $this->db->get('tugas');
        $hasil = $query->row();
        return $hasil->kd_tugas;
    }
    public function get_kelas($prodi, $kd_kelas)
    {
        $this->db->from('kelas');
        $this->db->where('prodi', $prodi);
        $this->db->where('kd_kelas <>', $kd_kelas);
        $query = $this->db->get();
        return $query;
    }

    public function get_dosen($prodi, $nip)
    {
        $this->db->from('dosen');
        $this->db->where('prodi', $prodi);
        $this->db->where('nip_dosen <>', $nip);
        $query = $this->db->get();
        return $query;
    }
    public function get_matkul($prodi, $matkul)
    {
        $this->db->from('matkul');
        $this->db->where('prodi', $prodi);
        $this->db->where('kd_matkul <>', $matkul);
        $query = $this->db->get();
        return $query;
    }
    public function get_ampu($nip = NULL)
    {
        $this->db->select('tugas.*, matkul.nama_matkul, dosen.nama_dosen');
        $this->db->from('tugas');
        $this->db->join('matkul', 'matkul.kd_matkul = tugas.kd_matkul');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        $this->db->where('dosen.nip_dosen', $nip);
        $query = $this->db->get();
        return $query;
    }
    public function get_matkul2($prodi, $semester, $kelas)
    {
        $this->db->from('matkul');
        $this->db->where('prodi', $prodi);
        $this->db->where('semester', $semester);
        $this->db->where('kelas', $kelas);
        $query = $this->db->get();
        return $query;
    }
    public function get_doskel($matkul)
    {
        $this->db->from('matkul');
        $this->db->where('kd_matkul', $matkul);
        $query = $this->db->get();
        return $query;
    }
    public function update_nilai($post)
    {
        $param['nilai'] = $post['nilai'];
        $this->db->where('kd_tugas', $post['kd_tugas']);
        $this->db->where('nim', $post['nim']);
        $this->db->update('mhs_tugas', $param);
    }
}
