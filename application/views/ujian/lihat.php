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
             <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
            TAMBAH
          </button> -->
             <br>
             <br>
             <table class='table table-striped' id="dataTable">
                 <thead>
                     <tr>
                         <th>No</th>
                         <th>Kode Fakultas</th>
                         <th>Nama Fakultas</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php
                        $no = 1;
                        foreach ($row as $d) {
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $d->kd_fakultas ?></td>
                             <td><?= $d->nama_fakultas ?></td>
                             <td><a class="badge bg-primary" href="#" data-toggle="modal" data-target="#modal_prodi" data-id="<?= $d->kd_fakultas ?>"><i data-feather="eye" width="20"></i>Lihat Prodi</a>
                             </td>

                         </tr>
                     <?php } ?>
                 </tbody>

             </table>
         </div>
     </div>
     <!-- Vertically Centered modal Modal -->
     <div class="modal fade" id="modal_prodi" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
             <div class="modal-content">
                 <div class="modal-header bg-primary">
                     <h5 class="modal-title white" id="myModalLabel160">Pilih Program Studi</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <i data-feather="x"></i>
                     </button>
                 </div>
                 <div class="modal-body">

                     <table class='table table-striped' id='table_id'>
                         <thead>
                             <tr>
                                 <td>Kode Prodi</td>
                                 <td>Nama Prodi</td>
                                 <td>Aksi</td>
                             </tr>
                         </thead>
                         <tbody class="fetched-data">

                         </tbody>
                     </table>

                 </div>
             </div>
         </div>
     </div>
 </section>
 </div>
 <script type="text/javascript">
     $(document).ready(function($) {

         $('#modal_prodi').on('show.bs.modal', function(e) {
             var rowid = $(e.relatedTarget).data('id');
             $.ajax({
                 type: 'POST',
                 url: "<?= site_url('master_data/dosen/getprodi') ?>",
                 data: {
                     id: rowid
                 },
                 async: true,
                 dataType: 'json',
                 success: function(data) {

                     var html = '';
                     var i;
                     var no = 1;


                     for (i = 0; i < data.length; i++) {
                         html += '<tr>';
                         html += '<td>' + data[i].kd_prodi + '</td>';
                         html += '<td>' + data[i].nama_prodi + '</td>';
                         <?php
                            if ($this->uri->segment(3) == 2) {
                            ?>
                             html += '<td> <a class="badge bg-primary" href="<?= site_url('ujian/lihat_pilgan/' . $this->uri->segment(3) . '/') ?>' + data[i].kd_prodi + '">Lihat Ujian</a></td>';
                         <?php
                            } elseif ($this->uri->segment(3) == 1) {
                            ?>
                             html += '<td> <a class="badge bg-primary" href="<?= site_url('ujian/lihat_essay/' . $this->uri->segment(3) . '/') ?>' + data[i].kd_prodi + '">Lihat Ujian</a></td>';
                         <?php
                            } elseif ($this->uri->segment(3) == 3) {
                            ?>
                             html += '<td> <a class="badge bg-primary" href="<?= site_url('ujian/lihat_pemrograman/' . $this->uri->segment(3) . '/') ?>' + data[i].kd_prodi + '">Lihat Ujian</a></td>';
                         <?php
                            }
                            ?>

                         html += '</tr>';
                     }
                     $('.fetched-data').html(html);
                     $('#table_id').DataTable();
                 }
             });
         });
     });
 </script>