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
                      <?php if ($this->uri->segment(3) == 1) { ?>
                          <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_essay/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                      <?php } elseif ($this->uri->segment(3) == 2) {
                        ?>
                          <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_pilgan/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                      <?php
                        } elseif ($this->uri->segment(3) == 3) {
                        ?>
                          <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_pemrograman/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                      <?php
                        } ?>
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
                  <form class="form form-vertical" action="<?= site_url('ujian/process/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Kode Pengawas</label>
                                      <input type="text" class="form-control" readonly="" required="" value="<?= $row->kd_pengawas ?>" name="kd_pengawas" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Pengawas</label>
                                      <input type="text" class="form-control" name="nama_pengawas" placeholder="Masukkan Nama Pengawas" value="<?= $row->nama_pengawas; ?>" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Ujian</label>
                                      <input type="text" class="form-control" name="nama_ujian" placeholder="Masukkan Nama Pengawas" value="<?= $row->nama_ujian; ?>" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Paket Soal</label>
                                      <select class="choices form-control" name="kd_paket" required="">
                                          <option selected="" value="<?= $row->kd_paket ?>">(<?php echo $row->kd_paket; ?>)<?php echo $row->nama_matkul; ?>/<?php echo $row->nama_kelas; ?>/<?php echo jenis_soal($row->jenis_soal); ?></option>
                                          <?php foreach ($paket as $row2) : ?>
                                              <option value=" <?php echo $row2->kd_paket; ?>">(<?php echo $row2->kd_paket; ?>)<?php echo $row2->nama_matkul; ?>/<?php echo $row2->nama_kelas; ?>/<?php echo jenis_soal($row2->jenis_soal); ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Waktu Ujian</label>
                                      <input type="datetime-local" class="form-control" name="waktu_ujian" placeholder="Masukkan Waktu Ujian" value="<?= date('Y-m-d\TH:i', strtotime($row->tanggal_ujian)) ?>" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Batas Keterlambatan</label>
                                      <input type="number" class="form-control" value="<?= $row->batas_telat ?>" name="batas_telat" placeholder="Masukkan Batas Keterlambatan dalam Menit" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label for="">Password <div style="color: red; display: inline;">*Tidak Wajib Diisi</div></label>
                                      <input type="password" class="form-control" name="password" placeholder="Masukkan Password Login Pengawas">
                                      <input type="hidden" class="form-control" name="nip_dosen" value="<?= $row->nip ?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label>Status</label>
                                  <select class="choices form-control" name="status" required="">
                                      <?php if ($row->status > 0) {
                                            echo "<option value='1' selected>Sudah Diaktifkan</option>
                                                <option value='0'>Belum Diaktifkan</option>";
                                        } else {
                                            echo "<option value='0' selected>Belum Diaktifkan</option>
                                            <option value='1'>Sudah Diaktifkan</option>";
                                        } ?>


                                  </select>
                              </div>
                              <center><input type="submit" name="edit" class="btn btn-primary ml-1" value="Ubah"></center>
                          </div>
                      </div>
                  </form>

              </div>
          </div>
      </div>
  </section>