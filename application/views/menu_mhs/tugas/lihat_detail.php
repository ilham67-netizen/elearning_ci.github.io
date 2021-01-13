 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Lihat Detail Tugas</h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Tugas</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Lihat Detail Tugas</li>
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
                     <?php foreach ($tugas as $data) : ?>
                         <tr>
                             <th>KODE TUGAS</th>
                             <th>:</th>
                             <td><?= $data->kd_tugas ?></td>
                         </tr>
                         <tr>
                             <th>JUDUL TUGAS</th>
                             <th>:</th>
                             <td><?= $data->judul_tugas ?></td>
                         </tr>
                         <tr>
                             <th>TANGGAL UPLOAD</th>
                             <th>:</th>
                             <td><?= indo_date($data->tanggal_uplod) . ' JAM ' . date('H:i', strtotime($data->tanggal_uplod)) ?></td>
                         </tr>
                         <tr>
                             <th>BATAS WAKTU</th>
                             <th>:</th>
                             <td><?= indo_date($data->batas_waktu) . ' JAM ' . date('H:i', strtotime($data->batas_waktu)) ?></td>
                         </tr>
                         <tr>
                             <th>MATAKULIAH</th>
                             <th>:</th>
                             <td><?= $data->nama_matkul ?></td>
                         </tr>
                         <tr>
                             <th>NAMA DOSEN</th>
                             <th>:</th>
                             <td><?= $data->nama_dosen ?></td>
                         </tr>
                         <tr>
                             <th>FILE TUGAS</th>
                             <th>:</th>
                             <td><a href="<?= site_url("menu_mhs/tugas/download_tugas/" . $data->kd_tugas); ?>" class="btn btn-outline-success"><span data-feather="download"></span> Download</a></td>
                         </tr>
                         <tr>
                             <th>FILE TUGAS YANG DIKUMPULKAN</th>
                             <th>:</th>
                             <?php
                                foreach ($data->sub as $key) {
                                    if ($key->status > 0) { ?>
                                     <td><a href="<?= site_url("menu_mhs/tugas/download_kumpul/" . $data->kd_tugas); ?>" class="btn btn-outline-primary"><span data-feather="download"></span> Download</a></td>
                                 <?php } else { ?>
                                     <td><a href="#" class="btn btn-danger">Belum Mengumpulkan</a></td>
                             <?php }
                                } ?>
                         </tr>
                         <tr>
                             <th>NILAI TUGAS</th>
                             <th>:</th>
                             <td><?php
                                    if ($hitung > 0) {
                                        if ($nilai->nilai != NULL || $nilai->nilai != '') {
                                            echo '<b>' . $nilai->nilai . '</b>';
                                        } else {
                                            echo '<b>Belum Dinilai</b>';
                                        }
                                    } else {
                                        echo '<b>Belum Dinilai</b>';
                                    } ?>

                             </td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </div>
 </section>