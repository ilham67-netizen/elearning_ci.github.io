 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Dashboard extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_mahasiswa', 'm_krs', 'm_jadwal']);
        }
        public function index()
        {
            // $data['row'] = $this->item_m->chart_item();
            // $data['record'] = $this->item_m->get_bulan();	
            $data['title'] = "Dashboard";
            $data['jml_matkul'] = $this->m_krs->get_krsmhs($this->session->userdata('userid'))->num_rows();
            $data['jml_tugas'] = $this->m_krs->get_krsmhs2($this->session->userdata('userid'))->num_rows();
            $data['jadwal'] = $this->m_jadwal->get_ampu_mhs($this->session->userdata('userid'))->result();
            $this->template->load('template', 'menu_mhs/dashboard', $data);
        }
    }
