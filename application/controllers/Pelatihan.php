 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Pelatihan extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_admin();
            $this->load->model(['m_pelatihan', 'm_kelas', 'm_jadwal', 'm_matkul', 'm_fakultas']);
        }
        public function index()
        {
            $fakultas = $this->m_fakultas->get()->result();
            $data = array(
                'title' => "Pilih Fakultas",
                'row' => $fakultas
            );
            $this->template->load('template', 'pelatihan/lihat.php', $data);
        }
        public function lihat_pelatihan($kd_prodi)
        {
            $pelatihan = $this->m_pelatihan->get4($kd_prodi)->result();
            $gen_kode = $this->m_pelatihan->kode_pelatihan();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "PL" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            $matkul = $this->m_matkul->get2($kd_prodi)->result();
            $title = "Menu Pelatihan Pemrograman";
            $data = array(
                'row' => $pelatihan,
                'title' => $title,
                'kd_matkul' => $matkul,
                'kd_auto' => $kode_hasil
            );
            $this->template->load('template', 'pelatihan/lihat_pelatihan.php', $data);
        }
        public function process($kd_prodi)
        {
            if (isset($_POST['add'])) {
                $new_name = time() . '_' . $_FILES["soal"]['name'];
                // create configurasi
                $config['upload_path'] = FCPATH . '/upload_soal_pelatihan/';
                $config['max_size']   = 10000;
                $config['allowed_types'] = 'doc|docx|pdf|zip';
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('soal')) {
                    $data = array(
                        'kd_pelatihan' => $this->input->post('kd_pelatihan'),
                        'nama_pelatihan' => $this->input->post('nama_pelatihan'),
                        'nip_dosen' => $this->input->post('nip_dosen'),
                        'kd_matkul' => $this->input->post('kd_matkul'),
                        'nama_file'  => $this->upload->data('file_name'),
                        'status' => '1',
                        'tanggal_pelatihan' => $this->input->post('tanggal_pelatihan')
                    );
                    $this->m_pelatihan->add($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', 'Pelatihan <br> Berhasil Ditambah');
                    } else {
                        $this->session->set_flashdata('msg_error', 'Pelatihan <br> Tidak Berhasil Ditambah');
                    }
                } else {
                    $this->session->set_flashdata('msg_error', 'Pelatihan <br> Tidak Berhasil Upload Soal');
                }
            } elseif (isset($_POST['edit'])) {
                if (!empty($_FILES['soal']['name'])) {
                    $new_name = time() . '_' . $_FILES["soal"]['name'];
                    // create configurasi
                    $config['upload_path'] = FCPATH . '/upload_soal_pelatihan/';
                    $config['max_size']   = 10000;
                    $config['allowed_types'] = 'doc|docx|pdf|zip';
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('soal')) {
                        $data = array(
                            'kd_pelatihan' => $this->input->post('kd_pelatihan'),
                            'nama_pelatihan' => $this->input->post('nama_pelatihan'),
                            'nip_dosen' => $this->input->post('nip_dosen'),
                            'kd_matkul' => $this->input->post('kd_matkul'),
                            'nama_file'  => $this->upload->data('file_name'),
                            'status' => $this->input->post('status'),
                            'tanggal_pelatihan' => $this->input->post('tanggal_pelatihan')
                        );
                        $this->m_pelatihan->edit($data);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('msg', 'Pelatihan <br> Berhasil Diubah');
                        } else {
                            $this->session->set_flashdata('msg', 'Pelatihan <br> Tidak Berhasil Diubah');
                        }
                    }
                } else {
                    $data = array(
                        'kd_pelatihan' => $this->input->post('kd_pelatihan'),
                        'nama_pelatihan' => $this->input->post('nama_pelatihan'),
                        'nip_dosen' => $this->input->post('nip_dosen'),
                        'kd_matkul' => $this->input->post('kd_matkul'),
                        'status' => $this->input->post('status'),
                        'tanggal_pelatihan' => $this->input->post('tanggal_pelatihan')
                    );
                    $this->m_pelatihan->edit($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', 'Pelatihan <br> Berhasil Diubah');
                    } else {
                        $this->session->set_flashdata('msg', 'Pelatihan <br> Tidak Berhasil Diubah');
                    }
                }
            }
            redirect(base_url('pelatihan/lihat_pelatihan/' . $kd_prodi));
        }
        public function edit($kd_prodi, $kd_pelatihan)
        {
            $pelatihan = $this->m_pelatihan->get($kd_pelatihan);
            if ($pelatihan->num_rows() > 0) {
                $row = $pelatihan->row();
                $matkul = $this->m_matkul->get3($kd_prodi, $row->kd_matkul)->result();;
                $data = array(
                    'title' => 'Menu Edit Pelatihan',
                    'kd_matkul' => $matkul,
                    'row' => $row
                );
                $this->template->load('template', 'pelatihan/form_edit', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('pelatihan/lihat_pelatihan/' . $kd_prodi) . "';
 			</script>";
            }
        }
        //Untuk menghapus foto
        function hapus_file($kd_pelatihan)
        {
            //Ambil token foto
            $file = $this->m_pelatihan->get($kd_pelatihan);
            if ($file->num_rows() > 0) {
                $hasil = $file->row();
                if (file_exists($file2 = FCPATH . '/upload_soal_pelatihan/' . $hasil->nama_file)) {
                    unlink($file2);
                }
            }
        }
        public function del($kd_prodi, $id)
        {
            if (isset($id)) {
                $this->m_pelatihan->del($id);
                $this->session->set_flashdata('msg', 'Pelatihan <br> Berhasil Dihapus');
                $this->hapus_file($id);
                redirect(base_url('pelatihan/lihat_pelatihan/' . $kd_prodi));
            }
        }
        public function masuk_pelatihan($kd_prodi, $kd_pelatihan)
        {
            $pelatihan = $this->m_pelatihan->get($kd_pelatihan);
            $data = array(
                'title' => 'Menu Pemrograman',
                'row' => $pelatihan
            );
            $this->load->view('pelatihan/masuk_pemrograman.php', $data);
        }
        public function download_pelatihan($kd_pelatihan)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_pelatihan->get($kd_pelatihan)->row();
            $data = FCPATH . '/upload_soal_pelatihan/' . $file->nama_file;
            $this->zip->read_file($data);
            $filename = $kd_pelatihan . ".zip";
            $this->zip->download($filename, NULL);
        }
    }
