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
             <a class="btn btn-outline-primary" href="<?= site_url('menu_dosen/tugas/hal_add/') ?>">
                 TAMBAH
             </a>
             <br>
             <br>
             <div class="table-responsive">
                 <table class='table table-striped' id="dataTable">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Judul Tugas</th>
                             <th>Tanggal Upload</th>
                             <th>Mata Kuliah</th>
                             <th>Nama Dosen</th>
                             <th>Batas Waktu</th>
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
                                 <td><?= $d->judul_tugas ?></td>
                                 <td><?= $d->tanggal_uplod ?></td>
                                 <td><?= $d->nama_matkul ?></td>
                                 <td><?= $d->nama_dosen ?></td>
                                 <td><?= $d->batas_waktu ?></td>
                                 <td><a class="badge bg-success" href="<?= site_url('menu_dosen/tugas/edit/' . $d->kd_tugas) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                     <a href="<?= site_url('menu_dosen/tugas/del/' . $d->kd_tugas) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                                     <a class="badge bg-primary" href="<?= site_url('menu_dosen/tugas/lihat_detail_tugas/' . $d->kd_tugas) ?>"><i data-feather="eye" width="20"></i>Lihat Tugas</a>
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>