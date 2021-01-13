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
                      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section" style="margin-bottom: 0;">
      <div class="card">
          <div class="card-body">
              <h2>Kuliah Online Pada Hari Ini</h2><br>
              <div class="row">
                  <?php foreach ($matkul as $row) :
                        $tgl = date('d/m/Y');
                        $jam = timediff($row->jam_tersisa);
                        $menit = timediff2($row->jam_tersisa);
                        if (indo_date($row->waktu_mulai) == $tgl) {

                    ?>
                          <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                              <h3><u><?= $row->nama_matkul; ?></u></h3>
                              <h5>Tanggal : <?= indo_date($row->waktu_mulai); ?></h5>
                              <h5>Jam : <?= date('H:i', strtotime($row->waktu_mulai)) ?></h5>
                              <h5>Kelas : <?= $row->nama_kelas ?></h5>
                              <h5>Status : <?php if ($row->status == 0) {
                                                echo 'Belum Diaktifkan';
                                            } else {
                                                echo 'Sudah Diaktifkan';
                                            } ?></h5>
                              <?php if ($jam <= 0 || $menit <= 0) {
                                    if ($row->waktu_akhir != '' || $row->waktu_akhir != NULL) {
                                        echo '<a href="" class="btn btn-success">Sudah Melakukan Perkuliahan</a>';
                                    } elseif ($row->waktu_akhir == '' || $row->waktu_akhir == null) {
                                ?>
                                      <a href="<?= site_url('menu_dosen/kuliah/kuliah_daring/' . $row->kd_jadwal) ?>" class="btn btn-primary tombol-tanya">Masuk</a>
                              <?php
                                    }
                                } ?>
                          </div>
                  <?php }
                    endforeach; ?>
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-body">
              <h2>Kuliah Online Yang Akan Datang</h2><br>
              <div class="row">
                  <?php foreach ($matkul as $row) :
                        $tgl = date('d/m/Y');
                        $jam = timediff($row->jam_tersisa);
                        $menit = timediff2($row->jam_tersisa);
                        if ($row->hari_tersisa > 0) {

                    ?>
                          <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                              <h3><u><?= $row->nama_matkul; ?></u></h3>
                              <h5>Tanggal : <?= indo_date($row->waktu_mulai); ?></h5>
                              <h5>Jam : <?= date('H:i', strtotime($row->waktu_mulai)) ?></h5>
                              <h5>Kelas : <?= $row->nama_kelas ?></h5>
                              <h5>Status : <?php if ($row->status == 0) {
                                                echo 'Belum Diaktifkan';
                                            } else {
                                                echo 'Sudah Diaktifkan';
                                            } ?></h5>
                              <?php if ($jam <= 0 || $menit <= 0) {
                                    if ($row->waktu_akhir != '' || $row->waktu_akhir != NULL) {
                                        echo '<a href="" class="btn btn-success">Sudah Melakukan Perkuliahan</a>';
                                    } elseif ($row->waktu_akhir == '' || $row->waktu_akhir == null) {
                                ?>
                                      <a href="<?= site_url('menu_dosen/kuliah/kuliah_daring/' . $row->kd_jadwal) ?>" class="btn btn-primary tombol-tanya">Masuk</a>
                              <?php
                                    }
                                } ?>
                          </div>
                  <?php }
                    endforeach; ?>
              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-body">
              <h2>Daftar Kuliah Online Yang Telah Diikuti</h2><br>
              <table class='table table-striped' id="dataTable">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama Kuliah</th>
                          <th>Mata Kuliah</th>
                          <th>Nama Dosen</th>
                          <th>Waktu Mulai</th>
                          <th>Waktu Akhir</th>
                          <th>Status</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($matkul as $d) {
                            if ($d->hari_tersisa < 0) {
                        ?>
                              <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $d->nama_kuliah ?></td>
                                  <td><?= $d->nama_matkul ?></td>
                                  <td><?= $d->nama_dosen ?></td>
                                  <td><?= indo_date(date('Y-m-d', strtotime($d->waktu_mulai))) . ' || ' . date('H:i', strtotime($d->waktu_mulai)) ?></td>
                                  <td><?php
                                        if ($d->waktu_akhir != '') {
                                            echo indo_date(date('Y-m-d', strtotime($d->waktu_akhir))) . ' || ' . date('H:i', strtotime($d->waktu_akhir));
                                        } else {
                                            echo 'Belum Ditentukan';
                                        }
                                        ?></td>
                                  <td><?php if ($d->status == '0') {
                                            echo 'Belum Diaktifkan';
                                        } else {
                                            echo 'Sudah Diaktifkan';
                                        } ?></td>
                                  <td>
                                      <a class="badge bg-primary" href="<?= site_url('menu_dosen/jadwal/lihat_absen/' . $d->kd_jadwal) ?>"><i data-feather="eye" width="20"></i>Lihat Absen</a>
                              </tr>
                      <?php }
                        } ?>
                  </tbody>

              </table>
          </div>
      </div>
  </section>