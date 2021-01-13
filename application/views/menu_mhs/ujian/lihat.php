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
 <section class="section" style="margin-bottom: 0;">
     <div class="card">
         <div class="card-body">
             <h2>Ujian Pada Hari Ini</h2><br>
             <div class="table-responsive">
                 <div class="row">
                     <?php foreach ($col as $d) :
                            $tgl = date('d/m/Y');
                            $jam = timediff($d->jam_tersisa);
                            $menit = timediff2($d->jam_tersisa);
                            if (indo_date($d->tanggal_ujian) == $tgl) {
                        ?>
                             <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                                 <h3><u><?= $d->nama_ujian; ?></u></h3>
                                 <h5>Matkul : <?= $d->nama_matkul; ?></h5>
                                 <h5>Tanggal : <?= indo_date($d->tanggal_ujian); ?></h5>
                                 <h5>Jam : <?= date('H:i', strtotime($d->tanggal_ujian)) ?></h5>
                                 <h5>Kelas : <?= $d->nama_kelas ?></h5>
                                 <h5>Status : <?php if ($d->cek_nilai <= 0) {
                                                    echo '<span class="badge bg-danger">Belum Mengerjakan</span>';
                                                } else {
                                                    echo '<span class="badge bg-success">Sudah Mengerjakan</span>';
                                                } ?></h5>
                                 <h5><?php

                                        if ($d->status == 0) {
                                            echo 'Belum Diaktifkan';
                                        } else {
                                            if ($d->cek_nilai <= 0) {
                                                if ($jam > 0) {
                                                    echo '<span class="badge bg-primary">Belum Aktif</span>';
                                                } elseif ($jam < 0) {
                                                    echo '<a href="" class="btn btn-success">Terlambat</a>';
                                                } elseif ($jam <= 0) {
                                                    if ($menit < -$d->batas_telat) {
                                                        echo '<a href="" class="btn btn-success">Terlambat</a>';
                                                    } elseif ($menit > 0) {
                                                        echo '<span class="badge bg-primary">Belum Aktif</span>';
                                                    } else {
                                                        if ($d->jenis_soal == 1) {
                                                            echo '<a href="' . site_url('menu_mhs/ujian/sedang_ujian_essay/' . $d->kd_pengawas) . '" class="btn btn-outline-primary"><span data-feather="log-in"></span>Masuk Ujian</a></h5>';
                                                        } elseif ($d->jenis_soal == 2) {
                                                            echo '<a href="' . site_url('menu_mhs/ujian/sedang_ujian/' . $d->kd_pengawas) . '" class="btn btn-outline-primary"><span data-feather="log-in"></span>Masuk Ujian</a></h5>';
                                                        } elseif ($d->jenis_soal == 3) {
                                                            echo '<a href="' . site_url('menu_mhs/ujian/sedang_ujian_koding/' . $d->kd_pengawas) . '" class="btn btn-outline-primary"><span data-feather="log-in"></span>Masuk Ujian</a></h5>';
                                                        }
                                                    }
                                                }
                                                # code...
                                            }
                                        } ?>
                             </div>
                     <?php }
                        endforeach; ?>
                 </div>
             </div>
         </div>
     </div>
     <!-- <div class="card">
         <div class="card-body">
             <h2>Ujian Hari Yang Akan Datang</h2><br>
             <div class="row">
                 <?php foreach ($matkul3 as $row) :
                    ?>
                     <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                         <h3><u><?= $row->nama_matkul; ?></u></h3>
                         <h5>Tanggal : <?= indo_date($row->waktu_mulai); ?></h5>
                         <h5>Jam : <?= date('H:i', strtotime($row->waktu_mulai)) ?></h5>
                         <h5>Kelas : <?= $row->nama_kelas ?></h5>
                         <h5><?php if ($row->status == 1) {
                                    echo 'Belum Diaktifkan';
                                } else {
                                    echo '<a href="' . site_url('menu_mhs/kuliah/kuliah_daring/' . $row->kd_jadwal) . '" class="btn btn-outline-primary"><span data-feather="log-in"></span>Masuk Kuliah</a>';
                                } ?></h5>
                     </div>
                 <?php
                    endforeach; ?>
             </div>
         </div>
     </div> -->
     <div class="card">
         <div class="card-body">
             <h2>Daftar Ujian Yang Telah Diikuti</h2><br>
             <div class="table-responsive">
                 <table class='table table-striped' id="dataTable">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Nama Ujian</th>
                             <th>Mata Kuliah</th>
                             <th>Nama Dosen</th>
                             <th>Tanggal Ujian</th>
                             <th>Jenis Soal</th>
                             <th>Status Pengerjaan</th>
                             <th>Aksi</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            $no = 1;
                            foreach ($col as $d) {
                            ?>
                             <tr>
                                 <td><?= $no++ ?></td>
                                 <td><?= $d->nama_ujian ?></td>
                                 <td><?= $d->nama_matkul ?></td>
                                 <td><?= $d->nama_dosen ?></td>
                                 <td><?= indo_date(date('Y-m-d', strtotime($d->tanggal_ujian))) . ' || ' . date('H:i', strtotime($d->tanggal_ujian)) ?></td>
                                 <td><?= jenis_soal($d->jenis_soal); ?></td>
                                 <td><?php if ($d->cek_nilai <= 0) {
                                            echo '<span class="badge bg-danger">Belum Mengerjakan</span>';
                                        } else {
                                            echo '<span class="badge bg-success">Sudah Mengerjakan</span>';
                                        } ?></td>
                                 <td>
                                     <a class="badge bg-primary" href="<?= site_url('menu_mhs/ujian/lihat_absen/' . $this->uri->segment(3) . '/' . $d->kd_pengawas) ?>"><i data-feather="eye" width="20"></i>Lihat Absen</a>
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>

 </section>