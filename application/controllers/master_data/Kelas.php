 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Kelas extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_kelas', 'm_fakultas', 'm_prodi', 'm_dosen']);
		}
		public function index()
		{
			$kelas = $this->m_kelas->get()->result();
			$gen_kode = $this->m_kelas->kode_kelas();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			$nourut = substr($gen_kode, 3, 4);
			$kode = $nourut + 1;
			$kode_hasil = "K" . str_pad($kode, 4, "0",  STR_PAD_LEFT);

			$fakultas = $this->m_fakultas->get()->result();
			$data = array(
				'title' => "Menu Kelas",
				'row' => $kelas,
				'fakultas' => $fakultas,
				'kd_kelas' => $kode_hasil
			);
			$this->template->load('template', 'kelas/lihat.php', $data);
		}
		public function process()
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_kelas->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Kelas <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Kelas <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_kelas->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Kelas <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Kelas <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/kelas'));
		}
		public function edit($id)
		{
			$query = $this->m_kelas->get($id);
			if ($query->num_rows() > 0) {
				$kelas = $query->row();
				$fakultas = $this->m_dosen->get_fakultas($kelas->fakultas)->result();
				$data = array(
					'title' => "Edit kelas",
					'row' => $kelas,
					'fakultas' => $fakultas
				);
				$this->template->load('template', 'kelas/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('masterdata/kelas') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_kelas->del($id);
				$this->session->set_flashdata('msg', 'Data Kelas <br> Berhasil Dihapus');
				redirect(base_url('master_data/kelas'));
			}
		}
	}
