 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Paket_soal extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_soal', 'm_tugas', 'm_matkul', 'm_jadwal']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $gen_kode = $this->m_soal->kode_paket();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "PS" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            $matkul = $this->m_jadwal->get_matkul2($this->session->userdata('userid'))->result();
            $paket = $this->m_soal->get2($this->session->userdata('userid'))->result();
            $data = array(
                'title' => "Paket Soal",
                'row' => $paket,
                'kd_auto' => $kode_hasil,
                'kd_matkul' => $matkul
            );
            $this->template->load('template', 'menu_dosen/soal/lihat_paket', $data);
        }
        public function lihat_soal($kd_paket)
        {
            $soal = $this->m_soal->get_soal($kd_paket)->result();
            $data = array(
                'title' => "Soal Ujian",
                'row' => $soal
            );
            $this->template->load('template', 'menu_dosen/soal/lihat_soal', $data);
        }
        public function tambah_soal($kd_paket)
        {
            $gen_kode = $this->m_soal->kode_soal();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            $hitung = $this->m_soal->get($kd_paket, $this->session->userdata('userid'));
            if ($hitung->num_rows() > 0) {
                $paket = $hitung->row();
                $data = array(
                    'title' => "Tambah Soal",
                    'row' => $paket,
                    'kd_auto' => $kode_hasil
                );
                $jenis = $hitung->row();
                if ($jenis->jenis_soal == 1) {
                    $this->template->load('template', 'menu_dosen/soal/tambah_essay', $data);
                } elseif ($jenis->jenis_soal == 2) {
                    $this->template->load('template', 'menu_dosen/soal/tambah_soal', $data);
                } elseif ($jenis->jenis_soal == 4) {
                    $this->template->load('template', 'menu_dosen/soal/tambah_pilgansay', $data);
                }
            }
        }
        public function edit_paket($kd_paket)
        {
            $hitung = $this->m_soal->get($kd_paket, $this->session->userdata('userid'));
            if ($hitung->num_rows() > 0) {
                $paket = $hitung->row();
                $matkul = $this->m_jadwal->get_matkul3($this->session->userdata('userid'), $paket->kd_matkul)->result();
                $data = array(
                    'title' => "Edit Paket Ujian",
                    'row' => $paket,
                    'matkul' => $matkul
                );
                $this->template->load('template', 'menu_dosen/soal/edit_paket', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('menu_dosen/soal/' . $kd_paket) . "';
 			</script>";
            }
        }
        public function process()
        {
            if (isset($_POST['add'])) {
                if (!empty($_FILES['soal']['name'])) {
                    $new_name = time() . '_' . $_FILES["soal"]['name'];
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_soal_program/';
                    $config['max_size']   = 10000;
                    $config['allowed_types'] = 'doc|docx|pdf|zip';
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('soal')) {
                        $data = array(
                            'kd_paket' => $this->input->post('kd_paket'),
                            'jenis_soal' => $this->input->post('jenis_soal'),
                            'kd_matkul' => $this->input->post('kd_matkul'),
                            'tanggal_buat' => date('Y-m-d H:i'),
                            'waktu_soal' => $this->input->post('waktu_soal')
                        );
                        $data2 = array(
                            'nama_file'  => $this->upload->data('file_name'),
                            'kd_paket' => $this->input->post('kd_paket'),
                            'nip_dosen' => $this->input->post('nip_dosen'),
                        );
                        $this->m_soal->add_paket($data);
                        $this->m_soal->add_upload($data2);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Ditambah');
                        } else {
                            $this->session->set_flashdata('msg', 'Paket Soal <br> Tidak Berhasil Ditambah');
                        }
                    }
                } else {
                    $data = array(
                        'kd_paket' => $this->input->post('kd_paket'),
                        'jenis_soal' => $this->input->post('jenis_soal'),
                        'kd_matkul' => $this->input->post('kd_matkul'),
                        'tanggal_buat' => date('Y-m-d H:i'),
                        'waktu_soal' => $this->input->post('waktu_soal')
                    );
                    $this->m_soal->add_paket($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Ditambah');
                    } else {
                        $this->session->set_flashdata('msg_eror', 'Paket Soal <br> Tidak Berhasil Ditambah');
                    }
                }
            } elseif (isset($_POST['edit'])) {
                // jika ada file gambar
                if (!empty($_FILES['soal']['name'])) {
                    $new_name = time() . $_FILES["soal"]['name'];
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_soal_program/';
                    $config['max_size']   = 10000;
                    $config['allowed_types'] = 'doc|docx|pdf|zip';
                    // $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('soal')) {
                        $data = array(
                            'kd_paket' => $this->input->post('kd_paket'),
                            'jenis_soal' => $this->input->post('jenis_soal'),
                            'kd_matkul' => $this->input->post('kd_matkul'),
                            'tanggal_buat' => date('Y-m-d H:i'),
                            'waktu_soal' => $this->input->post('waktu_soal')
                        );
                        $data2 = array(
                            'nama_file'  => $this->upload->data('file_name'),
                            'kd_paket' => $this->input->post('kd_paket'),
                            'nip_dosen' => $this->input->post('nip_dosen')
                        );
                        $this->m_soal->edit_paket($this->input->post('kd_paket'), $data);
                        $this->m_soal->add_upload($data2);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Diubah');
                        } else {
                            $this->session->set_flashdata('msg', 'Paket Soal <br> Tidak Diubah');
                        }
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        $this->m_soal->add_upload($error);
                    }
                } else {
                    $data = array(
                        'kd_paket' => $this->input->post('kd_paket'),
                        'jenis_soal' => $this->input->post('jenis_soal'),
                        'kd_matkul' => $this->input->post('kd_matkul'),
                        'tanggal_buat' => date('Y-m-d H:i'),
                        'waktu_soal' => $this->input->post('waktu_soal')
                    );
                    $this->m_soal->edit_paket($this->input->post('kd_paket'), $data);
                    // jika data tertambah ke database
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Diubah');
                    } else {
                        $this->session->set_flashdata('msg', 'Paket Soal <br> Tidak Diubah');
                    }
                }
            }
            redirect(base_url('menu_dosen/paket_soal'));
        }
        public function proses_soal()
        {
            $post = $this->input->post();
            if (isset($post['add'])) {
                // mengambil data kode
                $gen_kode = $this->m_soal->kode_soal();
                // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
                $nourut = substr($gen_kode, 3, 4);
                $i = 1;
                foreach ($post['pertanyaan'] as $key => $value) {
                    // Difine photo upload
                    $ext = substr(strrchr($_FILES['gambar']['name'][$key], '.'), 1);
                    $_FILES['file']['name'] = time() . $key . "_" . ($key + 1) . "." . $ext;
                    $_FILES['file']['type'] = $_FILES['gambar']['type'][$key];
                    $_FILES['file']['tmp_name'] = $_FILES['gambar']['tmp_name'][$key];
                    $_FILES['file']['error'] = $_FILES['gambar']['error'][$key];
                    $_FILES['file']['size'] = $_FILES['gambar']['size'][$key];
                    // end difine
                    $filenamed  = time() . $key . "_" . ($key + 1) . "." . $ext;
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_gambar/';
                    $config['max_size']   = 5000;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    // end create

                    $this->load->library('upload', $config);
                    $kode = $nourut + $i++;
                    // Jika file gambar tidak ada
                    if (!$_FILES['gambar']['name'][$key]) {
                        $soal[] = array(
                            'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                            'kd_paket' => $post['kd_paket'],
                            'pertanyaan' => $post['pertanyaan'][$key],
                            'kunci_jawaban' => $post['kunci_jawaban'][$key]

                        );
                        $pilgan[] = array(
                            'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                            'kd_paket' => $post['kd_paket'],
                            'opsi_a' => $post['jawaban_a'][$key],
                            'opsi_b' => $post['jawaban_b'][$key],
                            'opsi_c' => $post['jawaban_c'][$key],
                            'opsi_d' => $post['jawaban_d'][$key],
                            'opsi_e' => $post['jawaban_e'][$key],

                        );
                    } else {
                        // melakukan proses upload dan memasukkan data ke database
                        if ($this->upload->do_upload('file')) {
                            $soal[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'pertanyaan' => $post['pertanyaan'][$key],
                                'kunci_jawaban' => $post['kunci_jawaban'][$key]

                            );
                            $pilgan[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'opsi_a' => $post['jawaban_a'][$key],
                                'opsi_b' => $post['jawaban_b'][$key],
                                'opsi_c' => $post['jawaban_c'][$key],
                                'opsi_d' => $post['jawaban_d'][$key],
                                'opsi_e' => $post['jawaban_e'][$key],

                            );

                            $gambar[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'nama_file' => $filenamed
                            );
                        }
                    }
                }
                $this->m_soal->add_batch_soal($soal);
                $this->m_soal->add_batch_pilgan($pilgan);
                if ($gambar) {
                    $this->m_soal->add_batch_upload($gambar);
                }

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Soal <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg_error', 'Soal Ujian <br> Tidak Berhasil Ditambah');
                }
            }
            redirect(base_url('menu_dosen/paket_soal/lihat_soal/' . $post['kd_paket']));
        }
        public function proses_essay()
        {
            $post = $this->input->post();
            if (isset($post['add'])) {
                // mengambil data kode
                $gen_kode = $this->m_soal->kode_soal();
                // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
                $nourut = substr($gen_kode, 3, 4);
                $i = 1;
                foreach ($post['pertanyaan'] as $key => $value) {
                    $kode = $nourut + $i++;
                    $ext = substr(strrchr($_FILES['gambar']['name'][$key], '.'), 1);
                    $_FILES['file']['name'] = time() . $key . "_" . ($key + 1) . "." . $ext;
                    $_FILES['file']['type'] = $_FILES['gambar']['type'][$key];
                    $_FILES['file']['tmp_name'] = $_FILES['gambar']['tmp_name'][$key];
                    $_FILES['file']['error'] = $_FILES['gambar']['error'][$key];
                    $_FILES['file']['size'] = $_FILES['gambar']['size'][$key];
                    // end difine
                    $filenamed  = time() . $key . "_" . ($key + 1) . "." . $ext;
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_gambar/';
                    $config['max_size']   = 5000;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    // end create

                    $this->load->library('upload', $config);
                    // Jika file gambar tidak ada
                    if (!$_FILES['gambar']['name'][$key]) {
                        $soal[] = array(
                            'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                            'kd_paket' => $post['kd_paket'],
                            'pertanyaan' => $post['pertanyaan'][$key],
                            'kunci_jawaban' => "-"

                        );
                    } else {
                        // melakukan proses upload dan memasukkan data ke database
                        if ($this->upload->do_upload('file')) {
                            $soal[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'pertanyaan' => $post['pertanyaan'][$key],
                                'kunci_jawaban' => "-"

                            );
                            $gambar[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'nama_file' => $filenamed
                            );
                        }
                    }
                }
                $this->m_soal->add_batch_soal($soal);
                if ($gambar) {
                    $this->m_soal->add_batch_upload($gambar);
                }

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Soal <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg_error', 'Soal Ujian <br> Tidak Berhasil Ditambah');
                }
                redirect(base_url('menu_dosen/paket_soal/lihat_soal/' . $post['kd_paket']));
            }
        }
        public function proses_pilgansay()
        {
            $post = $this->input->post();
            if (isset($post['add'])) {
                // mengambil data kode
                $gen_kode = $this->m_soal->kode_soal();
                // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
                $nourut = substr($gen_kode, 3, 4);
                $i = 1;
                foreach ($post['pertanyaan'] as $key => $value) {
                    // Difine photo upload
                    $ext = substr(strrchr($_FILES['gambar']['name'][$key], '.'), 1);
                    $_FILES['file']['name'] = time() . $key . "_" . ($key + 1) . "." . $ext;
                    $_FILES['file']['type'] = $_FILES['gambar']['type'][$key];
                    $_FILES['file']['tmp_name'] = $_FILES['gambar']['tmp_name'][$key];
                    $_FILES['file']['error'] = $_FILES['gambar']['error'][$key];
                    $_FILES['file']['size'] = $_FILES['gambar']['size'][$key];
                    // end difine
                    $filenamed  = time() . $key . "_" . ($key + 1) . "." . $ext;
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_gambar/';
                    $config['max_size']   = 5000;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    // end create

                    $this->load->library('upload', $config);
                    $kode = $nourut + $i++;
                    // Jika file gambar tidak ada
                    if (!$_FILES['gambar']['name'][$key]) {

                        if ($post['kunci_jawaban'][$key]) {
                            $soal[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'pertanyaan' => $post['pertanyaan'][$key],
                                'kunci_jawaban' => $post['kunci_jawaban'][$key]
                            );
                            $pilgan[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'opsi_a' => $post['jawaban_a'][$key],
                                'opsi_b' => $post['jawaban_b'][$key],
                                'opsi_c' => $post['jawaban_c'][$key],
                                'opsi_d' => $post['jawaban_d'][$key],
                                'opsi_e' => $post['jawaban_e'][$key],

                            );
                        } elseif (!$post['kunci_jawaban'][$key]) {
                            $soal[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'pertanyaan' => $post['pertanyaan'][$key],
                                'kunci_jawaban' => '-'

                            );
                        }
                    } else {
                        // melakukan proses upload dan memasukkan data ke database
                        if ($this->upload->do_upload('file')) {

                            if ($post['kunci_jawaban'][$key]) {
                                $soal[] = array(
                                    'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                    'kd_paket' => $post['kd_paket'],
                                    'pertanyaan' => $post['pertanyaan'][$key],
                                    'kunci_jawaban' => $post['kunci_jawaban'][$key]

                                );
                                $pilgan[] = array(
                                    'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                    'kd_paket' => $post['kd_paket'],
                                    'opsi_a' => $post['jawaban_a'][$key],
                                    'opsi_b' => $post['jawaban_b'][$key],
                                    'opsi_c' => $post['jawaban_c'][$key],
                                    'opsi_d' => $post['jawaban_d'][$key],
                                    'opsi_e' => $post['jawaban_e'][$key],

                                );
                            } elseif (!$post['kunci_jawaban'][$key]) {
                                $soal[] = array(
                                    'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                    'kd_paket' => $post['kd_paket'],
                                    'pertanyaan' => $post['pertanyaan'][$key],
                                    'kunci_jawaban' => '-'

                                );
                            }


                            $gambar[] = array(
                                'kd_soal' => "SO" . str_pad($kode, 4, "0",  STR_PAD_LEFT),
                                'kd_paket' => $post['kd_paket'],
                                'nama_file' => $filenamed
                            );
                        }
                    }
                }
                $this->m_soal->add_batch_soal($soal);
                if ($pilgan) {
                    $this->m_soal->add_batch_pilgan($pilgan);
                }
                if ($gambar) {
                    $this->m_soal->add_batch_upload($gambar);
                }

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Soal <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg_error', 'Soal Ujian <br> Tidak Berhasil Ditambah');
                }
            }
            redirect(base_url('menu_dosen/paket_soal/lihat_soal/' . $post['kd_paket']));
        }
        public function getmatkul()
        {
            $kd_matkul = $this->input->post('kd_matkul');
            if (!$kd_matkul) {
                $query_matkul = $this->m_matkul->get_ampu($this->session->userdata('userid'))->row();
            } else {
                $query_matkul = $this->m_matkul->get($kd_matkul)->row();
            }

            echo json_encode($query_matkul);
        }
        public function del($id)
        {
            if (isset($id)) {
                $this->m_soal->delete_paket($id);
                $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Dihapus');
                redirect(base_url('menu_dosen/paket_soal'));
            }
        }
        public function del_soal($kd_soal, $kd_paket)
        {
            if (isset($kd_soal)) {
                $this->m_soal->delete_soal($kd_soal);
                $this->session->set_flashdata('msg', 'Soal Ujian <br> Berhasil Dihapus');
                redirect(base_url('menu_dosen/paket_soal/lihat_soal/' . $kd_paket));
            }
        }
        public function download_soal($kd_paket)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_soal->get_file_soal($kd_paket)->result();
            foreach ($file as $isi) {
                $data = FCPATH . '/upload_soal_program/' . $isi->nama_file;
                $this->zip->read_file($data);
            }

            $filename = $kd_paket . ".zip";
            $this->zip->download($filename, NULL);
        }
    }
