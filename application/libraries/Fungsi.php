<?php
class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('m_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->m_user->get($user_id)->row();
        return $user_data;
    }
    function user_dosen()
    {
        $this->ci->load->model('m_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->m_user->get_dosen($user_id);
        return $user_data;
    }
    function user_mhs()
    {
        $this->ci->load->model('m_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->m_user->get_mhs($user_id);
        return $user_data;
    }
    function user_pengawas()
    {
        $this->ci->load->model('m_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->m_user->get_pengawas($user_id);
        return $user_data;
    }
}
