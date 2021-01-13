 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Ujian extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_mahasiswa', 'm_ujian', 'm_jadwal', 'm_soal']);
            date_default_timezone_set('Asia/Jakarta');
        }
        public function index()
        {
            $ujian = $this->m_ujian->get_mhs($this->session->userdata('userid'))->result();
            $test = $this->get_opsi_detail3();
            $data = array(
                'title' => 'Menu Ujian',
                'row' => $ujian,
                'col' => $test
            );


            $this->template->load('template', 'menu_mhs/ujian/lihat', $data);
        }
        public function jajal()
        {
            $hal = $this->input->post('nomor_hal');
            $kd_paket = $this->input->post('kd_paket');
            $kd_pengawas = $this->input->post('kd_pengawas');
            echo json_encode($this->get_opsi_detail($hal, $kd_paket, $kd_pengawas));
        }
        public function jajal2()
        {
            echo json_encode($this->get_opsi_detail4('KP0001'));
        }
        public function sedang_ujian($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $test = $this->get_opsi_detail4($kd_pengawas);
                // $opsi = $this->get_opsi_detail($hasil->kd_paket);
                $data = array(
                    'title' => 'UJIAN',
                    'row' => $hasil,
                    'col' => $test
                );
                $dat = array(
                    'kd_pengawas' => $kd_pengawas,
                    'nim' => $this->session->userdata('userid'),
                    'kd_paket' => $hasil->kd_paket,
                    'tanggal_absen' => date('Y-m-d H:i')

                );
                $cek_absen = $this->m_ujian->get_absen2($this->session->userdata('userid'), $kd_pengawas,  $hasil->kd_paket)->num_rows();
                if ($cek_absen <= 0) {
                    $this->m_ujian->absen_ujian($dat);
                }
                $this->template->load('template', 'menu_mhs/ujian/sheet', $data);
            }
        }
        public function sedang_ujian_essay($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $test = $this->get_opsi_detail4($kd_pengawas);

                $data = array(
                    'title' => 'UJIAN',
                    'row' => $hasil,
                    'col' => $test
                );
                $dat = array(
                    'kd_pengawas' => $kd_pengawas,
                    'nim' => $this->session->userdata('userid'),
                    'kd_paket' => $hasil->kd_paket,
                    'tanggal_absen' => date('Y-m-d H:i')

                );
                $cek_absen = $this->m_ujian->get_absen2($this->session->userdata('userid'), $kd_pengawas,  $hasil->kd_paket)->num_rows();
                if ($cek_absen <= 0) {
                    $this->m_ujian->absen_ujian($dat);
                }
                $this->template->load('template', 'menu_mhs/ujian/sheet_essay', $data);
            }
        }
        public function sedang_ujian_koding($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $jawaban = $this->m_soal->get_status_koding($kd_pengawas, $hasil->kd_paket, $this->session->userdata('userid'))->row();
                $data = array(
                    'title' => 'UJIAN PEMROGRAMAN',
                    'row' => $hasil,
                    'jawab' => $jawaban
                );
                $dat = array(
                    'kd_pengawas' => $kd_pengawas,
                    'nim' => $this->session->userdata('userid'),
                    'kd_paket' => $hasil->kd_paket,
                    'tanggal_absen' => date('Y-m-d H:i')

                );
                $cek_absen = $this->m_ujian->get_absen2($this->session->userdata('userid'), $kd_pengawas,  $hasil->kd_paket)->num_rows();
                if ($cek_absen <= 0) {
                    $this->m_ujian->absen_ujian($dat);
                }
                $this->load->view('menu_mhs/ujian/sheet_koding', $data);
            }
        }
        public function get_opsi_detail($hal, $kd_paket, $kd_pengawas)
        {
            $ujian = $this->m_soal->get_soal3($hal, $kd_paket)->result();
            $i = 0;
            foreach ($ujian as $d) {
                $ujian[$i]->opsi = $this->get_sub_status($d->kd_soal);
                $ujian[$i]->gambar = $this->get_gambar($d->kd_soal);
                $ujian[$i]->jumlah = $this->m_soal->get_soal($kd_paket)->num_rows();
                $ujian[$i]->jawaban = $this->get_jawaban($kd_pengawas, $d->kd_soal);
                $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($this->session->userdata('userid'), $kd_pengawas, $d->jenis_soal)->num_rows();
                $i++;
            }
            return $ujian;
        }

        public function get_opsi_detail4($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas)->result();
            $i = 0;
            foreach ($ujian as $d) {

                $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($this->session->userdata('userid'), $kd_pengawas, $d->jenis_soal)->num_rows();
                $i++;
            }
            return $ujian;
        }
        public function get_opsi_detail2($kd_paket, $kd_pengawas)
        {
            $ujian = $this->m_soal->get_soal($kd_paket)->result();
            $i = 0;
            foreach ($ujian as $d) {
                $ujian[$i]->opsi = $this->get_sub_status($d->kd_soal);
                $ujian[$i]->gambar = $this->get_gambar($d->kd_soal);
                $ujian[$i]->jumlah = $this->m_soal->get_soal($kd_paket)->num_rows();
                $ujian[$i]->jawaban = $this->get_jawaban($kd_pengawas, $d->kd_soal);
                $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($this->session->userdata('userid'), $kd_pengawas, $d->jenis_soal)->num_rows();
                $i++;
            }
            return $ujian;
        }
        public function get_opsi_detail3()
        {
            $ujian = $this->m_ujian->get_mhs($this->session->userdata('userid'))->result();
            $i = 0;
            foreach ($ujian as $d) {

                $ujian[$i]->cek_nilai = $this->m_ujian->get_nilai($this->session->userdata('userid'), $d->kd_pengawas, $d->jenis_soal)->num_rows();
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
        public function get_jawaban($kd_pengawas, $kd_soal)
        {
            $jawab = $this->m_soal->get_status_jawab($kd_pengawas, $kd_soal, $this->session->userdata('userid'))->result();
            return $jawab;
        }
        public function simpan()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('opsi', 'opsi', 'required');
            $this->form_validation->set_rules('kd_pengawas', 'kd pengawas', 'required');
            $this->form_validation->set_rules('kd_soal', 'kd_soal', 'required');
            if ($this->form_validation->run()) {
                $opsi = $this->input->post('opsi');
                $kd_pengawas = $this->input->post('kd_pengawas');
                $kd_soal = $this->input->post('kd_soal');
                $get_status = $this->m_soal->get_status_jawab($kd_pengawas, $kd_soal, $this->session->userdata('userid'));

                if ($get_status->num_rows() <= 0) {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'jawaban_opsi' => $opsi,
                        'kd_pengawas' => $kd_pengawas,
                        'kd_soal' => $kd_soal,
                        'jawaban' => '-'
                    );
                    $this->m_soal->simpan_jawaban($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Simpan";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Berhasil Di Simpan";
                        $icon = 'error';
                    }
                } else {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'jawaban_opsi' => $opsi,
                        'kd_pengawas' => $kd_pengawas,
                        'kd_soal' => $kd_soal,
                        'jawaban' => '-'
                    );
                    $this->m_soal->update_jawaban($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Ubah";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Di Ubah";
                        $icon = 'success';
                    }
                }
            } else {
                $hasil = "Jawaban <br> Belum Diisi";
                $icon = 'warning';
            }
            $data = array(
                'hasil' => $hasil,
                'icon' => $icon
            );
            echo json_encode($data);
        }
        public function simpan_essay()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('jawaban', 'jawaban', 'required');
            $this->form_validation->set_rules('kd_pengawas', 'kd pengawas', 'required');
            $this->form_validation->set_rules('kd_soal', 'kd_soal', 'required');
            if ($this->form_validation->run()) {
                $jawaban = $this->input->post('jawaban');
                $kd_pengawas = $this->input->post('kd_pengawas');
                $kd_soal = $this->input->post('kd_soal');
                $get_status = $this->m_soal->get_status_jawab($kd_pengawas, $kd_soal, $this->session->userdata('userid'));

                if ($get_status->num_rows() <= 0) {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'jawaban_opsi' => '-',
                        'kd_pengawas' => $kd_pengawas,
                        'kd_soal' => $kd_soal,
                        'jawaban' => $jawaban
                    );
                    $this->m_soal->simpan_jawaban($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Simpan";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Berhasil Di Simpan";
                        $icon = 'error';
                    }
                } else {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'jawaban_opsi' => '-',
                        'kd_pengawas' => $kd_pengawas,
                        'kd_soal' => $kd_soal,
                        'jawaban' => $jawaban
                    );
                    $this->m_soal->update_jawaban($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Ubah";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Di Ubah";
                        $icon = 'success';
                    }
                }
            } else {
                $hasil = "Jawaban <br> Belum Diisi";
                $icon = 'warning';
            }
            $data = array(
                'hasil' => $hasil,
                'icon' => $icon
            );
            echo json_encode($data);
        }
        public function simpan_koding()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('editor', 'editor', 'required');
            $this->form_validation->set_rules('kd_pengawas', 'kd pengawas', 'required');
            $this->form_validation->set_rules('kd_paket', 'kd_paket', 'required');
            if ($this->form_validation->run()) {
                $jawaban = $this->input->post('editor');
                $kd_pengawas = $this->input->post('kd_pengawas');
                $kd_paket = $this->input->post('kd_paket');
                $get_status = $this->m_soal->get_status_koding($kd_pengawas, $kd_paket, $this->session->userdata('userid'));

                if ($get_status->num_rows() <= 0) {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'kd_pengawas' => $kd_pengawas,
                        'kd_paket' => $kd_paket,
                        'teks_koding' => $jawaban
                    );
                    $this->m_soal->simpan_jawaban_koding($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Simpan";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Berhasil Di Simpan";
                        $icon = 'error';
                    }
                } else {
                    $data = array(
                        'nim' => $this->session->userdata('userid'),
                        'kd_pengawas' => $kd_pengawas,
                        'kd_paket' => $kd_paket,
                        'teks_koding' => $jawaban
                    );
                    $this->m_soal->update_jawaban_koding($data);
                    if ($this->db->affected_rows() > 0) {
                        $hasil = "Jawaban <br> Berhasil Di Ubah";
                        $icon = 'success';
                    } else {
                        $hasil = "Jawaban <br> Tidak Di Ubah";
                        $icon = 'success';
                    }
                }
            } else {
                $hasil = "Jawaban <br> Belum Diisi";
                $icon = 'warning';
            }
            $data = array(
                'hasil' => $hasil,
                'icon' => $icon
            );
            echo json_encode($data);
        }
        public function hasil_pilgan($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $opsi = $this->get_opsi_detail2($hasil->kd_paket, $kd_pengawas);
                $benar = 0;
                $salah = 0;
                foreach ($opsi as $d) {
                    foreach ($d->jawaban as $da) {
                        if ($d->kunci_jawaban == $da->jawaban_opsi) {
                            $benar++;
                        } else {
                            $salah++;
                        }
                    }
                }
                $jumlah = $d->jumlah;
                $tidakjawab = $jumlah - $benar - $salah;
                $jumlah_nilai = ($benar / $jumlah) * 100;
                $data = array(
                    'benar' => $benar,
                    'salah' => $salah,
                    'tidak_dikerjakan' => $tidakjawab,
                    'nilai' => $jumlah_nilai,
                    'nim' => $this->session->userdata('userid'),
                    'kd_pengawas' => $kd_pengawas,
                    'kd_paket' => $hasil->kd_paket
                );
                $data2 = array(
                    'title' => 'Hasil Ujian',
                    'benar' => $benar,
                    'salah' => $salah,
                    'tidak_dikerjakan' => $tidakjawab,
                    'nilai' => $jumlah_nilai,
                    'nim' => $this->session->userdata('userid'),
                    'kd_pengawas' => $kd_pengawas,
                    'kd_paket' => $hasil->kd_paket
                );
                $cek_nilai = $this->m_soal->cek_nilai_pilgan($this->session->userdata('userid'), $kd_pengawas)->num_rows();
                if ($cek_nilai <= 0) {
                    $this->m_soal->simpan_hasil_pilgan($data);
                    $this->template->load('template', 'menu_mhs/ujian/hasil', $data2);
                } else {
                    $this->template->load('template', 'menu_mhs/ujian/hasil', $data2);
                }

                $this->session->unset_userdata('waktu_start');

                // echo $benar . '/' . $salah . '/' . $tidakjawab . '/' . $jumlah_nilai;
            }
        }
        public function hasil_essay($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            $data = array(
                'title' => 'Hasil Essay'
            );
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $data2 = array(
                    'kd_pengawas' => $kd_pengawas,
                    'kd_paket' => $hasil->kd_paket,
                    'nim' => $this->session->userdata('userid')
                );
                $cek_nilai = $this->m_soal->cek_nilai_essay($this->session->userdata('userid'), $kd_pengawas)->num_rows();
                if ($cek_nilai <= 0) {
                    $this->session->unset_userdata('waktu_start');
                    $this->m_soal->simpan_hasil_essay($data2);
                    $this->template->load('template', 'menu_mhs/ujian/hasil_essay', $data);
                } else {
                    $this->session->unset_userdata('waktu_start');
                    $this->template->load('template', 'menu_mhs/ujian/hasil_essay', $data);
                }
            } else {
                $this->session->unset_userdata('waktu_start');
                $this->template->load('template', 'menu_mhs/ujian/hasil_essay', $data);
            }
        }
        public function hasil_koding($kd_pengawas)
        {
            $ujian = $this->m_ujian->get2($kd_pengawas);
            $data = array(
                'title' => 'Hasil Ujian Pemrograman'
            );
            if ($ujian->num_rows() > 0) {
                $hasil = $ujian->row();
                $data2 = array(
                    'kd_pengawas' => $kd_pengawas,
                    'kd_paket' => $hasil->kd_paket,
                    'nim' => $this->session->userdata('userid')
                );
                $cek_nilai = $this->m_soal->cek_nilai_koding($this->session->userdata('userid'), $kd_pengawas)->num_rows();
                if ($cek_nilai <= 0) {
                    $this->session->unset_userdata('waktu_start');
                    $this->m_soal->simpan_hasil_koding($data2);
                    $this->template->load('template', 'menu_mhs/ujian/hasil_koding', $data);
                } else {
                    $this->session->unset_userdata('waktu_start');
                    $this->template->load('template', 'menu_mhs/ujian/hasil_koding', $data);
                }
            } else {
                $this->session->unset_userdata('waktu_start');
                $this->template->load('template', 'menu_mhs/ujian/hasil_essay', $data);
            }
        }
        public function lihat_absen($kd_pengawas)
        {
            $absen = $this->m_ujian->get_absen($kd_pengawas)->result();
            $data = array(
                'title' => 'Lihat Absen',
                'row' => $absen
            );
            $this->template->load('template', 'menu_mhs/ujian/lihat_absen', $data);
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
