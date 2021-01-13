 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Matkul extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_matkul', 'm_kelas', 'm_fakultas', 'm_dosen']);
		}
		public function index()
		{
			$fakultas = $this->m_fakultas->get()->result();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil

			$data = array(
				'title' => "Menu Mata Kuliah",
				'row' => $fakultas,
			);
			$this->template->load('template', 'matkul/lihat.php', $data);
		}
		public function lihat_matkul($kd_prodi)
		{
			$matkul = $this->m_matkul->get2($kd_prodi)->result();
			$kd_matkul = $this->m_matkul->kode_matkul();
			$fakultas = $this->m_fakultas->get()->result();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			$nourut = substr($kd_matkul, 3, 4);
			$kode = $nourut + 1;
			$kode_hasil = "KM" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
			$data = array(
				'title' => "Menu Mata Kuliah",
				'row' => $matkul,
				'fakultas' => $fakultas,
				'kode_matkul' => $kode_hasil
			);
			$this->template->load('template', 'matkul/lihat_matkul.php', $data);
		}
		public function process()
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_matkul->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Matkul <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Matkul <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_matkul->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Matkul <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Matkul <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/matkul'));
		}
		public function edit($id)
		{
			$query = $this->m_matkul->get($id);
			if ($query->num_rows() > 0) {
				$matkul = $query->row();
				$fakultas = $this->m_dosen->get_fakultas($matkul->fakultas)->result();
				$prodi = $this->m_matkul->get_prodi($matkul->fakultas, $matkul->prodi)->result();
				$dosen = $this->m_matkul->get_dosen2($matkul->prodi, $matkul->nip_dosen)->result();
				$data = array(
					'title' => "Edit Matkul",
					'row' => $matkul,
					'fakultas' => $fakultas,
					'prodi' => $prodi,
					'dosen' => $dosen
				);
				$this->template->load('template', 'matkul/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('masterdata/matkul') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_matkul->del($id);
				$this->session->set_flashdata('msg', 'Data Matkul <br> Berhasil Dihapus');
				redirect(base_url('master_data/matkul'));
			}
		}
		public function getkelas()
		{
			$prodi = $this->input->post('id_prodi');
			$query_kelas = $this->m_matkul->get_kelas($prodi)->result();
			echo json_encode($query_kelas);
		}
		public function getdosen()
		{
			$prodi = $this->input->post('id_prodi');
			$query_dosen = $this->m_matkul->get_dosen($prodi)->result();
			echo json_encode($query_dosen);
		}
	}
