  <?php date_default_timezone_set('Asia/Jakarta'); ?>
  <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              <h3><?= $title; ?></h3>
              <br>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class='breadcrumb-header'>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Jadwal</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
      <div class="card">
          <div class="card-content">
              <div class="card-body">
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/jadwal/process') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Jadwal</label>
                                      <input type="text" class="form-control" readonly="" required="" name="kd_jadwal" placeholder="Masukkan Kode Tugas" autocomplete="off" value="<?= $row->kd_jadwal ?>">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Kuliah</label>
                                      <input type="text" class="form-control" required="" name="nama_kuliah" value="<?= $row->nama_kuliah ?>" placeholder="Masukkan Nama Kuliah" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Mulai</label>
                                      <input type="datetime-local" class="form-control" required="" name="waktu_mulai" value="<?= date('Y-m-d\TH:i', strtotime($row->waktu_mulai)) ?>" autocomplete="off">
                                  </div>
                              </div>
                              <!-- <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Akhir</label>
                                      <?php if ($row->waktu_akhir != '' || $row->waktu_akhir != null) {
                                            echo '<input type="datetime-local" class="form-control" name="waktu_akhir" value="' . date('Y-m-d\TH:i', strtotime($row->waktu_akhir)) . '" autocomplete="off">';
                                        } else {
                                            echo '<input type="datetime-local" class="form-control" name="waktu_akhir" value="" autocomplete="off">';
                                        } ?>
                                  </div>
                              </div> -->
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Mata Kuliah</label>
                                      <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                          <option selected="" value="<?= $row->kd_matkul ?>"><?= $row->nama_matkul ?></option>
                                          <?php foreach ($matkul as $row2) : ?>
                                              <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                              </div>
                              <div id="isi">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Dosen</label>
                                          <input type="text" class="form-control" name="dosen" autocomplete="off" value="<?= $row->nama_dosen ?>" required readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Kelas</label>
                                          <input type="text" class="form-control" name="kelas" required autocomplete="off" value="<?= $row->nama_kelas ?>" readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Semester</label>
                                          <input type="text" class="form-control" name="semester" required autocomplete="off" value="<?= $row->semester ?>" readonly>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="row">
                                      <div class="col-6">
                                          <div class="form-group">
                                              <label>Link</label>
                                              <input type="text" class="form-control" name="link1" required="" value="https://meet.jit.si/" autocomplete="off" readonly>
                                          </div>
                                      </div>
                                      <div class="col-6">
                                          <label>Nama Ruangan</label>
                                          <div class="form-group">
                                              <input type="text" name="link2" class="form-control" required="" value="<?php $PecahStr = explode("https://meet.jit.si/", $row->link);
                                                                                                                        echo $PecahStr[1] ?>" placeholder="Masukkan Nama Room" autocomplete="off">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label class="form-check-label" for="flexSwitchCheckDefault">AKTIFKAN KULIAH</label>
                                      <div class="form-check form-switch">
                                          <?php if ($row->status > 0) {
                                                echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2" checked>';
                                            } else {
                                                echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2">';
                                            } ?>
                                          <label class="form-check-label" for="flexSwitchCheckDefault">ON</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="form-check-label" for="flexSwitchCheckDefault">IJINKAN ABSENSI</label>
                                      <div class="form-check form-switch">

                                          <?php if ($row->allow_absen > 0) {
                                                echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked>';
                                            } else {
                                                echo '<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">';
                                            } ?>
                                          <label class="form-check-label" for="flexSwitchCheckDefault">ON</label>
                                      </div>
                                  </div>
                              </div>
                              <label style="margin-bottom: 10px;">FILE MATERI YANG ADA SAAT INI</label>
                              <div id="filemateri">
                                  <?php foreach ($file as $data) :
                                    ?>
                                      <div class="col-1">
                                          <center>
                                              <img src="<?= base_url('images/') . 'file.png' ?>" width="64" height="64">
                                              <label><?= $data->nama_file ?></label>
                                              <a class="btn btn-sm btn-danger mt-2 tombol-hapus" data-token="<?= $data->token ?>">HAPUS</a>
                                          </center>
                                      </div>
                                  <?php endforeach; ?>
                              </div>
                              <div id="filemateri2"></div>
                              <div class="dropzone">
                                  <div class="dz-message" style="height: 100px;">
                                      <center>
                                          <h3 style="margin-top: 50px;"> Klik atau Drop File Tugas Di sini</h3><br><span data-feather="upload-cloud"></span>
                                      </center>
                                  </div>
                              </div>
                              <center><input type="submit" name="edit" class="btn btn-primary ml-1" value="Ubah"></center>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
  <script type="text/javascript">
      $(document).ready(function() {
          $('#kd_matkul').change(function() {
              var id = $(this).val();

              $.ajax({
                  url: "<?= site_url('menu_dosen/jadwal') ?>",
                  method: "POST",
                  data: {
                      id: id
                  },
                  async: true,
                  dataType: 'json',
                  success: function(data) {

                      var html = '';
                      var i;

                      html += '<div class="col-12">';
                      html += '<div class="form-group">'
                      html += '<label>Dosen</label>';
                      html += '<input type="text" class="form-control" name="dosen" value="' + data.nama_dosen + '" autocomplete="off" required readonly>';
                      html += ' </div></div>';
                      html += '<div class="col-12">';
                      html += '<div class="form-group">'
                      html += '<label>Kelas</label>';
                      html += '<input type="text" class="form-control" name="kelas" value="' + data.nama_kelas + '" autocomplete="off" required readonly>';
                      html += ' </div></div>';
                      html += '<div class="col-12">';
                      html += '<div class="form-group">'
                      html += '<label>Semester</label>';
                      html += '<input type="text" class="form-control" name="semester" value="' + data.semester + '" autocomplete="off" required readonly>';
                      html += ' </div></div>';

                      $('#isi').html(html);

                  }
              });
              return false;
          });
      });
  </script>
  <script type="text/javascript">
      Dropzone.autoDiscover = false;
      var foto_upload = new Dropzone(".dropzone", {
          url: "<?= site_url('menu_dosen/jadwal/file_upload/' . $this->uri->segment(4)) ?>",
          maxFilesize: 7,
          method: "post",
          acceptedFiles: ".jpg, .png, .jpeg, .pdf, .zip",
          paramName: "userfile",
          dictInvalidFileType: "Type file ini tidak dizinkan",
          addRemoveLinks: true,
      });
      foto_upload.on("sending", function(a, b, c) {
          a.token = Math.random();
          c.append("token_foto", a.token);
      });

      foto_upload.on("removedfile", function(a) {
          var token = a.token;
          $.ajax({
              type: "POST",
              data: {
                  token: token
              },
              url: "<?= site_url('menu_dosen/jadwal/hapus_file') ?>",
              cache: false,
              dataType: 'json',
              success: function() {
                  console.log("remove file sukses");
              },
              error: function() {
                  console.log("remove file gagal");
              }
          });
      });
  </script>
  <script type="text/javascript">
      $(".tombol-hapus").on('click', function(e) {
          e.preventDefault();
          const token = $('.tombol-hapus').data('token');
          Swal.fire({
              title: 'Apakah Anda Yakin Dokumen Akan Dihapus ?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya, Hapus Dokumen!'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: "<?= site_url('menu_dosen/jadwal/hapus_file2') ?>",
                      method: "POST",
                      data: {
                          token: token,
                          kd_tugas: "<?= $this->uri->segment(4) ?>"
                      },
                      async: true,
                      dataType: 'json',
                      success: function(data) {

                          var html = '';
                          var i;
                          $('#filemateri').remove();
                          for (i = 0; i < data.length; i++) {
                              html += ' <div class="col-1">';
                              html += ' <center>';
                              html += '<img src="<?= base_url("images/") . "file.png" ?>" width="64" height="64">';
                              html += '<label> ' + data[i].nama_file + '</label>';
                              html += '<a class="btn btn-sm btn-danger mt-2 tombol-delete" data-token="' + data[i].token + '">HAPUS</a>';
                              html += ' </center>';
                              html += '</div>';
                          }
                          $('filemateri2').html(html);
                      }
                  });
                  return false;
              }
          })

      });
  </script>
  <script>
      $(document).ready(function() {
          $("#flexSwitchCheckDefault").on('click', function() {
              var kd_jadwal = '<?= $this->uri->segment(4); ?>';
              if (this.checked) {
                  var status = "1";
                  $.ajax({
                      type: "POST",
                      data: {
                          status: status,
                          kd_jadwal: kd_jadwal
                      },
                      url: "<?= site_url('menu_dosen/kuliah/check_absen') ?>",
                      cache: false,
                      dataType: 'json',
                      success: function(data) {
                          console.log('Absen Aktif');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'success'
                          });
                      },
                      error: function(data) {
                          console.log('Absen Aktif Gagal');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'error'
                          });
                      }
                  });
              } else {
                  var status = "0";
                  $.ajax({
                      type: "POST",
                      data: {
                          status: status,
                          kd_jadwal: kd_jadwal
                      },
                      url: "<?= site_url('menu_dosen/kuliah/check_absen') ?>",
                      cache: false,
                      dataType: 'json',
                      success: function(data) {
                          console.log('Absen Tidak Aktif Sukses');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'success'
                          });
                      },
                      error: function(data) {
                          console.log('Absen Tidak Aktif Gagal');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'error'
                          });
                      }
                  });
              }

          });
      });
  </script>
  <script>
      $(document).ready(function() {
          $("#flexSwitchCheckDefault2").on('click', function() {
              var kd_jadwal = '<?= $this->uri->segment(4); ?>';
              if (this.checked) {
                  var status = "1";
                  $.ajax({
                      type: "POST",
                      data: {
                          status: status,
                          kd_jadwal: kd_jadwal
                      },
                      url: "<?= site_url('menu_dosen/kuliah/aktifkan_kuliah') ?>",
                      cache: false,
                      dataType: 'json',
                      success: function(data) {
                          console.log('Kuliah Aktif');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'success'
                          });
                      },
                      error: function(data) {
                          console.log('Kuliah Aktif Gagal');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'error'
                          });
                      }
                  });
              } else {
                  var status = "0";
                  $.ajax({
                      type: "POST",
                      data: {
                          status: status,
                          kd_jadwal: kd_jadwal
                      },
                      url: "<?= site_url('menu_dosen/kuliah/aktifkan_kuliah') ?>",
                      cache: false,
                      dataType: 'json',
                      success: function(data) {
                          console.log('Kuliah Tidak Aktif Sukses');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'success'
                          });
                      },
                      error: function(data) {
                          console.log('Kuliah Tidak Aktif Gagal');
                          Swal.fire({
                              title: data.hasil,
                              text: 'Klik OK',
                              icon: 'error'
                          });
                      }
                  });
              }

          });
      });
  </script>