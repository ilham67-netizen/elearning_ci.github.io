 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Tugas extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_tugas', 'm_matkul', 'm_krs']);
            $this->load->helper(array('url', 'file'));
        }
        public function index()
        {
            $query = $this->get_mhs();
            $tugas = $this->get_status();
            $cek = $this->m_krs->get_krsmhs3($this->session->userdata('userid'))->num_rows();
            $data = array(
                'title' => "Menu Tugas",
                'tugas' => $tugas,
                'row2' => $query,
                'cek' => $cek
            );
            $this->template->load('template', 'menu_mhs/tugas/lihat.php', $data);
        }
        public function jajal()
        {
            return print_r($this->get_mhs_detail('T0005'));
        }
        public function lihat_detail($kd_tugas)
        {
            $tugas = $this->get_mhs_detail($kd_tugas);
            if (count($tugas) > 0) {
                $hitung = $this->m_tugas->get_mhs_tugas($this->session->userdata('userid'), $kd_tugas)->num_rows();
                $nilai = $this->m_tugas->get_mhs_tugas($this->session->userdata('userid'), $kd_tugas)->row();

                $data = array(
                    'title' => "Menu Tugas",
                    'tugas' => $tugas,
                    'nilai' => $nilai,
                    'hitung' => $hitung
                );
                $this->template->load('template', 'menu_mhs/tugas/lihat_detail.php', $data);
            }
        }
        public function tugas_kumpul($kd_tugas)
        {

            $cek = $this->m_krs->get_krsmhs4($this->session->userdata('userid'), $kd_tugas)->num_rows();
            if ($cek > 0) {
                $tugas = $this->m_krs->get_krsmhs4($this->session->userdata('userid'), $kd_tugas)->row();
                $data = array(
                    'title' => "Kumpulkan Tugas",
                    'tugas' => $tugas
                );
                $this->template->load('template', 'menu_mhs/tugas/kumpulkan.php', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('menu_mhs/tugas') . "';
 			</script>";
            }
        }
        public function tugas_edit($kd_tugas)
        {
            $file = $this->m_tugas->get_file_mhs2($this->session->userdata('userid'), $kd_tugas)->result();
            $cek = $this->m_krs->get_krsmhs4($this->session->userdata('userid'), $kd_tugas)->num_rows();
            if ($cek > 0) {
                $tugas = $this->m_krs->get_krsmhs4($this->session->userdata('userid'), $kd_tugas)->row();
                $data = array(
                    'title' => "Edit Tugas",
                    'tugas' => $tugas,
                    'file' => $file
                );
                $this->template->load('template', 'menu_mhs/tugas/form_edit.php', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('menu_mhs/tugas') . "';
 			</script>";
            }
        }
        public function process()
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add'])) {
                $this->m_tugas->add_tugas_mhs($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Tugas <br> Berhasil Dikumpulkan');
                } else {
                    $this->session->set_flashdata('msg', 'Tugas <br> Tidak Berhasil Dikumpulkan');
                }
            } else if (isset($_POST['edit'])) {
                $this->m_tugas->edit_tugas_mhs($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Tugas <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg', 'Tugas <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('menu_mhs/tugas/'));
        }
        // File upload
        public function file_upload($id)
        {
            // Set preference
            $config['upload_path']   = FCPATH . '/upload_tugas_mhs/';
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
                    'kd_tugas' => $id,
                    'nim' => $this->session->userdata('userid')
                );
                $this->m_tugas->add_upload_mhs($data);
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->m_tugas->add_upload_mhs($error);
            }
        }
        //Untuk menghapus foto
        function hapus_file()
        {
            //Ambil token foto
            $token = $this->input->post('token');
            $file = $this->m_tugas->get_file_mhs($token);

            if ($file->num_rows() > 0) {
                $hasil = $file->row();
                $nama_foto = $hasil->nama_file;
                if (file_exists($file = FCPATH . '/upload_tugas_mhs/' . $nama_foto)) {
                    unlink($file);
                }
                $this->m_tugas->delete_file_mhs($token);
            }


            echo "{}";
        }
        function hapus_file2()
        {
            //Ambil token foto
            $token = $this->input->post('token');
            $kd_tugas = $this->input->post('kd_tugas');
            $file = $this->m_tugas->get_file_mhs($token);

            if ($file->num_rows() > 0) {
                $hasil = $file->row();
                $nama_foto = $hasil->nama_file;
                if (file_exists($file = FCPATH . '/upload_tugas_mhs/' . $nama_foto)) {
                    unlink($file);
                }
                $this->m_tugas->delete_file_mhs($token);
            }
            $file = $this->m_tugas->get_file_mhs2($this->session->userdata('userid'), $kd_tugas)->num_rows();
            if ($file <= 0) {
                $this->m_tugas->delete_tugas_mhs($this->session->userdata('userid'), $kd_tugas);
                $file2 = $this->m_tugas->get_file_mhs2($this->session->userdata('userid'), $kd_tugas)->result();
            } else {
                $file2 = $this->m_tugas->get_file_mhs2($this->session->userdata('userid'), $kd_tugas)->result();
            }
            echo json_encode($file2);
        }
        public function download_tugas($kd_tugas)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_tugas->get_file2($kd_tugas)->result();
            foreach ($file as $isi) {
                $data = FCPATH . '/upload_tugas/' . $isi->nama_file;
                $this->zip->read_file($data);
            }

            $filename = "tugas.zip";
            $this->zip->download($filename, NULL);
        }
        public function download_kumpul($kd_tugas)
        {
            $this->load->helper('download');
            $this->load->library('zip');
            $file = $this->m_tugas->get_file_mhs2($this->session->userdata('userid'), $kd_tugas)->result();
            foreach ($file as $isi) {
                $data = FCPATH . '/upload_tugas_mhs/' . $isi->nama_file;
                $this->zip->read_file($data);
            }

            $filename = $this->session->userdata('userid') . ".zip";
            $this->zip->download($filename, NULL);
        }
        public function get_status()
        {
            $status = $this->m_krs->get_krsmhs3($this->session->userdata('userid'))->result();
            $i = 0;
            foreach ($status as $d) {
                $status[$i]->sub = $this->get_sub_status($d->kd_tugas);
                $i++;
            }
            return $status;
        }
        public function get_mhs()
        {
            $status = $this->m_krs->get_krsmhs2($this->session->userdata('userid'))->result();
            $i = 0;
            foreach ($status as $d) {
                $status[$i]->sub = $this->get_sub_status($d->kd_tugas);
                $i++;
            }
            return $status;
        }
        public function get_mhs_detail($kd_tugas)
        {
            $status = $this->m_krs->get_krsmhs5($this->session->userdata('userid'), $kd_tugas)->result();
            $i = 0;
            foreach ($status as $d) {
                $status[$i]->sub = $this->get_sub_status($d->kd_tugas);
                $i++;
            }
            return $status;
        }
        public function get_sub_status($kd_tugas)
        {
            $status2 = $this->m_krs->get_krsmhs4($this->session->userdata('userid'), $kd_tugas)->result();
            $i = 0;
            foreach ($status2 as $key) {
                # code...
                $status2[$i]->status = $this->m_tugas->get_mhs_tugas($this->session->userdata('userid'), $key->kd_tugas)->num_rows();
            }
            return $status2;
        }
    }
