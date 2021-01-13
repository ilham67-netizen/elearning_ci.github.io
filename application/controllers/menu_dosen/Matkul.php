 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Matkul extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_matkul']);
        }
        public function index()
        {
            $matkul = $this->m_matkul->get_ampu($this->session->userdata('userid'))->result();

            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $data = array(
                'title' => "Menu Mata Kuliah",
                'row' => $matkul
            );
            $this->template->load('template', 'menu_dosen/matkul/lihat.php', $data);
        }

        public function getdosen()
        {
            $prodi = $this->input->post('id_prodi');
            $query_dosen = $this->m_matkul->get_dosen($prodi)->result();
            echo json_encode($query_dosen);
        }
    }
