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
             <a class="btn btn-outline-primary" href="<?= site_url('jadwal/hal_add/' . $this->uri->segment(3)) ?>">
                 TAMBAH
             </a>
             <br>
             <br>
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
                             <td><?php if ($d->status == '0') {
                                        echo 'Belum Diaktifkan';
                                    } else {
                                        echo 'Sudah Diaktifkan';
                                    } ?></td>
                             <td>
                                 <a class="btn btn-success" href="<?= site_url('jadwal/edit/' . $d->kd_jadwal . '/' . $this->uri->segment(3)) ?>"><i data-feather="edit" width="20"></i></a>
                                 <a href="<?= site_url('jadwal/del/' . $d->kd_jadwal) ?>" class="btn btn-danger tombol-delete"> <i data-feather="trash" width="20"></i></a><br><br>
                                 <a class="btn btn-primary" href="<?= site_url('jadwal/lihat_absen/' . $this->uri->segment(3) . '/' . $d->kd_jadwal) ?>"><i data-feather="eye" width="20"></i>Lihat Absen</a>
                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>
 </section>