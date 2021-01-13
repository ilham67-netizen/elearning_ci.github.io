 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Mahasiswa</h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Mahasiswa</li>
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
                         <th>NIM</th>
                         <th>Nama</th>
                         <th>No HP</th>
                         <th>Fakultas</th>
                         <th>Prodi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($row as $d) {
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $d->nim ?></td>
                             <td><?= $d->nama_mhs ?></td>
                             <td><?= $d->no_telp ?></td>
                             <td><?= $d->nama_fakultas ?></td>
                             <td><?= $d->nama_prodi ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>

 </section>