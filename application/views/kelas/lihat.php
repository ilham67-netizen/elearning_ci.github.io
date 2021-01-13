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
             <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
                 TAMBAH
             </button>
             <br>
             <br>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Kode Kelas</th>
                         <th>Nama kelas</th>
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
                             <td><?= $d->kd_kelas ?></td>
                             <td><?= $d->nama_kelas ?></td>
                             <td><?= $d->nama_fakultas ?></td>
                             <td><?= $d->nama_prodi ?></td>
                             <td><a class="badge bg-success" href="<?= site_url('master_data/kelas/edit/' . $d->kd_kelas) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                 <a href="<?= site_url('master_data/kelas/del/' . $d->kd_kelas) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                             </td>

                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>
     <!-- Vertically Centered modal Modal -->
     <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <h5 class="modal-title white" id="myModalLabel160">Tambah Kelas</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form class="form form-vertical" action="<?= site_url('master_data/kelas/process') ?>" method="POST">
                         <div class="form-body">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Kode Kelas</label>
                                         <input type="text" class="form-control" required="" readonly="" name="kd_kelas" value="<?= $kd_kelas; ?>" placeholder="Masukkan Kode Kelas" autocomplete="off">
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Nama Kelas</label>
                                         <input type="text" class="form-control" required="" name="nama_kelas" placeholder="Masukkan Nama Kelas" autocomplete="off">
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Fakultas</label>
                                         <select class="form-control" name="fakultas" id="fakultas" required>
                                             <option value="">--- Pilih Fakultas --</option>
                                             <?php foreach ($fakultas as $row) : ?>
                                                 <option value="<?php echo $row->kd_fakultas; ?>"><?php echo $row->nama_fakultas; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Prodi</label>
                                         <select class="form-control" name="prodi" id="prodi" required="">
                                             <option selected="">--- Pilih Prodi ---</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="modal-footer">
                                     <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                         <i class="bx bx-x d-block d-sm-none"></i>
                                         <span class="d-none d-sm-block">Close</span>
                                     </button>
                                     <input type="submit" name="add" class="btn btn-primary ml-1" value="Submit">
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>

             </div>
         </div>
     </div>
 </section>
 <script type="text/javascript">
     $(document).ready(function() {

         $('#fakultas').change(function() {
             var id = $(this).val();
             $.ajax({
                 url: "<?= site_url('master_data/dosen/getprodi') ?>",
                 method: "POST",
                 data: {
                     id: id
                 },
                 async: true,
                 dataType: 'json',
                 success: function(data) {

                     var html = '';
                     var i;
                     html += '<option value="" selected>--- Pilih Prodi ---</option>';
                     for (i = 0; i < data.length; i++) {
                         html += '<option value=' + data[i].kd_prodi + '>' + data[i].nama_prodi + '</option>';
                     }
                     $('#prodi').html(html);

                 }
             });
             return false;
         });

     });
 </script>