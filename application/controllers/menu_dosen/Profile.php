 <?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Profile extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            check_not_login();
            check_dosen();
            $this->load->model(['m_dosen', 'm_fakultas', 'm_prodi']);
        }
        public function index()
        {
            $dosen = $this->m_dosen->get($this->session->userdata('userid'))->row();
            $data = array(
                'title' => "Profile Dosen",
                'row' => $dosen
            );
            $this->template->load('template', 'menu_dosen/profile/form_edit.php', $data);
        }
        public function process()
        {
            $post = $this->input->post(null, TRUE);
            if (isset($_POST['edit'])) {
                $this->m_dosen->edit($post);

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('msg', 'Data Dosen <br> Berhasil Diubah');
                } else {
                    $this->session->set_flashdata('msg', 'Data Dosen <br> Tidak Berhasil Diubah');
                }
            }
            redirect(base_url('menu_dosen/profile'));
        }
    }
