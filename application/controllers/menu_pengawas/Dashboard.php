 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Dashboard extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_pengawas();
			$this->load->model(['m_ujian', 'm_soal', 'm_mahasiswa']);
		}
		public function index()
		{
			// $data['row'] = $this->item_m->chart_item();
			$ujian = $this->m_ujian->get2($this->session->userdata('userid'))->row();
			$data = array(
				'title' => 'Dashboard',
				'row' => $ujian
			);
			$this->template->load('template', 'menu_pengawas/dashboard', $data);
		}
		public function lihat_soal($kd_paket)
		{
			$ujian = $this->get_opsi_detail($kd_paket);
			$data = array(
				'title' => 'Lihat Soal Ujian',
				'row' => $ujian
			);
			$this->template->load('template', 'menu_pengawas/lihat_soal', $data);
		}
		public function lihat_absen($kd_pengawas)
		{
			$absen = $this->m_ujian->get_absen($kd_pengawas)->result();
			$data = array(
				'title' => 'Lihat Absen',
				'row' => $absen
			);
			$this->template->load('template', 'menu_pengawas/lihat_absen', $data);
		}
		public function lihat_hasil($kd_pengawas)
		{
			$ujian = $this->get_ujian_detail($kd_pengawas);
			$data = array(
				'title' => 'Lihat Ujian Mahasiswa',
				'row' => $ujian
			);
			$this->template->load('template', 'menu_pengawas/lihat_hasil', $data);
		}
		public function jajal()
		{
			return print_r($this->get_ujian_detail('KP0001'));
		}
		public function get_opsi_detail($kd_paket)
		{
			$ujian = $this->m_soal->get_soal($kd_paket)->result();
			$i = 0;
			foreach ($ujian as $d) {
				$ujian[$i]->opsi = $this->get_sub_status($d->kd_soal);
				$ujian[$i]->gambar = $this->get_gambar($d->kd_soal);
				$i++;
			}
			return $ujian;
		}

		public function get_sub_status($kd_soal)
		{
			$soal = $this->m_soal->get_opsi($kd_soal)->result();
			$i = 0;
			return $soal;
		}
		public function get_gambar($kd_soal)
		{
			$gambar = $this->m_soal->get_foto($kd_soal)->result();
			return $gambar;
		}
		public function get_ujian_detail($kd_pengawas)
		{
			$ujian = $this->m_ujian->get2($kd_pengawas)->result();
			$i = 0;
			foreach ($ujian as $d) {
				$ujian[$i]->mhs = $this->get_sub_ujian($d->nip_dosen, $kd_pengawas, $d->jenis_soal);
				$i++;
			}
			return $ujian;
		}
		public function get_sub_ujian($nip_dosen, $kd_pengawas, $jenis)
		{
			$mhs = $this->m_mahasiswa->get_ampu($nip_dosen)->result();
			$i = 0;
			foreach ($mhs as $d) {
				$mhs[$i]->cek_nilai = $this->m_ujian->get_nilai($d->nim, $kd_pengawas, $jenis)->num_rows();
				$i++;
			}
			return $mhs;
		}
	}
