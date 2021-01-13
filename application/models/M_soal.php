<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_soal extends CI_Model
{

    public function get($id = null, $nip = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');

        if ($nip != null && $id != null) {
            $this->db->where('paket_soal.kd_paket', $id);
            $this->db->where('matkul.nip_dosen', $nip);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get2($nip = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($nip != null) {
            $this->db->where('matkul.nip_dosen', $nip);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get5($prodi = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($prodi != null) {
            $this->db->where('matkul.prodi', $prodi);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get3($id = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');

        if ($id != null) {
            $this->db->where('paket_soal.kd_paket', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get4($jenis = null, $prodi = null)
    {
        $this->db->select('paket_soal.*, kelas.nama_kelas, dosen.nama_dosen, matkul.nama_matkul, matkul.nip_dosen, matkul.kelas, matkul.semester');
        $this->db->from('paket_soal');
        $this->db->join('matkul', 'matkul.kd_matkul = paket_soal.kd_matkul');
        $this->db->join('kelas', 'kelas.kd_kelas = matkul.kelas');
        $this->db->join('dosen', 'dosen.nip_dosen = matkul.nip_dosen');
        if ($jenis != null && $prodi != null) {
            $this->db->where('paket_soal.jenis_soal', $jenis);
            $this->db->where('matkul.prodi', $prodi);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_soal($kd_paket)
    {
        $this->db->select('soal.*, paket_soal.jenis_soal');
        $this->db->from('soal');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = soal.kd_paket');
        $this->db->where('soal.kd_paket', $kd_paket);
        $query = $this->db->get();
        return $query;
    }
    public function get_soal3($hal, $kd_paket)
    {
        $this->db->select('soal.*, paket_soal.jenis_soal');
        $this->db->from('soal');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = soal.kd_paket');
        $this->db->where('soal.kd_paket', $kd_paket);
        $this->db->limit(1, $hal);
        $query = $this->db->get();
        return $query;
    }
    public function get_status_jawab($pengawas, $soal, $nim)
    {

        $this->db->from('jawaban');
        $this->db->where('kd_pengawas', $pengawas);
        $this->db->where('kd_soal', $soal);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function get_status_koding($pengawas, $soal, $nim)
    {

        $this->db->from('jawaban_koding');
        $this->db->where('kd_pengawas', $pengawas);
        $this->db->where('kd_paket', $soal);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function cek_nilai_pilgan($nim, $kd_pengawas)
    {
        $this->db->from('nilai_pilgan');
        $this->db->where('kd_pengawas', $kd_pengawas);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function cek_nilai_essay($nim, $kd_pengawas)
    {
        $this->db->from('nilai_essay');
        $this->db->where('kd_pengawas', $kd_pengawas);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function cek_nilai_koding($nim, $kd_pengawas)
    {
        $this->db->from('nilai_koding');
        $this->db->where('kd_pengawas', $kd_pengawas);
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        return $query;
    }
    public function get_soal2($kd_soal)
    {
        $this->db->select('soal.*, paket_soal.jenis_soal');
        $this->db->from('soal');
        $this->db->join('paket_soal', 'paket_soal.kd_paket = soal.kd_paket');
        $this->db->where('soal.kd_soal', $kd_soal);
        $query = $this->db->get();
        return $query;
    }
    public function get_opsi($kd_soal)
    {
        $this->db->select('opsi_pilgan.*');
        $this->db->from('opsi_pilgan');
        $this->db->join('soal', 'soal.kd_soal = opsi_pilgan.kd_soal');
        $this->db->where('opsi_pilgan.kd_soal', $kd_soal);
        $query = $this->db->get();
        return $query;
    }
    public function get_foto($kd_soal)
    {
        $this->db->from('upload_gambar_soal');
        $this->db->where('kd_soal', $kd_soal);
        $query = $this->db->get();
        return $query;
    }
    public function get_file_soal($kd_paket)
    {
        $this->db->from('upload_soal_program');
        $this->db->where('kd_paket', $kd_paket);
        $query = $this->db->get();
        return $query;
    }
    public function kode_paket()
    {
        $this->db->select_max('kd_paket');
        $query = $this->db->get('paket_soal');
        $hasil = $query->row();
        return $hasil->kd_paket;
    }
    public function kode_soal()
    {
        $this->db->select_max('kd_soal');
        $query = $this->db->get('soal');
        $hasil = $query->row();
        return $hasil->kd_soal;
    }

    public function add_paket($data)
    {
        $this->db->insert('paket_soal', $data);
    }
    public function simpan_jawaban($data)
    {
        $this->db->insert('jawaban', $data);
    }
    public function simpan_hasil_pilgan($data)
    {
        $this->db->insert('nilai_pilgan', $data);
    }
    public function simpan_hasil_essay($data)
    {
        $this->db->insert('nilai_essay', $data);
    }
    public function simpan_jawaban_koding($data)
    {
        $this->db->insert('jawaban_koding', $data);
    }
    public function simpan_hasil_koding($data)
    {
        $this->db->insert('nilai_koding', $data);
    }
    public function update_jawaban($data)
    {
        $this->db->where('nim', $data['nim']);
        $this->db->where('kd_pengawas', $data['kd_pengawas']);
        $this->db->where('kd_soal', $data['kd_soal']);
        $this->db->update('jawaban', $data);
    }
    public function update_jawaban_koding($data)
    {
        $this->db->where('nim', $data['nim']);
        $this->db->where('kd_pengawas', $data['kd_pengawas']);
        $this->db->where('kd_paket', $data['kd_paket']);
        $this->db->update('jawaban_koding', $data);
    }
    public function add_batch_soal($data)
    {
        $this->db->insert_batch('soal', $data);
    }
    public function add_batch_pilgan($data)
    {
        $this->db->insert_batch('opsi_pilgan', $data);
    }
    public function add_batch_upload($data)
    {
        $this->db->insert_batch('upload_gambar_soal', $data);
    }
    public function add_upload($data)
    {
        $this->db->insert('upload_soal_program', $data);
    }
    public function edit_paket($kd_paket, $data)
    {
        $this->db->where('kd_paket', $kd_paket);
        $this->db->update('paket_soal', $data);
    }

    public function delete_paket($id)
    {
        $this->db->where('kd_paket', $id);
        $this->db->delete('paket_soal');
    }
    public function delete_soal($id)
    {
        $this->db->where('kd_soal', $id);
        $this->db->delete('soal');
    }
}
