 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_dosen();
			$this->load->model(['m_mahasiswa', 'm_dosen', 'm_matkul']);
		}
		public function index()
		{
			// $data['row'] = $this->item_m->chart_item();
			// $data['record'] = $this->item_m->get_bulan();	
			$data['title'] = "Dashboard";
			$data['jml_mhs_ampu'] = $this->m_mahasiswa->get_ampu($this->session->userdata('userid'))->num_rows();
			$data['jml_matkul_ampu'] = $this->m_matkul->get_ampu($this->session->userdata('userid'))->num_rows();
			$data['jml_tugas_ampu'] = $this->m_matkul->get_ampu($this->session->userdata('userid'))->num_rows();
			$this->template->load('template', 'menu_dosen/dashboard', $data);
		}
	}
