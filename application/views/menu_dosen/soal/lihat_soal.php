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
                     <li class="breadcrumb-item"><a href="<?= site_url('menu_dosen/paket_soal') ?>">Lihat Paket</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                 </ol>
             </nav>
         </div>
     </div>
 </div>
 <section class="section">
     <div class="card">

         <div class="card-body">
             <a class="btn btn-primary" href="<?= site_url('menu_dosen/paket_soal/tambah_soal/' . $this->uri->segment(4)) ?>">
                 TAMBAH
             </a>
             <br>
             <br>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>Kode Soal</th>
                         <th>Pertanyaan</th>
                         <th>Kunci Jawaban</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($row as $d) {
                        ?>
                         <tr>
                             <td><?= $d->kd_soal ?></td>
                             <td><?= limit_words($d->pertanyaan, 15) ?></td>
                             <td align="center"><?= $d->kunci_jawaban ?></td>
                             <!-- <a class="badge bg-success" href="<?= site_url('menu_dosen/paket_soal/edit_soal/' . $d->kd_soal) ?>"><i data-feather="edit" width="20"></i>Edit</a> -->
                             <td><a href="<?= site_url('menu_dosen/paket_soal/del_soal/' . $d->kd_soal . '/' . $d->kd_paket) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                         </tr>
                     <?php } ?>
                 </tbody>

             </table>

         </div>
     </div>
 </section>