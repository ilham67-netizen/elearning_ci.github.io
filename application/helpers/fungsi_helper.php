<?php
function check_already_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('level');
    if ($user_session == 'Admin') {
        redirect('dashboard');
    } elseif ($user_session == 'Dosen') {
        redirect('menu_dosen/dashboard');
    } elseif ($user_session == 'Mahasiswa') {
        redirect('menu_mhs/dashboard');
    } elseif ($user_session == 'Pengawas') {
        redirect('menu_pengawas/dashboard');
    }
}

function check_not_login()
{
    $ci = &get_instance();
    $user_session = $ci->session->userdata('userid');
    if (!$user_session) {
        redirect('auth/login');
    }
}

function check_admin()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_login()->level != 'Admin') {
        redirect('auth/login');
    }
}
function check_dosen()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_dosen()->num_rows() <= 0) {
        redirect('auth/login');
    }
}
function check_mhs()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_mhs()->num_rows() <= 0) {
        redirect('auth/login');
    }
}
function check_pengawas()
{
    $ci = &get_instance();
    $ci->load->library('fungsi');
    if ($ci->fungsi->user_pengawas()->num_rows() <= 0) {
        redirect('auth/login');
    }
}
function indo_currency($nominal)
{
    $result = "Rp " . number_format($nominal, 2, ',', '.');
    return $result;
}

function indo_date($date)
{
    $d = substr($date, 8, 2);
    $m = substr($date, 5, 2);
    $y = substr($date, 0, 4);
    return $d . '/' . $m . '/' . $y;
}
function datediff($batas)
{
    $origin = new DateTime(date('Y-m-d H:i'));
    $target = new DateTime(date('Y-m-d H:i', strtotime($batas)));
    $interval = $origin->diff($target);
    return $interval->format('%R%a');
}
function timediff($waktu)
{
    $new_time = explode(":", $waktu);
    return $new_time[0];
}
function timediff2($waktu)
{
    $new_time = explode(":", $waktu);
    $custom = substr($waktu, 0, 1) . $new_time[1];
    return $custom;
}
function jenis_soal($jenis)
{
    if ($jenis == 1) {
        return 'Essay';
    } elseif ($jenis == 2) {
        return 'Pilihan Ganda';
    } elseif ($jenis == 3) {
        return 'Pemrograman';
    } elseif ($jenis == 4) {
        return 'Pilihan Ganda & Essay';
    }
}
function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
