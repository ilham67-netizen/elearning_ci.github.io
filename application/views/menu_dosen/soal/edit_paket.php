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
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Paket Soal</a></li>
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
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/paket_soal/process') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Paket</label>
                                      <input type="text" class="form-control" readonly="" required="" value="<?= $row->kd_paket ?>" name="kd_paket" placeholder="Masukkan Kode Tugas" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Jenis Soal</label>
                                      <select class="choices form-control" name="jenis_soal" required="">
                                          <option selected="" value="<?= $row->jenis_soal ?>"><?= jenis_soal($row->jenis_soal) ?></option>
                                          <?php for ($i = 1; $i <= 4; $i++) {
                                                if ($i != $row->jenis_soal) {
                                                    echo '<option value="' . $i . '">' . jenis_soal($i) . '</option>';
                                                } else {
                                                }
                                            } ?>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Mata Kuliah</label>
                                      <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                          <option selected="" value="<?= $row->kd_matkul ?>"><?= $row->nama_matkul ?> (<?= $row->nama_kelas ?>)</option>
                                          <?php foreach ($matkul as $row2) : ?>
                                              <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?> (<?php echo $row2->nama_kelas; ?>)</option>
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
                                          <input type="hidden" class="form-control" value="<?= $row->kelas ?>" name="kelas" autocomplete="off" required readonly>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label>Semester</label>
                                          <input type="text" class="form-control" value="<?= $row->semester ?>" name="semester" required autocomplete="off" readonly>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Pengerjaan</label>
                                      <input type="number" class="form-control" name="waktu_soal" value="<?= $row->waktu_soal ?>" required autocomplete="off" placeholder="Masukkan waktu dalam Menit">
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