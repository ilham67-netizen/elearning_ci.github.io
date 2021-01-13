  <?php date_default_timezone_set('Asia/Jakarta'); ?>
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
                      <li class="breadcrumb-item"><a href="<?= site_url('menu_dosen/paket_soal') ?>">Lihat Paket</a></li>
                      <li class="breadcrumb-item"><a href="<?= site_url('menu_dosen/paket_soal/lihat_soal/' . $this->uri->segment(4)) ?>">Lihat Soal</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
                  </ol>
              </nav>
          </div>
      </div>
  </div>
  <section class="section">
      <div class="card">
          <div class="card-header">
              <h4>Jenis Soal <?= jenis_soal($row->jenis_soal); ?></h4>
          </div>
          <div class="card-content">
              <div class="card-body">
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/paket_soal/proses_pilgansay') ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-body">
                          <div class="row">
                              <input type="hidden" name="kd_paket" value="<?= $row->kd_paket ?>">
                              <div id="clone">
                                  <div id="lanjut"></div>
                                  <div class="modal-footer">
                                      <button type="button" id="tambah_soal1" class="btn btn-primary">Tambah Essay</button>
                                      <button type="button" id="tambah_soal2" class="btn btn-primary">Tambah Pilgan</button>
                                  </div>
                              </div>
                          </div>
                      </div>


              </div>
          </div>
      </div>
      <div class="card">
          <div class="card-content">
              <div class="card-body">
                  <center><input type="submit" class="btn btn-primary" name="add" value="SIMPAN"></center>
                  </form>
              </div>
          </div>
      </div>
  </section>

  </div>
  <script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
  <script>
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
  </script>
  <script>
      var count = 0;
      $(document).on('click', '#tambah_soal1', function() {
          count += 1;

          var html = '';
          html += '<div class="hapus_' + count + '">';
          html += '<hr size="10px" style="color: red;">';
          html += '<a class="btn btn-danger" id="remove" style="float: right;" data-id="' + count + '"><span data-feather="trash"></span>Hapus</a>';
          html += '<div class="col-12" style="clear: both;">';
          html += '<h2>Soal Nomor ' + count + '</h2>';
          html += '<label>Gambar <div style="color: red; display: inline;">*Jika Ada</div></label>';
          html += '<div class="form-file">'
          html += '<input type="file" class="form-file-input" id="inputGroupFile01" name="gambar[]" accept=".png, .jpg, .jpeg">';
          html += '<input type="hidden" name="jenis_soal[]" value="essay">';
          html += ' <label class="form-file-label" for="inputGroupFile01">' +
              '<span class = "form-file-text"> Choose file... </span>' +
              '<span class = "form-file-button"> Browse </span></label>';
          html += ' </div></div>';
          html += '<div class="col-12">';
          html += '<div class="form-group">'
          html += ' <label for="">Pertanyaan</label>';
          html += ' <div class = "col-11" ><input type="hidden" name="nama_opsi[]" value="A"><input type = "hidden" class = "form-control" name = "jawaban_a[]" placeholder = "Masukkan Jawaban A"> </div>';
          html += ' <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="B"> <input type = "hidden" class = "form-control" name = "jawaban_b[]" placeholder = "Masukkan Jawaban B" > </div>';
          html += ' <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="C"> <input type = "hidden" class = "form-control" name = "jawaban_c[]" placeholder = "Masukkan Jawaban C" > </div>';
          html += ' <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="D"> <input type = "hidden" class = "form-control" name = "jawaban_d[]" placeholder = "Masukkan Jawaban D" > </div>';
          html += ' <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="E"> <input type = "hidden" class = "form-control" name = "jawaban_e[]" placeholder = "Masukkan Jawaban E" > </div>';
          html += '<textarea name="pertanyaan[]" id="editor' + count + '" rows="10" cols="80"></textarea>';
          html += '<input type="hidden" class="form-control" name="kunci_jawaban[]" value="" placeholder="Masukkan Kunci Jawaban">';
          html += ' </div></div></div>';

          $('#lanjut').append(html);
          CKEDITOR.replace('editor' + count);
      });
      $(document).on('click', '#tambah_soal2', function() {
          count += 1;

          var html = '';
          html += '<div class="hapus_' + count + '">';
          html += '<hr size="10px" style="color: red;">';
          html += '<a class="btn btn-danger" id="remove" style="float: right;" data-id="' + count + '"><span data-feather="trash"></span>Hapus</a>';
          html += '<div class="col-12" style="clear: both;">';
          html += '<h2>Soal Nomor ' + count + '</h2>';
          html += '<label>Gambar <div style="color: red; display: inline;">*Jika Ada</div></label>';
          html += '<div class="form-file">'
          html += '<input type="file" class="form-file-input" id="inputGroupFile01" name="gambar[]" accept=".png, .jpg, .jpeg">';
          html += '<input type="hidden" name="jenis_soal[]" value="pilgan">';
          html += ' <label class="form-file-label" for="inputGroupFile01">' +
              '<span class = "form-file-text"> Choose file... </span>' +
              '<span class = "form-file-button"> Browse </span></label>';
          html += ' </div></div>';
          html += '<div class="col-12">';
          html += '<div class="form-group">'
          html += ' <label for="">Pertanyaan</label>';
          html += '<textarea name="pertanyaan[]" id="editor' + count + '" rows="10" cols="80"></textarea>';
          html += ' </div></div>';
          html += '<div class="col-12">';
          html += '<div class="form-group">'
          html += '<label>Opsi Jawaban</label><br>';
          html += '<div class="row">';
          html += ' <div class="col-1" style="font-size: large; font-weight: bold; ">A. </div> <div class = "col-11" ><input type="hidden" name="nama_opsi[]" value="A"><input type = "text" class = "form-control" name = "jawaban_a[]" required placeholder = "Masukkan Jawaban A" > </div>';
          html += ' <div class="col-1 mt-2" style="font-size: large; font-weight: bold; ">B. </div> <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="B"> <input type = "text" class = "form-control" name = "jawaban_b[]" required placeholder = "Masukkan Jawaban B" > </div>';
          html += ' <div class="col-1 mt-2" style="font-size: large; font-weight: bold; ">C. </div> <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="C"> <input type = "text" class = "form-control" name = "jawaban_c[]" required placeholder = "Masukkan Jawaban C" > </div>';
          html += ' <div class="col-1 mt-2" style="font-size: large; font-weight: bold; ">D. </div> <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="D"> <input type = "text" class = "form-control" name = "jawaban_d[]" required placeholder = "Masukkan Jawaban D" > </div>';
          html += ' <div class="col-1 mt-2" style="font-size: large; font-weight: bold; ">E. </div> <div class = "col-11 mt-2" ><input type="hidden" name="nama_opsi[]" value="E"> <input type = "text" class = "form-control" name = "jawaban_e[]" required placeholder = "Masukkan Jawaban E" > </div>';
          html += '</div>';
          html += ' </div></div>';
          html += '<div class="col-12">';
          html += '<div class="form-group">'
          html += '<label>Kunci Jawaban</label>';
          html += '<input type="text" class="form-control" name="kunci_jawaban[]" value="" autocomplete="off" placeholder="Masukkan Kunci Jawaban" required>';
          html += ' </div></div></div>';

          $('#lanjut').append(html);
          CKEDITOR.replace('editor' + count);
      });
      $(document).ready(function() {
          $("#lanjut").on('click', '#remove', function(ev) {
              const id = $(this).data('id');
              count -= 1;
              if (ev.type == 'click') {
                  $(".hapus_" + id).fadeOut(5000);
                  $(".hapus_" + id).remove();
              }
          });
      });
  </script>
  <!-- <script>
      $(document).ready(function() {
          var count = 0;

          $("#add_btn").click(function() {
              count += 1;
              $('#container').append(
                  '<div class="records">' +
                  '<td ><div id="' + count + '">' + count + '</div></td>' +
                  '<td><input id="nim_' + count + '" name="nim_' + count + '" type="text"></td>' +
                  '<td><input id="nama_depan_' + count + '" name="nama_depan_' + count + '" type="text"></td>' +
                  '<td><input id="nama_belakang_' + count + '" name="nama_belakang_' + count + '" type="text"></td>' +
                  '<td><a class="remove_item" href="#" >Delete</a>' +
                  '<input id="rows_' + count + '" name="rows[]" value="' + count + '" type="hidden"></td></div>'
              );
          });

          $(".remove_item").live('click', function(ev) {
              if (ev.type == 'click') {
                  $(this).parents(".records").fadeOut();
                  $(this).parents(".records").remove();
              }
          });
      });
  </script> -->