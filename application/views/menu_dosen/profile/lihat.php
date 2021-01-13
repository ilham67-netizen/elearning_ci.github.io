 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3><?= $title ?></h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
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
                         <th>NIP</th>
                         <th>Nama Dosen</th>
                         <th>Fakultas</th>
                         <th>Prodi</th>
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
                             <td><?= $d->nip_dosen ?></td>
                             <td><?= $d->nama_dosen ?></td>
                             <td><?= $d->nama_fakultas ?></td>
                             <td><?= $d->nama_prodi ?></td>
                             <td><a class="badge bg-success" href="<?= site_url('menu_dosen/dosen/edit/' . $d->nip_dosen) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                 <a href="<?= site_url('master_data/dosen/del/' . $d->nip_dosen) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                             </td>

                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>

 </section>