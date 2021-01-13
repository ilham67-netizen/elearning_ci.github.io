 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Mahasiswa extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_mahasiswa', 'm_fakultas', 'm_prodi', 'm_matkul']);
		}
		public function index()
		{
			$fakultas = $this->m_fakultas->get()->result();
			$data = array(
				'row' => $fakultas,
				'title' => "Menu Mahasiswa"
			);
			$this->template->load('template', 'mahasiswa/lihat.php', $data);
		}
		public function lihat_mhs($kd_prodi)
		{
			$mhs = $this->m_mahasiswa->get_mhs($kd_prodi)->result();
			$prodi = $this->m_prodi->get($kd_prodi)->row();
			$dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
			$title = "Menu Mahasiswa";
			$data = array(
				'row' => $mhs,
				'title' => $title,
				'prodi' => $prodi,
				'dosen' => $dosen
			);
			$this->template->load('template', 'mahasiswa/lihat_mahasiswa.php', $data);
		}
		public function process($kd_prodi)
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_mahasiswa->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Mahasiswa <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Mahasiswa <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_mahasiswa->edit($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Mahasiswa <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Mahasiswa <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/mahasiswa/lihat_mhs/' . $kd_prodi));
		}
		public function edit($kd_prodi, $nim)
		{
			$query = $this->m_mahasiswa->get($nim);

			if ($query->num_rows() > 0) {
				$mahasiswa = $query->row();
				$dosen = $this->m_matkul->get_dosen2($kd_prodi, $mahasiswa->dosbing_akad)->result();
				$title = "Edit Mahasiswa";
				$data = array(
					'row' => $mahasiswa,
					'title' => $title,
					'dosen' => $dosen
				);

				$this->template->load('template', 'mahasiswa/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('mahasiswa/lihat_mhs' . $kd_prodi) . "';
 			</script>";
			}
		}
		public function del($kd_prodi, $nim)
		{
			if (isset($nim)) {
				$this->db->where('nim', $nim);
				$this->db->delete('mahasiswa');
				$this->session->set_flashdata('msg', 'Data Mahasiswa <br> Berhasil Dihapus');
				redirect(base_url('master_data/mahasiswa/lihat_mhs/' . $kd_prodi));
			}
		}
	}
