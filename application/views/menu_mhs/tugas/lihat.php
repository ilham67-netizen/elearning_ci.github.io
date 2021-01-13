 <?php date_default_timezone_set('Asia/Jakarta'); ?>
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
             <h2>Daftar Tugas Yang Harus Dikumpulkan</h2><br>
             <div class="row">
                 <?php
                    if ($cek > 0) {
                        foreach ($tugas as $row) :
                            $jam = timediff($row->jam_tersisa);
                            $menit = timediff2($row->jam_tersisa);


                    ?>
                         <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                             <h3><u><?= $row->judul_tugas; ?></u></h3>
                             <h5>Mata Kuliah : <?= $row->nama_matkul; ?></h5>
                             <h5>Tanggal Upload : <?= indo_date($row->tanggal_uplod); ?></h5>
                             <h5>Batas Waktu : <?= date('d/m/Y H:i', strtotime($row->batas_waktu)) ?></h5>
                             <h5>Kelas : <?= $row->nama_kelas ?></h5>
                             <!-- <h5>Status : </h5> -->
                             <?php
                                foreach ($row->sub as $key) {
                                    if ($jam < 0 || $menit < 0) {
                                        echo "<h5>Status: Waktu Habis</h5>";
                                        if ($key->status > 0) {
                                            if ($jam < 0 || $menit < 0) {
                                                echo ' <a href="#" class="btn btn-success">Sudah Dikumpulkan</a>';
                                            } else {
                                                echo ' <a href="#" class="btn btn-success">Sudah Dikumpulkan</a>||<a href="' . site_url("menu_mhs/tugas/tugas_edit/" . $row->kd_tugas) . '" class="btn btn-primary">Edit Tugas</a><br><br>';
                                            }
                                        } else {
                                            echo ' <a href="#" class="btn btn-danger">Belum Dikumpulkan</a>';
                                        }
                                    } else {

                                        if ($key->status > 0) {
                                            echo ' <a href="#" class="btn btn-success">Sudah Dikumpulkan</a>||<a href="' . site_url("menu_mhs/tugas/tugas_edit/" . $row->kd_tugas) . '" class="btn btn-primary">Edit Tugas</a><br><br>';
                                        } else {
                                            echo ' <a href="' . site_url("menu_mhs/tugas/tugas_kumpul/" . $row->kd_tugas) . '" class="btn btn-primary">Kumpulkan</a>';
                                        }
                                    }
                                }
                                //  if ($selisih <= 0) { 
                                ?>
                             <a href="<?= site_url("menu_mhs/tugas/download_tugas/" . $row->kd_tugas); ?>" class="btn icon btn-outline-success"><span data-feather="download"></span>DOWNLOAD</a>
                         </div>
                 <?php

                        endforeach;
                    } else {
                        echo "<h2>Tidak Ada Tugas</h2>";
                    } ?>
             </div>
         </div>
     </div>
     <div class="card">
         <div class="card-body">
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
                             <th>Status</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($row2 as $d) {
                            ?>
                             <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= $d->judul_tugas ?></td>
                                 <td align="center"><?= indo_date($d->tanggal_uplod) ?></td>
                                 <td><?= $d->nama_matkul ?></td>
                                 <td><?= $d->nama_dosen ?></td>
                                 <td align="center"><?= indo_date($d->batas_waktu) . '<br>Jam ' . date('H:i', strtotime($d->batas_waktu)) ?></td>
                                 <?php
                                    foreach ($d->sub as $key) {
                                        if ($key->status > 0) {
                                            echo "<td>Sudah Mengumpulkan</td>";
                                        } else {
                                            echo "<td>Belum Mengumpulkan</td>";
                                        }
                                    } ?>
                                 <td>
                                     <a class="badge bg-primary" href="<?= site_url('menu_mhs/tugas/lihat_detail/' . $d->kd_tugas) ?>"><i data-feather="eye" width="20"></i>Lihat Tugas</a>
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>
     <script type="text/javascript">
         $(document).ready(function() {

             $('#kd_matkul').change(function() {
                 var id = $(this).val();

                 $.ajax({
                     url: "<?= site_url('menu_dosen/jadwal/getmatkul') ?>",
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
         });
     </script>