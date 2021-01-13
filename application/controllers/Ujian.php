 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Ujian extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_admin();
            $this->load->model(['m_fakultas', 'm_ujian', 'm_soal', 'm_mahasiswa']);
            $this->load->helper(array('url', 'file'));
        }
        public function lihat_fakultas()
        {
            $fakultas = $this->m_fakultas->get()->result();
            $data = array(
                'title' => "Pilih Fakultas",
                'row' => $fakultas,
            );
            $this->template->load('template', 'ujian/lihat.php', $data);
        }
        public function kode_otomatis()
        {
            $gen_kode = $this->m_ujian->kode_pengawas();
            $nourut = substr($gen_kode, 3, 4);
            $kode = $nourut + 1;
            $kode_hasil = "KP" . str_pad($kode, 4, "0",  STR_PAD_LEFT);
            return $kode_hasil;
        }
        public function lihat_pilgan($jenis, $kd_prodi)
        {
            $paket = $this->m_soal->get4($jenis, $kd_prodi)->result();
            $pilgan = $this->m_ujian->get3($jenis, $kd_prodi)->result();
            $data = array(
                'title' => "Menu Ujian Pilihan Ganda",
                'row' => $pilgan,
                'kd_auto' => $this->kode_otomatis(),
                'paket' => $paket
            );
            $this->template->load('template', 'ujian/lihat_jenis.php', $data);
        }
        public function lihat_essay($jenis, $kd_prodi)
        {
            $paket = $this->m_soal->get4($jenis, $kd_prodi)->result();
            $essay = $this->m_ujian->get3($jenis, $kd_prodi)->result();
            $data = array(
                'title' => "Menu Ujian Essay",
                'row' => $essay,
                'kd_auto' => $this->kode_otomatis(),
                'paket' => $paket
            );
            $this->template->load('template', 'ujian/lihat_jenis.php', $data);
        }
        public function lihat_pemrograman($jenis, $kd_prodi)
        {
            $paket = $this->m_soal->get4($jenis, $kd_prodi)->result();
            $pemrograman = $this->m_ujian->get3($jenis, $kd_prodi)->result();
            $data = array(
                'title' => "Menu Ujian Pemrograman",
                'row' => $pemrograman,
                'kd_auto' => $this->kode_otomatis(),
                'paket' => $paket
            );
            $this->template->load('template', 'ujian/lihat_jenis.php', $data);
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
        public function edit_hal($jenis, $kd_prodi, $kd_pengawas)
        {
            $query = $this->m_ujian->get2($kd_pengawas);
            if ($query->num_rows() > 0) {
                $pengaturan = $query->row();
                $paket = $this->m_ujian->get_paket2($pengaturan->kd_paket, $jenis, $kd_prodi)->result();
                $title = "Edit Ujian " . jenis_soal($jenis);
                $data = array(
                    'row' => $pengaturan,
                    'title' => $title,
                    'paket' => $paket
                );
                $this->template->load('template', 'ujian/form_edit', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('ujian/lihat_jenis/' . $jenis . '/' . $kd_prodi) . "';
 			</script>";
            }
        }
        public function hal_detail($jenis, $kd_prodi, $kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas)->row();
            $data = array(
                'title' => 'Lihat Detail Ujian ' . jenis_soal($jenis),
                'row' => $ujian
            );
            $this->template->load('template', 'ujian/lihat_detail', $data);
        }
        public function process($jenis, $kd_prodi)
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
            if ($jenis == 1) {
                redirect(base_url('ujian/lihat_essay/' . $jenis . '/' . $kd_prodi));
            } elseif ($jenis == 2) {
                redirect(base_url('ujian/lihat_pilgan/' . $jenis . '/' . $kd_prodi));
            } elseif ($jenis == 3) {
                redirect(base_url('ujian/lihat_pemrograman/' . $jenis . '/' . $kd_prodi));
            }
        }
        public function del($jenis, $kd_prodi, $id)
        {
            if (isset($id)) {
                $this->m_ujian->delete_ujian($id);
                $this->session->set_flashdata('msg', 'Ujian <br> Berhasil Dihapus');
                if ($jenis == 1) {
                    redirect(base_url('ujian/lihat_essay/' . $jenis . '/' . $kd_prodi));
                } elseif ($jenis == 2) {
                    redirect(base_url('ujian/lihat_pilgan/' . $jenis . '/' . $kd_prodi));
                } elseif ($jenis == 3) {
                    redirect(base_url('ujian/lihat_pemrograman/' . $jenis . '/' . $kd_prodi));
                }
            }
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
        public function get_opsi_detail($nim, $kd_pengawas)
        {
            $ujian1 = $this->m_ujian->get2($kd_pengawas)->row();
            $ujian = $this->m_soal->get_soal($ujian1->kd_paket)->result();
            $i = 0;
            foreach ($ujian as $d) {
                $ujian[$i]->opsi = $this->m_soal->get_opsi($d->kd_soal)->result();;
                $ujian[$i]->gambar = $this->m_soal->get_foto($d->kd_soal)->result();
                $ujian[$i]->jumlah = $this->m_soal->get_soal($ujian1->kd_paket)->num_rows();
                $ujian[$i]->jawaban = $this->m_soal->get_status_jawab($kd_pengawas, $d->kd_soal, $nim)->result();
                // $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($nim, $kd_pengawas, $d->jenis_soal)->numb_rows();
                $i++;
            }
            return $ujian;
        }
        public function get_ujian($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas)->row();
            $mhs = $this->m_mahasiswa->get_ampu($ujian->nip_dosen)->result();
            $i = 0;
            foreach ($mhs as $d) {
                $mhs[$i]->penilaian = $this->m_ujian->get_nilai($d->nim, $ujian->kd_pengawas, $ujian->jenis_soal)->result();
                $mhs[$i]->jenis = $ujian->jenis_soal;
                $i++;
            }
            return $mhs;
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
        public function lihat_jawaban($jenis, $kd_prodi, $kd_pengawas, $nim)
        {
            $row = $this->get_opsi_detail($nim, $kd_pengawas);
            $ujian1 = $this->m_ujian->get2($kd_pengawas)->row();
            $nilai = $this->m_ujian->get_nilai($nim, $kd_pengawas, $ujian1->jenis_soal)->row();
            $data = array(
                'title' => 'Menu Lihat Jawaban ' . jenis_soal($jenis),
                'row' => $row,
                'nilai' => $nilai
            );
            $this->template->load('template', 'ujian/lihat_jawaban', $data);
        }
        public function lihat_koding($jenis, $kd_prodi, $kd_pengawas, $nim, $id_nilai)
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
                $this->load->view('ujian/lihat_koding', $data);
            }
        }
        public function get_paket()
        {
            $kd_paket = $this->input->post('kd_paket');
            $paket = $this->m_soal->get3($kd_paket)->row();
            echo json_encode($paket);
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
