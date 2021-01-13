<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function login()
	{
		check_already_login();
		$this->load->view('login_admin');
	}
	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if (isset($post['login'])) {
			$this->load->model('m_user');
			$dosen = $this->m_user->login_dosen($post);
			$mahasiswa = $this->m_user->login_mhs($post);
			$pengawas = $this->m_user->login_pengawas($post);
			$query = $this->m_user->login($post);
			if ($query->num_rows() > 0) {
				# code...
				$row = $query->row();
				$param = array(
					'userid' => $row->user_id,
					'level' => $row->level,
					'name' => $row->name
				);
				$this->session->set_userdata($param);
				redirect('dashboard');
			} elseif ($dosen->num_rows() > 0) {
				$row = $dosen->row();
				$param = array(
					'userid' => $row->nip_dosen,
					'name' => $row->nama_dosen,
					'level' => 'Dosen'
				);
				$this->session->set_userdata($param);
				redirect('menu_dosen/dashboard');
			} elseif ($mahasiswa->num_rows() > 0) {
				$row = $mahasiswa->row();
				$param = array(
					'userid' => $row->nim,
					'name' => $row->nama_mhs,
					'level' => 'Mahasiswa'
				);
				$this->session->set_userdata($param);
				redirect('menu_mhs/dashboard');
			} elseif ($pengawas->num_rows() > 0) {
				$row = $pengawas->row();
				$param = array(
					'userid' => $row->kd_pengawas,
					'name' => $row->nama_pengawas,
					'level' => 'Pengawas'
				);
				$this->session->set_userdata($param);
				redirect('menu_pengawas/dashboard');
			} else {
				$this->session->set_flashdata('msg_login', "<div class='alert alert-danger alert-message'>Username atau Password  Salah</div>");
				redirect('auth/login');
			}
		}
	}
	public function logout()
	{
		$param = array('userid', 'level', 'name');
		$this->session->unset_userdata($param);
		$this->session->set_flashdata('msg_login', "<div class='alert alert-success alert-message'>Anda Berhasil Logout</div>");
		redirect('auth/login');
	}
}
