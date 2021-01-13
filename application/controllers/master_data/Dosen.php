 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Dosen extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_dosen', 'm_fakultas', 'm_prodi']);
		}
		public function index()
		{
			$dosen = $this->m_dosen->get()->result();
			$fak = $this->m_fakultas->get()->result();
			$data = array(
				'title' => "Menu Dosen",
				'row' => $dosen,
				'selected' => null,
				'fakultas' => $fak
			);
			$this->template->load('template', 'dosen/lihat.php', $data);
		}
		public function process()
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_dosen->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Dosen <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Dosen <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_dosen->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Dosen <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Dosen <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/dosen'));
		}
		public function edit($id)
		{
			$query = $this->m_dosen->get($id);
			if ($query->num_rows() > 0) {
				$dosen = $query->row();
				$fakultas = $this->m_dosen->get_fakultas($dosen->fakultas)->result();
				$prodi = $this->m_dosen->get_prodi($dosen->prodi)->result();
				$data = array(
					'title' => "Edit Dosen",
					'row' => $dosen,
					'fakultas' => $fakultas,
					'prodi' => $prodi
				);
				$this->template->load('template', 'dosen/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('masterdata/dosen') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_dosen->del($id);
				$this->session->set_flashdata('msg', 'Data Dosen <br> Berhasil Dihapus');
				redirect(base_url('master_data/dosen'));
			}
		}
		public function getprodi()
		{
			$key = $this->input->post('id');
			$query_prodi = $this->m_dosen->get_prod($key)->result();
			echo json_encode($query_prodi);
		}
	}
