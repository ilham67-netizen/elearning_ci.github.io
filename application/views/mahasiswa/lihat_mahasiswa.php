 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Mahasiswa <?= $prodi->nama_prodi ?></h3>
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
             <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
                 TAMBAH
             </button>
             <br>
             <br>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>NIM</th>
                         <th>Nama</th>
                         <th>No HP</th>
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
                             <td><?= $d->nim ?></td>
                             <td><?= $d->nama_mhs ?></td>
                             <td><?= $d->no_telp ?></td>
                             <td><a class="badge bg-success" href="<?= site_url('master_data/mahasiswa/edit/' . $this->uri->segment(4) . '/' . $d->nim) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                 <a href="<?= site_url('master_data/mahasiswa/del/' . $this->uri->segment(4) . '/' . $d->nim) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
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
                     <h5 class="modal-title white" id="myModalLabel160">Tambah Mahasiswa</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form class="form form-vertical" action="<?= site_url('master_data/mahasiswa/process/' . $this->uri->segment(4)) ?>" method="POST">
                         <div class="form-body">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>NIM</label>
                                         <input type="number" class="form-control" name="nim" placeholder="Masukkan NIM" autocomplete="off" required>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Nama Lengkap</label>
                                         <input type="text" class="form-control" name="nama_mhs" placeholder="Masukkan Nama Lengkap" onkeyup="this.value = this.value.toUpperCase()" autocomplete="off" required>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Nomor Telphone</label>
                                         <input type="number" class="form-control" name="no_telp" placeholder="Masukkan Nomor Telphone" autocomplete="off" required>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Tempat Lahir</label>
                                         <input type="text" class="form-control" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" autocomplete="off" required>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Tanggal Lahir</label>
                                         <input type="date" class="form-control" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir" autocomplete="off" required>
                                         <input type="hidden" value="<?= $prodi->fakultas ?>" name="kd_fakultas">
                                         <input type="hidden" value="<?= $prodi->kd_prodi ?>" name="kd_prodi">
                                     </div>
                                 </div>

                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Alamat Rumah</label>
                                         <textarea class="form-control" rows="3" name="alamat" required></textarea>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Dosen Pembimbing</label>
                                         <select class="choices form-control" name="dosbing_akad" id="dosbing_akad" required>
                                             <option value="">--- Pilih Dosbing --</option>
                                             <?php foreach ($dosen as $row) : ?>
                                                 <option value="<?php echo $row->nip_dosen; ?>"><?php echo $row->nama_dosen; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Email</label>
                                         <input type="email" class="form-control" name="email" placeholder="Masukkan Email" autocomplete="off" required>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Password</label>
                                         <input type="password" class="form-control" name="password" placeholder="Masukkan Password" autocomplete="off">
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
                     $('#prodi').remove();
                     html += '<label >Prodi</label>';
                     html += ' <select class="js-choice form-select" id="prodi3"  name="prodi" required="">'
                     html += '<option value="" selected>--- Pilih Prodi ---</option>';
                     for (i = 0; i < data.length; i++) {
                         html += '<option value=' + data[i].kd_prodi + '>' + data[i].nama_prodi + '</option>';
                     }
                     html += ' </select>';

                     $('#prodi2').html(html);
                     const choices = new Choices('.js-choice');

                 }
             });
             return false;
         });


     });
 </script>