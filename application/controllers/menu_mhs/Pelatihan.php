 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Pelatihan extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_pelatihan', 'm_kelas', 'm_jadwal']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $pelatihan = $this->m_pelatihan->get3($this->session->userdata('userid'))->result();
            $title = "Menu Pelatihan Pemrograman";
            $data = array(
                'row' => $pelatihan,
                'title' => $title,
                'col' => $pelatihan
            );
            $this->template->load('template', 'menu_mhs/pelatihan/lihat.php', $data);
        }
        public function masuk_pelatihan($kd_pelatihan)
        {
            $pelatihan = $this->m_pelatihan->get($kd_pelatihan)->result();
            $data = array(
                'row' => $pelatihan,
                'title' => 'Pelatihan Pemrograman'
            );
            $this->load->view('menu_mhs/pelatihan/pelatihan_koding.php', $data);
        }
        public function detail_pelatihan($kd_pelatihan)
        {
            $pelatihan = $this->m_pelatihan->get($kd_pelatihan)->result();
            $data = array(
                'row' => $pelatihan,
                'title' => 'Menu Detail Pelatihan'
            );
            $this->template->load('template', 'menu_mhs/pelatihan/lihat_detail.php', $data);
        }
        public function download_pelatihan($kd_pelatihan)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_pelatihan->get($kd_pelatihan)->row();
            $data = FCPATH . '/upload_soal_pelatihan/' . $file->nama_file;
            $this->zip->read_file($data);
            $filename = $kd_pelatihan . ".zip";
            $this->zip->download($filename, NULL);
        }
    }
