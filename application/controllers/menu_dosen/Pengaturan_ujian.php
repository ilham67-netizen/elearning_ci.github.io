 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Pengaturan_ujian extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_ujian', 'm_soal', 'm_mahasiswa']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $paket = $this->m_soal->get2($this->session->userdata('userid'))->result();
            $pengaturan = $this->m_ujian->get($this->session->userdata('userid'))->result();
            $gen_kode = $this->m_ujian->kode_pengawas();
            // contoh JRD0004, angka 3 adalah awal pengambilan angka, dan 4 jumlah angka yang diambil
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "KP" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            // $dosen = $this->m_matkul->get_dosen($kd_prodi)->result();
            $title = "Menu Pengaturan Ujian";
            $data = array(
                'paket' => $paket,
                'pengaturan' => $pengaturan,
                'title' => $title,
                'kd_auto' => $kode_hasil
            );
            $this->template->load('template', 'menu_dosen/pengaturan_ujian/lihat', $data);
        }
        public function jajal($kd_pengawas)
        {
            echo json_encode($this->get_ujian($kd_pengawas));
        }
        public function jajal2()
        {
            $id_nilai = $this->input->get('id');
            $jenis = $this->input->get('jenis');
            echo json_encode($this->get_ujian_byid($id_nilai, $jenis));
        }
        public function jajal3($nim, $kd_pengawas)
        {
            echo json_encode($this->get_opsi_detail($nim, $kd_pengawas));
        }
        public function jajal4($nim, $kd_pengawas)
        {
            $ujian1 = $this->m_ujian->get2($kd_pengawas)->row();
            $nilai = $this->m_ujian->get_nilai($nim, $kd_pengawas, $ujian1->jenis_soal)->row();
            echo json_encode($nilai);
        }
        public function lihat_jawaban($nim, $kd_pengawas)
        {
            $row = $this->get_opsi_detail($nim, $kd_pengawas);
            $ujian1 = $this->m_ujian->get2($kd_pengawas)->row();
            $nilai = $this->m_ujian->get_nilai($nim, $kd_pengawas, $ujian1->jenis_soal)->row();
            $data = array(
                'title' => 'Menu Lihat Jawaban',
                'row' => $row,
                'nilai' => $nilai
            );
            $this->template->load('template', 'menu_dosen/pengaturan_ujian/lihat_jawaban', $data);
        }
        public function lihat_koding($nim, $kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $jawaban = $this->m_soal->get_status_koding($kd_pengawas, $hasil->kd_paket, $nim)->row();
                $data = array(
                    'title' => 'HASIL JAWABAN PEMROGRAMAN',
                    'row' => $hasil,
                    'jawab' => $jawaban
                );
                $this->load->view('menu_dosen/pengaturan_ujian/lihat_koding', $data);
            }
        }
        public function get_opsi_detail($nim, $kd_pengawas)
        {
            $ujian1 = $this->m_ujian->get2($kd_pengawas)->row();
            $ujian = $this->m_soal->get_soal($ujian1->kd_paket)->result();
            $i = 0;
            foreach ($ujian as $d) {
                $ujian[$i]->opsi = $this->get_sub_status($d->kd_soal);
                $ujian[$i]->gambar = $this->get_gambar($d->kd_soal);
                $ujian[$i]->jumlah = $this->m_soal->get_soal($ujian1->kd_paket)->num_rows();
                $ujian[$i]->jawaban = $this->get_jawaban($kd_pengawas, $d->kd_soal, $nim);
                // $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($nim, $kd_pengawas, $d->jenis_soal)->numb_rows();
                $i++;
            }
            return $ujian;
        }
        public function get_sub_status($kd_soal)
        {
            $soal = $this->m_soal->get_opsi($kd_soal)->result();
            $i = 0;
            return $soal;
        }
        public function get_gambar($kd_soal)
        {
            $gambar = $this->m_soal->get_foto($kd_soal)->result();
            return $gambar;
        }
        public function get_jawaban($kd_pengawas, $kd_soal, $nim)
        {
            $jawab = $this->m_soal->get_status_jawab($kd_pengawas, $kd_soal, $nim)->result();
            return $jawab;
        }
        public function add_nilai_ujian()
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['nim'])) {
                $this->m_ujian->update_nilai_ujian($post);
                if ($this->db->affected_rows() > 0) {
                    $hasil = 'Ujian <br> Berhasil Diubah';
                    $icon = 'success';
                } else {
                    $hasil = 'Ujian <br> Tidak Berhasil Ditambah';
                    $icon = 'error';
                }
                $data = array(
                    'hasil' => $hasil,
                    'icon' => $icon
                );
                echo json_encode($data);
            }
        }
        public function edit_hal($kd_pengawas)
        {
            $query = $this->m_ujian->get2($kd_pengawas);
            if ($query->num_rows() > 0) {
                $pengaturan = $query->row();
                $paket = $this->m_ujian->get_paket($pengaturan->kd_paket, $pengaturan->nip_dosen)->result();
                $title = "Edit Pengaturan Ujian";
                $data = array(
                    'row' => $pengaturan,
                    'title' => $title,
                    'paket' => $paket
                );
                $this->template->load('template', 'menu_dosen/pengaturan_ujian/form_edit', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('menu_dosen/pengaturan_ujian') . "';
 			</script>";
            }
        }
        public function hal_detail($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas)->row();
            $data = array(
                'title' => 'Lihat Detail Ujian',
                'row' => $ujian
            );
            $this->template->load('template', 'menu_dosen/pengaturan_ujian/lihat_detail', $data);
        }
        public function process()
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add'])) {
                $this->m_ujian->add_ujian($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Ujian Telah <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg', 'Ujian <br> Tidak Berhasil Ditambah');
                }
            } elseif (isset($_POST['edit'])) {
                $this->m_ujian->edit_ujian($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Paket Soal <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg', 'Paket Soal <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('menu_dosen/pengaturan_ujian'));
        }
        public function get_ujian($kd_pengawas)
        {
            $hitung = $this->m_ujian->get2($kd_pengawas);
            if ($hitung->num_rows() > 0) {
                $ujian = $hitung->row();
                $mhs = $this->m_mahasiswa->get_ampu($ujian->nip_dosen)->result();
                $i = 0;
                foreach ($mhs as $d) {
                    $mhs[$i]->penilaian = $this->m_ujian->get_nilai($d->nim, $ujian->kd_pengawas, $ujian->jenis_soal)->result();
                    $mhs[$i]->jenis = $ujian->jenis_soal;
                    $i++;
                }
                return $mhs;
            }
        }
        public function get_ujian_byid($id_nilai, $jenis)
        {
            $nilai = $this->m_ujian->get_nilai2($id_nilai, $jenis)->row();
            $mhs = $this->m_mahasiswa->get($nilai->nim)->row();
            $pengawas = $this->m_ujian->get2($nilai->kd_pengawas)->row();
            $data = array(
                'nilai' => $nilai,
                'mahasiswa' => $mhs,
                'pengawas' => $pengawas
            );
            return $data;
        }
        public function del($id)
        {
            if (isset($id)) {
                $this->m_ujian->delete_ujian($id);
                $this->session->set_flashdata('msg', 'Ujian <br> Berhasil Dihapus');
                redirect(base_url('menu_dosen/pengaturan_ujian'));
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
