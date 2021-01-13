 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Jadwal extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_admin();
            $this->load->model(['m_fakultas', 'm_prodi', 'm_jadwal', 'm_matkul']);
            $this->load->helper(array('url', 'file'));
        }
        public function index()
        {
            $fakultas = $this->m_fakultas->get()->result();
            $data = array(
                'title' => "Pilih Fakultas",
                'row' => $fakultas
            );
            $this->template->load('template', 'jadwal/lihat.php', $data);
        }
        public function lihat_jadwal($id)
        {
            $jadwal = $this->m_jadwal->get($id)->result();
            $data = array(
                'title' => "Menu Jadwal",
                'row' => $jadwal
            );
            $this->template->load('template', 'jadwal/lihat_jadwal.php', $data);
        }
        public function lihat_absen($kd_prodi, $kd_jadwal)
        {
            $query = $this->m_jadwal->get_jadwal($kd_jadwal);
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            if ($query->num_rows() > 0) {
                $jadwal = $query->row();
                $detail = $this->m_jadwal->get_absen($kd_jadwal)->result();
                $data = array(
                    'title' => "Menu Jadwal Kuliah",
                    'jadwal' => $jadwal,
                    'row' => $detail,
                    'file' => $file
                );
                $this->template->load('template', 'jadwal/lihat_absen.php', $data);
            }
        }
        public function hal_add($id)
        {
            $gen_kode = $this->m_jadwal->kode_jadwal();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "J" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            $matkul = $this->m_matkul->get_matkul($id)->result();
            $data = array(
                'title' => "Tambah Jadwal",
                'kode_auto' => $kode_hasil,
                'row' => $matkul,
            );
            $this->template->load('template', 'jadwal/hal_tambah.php', $data);
        }
        public function process($id)
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add'])) {
                $this->m_jadwal->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Jadwal Kuliah <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg_error', 'Jadwal Kuliah <br> Tidak Berhasil Ditambah');
                }
            } else if (isset($_POST['edit'])) {
                $this->m_jadwal->edit($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Jadwal Kuliah <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg_error', 'Jadwal Kuliah <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('jadwal/lihat_jadwal/' . $id));
        }
        // File upload
        public function file_upload($id)
        {
            // Set preference
            $config['upload_path']   = FCPATH . '/upload_materi/';
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
                    'kd_jadwal' => $id
                );
                $this->m_jadwal->add_upload($data);
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->m_jadwal->add_upload($error);
            }
        }
        //Untuk menghapus foto
        function hapus_file()
        {
            //Ambil token foto
            $token = $this->input->post('token');
            $file = $this->m_jadwal->get_file($token);

            if ($file->num_rows() > 0) {
                $hasil = $file->row();
                $nama_foto = $hasil->nama_file;
                if (file_exists($file = FCPATH . '/upload_materi/' . $nama_foto)) {
                    unlink($file);
                }
                $this->m_jadwal->delete_file($token);
            }


            echo "{}";
        }
        public function check_absen()
        {
            $status = $this->input->post('status');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $this->m_jadwal->check_update($status, $kd_jadwal);
            if ($this->db->affected_rows() > 0) {
                if ($status > 0) {
                    $hasil = "Absen Kuliah <br> Berhasil Diaktifkan";
                } else {
                    $hasil = "Absen Kuliah <br> Berhasil Dinonaktifkan";
                }
            } else {
                $hasil = "Absen Kuliah <br> Tidak Berhasil Diaktifkan";
            }
            $data = array(
                'hasil' => $hasil
            );
            echo json_encode($data);
        }
        public function aktifkan_kuliah()
        {
            $status = $this->input->post('status');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $this->m_jadwal->kuliah_update($status, $kd_jadwal);
            if ($this->db->affected_rows() > 0) {
                if ($status > 0) {
                    $hasil = "Kuliah Online <br> Berhasil Diaktifkan";
                } else {
                    $hasil = "Kuliah Online <br> Berhasil Dinonaktifkan";
                }
            } else {
                $hasil = "Kuliah Online <br> Tidak Berhasil Diaktifkan";
            }
            $data = array(
                'hasil' => $hasil
            );
            echo json_encode($data);
        }
        //Untuk menghapus foto
        function hapus_file2()
        {
            //Ambil token foto
            $token = $this->input->post('token');
            $kd_jadwal = $this->input->post('kd_jadwal');
            $file = $this->m_jadwal->get_file($token);

            if ($file->num_rows() > 0) {
                $hasil = $file->row();
                $nama_foto = $hasil->nama_file;
                if (file_exists($file = FCPATH . '/upload_materi/' . $nama_foto)) {
                    unlink($file);
                }
                $this->m_jadwal->delete_file($token);
            }
            $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
            echo json_encode($file);
        }
        //Untuk menghapus foto
        function hapus_file3($kd_jadwal)
        {
            //Ambil token foto
            $file = $this->m_jadwal->get_file2($kd_jadwal);
            if ($file->num_rows() > 0) {
                $hasil = $file->result();
                foreach ($hasil as $key) {
                    if (file_exists($file2 = FCPATH . '/upload_materi/' . $key->nama_file)) {
                        unlink($file2);
                    }
                    $this->m_jadwal->delete_file2($kd_jadwal);
                }
            }
        }
        public function edit($kd_jadwal, $kd_prodi)
        {
            $query = $this->m_jadwal->get_jadwal($kd_jadwal);


            if ($query->num_rows() > 0) {
                $jadwal = $query->row();
                $matkul = $this->m_jadwal->get_matkul($kd_prodi, $jadwal->kd_matkul)->result();
                $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
                $data = array(
                    'title' => "Edit Jadwal",
                    'row' => $jadwal,
                    'matkul' => $matkul,
                    'prodi' => $kd_prodi,
                    'file' => $file
                );
                $this->template->load('template', 'jadwal/form_edit', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('jadwal') . "';
 			</script>";
            }
        }
        public function del($id)
        {
            if (isset($id)) {
                $this->m_jadwal->del($id);
                $this->session->set_flashdata('msg', 'Jadwal Kuliah <br> Berhasil Dihapus');
                $this->hapus_file3($id);
                redirect(base_url('menu_dosen/jadwal'));
            }
        }
        // public function getmatkul()
        // {
        // 	$semester = $this->input->post('semester');
        // 	$prodi = $this->input->post('prodi');
        // 	$kelas = $this->input->post('kelas');
        // 	$query_matkul = $this->m_tugas->get_matkul2($prodi, $semester, $kelas)->result();
        // 	echo json_encode($query_matkul);
        // }
        // public function getkelas()
        // {

        // 	$prodi = $this->input->post('prodi');
        // 	$query_kelas = $this->m_matkul->get_kelas($prodi)->result();
        // 	echo json_encode($query_kelas);
        // }
        // public function getkeldos()
        // {
        // 	$matkul = $this->input->post('matkul');
        // 	$query = $this->m_matkul->get($matkul)->result();
        // 	echo json_encode($query);
        // }
    }
