 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_mahasiswa', 'm_dosen', 'm_matkul', 'm_tugas']);
		}
		public function index()
		{
			// $data['row'] = $this->item_m->chart_item();
			// $data['record'] = $this->item_m->get_bulan();	
			$data['title'] = "Dashboard";
			$data['jml_mhs'] = $this->m_mahasiswa->get()->num_rows();
			$data['jml_dosen'] = $this->m_dosen->get()->num_rows();
			$data['jml_matkul'] = $this->m_matkul->get()->num_rows();
			$data['jml_tugas'] = $this->m_tugas->get()->num_rows();
			$this->template->load('template', 'dashboard', $data);
		}
	}
