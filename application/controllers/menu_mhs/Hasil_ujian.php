 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Hasil_ujian extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_soal', 'm_ujian']);
        }
        public function index()
        {
            $ujian = $this->get_mhs_nilai();
            // $dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
            $title = "Menu Hasil Ujian";
            $data = array(
                'row' => $ujian,
                'title' => $title,
            );
            $this->template->load('template', 'menu_mhs/ujian/hasil_ujian', $data);
        }
        public function jajal()
        {
            echo json_encode($this->get_mhs_nilai());
        }
        public function get_mhs_nilai()
        {
            $ujian = $this->m_ujian->get_mhs($this->session->userdata('userid'))->result();
            $i = 0;
            foreach ($ujian as $d) {
                $ujian[$i]->nilai = $this->m_ujian->get_nilai($this->session->userdata('userid'), $d->kd_pengawas, $d->jenis_soal)->result();
                $i++;
            }
            return $ujian;
        }
    }
