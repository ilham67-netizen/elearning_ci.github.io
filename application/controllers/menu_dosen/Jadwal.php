 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Jadwal extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_fakultas', 'm_prodi', 'm_jadwal', 'm_matkul']);
            $this->load->helper(array('url', 'file'));
        }
        public function index()
        {
            $jadwal = $this->m_jadwal->get($this->session->userdata('nip_dosen'))->result();
            $data = array(
                'title' => "Menu Jadwal",
                'row' => $jadwal
            );
            $this->template->load('template', 'menu_dosen/jadwal/lihat.php', $data);
        }
        public function lihat_absen($kd_jadwal)
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
                $this->template->load('template', 'menu_dosen/jadwal/lihat_absen.php', $data);
            }
        }
        public function hal_add()
        {
            $gen_kode = $this->m_jadwal->kode_jadwal();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "J" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            $matkul = $this->m_jadwal->get_matkul2($this->session->userdata('userid'))->result();
            $data = array(
                'title' => "Tambah Jadwal",
                'kode_auto' => $kode_hasil,
                'row' => $matkul,
            );
            $this->template->load('template', 'menu_dosen/jadwal/hal_tambah.php', $data);
        }
        public function process()
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
                    $this->session->set_flashdata('msg', 'Jadwal Kuliah <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('menu_dosen/jadwal/'));
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
        public function edit($kd_jadwal)
        {
            $query = $this->m_jadwal->get_jadwal($kd_jadwal);
            if ($query->num_rows() > 0) {
                $jadwal = $query->row();
                $matkul = $this->m_jadwal->get_matkul3($this->session->userdata('userid'), $jadwal->kd_matkul)->result();
                $file = $this->m_jadwal->get_file2($kd_jadwal)->result();
                $data = array(
                    'title' => "Edit Jadwal",
                    'row' => $jadwal,
                    'matkul' => $matkul,
                    'file' => $file
                );
                $this->template->load('template', 'menu_dosen/jadwal/form_edit', $data);
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
        public function getmatkul()
        {
            $kd_matkul = $this->input->post('id');
            $query_matkul = $this->m_matkul->get($kd_matkul)->row();
            echo json_encode($query_matkul);
        }
    }
