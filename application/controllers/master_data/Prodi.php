 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Prodi extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_prodi', 'm_fakultas']);
		}
		public function index()
		{
			$prodi = $this->m_prodi->get()->result();
			$query_fak = $this->m_fakultas->get();
			$fak[null] = "--- Pilih Fakultas ---";
			foreach ($query_fak->result() as $fk) {
				$fak[$fk->kd_fakultas] = $fk->nama_fakultas;
			}
			$data = array(
				'title' => "Menu Prodi",
				'selected' => null,
				'row' => $prodi,
				'fakultas' => $fak
			);
			$this->template->load('template', 'prodi/lihat.php', $data);
		}
		public function process()
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_prodi->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Prodi <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Prodi <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_prodi->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Prodi <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Prodi <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('master_data/prodi'));
		}
		public function edit($id)
		{
			$query = $this->m_prodi->get($id);
			if ($query->num_rows() > 0) {
				$prodi = $query->row();
				$query_fak = $this->m_fakultas->get();
				$fak[null] = "--- Pilih Fakultas ---";
				foreach ($query_fak->result() as $fk) {
					$fak[$fk->kd_fakultas] = $fk->nama_fakultas;
				}
				$data = array(
					'title' => "Edit prodi",
					'row' => $prodi,
					'fakultas' => $fak
				);
				$this->template->load('template', 'prodi/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('masterdata/prodi') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_prodi->del($id);
				$this->session->set_flashdata('msg', 'Data Prodi <br> Berhasil Dihapus');
				redirect(base_url('master_data/prodi'));
			}
		}
	}
