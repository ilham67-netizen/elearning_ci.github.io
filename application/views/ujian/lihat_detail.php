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
                     <?php if ($this->uri->segment(3) == 1) { ?>
                         <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_essay/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                     <?php } elseif ($this->uri->segment(3) == 2) {
                        ?>
                         <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_pilgan/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                     <?php
                        } elseif ($this->uri->segment(3) == 3) {
                        ?>
                         <li class="breadcrumb-item"><a href="<?= site_url('ujian/lihat_pemrograman/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) ?>">Menu Ujian <?= jenis_soal($this->uri->segment(3)) ?></a></li>
                     <?php
                        } ?>
                     <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
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
                         <th>KODE PENGAWAS</th>
                         <th>:</th>
                         <td><?= $row->kd_pengawas ?></td>
                     </tr>
                     <tr>
                         <th>NAMA UJIAN</th>
                         <th>:</th>
                         <td><?= $row->nama_ujian ?></td>
                     </tr>
                     <tr>
                         <th>NAMA MATKUL</th>
                         <th>:</th>
                         <td><?= $row->nama_matkul ?></td>
                     </tr>
                     <tr>
                         <th>NAMA KELAS</th>
                         <th>:</th>
                         <td><?= $row->nama_kelas ?></td>
                     </tr>
                     <tr>
                         <th>SEMESTER</th>
                         <th>:</th>
                         <td><?= $row->semester ?></td>
                     </tr>
                     <tr>
                         <th>NAMA PENGAWAS</th>
                         <th>:</th>
                         <td><?= $row->nama_pengawas ?></td>
                     </tr>
                     <tr>
                         <th>JENIS SOAL</th>
                         <th>:</th>
                         <td><?= jenis_soal($row->jenis_soal) ?></td>
                     </tr>
                     <tr>
                         <th>TANGGAL UJIAN</th>
                         <th>:</th>
                         <td><?= indo_date($row->tanggal_ujian) . ' || ' . date('H:i', strtotime($row->tanggal_ujian)) ?></td>
                     </tr>
                     <tr>
                         <th>BATAS KETERLAMBATAN</th>
                         <th>:</th>
                         <td><?= $row->batas_telat ?> Menit</td>
                     </tr>

                 </tbody>
             </table>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>

                         <th>NIM</th>
                         <th>Nama Mahasiswa</th>
                         <th>Nilai</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody id="show_data">

                 </tbody>
             </table>
         </div>
     </div>
     <!-- Vertically Centered modal Modal -->
     <div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <h5 class="modal-title white" id="myModalLabel160">Penilaian Ujian</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">
                     <form action="">
                         <div class="form-group">
                             <label for="">NIM</label>
                             <input type="text" class="form-control" name="nim" value="" readonly>
                         </div>
                         <div class="form-group">
                             <label for="">Kode Pengawas</label>
                             <input type="text" class="form-control" name="kd_pengawas" value="" readonly>
                         </div>
                         <div class="form-group">
                             <label for="">Nama Mahasiswa</label>
                             <input type="text" class="form-control" name="nama_mhs" value="" readonly>
                         </div>
                         <div class="form-group">
                             <label for="">Nilai</label>
                             <input type="number" class="form-control" name="nilai" placeholder="Masukkkan Nilai Tugas" required>
                             <input type="hidden" name="kd_paket">
                             <input type="hidden" name="jenis">
                         </div>
                         <div class="modal-footer">
                             <a class="btn btn-" class="btn btn-default" data-dismiss="modal">Tutup</a>
                             <a class="btn btn-primary" id="btn_update">Ubah Nilai</a>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <script>
     $(document).ready(function() {
         tampil_ujian();

         function tampil_ujian() {
             $.ajax({
                 type: 'GET',
                 url: '<?= site_url('ujian/jajal/' . $this->uri->segment(5)); ?>',
                 async: true,
                 dataType: 'json',
                 success: function(data) {
                     var html = '';
                     var i;
                     var i2;
                     for (i = 0; i < data.length; i++) {
                         if (data[i].penilaian.length > 0) {
                             html += '<tr>' +
                                 //  '<td>' + [i]++ + '</td>' +
                                 '<td>' + data[i].nim + '</td>' +
                                 '<td>' + data[i].nama_mhs + '</td>'
                             for (i2 = 0; i2 < data[i].penilaian.length; i2++) {
                                 if (data[i2].penilaian[i2].nilai !== null) {
                                     html += '<td><center>' + data[i].penilaian[i2].nilai + '</center></td>'
                                 } else {
                                     html += '<td><center><b>Belum Dinilai</b><br><a class="btn btn-primary item_edit" data-id="' + data[i].penilaian[i2].id_nilai + '" data-jenis="' + data[i].jenis + '">Beri Nilai</a></center></td>'
                                 }
                             }
                             for (i2 = 0; i2 < data[i].penilaian.length; i2++) {
                                 if (data[i].jenis == 3) {
                                     html += '<td>' +
                                         '<a href="<?= site_url('ujian/lihat_koding/' . $this->uri->segment(3) . '/' . $this->uri->segment(4) . '/') ?>' + data[i].penilaian[i2].kd_pengawas + '/' + data[i].nim + '/' + data[i].penilaian[i2].id_nilai + '" class="badge bg-success"><span data-feather="eye"></span> Lihat Jawaban</a>'
                                 } else {
                                     html += '<td>' +
                                         '<a href="<?= site_url('ujian/lihat_jawaban/' . $this->uri->segment(3) . '/' . $this->uri->segment(4)) . '/' ?>' + data[i].penilaian[i2].kd_pengawas + '/' + data[i].nim + '" class="badge bg-success"><span data-feather="eye"></span> Lihat Jawaban</a>'
                                 }
                                 if (data[i].penilaian[i2].nilai !== null) {
                                     html += '<a href="#" class="badge bg-primary item_editor" data-id="' + data[i].penilaian[i2].id_nilai + '" data-jenis="' + data[i].jenis + '">Edit</a>'
                                 }
                             }
                             html += '</td>' +
                                 '</tr>';
                         }
                     }
                     $('#show_data').html(html);
                 }

             });
         }
         //GET UPDATE
         $('#show_data').on('click', '.item_edit', function() {
             var id = $(this).attr('data-id');
             var jenis = $(this).attr('data-jenis');
             $.ajax({
                 type: "GET",
                 url: "<?= site_url('ujian/jajal2') ?>",
                 dataType: "JSON",
                 data: {
                     id: id,
                     jenis: jenis
                 },
                 success: function(data) {
                     $.each(data.nilai, function(nim, kd_pengawas) {
                         $('#modal_detail').modal('show');
                         $('[name="nim"]').val(data.nilai.nim);
                         $.each(data.mahasiswa, function(nama_mhs) {
                             $('[name="nama_mhs"]').val(data.mahasiswa.nama_mhs);
                         });
                         $('[name="kd_pengawas"]').val(data.nilai.kd_pengawas);
                         $('[name="kd_paket"]').val(data.nilai.kd_paket);
                         $('[name="jenis"]').val(jenis);
                     });
                 }
             });
             return false;
         });
         //GET UPDATE
         $('#show_data').on('click', '.item_editor', function() {
             var id = $(this).attr('data-id');
             var jenis = $(this).attr('data-jenis');
             $.ajax({
                 type: "GET",
                 url: "<?= site_url('ujian/jajal2') ?>",
                 dataType: "JSON",
                 data: {
                     id: id,
                     jenis: jenis
                 },
                 success: function(data) {
                     $.each(data.nilai, function(nim, kd_pengawas, nilai) {
                         $('#modal_detail').modal('show');
                         $('[name="nim"]').val(data.nilai.nim);
                         $.each(data.mahasiswa, function(nama_mhs) {
                             $('[name="nama_mhs"]').val(data.mahasiswa.nama_mhs);
                         });
                         $('[name="kd_pengawas"]').val(data.nilai.kd_pengawas);
                         $('[name="nilai"]').val(data.nilai.nilai);
                         $('[name="kd_paket"]').val(data.nilai.kd_paket);
                         $('[name="jenis"]').val(jenis);

                     });
                 }
             });
             return false;
         });
         //Update Barang
         $('#btn_update').on('click', function() {
             var nim = $('[name="nim"]').val();
             var nama = $('[name="nama_mhs"]').val();
             var nilai = $('[name="nilai"]').val();
             var kd_pengawas = $('[name="kd_pengawas"]').val();
             var kd_paket = $('[name="kd_paket"]').val();
             var jenis = $('[name="jenis"]').val();
             $.ajax({
                 type: "POST",
                 url: "<?= site_url('ujian/add_nilai_ujian') ?>",
                 dataType: "JSON",
                 data: {
                     nim: nim,
                     nama: nama,
                     nilai: nilai,
                     kd_pengawas: kd_pengawas,
                     kd_paket: kd_paket,
                     jenis: jenis
                 },
                 success: function(data) {
                     $('[name="nim"]').val("");
                     $('[name="nama_mhs"]').val("");
                     $('[name="nilai"]').val("");
                     $('[name="kd_pengawas"]').val("");
                     $('[name="kd_paket"]').val("");
                     $('[name="jenis"]').val("");
                     $('#modal_detail').modal('hide');
                     tampil_ujian();
                     Swal.fire({
                         title: data.hasil,
                         text: 'Klik OK',
                         icon: data.icon
                     });
                 },
                 error: function(data) {
                     $('[name="nim"]').val("");
                     $('[name="nama_mhs"]').val("");
                     $('[name="nilai"]').val("");
                     $('[name="kd_pengawas"]').val("");
                     $('[name="kd_paket"]').val("");
                     $('[name="jenis"]').val("");
                     $('#modal_detail').modal('hide');
                     tampil_ujian();
                     Swal.fire({
                         title: data.hasil,
                         text: 'Klik OK',
                         icon: data.icon
                     });
                 }
             });
             return false;
         });
     });
 </script>