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
                     <li class="breadcrumb-item"><a href="<?= site_url("menu_dosen/tugas/") ?>">Menu Tugas</a></li>
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
                     <tr>
                         <th>KODE TUGAS</th>
                         <th>:</th>
                         <td><?= $tugas->kd_tugas ?></td>
                     </tr>
                     <tr>
                         <th>JUDUL TUGAS</th>
                         <th>:</th>
                         <td><?= $tugas->judul_tugas ?></td>
                     </tr>
                     <tr>
                         <th>TANGGAL UPLOAD</th>
                         <th>:</th>
                         <td><?= $tugas->tanggal_uplod ?></td>
                     </tr>
                     <tr>
                         <th>MATAKULIAH</th>
                         <th>:</th>
                         <td><?= $tugas->nama_matkul ?></td>
                     </tr>
                     <tr>
                         <th>NAMA DOSEN</th>
                         <th>:</th>
                         <td><?= $tugas->nama_dosen ?></td>
                     </tr>
                     <tr>
                         <th>FILE TUGAS</th>
                         <th>:</th>
                         <td>
                             <div class="row">
                                 <?php foreach ($file as $data) :
                                    ?>

                                     <div class="col-1 ml-4">
                                         <center>
                                             <img src="<?= base_url('images/') . 'file.png' ?>" width="64" height="64">
                                             <label><?= $data->nama_file ?></label>
                                             <a href="<?= base_url('upload_tugas/') . $data->nama_file ?>" class="btn btn-sm btn-primary mt-2" data-token="<?= $data->token ?>">Download</a>
                                         </center>
                                     </div>

                                 <?php endforeach; ?>
                             </div>
                     </tr>
                 </tbody>
             </table>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>

                         <th>NIM</th>
                         <th>Nama Mahasiswa</th>
                         <th>Waktu Upload</th>
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
                     <h5 class="modal-title white" id="myModalLabel160">Penilaian Tugas</h5>
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
                             <label for="">Kode Tugas</label>
                             <input type="text" class="form-control" name="kd_tugas" value="" readonly>
                         </div>
                         <div class="form-group">
                             <label for="">Nama Mahasiswa</label>
                             <input type="text" class="form-control" name="nama_mhs" value="" readonly>
                         </div>
                         <div class="form-group">
                             <label for="">Nilai</label>
                             <input type="number" class="form-control" name="nilai" placeholder="Masukkkan Nilai Tugas">
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
         tampil_tugas();

         function tampil_tugas() {
             $.ajax({
                 type: 'GET',
                 url: '<?= base_url() ?>menu_dosen/tugas/get_tugas/<?= $this->uri->segment(4); ?>',
                 async: true,
                 dataType: 'json',
                 success: function(data) {
                     var html = '';
                     var i;
                     for (i = 0; i < data.length; i++) {
                         if (data[i].nilai.length > 0) {
                             html += '<tr>' +
                                 //  '<td>' + [i]++ + '</td>' +
                                 '<td>' + data[i].nim + '</td>' +
                                 '<td>' + data[i].nama_mhs + '</td>' +
                                 '<td>' + data[i].tgl_uplod + '</td>'
                             if (data[i].nilai !== null) {
                                 html += '<td><center>' + data[i].nilai + '</center></td>'
                             } else {
                                 html += '<td><center><b>Belum Dinilai</b><br><a class="btn btn-primary item_edit" data="' + data[i].id + '">Beri Nilai</a></center></td>'
                             }
                             html += '<td>' +
                                 '<a class="badge bg-success" href="<?= site_url('menu_dosen/tugas/download_mhs/') ?>' + data[i].nim + '/' + data[i].kd_tugas + '"><i data-feather="download" width="20"></i>Download</a>'
                             if (data[i].nilai !== null) {
                                 html += '<a href="#" class="badge bg-primary item_editor" data="' + data[i].id + '">Edit</a>'
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
             var id = $(this).attr('data');
             $.ajax({
                 type: "GET",
                 url: "<?= base_url('menu_dosen/tugas/get_tugas_byid') ?>",
                 dataType: "JSON",
                 data: {
                     id: id
                 },
                 success: function(data) {
                     $.each(data, function(nim, nama_mhs, kd_tugas) {
                         $('#modal_detail').modal('show');
                         $('[name="nim"]').val(data.nim);
                         $('[name="nama_mhs"]').val(data.nama_mhs);
                         $('[name="kd_tugas"]').val(data.kd_tugas);
                     });
                 }
             });
             return false;
         });
         //GET UPDATE
         $('#show_data').on('click', '.item_editor', function() {
             var id = $(this).attr('data');
             $.ajax({
                 type: "GET",
                 url: "<?= base_url('menu_dosen/tugas/get_tugas_byid') ?>",
                 dataType: "JSON",
                 data: {
                     id: id
                 },
                 success: function(data) {
                     $.each(data, function(nim, nama_mhs, kd_tugas, nilai) {
                         $('#modal_detail').modal('show');
                         $('[name="nim"]').val(data.nim);
                         $('[name="nama_mhs"]').val(data.nama_mhs);
                         $('[name="kd_tugas"]').val(data.kd_tugas);
                         $('[name="nilai"]').val(data.nilai);
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
             var kd_tugas = $('[name="kd_tugas"]').val();
             $.ajax({
                 type: "POST",
                 url: "<?= site_url('menu_dosen/tugas/add_tgs') ?>",
                 dataType: "JSON",
                 data: {
                     nim: nim,
                     nama: nama,
                     nilai: nilai,
                     kd_tugas: kd_tugas
                 },
                 success: function(data) {
                     $('[name="nim"]').val("");
                     $('[name="nama_mhs"]').val("");
                     $('[name="nilai"]').val("");
                     $('[name="kd_tugas"]').val("");
                     $('#modal_detail').modal('hide');
                     tampil_tugas();
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
                     $('[name="kd_tugas"]').val("");
                     $('#modal_detail').modal('hide');
                     tampil_tugas();
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