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
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1)) ?>">Pilih Fakultas</a></li>
                      <li class="breadcrumb-item"><a href="<?= site_url('pelatihan/lihat_pelatihan/' . $this->uri->segment(3)) ?>">Menu Pelatihan</a></li>
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
                  <form class="form form-vertical" action="<?= site_url('pelatihan/process/' . $this->uri->segment(3)) ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Pelatihan</label>
                                      <input type="text" class="form-control" readonly="" required="" value="<?= $row->kd_pelatihan ?>" name="kd_pelatihan" autocomplete="off">
                                  </div>
                              </div>

                              <div id="program">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Nama Pelatihan</label>
                                          <input type="text" class="form-control" name="nama_pelatihan" value="<?= $row->nama_pelatihan ?>" autocomplete="off" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Mata Kuliah</label>
                                      <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                          <option selected="" value="<?= $row->kd_matkul; ?>"><?= $row->nama_matkul; ?> (<?= $row->nama_kelas; ?>)/ Semester <?= $row->semester; ?></option>
                                          <?php foreach ($kd_matkul as $row2) : ?>
                                              <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?> (<?php echo $row2->nama_kelas; ?>)/ Semester <?= $row2->semester; ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                              </div>
                              <div id="isi">
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Dosen</label>
                                          <input type="text" class="form-control" value="<?= $row->nama_dosen ?>" name="dosen" autocomplete="off" required readonly>
                                          <input type="hidden" class="form-control" value="<?= $row->nip_dosen ?>" name="nip_dosen" autocomplete="off" required readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Kelas</label>
                                          <input type="text" class="form-control" value="<?= $row->nama_kelas ?>" required autocomplete="off" readonly>
                                          <input type="hidden" class="form-control" value="<?= $row->kd_kelas ?>" name="kelas" autocomplete="off" required readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Semester</label>
                                          <input type="text" class="form-control" value="<?= $row->semester ?>" name="semester" required autocomplete="off" readonly>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                  <select class="choices form-control" name="status" required="">
                                      <?php if ($row->status == 1) { ?>
                                          <option value="0">Tidak Diaktifkan</option>
                                          <option value="1" selected>Sudah Diaktifkan</option>
                                          <option value="2">Sudah Berakhir</option>
                                      <?php } elseif ($row->status == 0) {
                                        ?>
                                          <option value="0" selected>Tidak Diaktifkan</option>
                                          <option value="1">Sudah Diaktifkan</option>
                                          <option value="2">Sudah Berakhir</option>
                                      <?php
                                        } elseif ($row->status == 2) {
                                        ?>
                                          <option value="0">Tidak Diaktifkan</option>
                                          <option value="1">Sudah Diaktifkan</option>
                                          <option value="2" selected>Sudah Berakhir</option>
                                      <?php
                                            # code...
                                        } ?>


                                  </select>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Tanggal Pelatihan</label>
                                      <input type="datetime-local" class="form-control" name="tanggal_pelatihan" placeholder="Masukkan Tanggal Pelatihan" value="<?= date('Y-m-d\TH:i', strtotime($row->tanggal_pelatihan)) ?>" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Upload Soal Pemrograman <div style="color: red; display: inline;">*Maksimal 2mb dan Opsional</div></label>
                                      <input type="file" class="form-control" name="soal" accept=".doc, .docx, .pdf, .zip" size="20">
                                  </div>
                              </div>
                              <center>
                                  <center><input type="submit" name="edit" class="btn btn-primary ml-1" value="UBAH"></center>
                              </center>
                          </div>
                      </div>
                  </form>

              </div>
          </div>
      </div>
  </section>
  <script>
      $('#kd_matkul').change(function() {
          var kd_matkul = $(this).val();

          $.ajax({
              url: "<?= site_url('paket_soal/getmatkul') ?>",
              method: "POST",
              data: {
                  kd_matkul: kd_matkul
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
                  html += '<input type="text" class="form-control"  value="' + data.nama_kelas + '" autocomplete="off" required readonly>';
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
  </script>