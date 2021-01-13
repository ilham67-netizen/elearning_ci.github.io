<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $post['username']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function login_dosen($post)
    {
        $this->db->from('dosen');
        $this->db->where('nip_dosen', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function login_mhs($post)
    {
        $this->db->from('mahasiswa');
        $this->db->where('nim', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function login_pengawas($post)
    {
        $this->db->from('pengaturan_ujian');
        $this->db->where('kd_pengawas', $post['username']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_dosen($id = null)
    {
        $this->db->from('dosen');
        if ($id != null) {
            $this->db->where('nip_dosen', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_mhs($id = null)
    {
        $this->db->from('mahasiswa');
        if ($id != null) {
            $this->db->where('nim', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function get_pengawas($id = null)
    {
        $this->db->from('pengaturan_ujian');
        if ($id != null) {
            $this->db->where('kd_pengawas', $id);
        }
        $query = $this->db->get();
        return $query;
    }
    public function add($post)
    {
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        $params['password'] = md5($post['password']);
        $params['level'] = $post['level'];
        $this->db->insert('user', $params);
    }

    public function edit($post)
    {
        $params['name'] = $post['fullname'];
        $params['username'] = $post['username'];
        if (!empty($post['password'])) {
            $params['password'] = md5($post['password']);
        }
        $params['level'] = $post['level'];
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $params);
    }

    public function del($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}
