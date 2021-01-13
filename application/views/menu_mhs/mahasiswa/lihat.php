  <div class="page-title">
      <div class="row">
          <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>Profile</h3>
              <br>
          </div>
          <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class='breadcrumb-header'>
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Profile</li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
      <div class="card">
          <div class="card-content">
              <div class="card-body">
                  <form class="form form-vertical" action="<?= site_url('menu_mhs/profile/process/') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>NIM</label>
                                      <input type="number" class="form-control" name="nim" value="<?= $row->nim ?>" placeholder="Masukkan NIM" autocomplete="off" readonly="">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Lengkap</label>
                                      <input type="text" class="form-control" name="nama_mhs" value="<?= $row->nama_mhs ?>" placeholder="Masukkan Nama Lengkap" autocomplete="off" onkeyup="this.value = this.value.toUpperCase()">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nomor Telphone</label>
                                      <input type="number" class="form-control" name="no_telp" value="<?= $row->no_telp ?>" placeholder="Masukkan Nomor Telphone" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Tempat Lahir</label>
                                      <input type="text" class="form-control" name="tempat_lahir" value="<?= $row->tempat_lahir ?>" placeholder="Masukkan Tempat Lahir" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Tanggal Lahir</label>
                                      <input type="date" class="form-control" name="tgl_lahir" value="<?= $row->tgl_lahir ?>" placeholder="Masukkan Tanggal Lahir" autocomplete="off" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Alamat Rumah</label>
                                      <textarea class="form-control" rows="3" name="alamat" required><?= $row->alamat ?></textarea>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Dosen Pembimbing</label>
                                      <input type="text" class="form-control" name="nama_dosen" value="<?= $row->nama_dosen ?>" readonly>
                                      <input type="hidden" class="form-control" name="dosbing_akad" value="<?= $row->dosbing_akad ?>" readonly>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Email</label>
                                      <input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="<?= $row->email ?>" autocomplete="off" required>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Password <div style="color: red; display: inline;">* Tidak Wajib Disi</div></label>
                                      <input type="password" class="form-control" name="password" placeholder="Masukkan Password" autocomplete="off">
                                  </div>
                              </div>
                              <center>
                                  <input type="submit" name="edit" class="btn btn-primary ml-1" value="UBAH">
                              </center>

                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
  </div>