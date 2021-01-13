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
             <a class="btn btn-primary" data-toggle="modal" data-target="#modal_tambah">
                 TAMBAH
             </a>
             <br>
             <br>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>Kode Pelatihan</th>
                         <th>Tanggal Ujian</th>
                         <th>Nama Pelatihan</th>
                         <th>Nama Matkul</th>
                         <th>Nama Kelas</th>
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
                             <td><?= $d->kd_pelatihan ?></td>
                             <td><?= indo_date($d->tanggal_pelatihan) . ' || ' . date('H:i', strtotime($d->tanggal_pelatihan)); ?></td>
                             <td><?= $d->nama_pelatihan ?></td>
                             <td><?= $d->nama_matkul ?></td>
                             <td align="center"><?= $d->nama_kelas . '<br>Semester' . $d->semester; ?></td>
                             <td> <?php if ($d->status == 1) {
                                        echo '<a class="badge bg-success">Aktif</a>';
                                    } elseif ($d->status == 0) {
                                        echo '<a class="badge bg-success">Tidak Aktif</a>';
                                    } elseif ($d->status == 2) {
                                        echo '<a class="badge bg-success">Sudah Berakhir</a>';
                                    } ?></td>
                             <td><a class="badge bg-success" href="<?= site_url('menu_dosen/pelatihan/edit/' . $d->kd_pelatihan) ?>"><i data-feather="edit" width="20"></i>Edit</a>
                                 <a href="<?= site_url('menu_dosen/pelatihan/del/' . $d->kd_pelatihan) ?>" class="badge bg-danger tombol-delete"> <i data-feather="trash" width="20"></i> Delete</a>
                                 <?php if ($d->status == 1) { ?>
                                     <a class="badge bg-success" href="<?= site_url('menu_dosen/pelatihan/masuk_pelatihan/' . $d->kd_pelatihan) ?>"><i data-feather="log-in" width="20"></i>Masuk Pelatihan</a>
                                 <?php } ?>
                         </tr>
                     <?php } ?>
                 </tbody>

             </table>

         </div>
     </div>
     <!-- Vertically Centered modal Modal -->
     <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <h5 class="modal-title white" id="myModalLabel160">Tambah Pelatihan</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form class="form form-vertical" action="<?= site_url('menu_dosen/pelatihan/process') ?>" method="POST" enctype="multipart/form-data">
                         <div class="form-body">
                             <div class="row">
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Kode Pelatihan</label>
                                         <input type="text" class="form-control" readonly="" required="" value="<?= $kd_auto ?>" name="kd_pelatihan" autocomplete="off">
                                     </div>
                                 </div>

                                 <div id="program">
                                     <div class="col-12">
                                         <div class="form-group">
                                             <label>Nama Pelatihan</label>
                                             <input type="text" class="form-control" name="nama_pelatihan" autocomplete="off" required>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Mata Kuliah</label>
                                         <select class="choices form-control" name="kd_matkul" id="kd_matkul" required="">
                                             <option selected="" value="">--- Pilih Mata Kuliah ---</option>
                                             <?php foreach ($kd_matkul as $row2) : ?>
                                                 <option value="<?php echo $row2->kd_matkul; ?>"><?php echo $row2->nama_matkul; ?> (<?php echo $row2->nama_kelas; ?>)/ Semester <?= $row2->semester; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div id="isi">
                                     <div class="col-12">
                                         <div class="form-group">
                                             <label>Dosen</label>
                                             <input type="text" class="form-control" value="" name="dosen" autocomplete="off" required readonly>
                                             <input type="hidden" class="form-control" value="" name="nip_dosen" autocomplete="off" required readonly>
                                         </div>
                                     </div>
                                     <div class="col-12">
                                         <div class="form-group">
                                             <label>Kelas</label>
                                             <input type="text" class="form-control" value="" required autocomplete="off" readonly>
                                             <input type="hidden" class="form-control" value="" name="kelas" autocomplete="off" required readonly>
                                         </div>
                                     </div>
                                     <div class="col-12">
                                         <div class="form-group">
                                             <label>Semester</label>
                                             <input type="text" class="form-control" value="" name="semester" required autocomplete="off" readonly>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label for="">Tanggal Pelatihan</label>
                                     <input type="datetime-local" class="form-control" name="tanggal_pelatihan" placeholder="Masukkan Tanggal Pelatihan" required>
                                 </div>
                                 <!-- <div class="form-group">
                                     <label>Status</label>
                                     <select class="choices form-control" name="status" required="">
                                         <option selected="" value="">--- Pilih Status ---</option>
                                         <option value="0">Tidak Diaktifkan</option>
                                         <option value="1">Sudah Diaktifkan</option>
                                         <option value="2">Sudah Berakhir</option>
                                     </select>
                                 </div> -->
                                 <div class="col-12">
                                     <div class="form-group">
                                         <label>Upload Soal Pemrograman <div style="color: red; display: inline;">*Maksimal 2mb</div></label>
                                         <input type="file" class="form-control" name="soal" accept=".doc, .docx, .pdf, .zip" size="20">
                                     </div>
                                 </div>
                                 <div class="modal-footer">
                                     <center><input type="submit" name="add" class="btn btn-primary ml-1" value="Tambah"></center>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>

             </div>
         </div>
     </div>
 </section>
 <script>
     $('#kd_matkul').change(function() {
         var kd_matkul = $(this).val();

         $.ajax({
             url: "<?= site_url('menu_dosen/paket_soal/getmatkul') ?>",
             method: "POST",
             data: {
                 kd_matkul: kd_matkul
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
                 html += '<input type="hidden" class="form-control" name="nip_dosen" value="' + data.nip_dosen + '" autocomplete="off">';
                 html += ' </div></div>';
                 html += '<div class="col-12">';
                 html += '<div class="form-group">'
                 html += '<label>Kelas</label>';
                 html += '<input type="text" class="form-control"  value="' + data.nama_kelas + '" autocomplete="off" required readonly>';
                 html += '<input type="hidden" class="form-control" name="kelas" value="' + data.kelas + '" autocomplete="off"readonly>';
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
 </script>