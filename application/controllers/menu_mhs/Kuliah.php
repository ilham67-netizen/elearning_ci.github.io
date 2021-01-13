 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Kuliah extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_jadwal']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $matkul = $this->m_jadwal->get_ampu_mhs2($this->session->userdata('userid'))->result();
            $matkul2 = $this->m_jadwal->get_ampu_mhs3($this->session->userdata('userid'))->result();
            $matkul3 = $this->m_jadwal->get_ampu_mhs4($this->session->userdata('userid'))->result();
            // $dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
            $title = "Menu Kuliah Online";
            $data = array(
                'matkul' => $matkul,
                'matkul2' => $matkul2,
                'matkul3' => $matkul3,
                'title' => $title,
            );
            $this->template->load('template', 'menu_mhs/kuliah/lihat', $data);
        }
        public function lihat_absen($kd_jadwal)
        {
            $query = $this->m_jadwal->get_jadwal($kd_jadwal);
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            if ($query->num_rows() > 0) {
                $jadwal = $query->row();
                $detail = $this->m_jadwal->get_absen($kd_jadwal)->result();
                $data = array(
                    'title' => "Menu Jadwal Kuliah",
                    'jadwal' => $jadwal,
                    'row' => $detail,
                    'file' => $file
                );
                $this->template->load('template', 'menu_mhs/kuliah/lihat_absen', $data);
            }
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
            $this->template->load('template', 'menu_mhs/kuliah/confrence', $data);
        }
        public function absen_mhs()
        {
            $nim = $this->input->post('nim');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $date = date('Y-m-d H:i');
            $arr = array(
                'nim' => $nim,
                'kd_jadwal' => $kd_jadwal,
                'waktu_absen' => $date
            );
            $absen = $this->m_jadwal->get_absen_mhs($nim, $kd_jadwal)->num_rows();
            if ($absen > 0) {
                $hasil = "Anda Sudah Absen Pada Kuliah Ini";
                $icon = "warning";
            } else {
                $this->m_jadwal->add_absen($arr);
                if ($this->db->affected_rows() > 0) {
                    $hasil = "Selamat Anda <br> Berhasil Absen";
                    $icon = "success";
                } else {
                    $hasil = "Maaf Absen Gagal";
                    $icon = "error";
                }
            }
            $data = array(
                'hasil' => $hasil,
                'icon' => $icon
            );
            echo json_encode($data);
        }
        public function refresh_file()
        {
            $kd_jadwal = $this->input->post('kd_jadwal');
            $jadwal = $this->m_jadwal->get_jadwal($kd_jadwal)->row();
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            $data = array(
                'jadwal2' => $jadwal,
                'file2' => $file
            );
            echo json_encode($data);
        }
    }
