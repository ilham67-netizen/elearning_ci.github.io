 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Profile extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_mhs();
            $this->load->model(['m_mahasiswa']);
        }
        public function index()
        {
            $query = $this->m_mahasiswa->get($this->session->userdata('userid'));
            if ($query->num_rows() > 0) {
                $mhs = $query->row();
                $data = array(
                    'row' => $mhs,
                    'title' => "Profile"
                );
                $this->template->load('template', 'menu_mhs/mahasiswa/lihat.php', $data);
            } else {
                echo "<script>
 			alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('menu_mhs/dashboard') . "';
 			</script>";
            }
        }
        public function process()
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['add'])) {
                $this->m_mahasiswa->add($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Data Mahasiswa <br> Berhasil Ditambah');
                } else {
                    $this->session->set_flashdata('msg', 'Data Mahasiswa <br> Tidak Berhasil Ditambah');
                }
            } else if (isset($_POST['edit'])) {
                $this->m_mahasiswa->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Data Mahasiswa <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg', 'Data Mahasiswa <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('menu_mhs/profile'));
        }
    }
