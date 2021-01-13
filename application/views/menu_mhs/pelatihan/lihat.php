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
             <h2>Pelatihan Pada Hari Ini</h2><br>
             <div class="table-responsive">
                 <div class="row">
                     <?php foreach ($col as $d) :
                            $tgl = date('d/m/Y');
                            $jam = timediff($d->jam_tersisa);
                            $menit = timediff2($d->jam_tersisa);
                            if (indo_date($d->tanggal_pelatihan) == $tgl) {
                        ?>
                             <div class="col-md-3 border border-secondary border-1 rounded shadow p-3 mb-5 bg-grey rounded text-center ml-5">
                                 <h3><u><?= $d->nama_pelatihan; ?></u></h3>
                                 <h5>Matkul : <?= $d->nama_matkul; ?></h5>
                                 <h5>Tanggal : <?= indo_date($d->tanggal_pelatihan); ?></h5>
                                 <h5>Jam : <?= date('H:i', strtotime($d->tanggal_pelatihan)) ?></h5>
                                 <h5>Kelas : <?= $d->nama_kelas ?></h5>
                                 <h5>Status : <?php if ($d->status == 1) {
                                                    echo '<a class="badge bg-success">Aktif</a>';
                                                } elseif ($d->status == 0) {
                                                    echo '<a class="badge bg-danger">Tidak Aktif</a>';
                                                } elseif ($d->status == 2) {
                                                    echo '<a class="badge bg-primary">Sudah Berakhir</a>';
                                                } ?></h5>
                                 <h5> <?php
                                        if ($jam <= 0 || $menit <= 0) {
                                            if ($d->status == 1) {
                                                echo ' <a href="' . site_url('menu_mhs/pelatihan/masuk_pelatihan/' . $d->kd_pelatihan) . '" class="btn btn-success">Masuk Pelatihan</a>';
                                            } elseif ($d->status == 0) {
                                                echo '<a class="badge bg-danger">Belum Diaktifkan</a>';
                                            } elseif ($d->status == 2) {
                                                echo '<a class="badge bg-danger">Sudah Berakhir</a>';
                                            }
                                        } else {
                                            echo '<span href="#" class="btn btn-danger"><span data-feather="minus-circle"></span></span>';
                                        }
                                        ?></h5>
                             </div>
                     <?php }
                        endforeach; ?>
                 </div>
             </div>
         </div>
     </div>

     <div class="card">
         <div class="card-body">
             <h2>Daftar Pelatihan Yang Telah Diikuti</h2><br>
             <div class="table-responsive">
                 <table class='table table-striped' id="dataTable">
                     <thead>
                         <tr>
                             <th>No</th>
                             <th>Tanggal Pelatihan</th>
                             <th>Nama Pelatihan</th>
                             <th>Mata Kuliah</th>
                             <th>Nama Dosen</th>
                             <th>Nama Kelas</th>
                             <th>Status Pelatihan</th>
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
                                 <td><?= indo_date($d->tanggal_pelatihan) . ' || ' . date('H:i', strtotime($d->tanggal_pelatihan)); ?></td>
                                 <td><?= $d->nama_pelatihan ?></td>
                                 <td><?= $d->nama_matkul ?></td>
                                 <td><?= $d->nama_dosen ?></td>
                                 <td align="center"><?= $d->nama_kelas . '<br>Semester' . $d->semester; ?></td>
                                 <td> <?php if ($d->status == 1) {
                                            echo '<a class="badge bg-success">Aktif</a>';
                                        } elseif ($d->status == 0) {
                                            echo '<a class="badge bg-success">Tidak Aktif</a>';
                                        } elseif ($d->status == 2) {
                                            echo '<a class="badge bg-success">Sudah Berakhir</a>';
                                        } ?></td>
                                 <td><a class="badge bg-success" href="<?= site_url('menu_mhs/pelatihan/detail_pelatihan/' . $d->kd_pelatihan) ?>"><i data-feather="eye" width="20"></i>Lihat Pelatihan</a></td>
                             </tr>
                         <?php } ?>
                     </tbody>

                 </table>
             </div>
         </div>
     </div>

 </section>