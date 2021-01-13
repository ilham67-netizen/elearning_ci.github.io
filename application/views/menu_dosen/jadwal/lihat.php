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
 <section class="section">
     <div class="card">

         <div class="card-body">
             <a class="btn btn-outline-primary" href="<?= site_url('menu_dosen/jadwal/hal_add/') ?>">
                 TAMBAH
             </a>
             <br>
             <br>
             <div class="table-responsive">
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
                            foreach ($row as $d) {
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
                                 <td align="center"><?php if ($d->status == '0') {
                                                        echo 'Belum Diaktifkan';
                                                    } else {
                                                        echo 'Sudah Diaktifkan';
                                                    } ?></td>
                                 <td>
                                     <center>
                                         <a class="btn btn-sm btn-success" href="<?= site_url('menu_dosen/jadwal/edit/' . $d->kd_jadwal) ?>"><span data-feather="edit" width="100"></span></a>
                                         <a href="<?= site_url('menu_dosen/jadwal/del/' . $d->kd_jadwal) ?>" class="btn btn-sm btn-danger tombol-delete"><span data-feather="trash" width="100"></span></a><br><br>
                                         <a class="btn btn-sm btn-primary" href="<?= site_url('menu_dosen/jadwal/lihat_absen/' . $d->kd_jadwal) ?>"><i data-feather="eye" width="50"></i>Lihat Absen</a>
                                     </center>
                                 </td>
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>
 </section>