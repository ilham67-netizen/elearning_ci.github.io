 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Kartu Rencana Studi</h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1)) ?>">Pilih Fakultas</a></li>
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(4)) ?>">Pilih Mahasiswa</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Lihat KRS</li>
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
             <table class="table table-hover">
                 <tbody>
                     <tr>
                         <th>NIM</th>
                         <th>:</th>
                         <td><?= $mhs->nim ?></td>
                     </tr>
                     <tr>
                         <th>NAMA</th>
                         <th>:</th>
                         <td><?= $mhs->nama_mhs ?></td>
                     </tr>
                     <tr>
                         <th>FAKULTAS</th>
                         <th>:</th>
                         <td><?= $mhs->nama_fakultas ?></td>
                     </tr>
                     <tr>
                         <th>PRODI</th>
                         <th>:</th>
                         <td><?= $mhs->nama_prodi ?></td>
                     </tr>
                     <tr>
                         <th>DOSEN PEMBIMBING AKADEMIK</th>
                         <th>:</th>
                         <td><?= $mhs->nama_dosen ?></td>
                     </tr>
                 </tbody>
             </table>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Mata Kuliah</th>
                         <th>Kelas</th>
                         <th>Dosen</th>
                         <th>Semester</th>
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
                             <td><?= $d->nama_matkul ?></td>
                             <td><?= $d->nama_kelas ?></td>
                             <td><?= $d->nama_dosen ?></td>
                             <td><?= $d->semester ?></td>
                             <td><a class="badge bg-danger tombol-delete" href="<?= site_url('krs/del/' . $d->nim . '/' . $d->id_krs) ?>"><i data-feather="trash" width="20"></i>Delete</a>
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
                     <h5 class="modal-title white" id="myModalLabel160">Tambah KRS</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form class="form form-vertical" action="<?= site_url('krs/process/' . $this->uri->segment(3)) ?>" method="POST">
                         <div class="form-body">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>NIM</label>
                                         <input type="number" class="form-control" name="nim" value="<?= $this->uri->segment(3) ?>" placeholder="Masukkan NIM" autocomplete="off" readonly required>
                                     </div>


                                     <div class="col-12">
                                         <div class="form-group">
                                             <label>Mata Kuliah</label>
                                             <select class="choices form-control" name="kd_matkul" id="kd_matkul" required>
                                                 <option value="">--- Pilih Matkul --</option>
                                                 <?php foreach ($matkul as $row) : ?>
                                                     <option value="<?php echo $row->kd_matkul; ?>"><?php echo $row->nama_matkul; ?></option>
                                                 <?php endforeach; ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div id="isi">
                                         <div class="col-12">
                                             <div class="form-group">
                                                 <label>Dosen</label>
                                                 <input type="text" class="form-control" name="dosen" autocomplete="off" required readonly>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group">
                                                 <label>Kelas</label>
                                                 <input type="text" class="form-control" name="kelas" required autocomplete="off" readonly>
                                             </div>
                                         </div>
                                         <div class="col-12">
                                             <div class="form-group">
                                                 <label>Semester</label>
                                                 <input type="text" class="form-control" name="semester" required autocomplete="off" readonly>
                                             </div>
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

         $('#kd_matkul').change(function() {
             var id = $(this).val();

             $.ajax({
                 url: "<?= site_url('krs/getmatkul') ?>",
                 method: "POST",
                 data: {
                     id: id
                 },
                 async: true,
                 dataType: 'json',
                 success: function(data) {

                     var html = '';
                     var i;

                     html += '<div class="col-12">';
                     html += '<div class="form-group">'
                     html += '<label>Dosen</label>';
                     html += '<input type="text" class="form-control" name="dosen" value="' + data.nama_dosen + '" autocomplete="off" required readonly>';
                     html += ' </div></div>';
                     html += '<div class="col-12">';
                     html += '<div class="form-group">'
                     html += '<label>Kelas</label>';
                     html += '<input type="text" class="form-control" name="kelas" value="' + data.nama_kelas + '" autocomplete="off" required readonly>';
                     html += ' </div></div>';
                     html += '<div class="col-12">';
                     html += '<div class="form-group">'
                     html += '<label>Semester</label>';
                     html += '<input type="text" class="form-control" name="semester" value="' + data.semester + '" autocomplete="off" required readonly>';
                     html += ' </div></div>';

                     $('#isi').html(html);

                 }
             });
             return false;
         });


     });
 </script>