 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Fakultas extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_fakultas']);
		}
		public function index()
		{
			$fakultas = $this->m_fakultas->get()->result();
			$data = array(
				'title' => "Menu Fakultas",
				'row' => $fakultas
			);
			$this->template->load('template', 'fakultas/lihat.php', $data);
		}
		public function process()
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_fakultas->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Fakultas <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Fakultas <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_fakultas->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Fakultas <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Fakultas <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/fakultas'));
		}
		public function edit($id)
		{
			$query = $this->m_fakultas->get($id);
			if ($query->num_rows() > 0) {
				$fakultas = $query->row();
				$data = array(
					'title' => "Edit Fakultas",
					'row' => $fakultas
				);
				$this->template->load('template', 'fakultas/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('masterdata/fakultas') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_fakultas->del($id);
				$this->session->set_flashdata('msg', 'Data Fakultas <br> Berhasil Dihapus');
				redirect(base_url('master_data/fakultas'));
			}
		}
	}
