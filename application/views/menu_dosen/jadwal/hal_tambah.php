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
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/jadwal/process/') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Jadwal</label>
                                      <input type="text" class="form-control" readonly="" required="" name="kd_jadwal" placeholder="Masukkan Kode Tugas" autocomplete="off" value="<?= $kode_auto ?>">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Kuliah</label>
                                      <input type="text" class="form-control" required="" name="nama_kuliah" value="" placeholder="Masukkan Nama Kuliah" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Mulai</label>
                                      <input type="datetime-local" class="form-control" required="" name="waktu_mulai" value="" autocomplete="off">
                                  </div>
                              </div>
                              <!-- <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Akhir</label>
                                      <input type="datetime-local" class="form-control" required="" name="waktu_akhir" value="" autocomplete="off">
                                  </div>
                              </div> -->
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Mata Kuliah</label>
                                      <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                          <option selected="" value="">--- Pilih Matkul ---</option>
                                          <?php foreach ($row as $row2) : ?>
                                              <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                              </div>
                              <div id="isi">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Dosen</label>
                                          <input type="text" class="form-control" name="dosen" autocomplete="off" required readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Kelas</label>
                                          <input type="text" class="form-control" name="kelas" required autocomplete="off" readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Semester</label>
                                          <input type="text" class="form-control" name="semester" required autocomplete="off" readonly>
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
                                              <input type="text" name="link2" class="form-control" required="" placeholder="Masukkan Nama Room" autocomplete="off">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="dropzone">
                                  <div class="dz-message" style="height: 100px;">
                                      <center>
                                          <h3 style="margin-top: 50px;"> Klik atau Drop File Materi Di sini</h3><br><span data-feather="upload-cloud"></span>
                                      </center>
                                  </div>
                              </div>
                              <center><input type="submit" name="add" class="btn btn-primary ml-1" value="Tambah"></center>
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
                  url: "<?= site_url('menu_dosen/jadwal/getmatkul') ?>",
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
          url: "<?= site_url('menu_dosen/jadwal/file_upload/' . $kode_auto) ?>",
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