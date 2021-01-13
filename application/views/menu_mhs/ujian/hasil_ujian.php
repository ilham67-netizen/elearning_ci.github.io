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

             <div class="table-responsive">
                 <table class='table table-striped' id="dataTable">
                     <thead>
                         <tr>

                             <th>Nama Ujian</th>
                             <th>Tanggal Ujian</th>
                             <th>Nama Matkul</th>
                             <th>Kelas</th>
                             <th>Jenis Soal</th>
                             <th>Waktu</th>
                             <th>Nilai</th>
                             <!-- <th>Aksi</th> -->
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($row as $d) {
                            ?>
                             <tr>
                                 <td><?= $d->nama_ujian ?></td>
                                 <td><?= indo_date($d->tanggal_ujian) . ' || ' . date('H:i', strtotime($d->tanggal_ujian)) ?></td>
                                 <td><?= $d->nama_matkul ?></td>
                                 <td align="center"><?= $d->nama_kelas ?><br>Semester <?= $d->semester; ?></td>
                                 <td><?= jenis_soal($d->jenis_soal) ?></td>
                                 <td><?= $d->waktu_soal ?> menit</td>
                                 <?php foreach ($d->nilai as $data) :
                                        if ($data->nilai == null) {
                                            echo '<td align="center">Belum Dinilai</td>';
                                        } else {
                                            echo '<td align="center"><h5>' . $data->nilai . '</h5></td>';
                                        } ?>

                                 <?php endforeach; ?>
                                 <!-- <td><a href="" class="badge bg-primary"><span data-feather="eye"></span>Lihat Detail</a></td> -->
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>

 </section>