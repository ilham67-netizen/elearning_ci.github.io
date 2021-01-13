 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Lihat Absensi Perkuliahan</h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="<?= site_url("menu_dosen/jadwal/" . $this->uri->segment(2)) ?>">Menu Jadwal</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Lihat Absensi</li>
                 </ol>
             </nav>
         </div>
     </div>
 </div>
 <section class="section">
     <div class="card">
         <div class="card-body">
             <table class="table table-hover">
                 <tbody>
                     <tr>
                         <th>KODE JADWAL</th>
                         <th>:</th>
                         <td><?= $jadwal->kd_jadwal ?></td>
                     </tr>
                     <tr>
                         <th>NAMA KULIAH</th>
                         <th>:</th>
                         <td><?= $jadwal->nama_kuliah ?></td>
                     </tr>
                     <tr>
                         <th>MATAKULIAH</th>
                         <th>:</th>
                         <td><?= $jadwal->nama_matkul ?></td>
                     </tr>
                     <tr>
                         <th>NAMA DOSEN</th>
                         <th>:</th>
                         <td><?= $jadwal->nama_dosen ?></td>
                     </tr>
                     <tr>
                         <th>WAKTU MULAI</th>
                         <th>:</th>
                         <td><?= indo_date(date('Y-m-d', strtotime($jadwal->waktu_mulai))) . ' || ' . date('H:i', strtotime($jadwal->waktu_mulai)) ?></td>
                     </tr>
                     <tr>
                         <th>WAKTU AKHIR</th>
                         <th>:</th>
                         <td><?php
                                if ($jadwal->waktu_akhir != '') {
                                    echo indo_date(date('Y-m-d', strtotime($jadwal->waktu_akhir))) . ' || ' . date('H:i', strtotime($jadwal->waktu_akhir));
                                } else {
                                    echo 'Belum Ditentukan';
                                }
                                ?></td>
                     </tr>
                     <tr>
                         <th>FILE MATERI</th>
                         <th>:</th>
                         <td>
                             <a href="<?= site_url("menu_dosen/kuliah/download_materi/" . $jadwal->kd_jadwal); ?>" class="btn btn-outline-success"><span data-feather="download"></span> Download</a>
                         </td>
                     </tr>
                 </tbody>
             </table>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>NIM</th>
                         <th>Nama Mahasiswa</th>
                         <th>Waktu Absen</th>
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
                             <td><?= $d->waktu_absen ?></td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </section>