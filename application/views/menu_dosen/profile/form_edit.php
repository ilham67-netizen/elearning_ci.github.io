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
                      <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Dosen</a></li>
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
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/profile/process') ?>" method="POST">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>NIP</label>
                                      <input type="number" class="form-control" required="" readonly="" name="nip" value="<?= $row->nip_dosen ?>" placeholder="Masukkan NIP Dosen" autocomplete="off">
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label>Nama Lengkap</label>
                                      <input type="text" class="form-control" required="" name="nama_dosen" value="<?= $row->nama_dosen; ?>" placeholder="Masukkan Nama Lengkap" autocomplete="off">
                                  </div>
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label>Nomor Telphone</label>
                                  <input type="number" class="form-control" required="" name="no_telp" value="<?= $row->no_telp; ?>" placeholder="Masukkan Nomor Telphone" autocomplete="off">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label>Tempat Lahir</label>
                                  <input type="text" class="form-control" required="" name="tempat_lahir" value="<?= $row->tempat_lahir; ?>" placeholder="Masukkan Tempat Lahir" autocomplete="off">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label>Tanggal Lahir</label>
                                  <input type="date" class="form-control" required="" name="tgl_lahir" value="<?= $row->tgl_lahir; ?>" placeholder="Masukkan Tanggal Lahir" autocomplete="off">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label>Password <div style="color: red; display: inline;">* Tidak Wajib Disi</div></label>
                                  <input type="password" name="password" value="" class="form-control" placeholder="Masukkan Password">
                              </div>
                          </div>
                          <div class="col-12">
                              <div class="form-group">
                                  <label>Alamat Rumah</label>
                                  <textarea class="form-control" required="" rows="3" name="alamat"><?= $row->alamat; ?></textarea>
                              </div>
                          </div>
                          <center>
                              <input type="submit" name="edit" class="btn btn-primary ml-1" value="EDIT">
                          </center>
                      </div>
              </div>
              </form>
          </div>
      </div>
      </div>
  </section>
  </div>