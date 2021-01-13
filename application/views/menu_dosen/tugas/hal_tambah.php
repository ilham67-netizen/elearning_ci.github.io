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
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Tugas</a></li>
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
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/tugas/process') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Tugas</label>
                                      <input type="text" class="form-control" readonly="" required="" name="kd_tugas" placeholder="Masukkan Kode Tugas" autocomplete="off" value="<?= $kode_auto ?>">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Tanggal Uplod</label>
                                      <input type="text" readonly="" class="form-control" required="" name="tanggal_uplod" value="<?= date('Y/m/d H:i') ?>" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Judul Tugas</label>
                                      <input type="text" class="form-control" required="" name="judul_tugas" value="" placeholder="Masukkan Judul Tugas" autocomplete="off">
                                  </div>
                              </div>

                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Batas Waktu</label>
                                      <input type="datetime-local" class="form-control" required="" name="batas_waktu" value="" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Mata Kuliah</label>
                                      <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                          <option selected="" value="">--- Pilih Matkul ---</option>
                                          <?php foreach ($row as $row2) : ?>
                                              <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?> (<?php echo $row2->nama_kelas; ?>)</option>
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
                                  <div class="form-group">
                                      <label>Keterangan</label>
                                      <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                                  </div>
                              </div>
                              <div class="dropzone">

                                  <div class="dz-message" style="height: 100px;">
                                      <center>
                                          <h3 style="margin-top: 50px;"> Klik atau Drop File Tugas Di sini</h3><br><span data-feather="upload-cloud"></span>
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

  </div>
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
                      html += '<input type="hidden" class="form-control" name="nip_dosen" value="' + data.nip_dosen + '" autocomplete="off">';
                      html += ' </div></div>';
                      html += '<div class="col-12">';
                      html += '<div class="form-group">'
                      html += '<label>Kelas</label>';
                      html += '<input type="text" class="form-control" value="' + data.nama_kelas + '" autocomplete="off" required readonly>';
                      html += '<input type="hidden" class="form-control" name="kelas" value="' + data.kelas + '" autocomplete="off"readonly>';
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
          url: "<?= site_url('menu_dosen/tugas/file_upload/' . $kode_auto) ?>",
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
              url: "<?= site_url('tugas/hapus_file') ?>",
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