 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Krs extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_admin();
            $this->load->model(['m_mahasiswa', 'm_fakultas', 'm_prodi', 'm_matkul', 'm_krs']);
        }
        public function index()
        {
            $fakultas = $this->m_fakultas->get()->result();
            $data = array(
                'row' => $fakultas,
                'title' => "Pilih Fakultas"
            );
            $this->template->load('template', 'krs/lihat.php', $data);
        }
        public function lihat_mhs($kd_prodi)
        {
            $mhs = $this->m_mahasiswa->get_mhs($kd_prodi)->result();
            $prodi = $this->m_prodi->get($kd_prodi)->row();
            $title = "Pilih Mahasiswa";
            $data = array(
                'row' => $mhs,
                'prodi' => $prodi,
                'title' => $title,
            );
            $this->template->load('template', 'krs/lihat_mhs.php', $data);
        }
        public function lihat_krs($nim)
        {
            $query = $this->m_mahasiswa->get($nim);
            if ($query->num_rows() > 0) {
                $krs = $this->m_krs->get_krsmhs($nim)->result();
                $mhs = $query->row();
                $matkul = $this->m_matkul->get2($mhs->prodi)->result();
                $title = "Menu Kartu Rencana Studi";
                $data = array(
                    'row' => $krs,
                    'title' => $title,
                    'mhs' => $mhs,
                    'matkul' => $matkul
                );
                $this->template->load('template', 'krs/lihat_krs.php', $data);
            }
        }
        public function process($nim)
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add'])) {
                $krs = $this->m_krs->cek_krs($_POST['kd_matkul'], $nim);
                if ($krs->num_rows() > 0) {
                    $this->session->set_flashdata('msg_error', 'Matakuliah Yang Dipilih <br> Sudah diambil');
                } else {
                    $this->m_krs->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('msg', 'Data KRS <br> Berhasil Ditambah');
                    } else {
                        $this->session->set_flashdata('msg', 'Data KRS <br> Tidak Berhasil Ditambah');
                    }
                }
            } else if (isset($_POST['edit'])) {
                $this->m_krs->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Data KRS <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg', 'Data KRS <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('krs/lihat_krs/' . $nim));
        }
        public function edit($nim)
        {
            $query = $this->m_krs->get($nim);

            if ($query->num_rows() > 0) {
                $krs = $query->row();
                // $dosen = $this->m_matkul->get_dosen2($$krs->dosbing_akad)->result();
                $title = "Edit KRS";
                $data = array(
                    'row' => $krs,
                    'title' => $title
                );

                $this->template->load('template', 'krs/form_edit', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('krs/lihat_krs' . $nim) . "';
 			</script>";
            }
        }
        public function del($nim, $id)
        {
            if (isset($id)) {
                $this->m_krs->del($id);
                $this->session->set_flashdata('msg', 'Data KRS <br> Berhasil Dihapus');
            }
            redirect(base_url('krs/lihat_krs/' . $nim));
        }
        public function getmatkul()
        {
            $kd_matkul = $this->input->post('id');
            $query_matkul = $this->m_matkul->get($kd_matkul)->row();
            echo json_encode($query_matkul);
        }
    }
