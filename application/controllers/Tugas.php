 <?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Tugas extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			check_not_login();
			check_admin();
			$this->load->model(['m_fakultas', 'm_prodi', 'm_dosen', 'm_tugas', 'm_matkul']);
			$this->load->helper(array('url', 'file'));
		}
		public function index()
		{
			$fakultas = $this->m_fakultas->get()->result();
			$data = array(
				'title' => "Menu Tugas",
				'row' => $fakultas
			);
			$this->template->load('template', 'tugas/lihat.php', $data);
		}
		public function lihat_tugas($id)
		{
			$tugas = $this->m_tugas->get($id)->result();
			$data = array(
				'title' => "Menu Tugas",
				'row' => $tugas
			);
			$this->template->load('template', 'tugas/lihat_tugas.php', $data);
		}
		public function lihat_detail_tugas($kd_prodi, $kd_tugas)
		{
			$query = $this->m_tugas->get_tugas($kd_tugas);
			if ($query->num_rows() > 0) {
				$tugas = $query->row();
				$detail = $this->m_tugas->get_mhs_tugas(null, $kd_tugas)->result();
				$file = $this->m_tugas->get_file2($kd_tugas)->result();
				$data = array(
					'title' => "Menu Tugas",
					'tugas' => $tugas,
					'row' => $detail,
					'file' => $file
				);
				$this->template->load('template', 'tugas/lihat_detail_tugas.php', $data);
			}
		}
		public function hal_add($id)
		{
			$gen_kode = $this->m_tugas->kode_tugas();
			// contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
			$nourut = substr($gen_kode, 3, 4);
			$kode = $nourut + 1;
			$kode_hasil = "T" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
			$kelas = $this->m_matkul->get_kelas($id)->result();
			$matkul = $this->m_matkul->get_matkul($id)->result();
			$dosen = $this->m_matkul->get_dosen($id)->result();
			$data = array(
				'title' => "Tambah Tugas",
				'row' => $kelas,
				'kode_auto' => $kode_hasil,
				'matkul' => $matkul,
				'dosen' => $dosen
			);
			$this->template->load('template', 'tugas/hal_tambah.php', $data);
		}
		public function process($id)
		{
			$post = $this->input->post(null, TRUE);
			if (isset($_POST['add'])) {
				$this->m_tugas->add($post);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Tugas <br> Berhasil Ditambah');
				} else {
					$this->session->set_flashdata('msg', 'Data Tugas <br> Tidak Berhasil Ditambah');
				}
			} else if (isset($_POST['edit'])) {
				$this->m_tugas->edit($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', 'Data Tugas <br> Berhasil Diubah');
				} else {
					$this->session->set_flashdata('msg', 'Data Tugas <br> Tidak Berhasil Diubah');
				}
			}
			redirect(base_url('tugas/lihat_tugas/' . $id));
		}
		// File upload
		public function file_upload($id)
		{
			// Set preference
			$config['upload_path']   = FCPATH . '/upload_tugas/';
			$config['max_size']   = 7000;
			$config['allowed_types'] = 'pdf|zip|jpg|png|jpeg';
			//Load upload library
			$this->load->library('upload', $config);

			// // File upload
			if ($this->upload->do_upload('userfile')) {
				// Get data about the file
				$nama = $this->upload->data('file_name');
				$data = array(
					'nama_file'  => $nama,
					'token' => $this->input->post('token_foto'),
					'kd_tugas' => $id
				);
				$this->m_tugas->add_upload($data);
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->m_tugas->add_upload($error);
			}
		}
		//Untuk menghapus foto
		function hapus_file()
		{
			//Ambil token foto
			$token = $this->input->post('token');
			$file = $this->m_tugas->get_file($token);

			if ($file->num_rows() > 0) {
				$hasil = $file->row();
				$nama_foto = $hasil->nama_file;
				if (file_exists($file = FCPATH . '/upload_tugas/' . $nama_foto)) {
					unlink($file);
				}
				$this->m_tugas->delete_file($token);
			}


			echo "{}";
		}
		//Untuk menghapus foto
		function hapus_file2()
		{
			//Ambil token foto
			$token = $this->input->post('token');
			$kd_tugas = $this->input->post('kd_tugas');
			$file = $this->m_tugas->get_file($token);

			if ($file->num_rows() > 0) {
				$hasil = $file->row();
				$nama_foto = $hasil->nama_file;
				if (file_exists($file = FCPATH . '/upload_tugas/' . $nama_foto)) {
					unlink($file);
				}
				$this->m_tugas->delete_file($token);
			}
			$file = $this->m_tugas->get_file2($kd_tugas)->result();
			echo json_encode($file);
		}
		public function edit($kd_tugas, $kd_prodi)
		{
			$query = $this->m_tugas->get_tugas($kd_tugas);


			if ($query->num_rows() > 0) {
				$tugas = $query->row();
				$kelas = $this->m_tugas->get_kelas($kd_prodi, $tugas->kelas)->result();
				$matkul = $this->m_tugas->get_matkul($kd_prodi, $tugas->kd_matkul)->result();
				$file = $this->m_tugas->get_file2($kd_tugas)->result();

				$dosen = $this->m_tugas->get_dosen($kd_prodi, $tugas->nip_dosen)->result();
				$data = array(
					'title' => "Edit Tugas",
					'row' => $tugas,
					'matkul' => $matkul,
					'dosen' => $dosen,
					'kelas' => $kelas,
					'prodi' => $kd_prodi,
					'file' => $file
				);
				$this->template->load('template', 'tugas/form_edit', $data);
			} else {
				echo "<script>
 			alert('Data tidak ditemukan');";
				echo "window.location='" . site_url('tugas') . "';
 			</script>";
			}
		}
		public function del($id)
		{
			if (isset($id)) {
				$this->m_tugas->del($id);
				$this->session->set_flashdata('msg', 'Data Tugas <br> Berhasil Dihapus');
				redirect(base_url('tugas'));
			}
		}
		public function getmatkul()
		{
			$semester = $this->input->post('semester');
			$prodi = $this->input->post('prodi');
			$kelas = $this->input->post('kelas');
			$query_matkul = $this->m_tugas->get_matkul2($prodi, $semester, $kelas)->result();
			echo json_encode($query_matkul);
		}
		public function getkelas()
		{

			$prodi = $this->input->post('prodi');
			$query_kelas = $this->m_matkul->get_kelas($prodi)->result();
			echo json_encode($query_kelas);
		}
		public function getkeldos()
		{
			$matkul = $this->input->post('matkul');
			$query = $this->m_matkul->get($matkul)->result();
			echo json_encode($query);
		}
		function get_tugas_byid()
		{
			$id = $this->input->get('id');
			$data = $this->m_tugas->get_tugasbyid($id)->row();
			echo json_encode($data);
		}
		function get_tugas($kd_tugas)
		{
			$data = $this->m_tugas->get_mhs_tugas(null, $kd_tugas)->result();
			echo json_encode($data);
		}
		function add_tgs()
		{
			$post = $this->input->post(null, TRUE);
			$this->m_tugas->update_nilai($post);
			if ($this->db->affected_rows() > 0) {
				$hasil = 'Data Nilai <br> Berhasil Ditambah';
				$icon = 'success';
			} else {
				$hasil = 'Data Nilai <br> Tidak Berhasil Ditambah';
				$icon = 'error';
			}
			$data = array(
				'hasil' => $hasil,
				'icon' => $icon
			);
			echo json_encode($data);
		}
		public function download_mhs($nim, $kd_tugas)
		{
			$this->load->helper('download');
			$this->load->library('zip');
			$file = $this->m_tugas->get_file_mhs2($nim, $kd_tugas)->result();
			foreach ($file as $isi) {
				$data = FCPATH . '/upload_tugas_mhs/' . $isi->nama_file;
				$this->zip->read_file($data);
			}

			$filename = $nim . ".zip";
			$this->zip->download($filename, NULL);
		}
	}
