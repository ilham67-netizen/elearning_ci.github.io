 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Kuliah extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_jadwal']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $matkul = $this->m_jadwal->get_ampu($this->session->userdata('userid'))->result();
            // $dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
            $title = "Menu Kuliah Online";
            $data = array(
                'matkul' => $matkul,
                'title' => $title,
            );
            $this->template->load('template', 'menu_dosen/kuliah/lihat.php', $data);
        }
        public function kuliah_daring($kd_jadwal)
        {
            $jadwal = $this->m_jadwal->get_jadwal($kd_jadwal)->row();
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            $data = array(
                'jadwal' => $jadwal,
                'title' => 'Video Confrence',
                'file' => $file
            );
            $this->template->load('template', 'menu_dosen/kuliah/confrence', $data);
        }
        public function check_absen()
        {
            $status = $this->input->post('status');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $this->m_jadwal->check_update($status, $kd_jadwal);
            if ($this->db->affected_rows() > 0) {
                if ($status > 0) {
                    $hasil = "Absen Kuliah <br> Berhasil Diaktifkan";
                } else {
                    $hasil = "Absen Kuliah <br> Berhasil Dinonaktifkan";
                }
            } else {
                $hasil = "Absen Kuliah <br> Tidak Berhasil Diaktifkan";
            }
            $data = array(
                'hasil' => $hasil
            );
            echo json_encode($data);
        }
        public function download_materi($kd_jadwal)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            foreach ($file as $isi) {
                $data = FCPATH . '/upload_materi/' . $isi->nama_file;
                $this->zip->read_file($data);
            }

            $filename = "materi.zip";
            $this->zip->download($filename, NULL);
        }
        public function aktifkan_kuliah()
        {
            $status = $this->input->post('status');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $this->m_jadwal->kuliah_update($status, $kd_jadwal);
            if ($this->db->affected_rows() > 0) {
                if ($status > 0) {
                    $hasil = "Kuliah Online <br> Berhasil Diaktifkan";
                } else {
                    $hasil = "Kuliah Online <br> Berhasil Dinonaktifkan";
                }
            } else {
                $hasil = "Kuliah Online <br> Tidak Berhasil Diaktifkan";
            }
            $data = array(
                'hasil' => $hasil
            );
            echo json_encode($data);
        }
        public function keluar_sesi($kd_jadwal)
        {
            $waktu = date('Y-m-d H:i');
            $this->m_jadwal->update_waktu($waktu, $kd_jadwal);
            redirect(base_url('menu_dosen/kuliah'));
        }
    }
