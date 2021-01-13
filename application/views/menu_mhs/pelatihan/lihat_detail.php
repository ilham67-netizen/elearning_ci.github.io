 <div class="page-title">
     <div class="row">
         <div class="col-12 col-md-6 order-md-1 order-last">
             <h3>Lihat Detail Pelatihan</h3>
             <br>
         </div>
         <div class="col-12 col-md-6 order-md-2 order-first">
             <nav aria-label="breadcrumb" class='breadcrumb-header'>
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(0)) ?>">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/' . $this->uri->segment(2)) ?>">Menu Pelatihan</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Lihat Detail Pelatihan</li>
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
                     <?php foreach ($row as $data) : ?>
                         <tr>
                             <th>KODE PELATIHAN</th>
                             <th>:</th>
                             <td><?= $data->kd_pelatihan ?></td>
                         </tr>
                         <tr>
                             <th>NAMA PELATIHAN</th>
                             <th>:</th>
                             <td><?= $data->nama_pelatihan ?></td>
                         </tr>
                         <tr>
                             <th>NAMA MATAKULIAH</th>
                             <th>:</th>
                             <td><?= $data->nama_matkul ?></td>
                         </tr>
                         <tr>
                             <th>TANGGAL PELATIHAN</th>
                             <th>:</th>
                             <td><?= indo_date($data->tanggal_pelatihan) . ' JAM ' . date('H:i', strtotime($data->tanggal_pelatihan)) ?></td>
                         </tr>
                         <tr>
                             <th>NAMA KELAS</th>
                             <th>:</th>
                             <td><?= $data->nama_kelas  ?></td>
                         </tr>
                         <tr>
                             <th>NAMA DOSEN</th>
                             <th>:</th>
                             <td><?= $data->nama_dosen ?></td>
                         </tr>
                         <tr>
                             <th>FILE PELATIHAN</th>
                             <th>:</th>
                             <td><a href="<?= site_url("menu_mhs/pelatihan/download_pelatihan/" . $data->kd_pelatihan); ?>" class="btn btn-outline-success"><span data-feather="download"></span> Download</a></td>
                         </tr>
                     <?php endforeach; ?>
                 </tbody>
             </table>
         </div>
     </div>
 </section>