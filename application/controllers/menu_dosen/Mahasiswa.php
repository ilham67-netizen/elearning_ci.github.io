 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Mahasiswa extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_mahasiswa', 'm_fakultas', 'm_prodi', 'm_matkul']);
        }
        public function index()
        {
            $mhs = $this->m_mahasiswa->get_ampu($this->session->userdata('userid'))->result();
            // $dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
            $title = "Menu Mahasiswa";
            $data = array(
                'row' => $mhs,
                'title' => $title,
            );
            $this->template->load('template', 'menu_dosen/mahasiswa/lihat.php', $data);
        }
    }
