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
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Kode Matkul</th>
                         <th>Nama Matkul</th>
                         <th>Kelas</th>
                         <th>Dosen</th>
                         <th>Semester</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($row as $d) {
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $d->kd_matkul ?></td>
                             <td><?= $d->nama_matkul ?></td>
                             <td><?= $d->nama_kelas ?></td>
                             <td><?= $d->nama_dosen ?></td>
                             <td><?= $d->semester ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>
 </section>