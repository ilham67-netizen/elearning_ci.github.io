     <div class="page-title">
         <h3><?= $title; ?></h3>
         <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
     </div>
     <section class="section">
         <div class="card">
             <div class="card-header">
                 <center>
                     <h3>INFORMASI UJIAN</h3>
                 </center>
             </div>
             <div class="card-body">
                 <div class="table-responsive">
                     <table class="table table-hover">
                         <tbody>
                             <tr>
                                 <th>KODE PENGAWAS</th>
                                 <th>:</th>
                                 <td><?= $row->kd_pengawas ?></td>
                             </tr>
                             <tr>
                                 <th>KODE PAKET</th>
                                 <th>:</th>
                                 <td><?= $row->kd_paket ?></td>
                             </tr>
                             <tr>
                                 <th>NAMA PENGAWAS</th>
                                 <th>:</th>
                                 <td><?= $row->nama_pengawas ?></td>
                             </tr>
                             <tr>
                                 <th>NAMA UJIAN</th>
                                 <th>:</th>
                                 <td><?= $row->nama_ujian ?></td>
                             </tr>
                             <tr>
                                 <th>NAMA MATA KULIAH</th>
                                 <th>:</th>
                                 <td><?= $row->nama_matkul ?></td>
                             </tr>
                             <tr>
                                 <th>KELAS</th>
                                 <th>:</th>
                                 <td><?= $row->nama_kelas ?></td>
                             </tr>
                             <tr>
                                 <th>SEMESTER</th>
                                 <th>:</th>
                                 <td><?= $row->semester ?></td>
                             </tr>
                             <tr>
                                 <th>JENIS UJIAN</th>
                                 <th>:</th>
                                 <td><?= jenis_soal($row->jenis_soal) ?></td>
                             </tr>
                             <tr>
                                 <th>TANGGAL UJIAN</th>
                                 <th>:</th>
                                 <td><?= indo_date(date('Y-m-d', strtotime($row->tanggal_ujian))) . ' || ' . date('H:i', strtotime($row->tanggal_ujian)) ?></td>
                             </tr>
                             <tr>
                                 <th>DURASI</th>
                                 <th>:</th>
                                 <td><?= $row->waktu_soal ?> Menit</td>
                             </tr>
                             <tr>
                                 <th>BATAS KETERLAMBATAN</th>
                                 <th>:</th>
                                 <td><?= $row->batas_telat ?> Menit</td>
                             </tr>
                             <tr>
                                 <td colspan="3" align="center">
                                     <a href="<?= site_url("menu_pengawas/dashboard/lihat_soal/" . $row->kd_paket); ?>" class="btn btn-outline-primary"><span data-feather="eye"></span> Lihat Soal</a>
                                     <a href="<?= site_url("menu_pengawas/dashboard/lihat_absen/" . $row->kd_pengawas); ?>" class="btn btn-outline-primary ml-3"><span data-feather="eye"></span> Lihat Absensi</a>
                                     <a href="<?= site_url("menu_pengawas/dashboard/lihat_hasil/" . $row->kd_pengawas); ?>" class="btn btn-outline-primary ml-3"><span data-feather="eye"></span> Lihat Hasil</a>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </section>