<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>

  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/bootstrap.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/chartjs/Chart.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/app.css">
  <link href='<?= base_url() ?>assets/fullcalendar/lib/main.css' rel='stylesheet' />
  <link src="<?= base_url() ?>assets/custom_dropzone/dropzone.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/basic.min.css">
  <!-- Include base CSS (optional) -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/choices/base.min.css" /> -->
  <!-- Include Choices CSS -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/select_js/css/select2.min.css"> -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/choices/choices.min.css" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/custom/images/favicon.svg" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>assets/loading_bar/loading-bar.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/quill/quill.bubble.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/vendors/quill/quill.snow.css">
  <style>
    #top {
      background: #eee;
      border-bottom: 1px solid #ddd;
      padding: 0 10px;
      line-height: 40px;
      font-size: 12px;
    }

    #calendar {
      max-width: 1100px;
      margin: 40px auto;
      padding: 0 10px;
    }

    .dropzone {
      margin-top: 10px;
      margin-bottom: 10px;
      border: 2px dashed #0087F7;
    }

    .responsive-iframe {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }

    .no-js #loader {
      display: none;
    }

    .js #loader {
      display: block;
      position: absolute;
      left: 100px;
      top: 0;
    }

    .ldBar path.mainline {
      stroke-width: 10;
      stroke: #09f;
      stroke-linecap: round;
    }

    .ldBar path.baseline {
      stroke-width: 14;
      stroke: #f1f2f3;
      stroke-linecap: round;
      filter: url(#custom-shadow);
    }

    .se-pre-con {
      width: 100%;
      height: 100%;
      background: url(<?= base_url('images/loading_bar.gif') ?>) center no-repeat #fff;
      z-index: 9999;
    }

    #timer_place {
      margin: 0 auto;
      text-align: center;
    }

    #timer {
      border-radius: 7px;
      border: 2px solid gray;
      padding: 7px;
      font-size: 2em;
      font-weight: bolder;
    }

    /* .dropzone, .dropzone *{box-sizing: border-box}.dropzone{position: :relative}.dropzone .dz-preview{position: relative;display: inline-block; width: 120px; margin:0.5em}.dropzone .dz-preview .dz-progress{display:block; height: 15px;border: 1px solid #aaa}.dropzone .dz-preview .dz-progress .dz-upload{display: block;height: 100%;width: 0;background: green}.dropzone .dz-preview.dz-error.dz-error-message{color: red; display: none;}, .dropzone .dz-preview .dz-eror-message, .dropzone .dz-preview .dz-error ..dz-error-mark{display: block}, .dropzone .dz-preview .dz-success-mark{display: block}.dropzone .dz-preview .dz-error-mark, .dropzone.dz-preview .dz-success-mark{position: absolute;display: none;left: 30px;top: 30px;width: 54px;height: 58px;left: 50%;margin-left: -27px}*/
  </style>
</head>
<?php $user = $this->session->userdata('level'); ?>

<body>
  <div class="flashdata" data-flashdata="<?= $this->session->flashdata('msg'); ?>"></div>
  <div class="flashdata_error" data-flashdata2="<?= $this->session->flashdata('msg_error'); ?>"></div>
  <div id="app">
    <div id="sidebar" class='active'>
      <!-- Wraper Sidebar -->
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <img src="<?= base_url() ?>assets/custom/images/logo.svg" alt="" srcset="">
        </div>
        <!-- Menu Sidebar -->
        <div class="sidebar-menu">
          <ul class="menu">
            <li class='sidebar-title'>Main Menu</li>
            <?php
            if ($user == 'Admin') {
            ?>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('dashboard') ?>" class='sidebar-link'>
                  <i data-feather="home" width="20"></i>
                  <span>Dashboard</span>
                </a>

              </li>

              <li class="sidebar-item <?= $this->uri->segment(1) == 'master_data' || $this->uri->segment(1) == '' ? 'active' : '' ?> has-sub">
                <a href="#" class='sidebar-link'>
                  <i data-feather="folder" width="20"></i>
                  <span>Master Data</span>
                </a>
                <ul class="submenu <?= $this->uri->segment(1) == 'master_data' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <li>
                    <a href="<?= site_url('master_data/dosen') ?>">Dosen</a>
                  </li>
                  <li>
                    <a href="<?= site_url('master_data/mahasiswa') ?>">Mahasiswa</a>
                  </li>
                  <li>
                    <a href="<?= site_url('master_data/fakultas') ?>">Fakultas</a>
                  </li>
                  <li>
                    <a href="<?= site_url('master_data/prodi') ?>">Prodi</a>
                  </li>
                  <li>
                    <a href="<?= site_url('master_data/matkul') ?>">Mata Kuliah</a>
                  </li>
                  <li>
                    <a href="<?= site_url('master_data/kelas') ?>">Kelas</a>
                  </li>
                </ul>
              </li>

              <li class="sidebar-item <?= $this->uri->segment(1) == 'jadwal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('jadwal') ?>" class='sidebar-link'>
                  <i data-feather="calendar" width="20"></i>
                  <span>Jadwal Perkuliahan</span>
                </a>

              </li>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'tugas' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('tugas') ?>" class='sidebar-link'>
                  <i data-feather="briefcase" width="20"></i>
                  <span>Tugas</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'krs' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('krs') ?>" class='sidebar-link'>
                  <i data-feather="file-text" width="20"></i>
                  <span>Kartu Rencana Studi</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'paket_soal' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('paket_soal') ?>" class='sidebar-link'>
                  <i data-feather="database" width="20"></i>
                  <span>Soal Ujian</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'pelatihan' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('pelatihan') ?>" class='sidebar-link'>
                  <i data-feather="layers" width="20"></i>
                  <span>Pelatihan</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(1) == 'ujian' || $this->uri->segment(1) == '' ? 'active' : '' ?> has-sub">
                <a href="#" class='sidebar-link'>
                  <i data-feather="clipboard" width="20"></i>
                  <span>Jenis Ujian</span>
                </a>
                <ul class="submenu <?= $this->uri->segment(1) == 'ujian' || $this->uri->segment(1) == '' ? 'active' : '' ?>">
                  <li>
                    <a href="<?= site_url('ujian/lihat_fakultas/2') ?>">Pilihan Ganda</a>
                  </li>
                  <li>
                    <a href="<?= site_url('ujian/lihat_fakultas/1') ?>">Essay</a>
                  </li>
                  <li>
                    <a href="<?= site_url('ujian/lihat_fakultas/3') ?>">Pemrograman</a>
                  </li>
                </ul>
              </li>

            <?php } elseif ($user == 'Dosen') {
            ?>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('menu_dosen/dashboard') ?>" class='sidebar-link'>
                  <i data-feather="home" width="20"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('menu_dosen/profile') ?>" class='sidebar-link'>
                  <i data-feather="user" width="20"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'dosen' || $this->uri->segment(2) == 'mahasiswa' || $this->uri->segment(2) == 'matkul' ? 'active' : '' ?> has-sub">
                <a href="#" class='sidebar-link'>
                  <i data-feather="folder" width="20"></i>
                  <span>Master Data</span>
                </a>
                <ul class="submenu <?= $this->uri->segment(2) == 'dosen' || $this->uri->segment(2) == 'mahasiswa' || $this->uri->segment(2) == 'matkul' ? 'active' : '' ?>">
                  <li>
                    <a href="<?= site_url('menu_dosen/mahasiswa') ?>">Mahasiswa</a>
                  </li>
                  <li>
                    <a href="<?= site_url('menu_dosen/matkul') ?>">Mata Kuliah</a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'jadwal' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/jadwal') ?>" class='sidebar-link'>
                  <i data-feather="calendar" width="20"></i>
                  <span>Jadwal Perkuliahan</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'kuliah' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/kuliah') ?>" class='sidebar-link'>
                  <i data-feather="cloud" width="20"></i>
                  <span>Kuliah Online</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'tugas' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/tugas') ?>" class='sidebar-link'>
                  <i data-feather="briefcase" width="20"></i>
                  <span>Tugas</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'pelatihan' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/pelatihan') ?>" class='sidebar-link'>
                  <i data-feather="layers" width="20"></i>
                  <span>Pelatihan</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'paket_soal' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/paket_soal') ?>" class='sidebar-link'>
                  <i data-feather="database" width="20"></i>
                  <span>Soal Ujian</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'pengaturan_ujian' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_dosen/pengaturan_ujian') ?>" class='sidebar-link'>
                  <i data-feather="settings" width="20"></i>
                  <span>Pengaturan Ujian</span>
                </a>
              </li>
              <!-- <li class="sidebar-item <?= $this->uri->segment(2) == 'ujian' || $this->uri->segment(2) == '' ? 'active' : '' ?> has-sub">
                <a href="#" class='sidebar-link'>
                  <i data-feather="clipboard" width="20"></i>
                  <span>Jenis Ujian</span>
                </a>
                <ul class="submenu <?= $this->uri->segment(2) == 'ujian' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                  <li>
                    <a href="<?= site_url('menu_dosen/ujian/pilihan') ?>">Pilihan Ganda</a>
                  </li>
                  <li>
                    <a href="<?= site_url('menu_dosen/ujian/essay') ?>">Essay</a>
                  </li>
                  <li>
                    <a href="<?= site_url('menu_dosen/ujian/ngoding') ?>">Menulis Kode</a>
                  </li>
                  <li>
                    <a href="<?= site_url('menu_dosen/ujian/pilihan_essay') ?>">Pilihan Ganda + Essay</a>
                  </li>
                </ul>
              </li> -->
            <?php
            } elseif ($user == 'Mahasiswa') {
            ?>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('menu_mhs/dashboard') ?>" class='sidebar-link'>
                  <i data-feather="home" width="20"></i>
                  <span>Dashboard</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('menu_mhs/profile') ?>" class='sidebar-link'>
                  <i data-feather="user" width="20"></i>
                  <span>Profile</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'kuliah' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_mhs/kuliah') ?>" class='sidebar-link'>
                  <i data-feather="cloud" width="20"></i>
                  <span>Kuliah Online</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'tugas' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_mhs/tugas') ?>" class='sidebar-link'>
                  <i data-feather="briefcase" width="20"></i>
                  <span>Tugas</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'pelatihan' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_mhs/pelatihan') ?>" class='sidebar-link'>
                  <i data-feather="layers" width="20"></i>
                  <span>Pelatihan</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'ujian' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_mhs/ujian') ?>" class='sidebar-link'>
                  <i data-feather="clipboard" width="20"></i>
                  <span>Ujian</span>
                </a>
              </li>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'hasil_ujian' || $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <a href="<?= site_url('menu_mhs/hasil_ujian') ?>" class='sidebar-link'>
                  <i data-feather="award" width="20"></i>
                  <span>Hasil Ujian</span>
                </a>
              </li>
            <?php
            } elseif ($user == 'Pengawas') { ?>
              <li class="sidebar-item <?= $this->uri->segment(2) == 'dashboard' || $this->uri->segment(2) == '' ? 'active' : '' ?> ">
                <a href="<?= site_url('menu_pengawas/dashboard') ?>" class='sidebar-link'>
                  <i data-feather="home" width="20"></i>
                  <span>Dashboard</span>
                </a>
              </li>

            <?php } ?>
          </ul>

        </div>
        <!-- Akhir Menu Sidebar -->
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main">
      <!-- Navbar atas -->
      <nav class="navbar navbar-header navbar-expand navbar-light">
        <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
        <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
            <li class="dropdown nav-icon">
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar mr-1">
                  <img src="<?= base_url() ?>assets/custom/images/avatar/avatar-s-1.png" alt="" srcset="">
                </div>
                <?php if ($user == "Mahasiswa" || $user == "Dosen") { ?>
                  <div class="d-none d-md-block d-lg-inline-block"><?= $this->session->userdata('userid'); ?></div>
                <?php } else { ?>
                  <div class="d-none d-md-block d-lg-inline-block"><?= $this->session->userdata('name'); ?></div>
                <?php  } ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <!--  <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                            <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                            <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                            <div class="dropdown-divider"></div> -->
                <a class="dropdown-item logout" href="<?= site_url('auth/logout') ?>"><i data-feather="log-out"></i> Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Akhir Navbar -->
      <!-- Main Menu atau isi konten halaman -->
      <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
      <div class="main-content container-fluid">
        <script src='<?= base_url() ?>assets/fullcalendar/lib/main.js'></script>
        <script src='<?= base_url() ?>assets/fullcalendar/lib/locales-all.js'></script>
        <script src="<?= base_url() ?>assets/custom_dropzone/dropzone.min.js"></script>
        <script src="<?= base_url() ?>assets/countdown/js/jquery.plugin.min.js"></script>
        <script src="<?= base_url() ?>assets/countdown/js/jquery.countdown.js"></script>
        <?php echo $contents; ?>
      </div>

      <!-- Akhir konten halaman -->
      <!-- Footer halaman -->
      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-left">
            <p>2020 &copy; Elearning UMP</p>
          </div>
          <div class="float-right">
            <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="ilhammp.com">Elearning UMP</a></p>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <script src="<?= base_url() ?>assets/custom/js/feather-icons/feather.min.js"></script>
  <script src="<?= base_url() ?>assets/custom/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>assets/custom/js/app.js"></script>
  <script src="<?= base_url() ?>assets/custom/vendors/chartjs/Chart.min.js"></script>
  <script src="<?= base_url() ?>assets/custom/vendors/apexcharts/apexcharts.min.js"></script>
  <script src="<?= base_url() ?>assets/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/datatables/datatables-demo.js"></script>
  <!-- <script src="<?= base_url() ?>assets/custom/js/vendors.js"></script> -->
  <script src="<?= base_url() ?>assets/custom/js/main.js"></script>
  <script src="<?= base_url() ?>assets/sweet_alert/sweetalert2.all.min.js"></script>
  <script src="<?= base_url() ?>assets/sweet_alert/script_alert.js"></script>
  <script src="<?= base_url() ?>assets/custom/vendors/choices/choices.min.js"></script>
  <script src="<?= base_url() ?>assets/loading_bar/loading-bar.min.js"></script>



  <!--  <script type="text/javascript" src="<?= base_url() ?>assets/select_js/js/select2.min.js"></script> -->
  <!-- <script type="text/javascript">
                $(document).ready(function() {
                  $('.js-example-basic-single').select2();
                });
              </script> -->

</body>

</html>