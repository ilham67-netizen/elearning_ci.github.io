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
                  <form class="form form-vertical" action="<?= site_url('menu_dosen/paket_soal/proses_essay') ?>" method="POST" enctype="multipart/form-data">
                      <div class="form-body">
                          <div class="row">
                              <div id="clone">
                                  <h2>Soal Nomor 1</h2>
                                  <div class="col-12">
                                      <input type="hidden" name="kd_paket" value="<?= $row->kd_paket ?>">
                                      <label>Gambar <div style="color: red; display: inline;">*Jika Ada</div></label>
                                      <div class="form-file">
                                          <input type="file" class="form-file-input" id="inputGroupFile01" name="gambar[]" accept=".png, .jpg, .jpeg">
                                          <label class="form-file-label" for="inputGroupFile01">
                                              <span class="form-file-text">Choose file...</span>
                                              <span class="form-file-button">Browse</span>
                                          </label>
                                      </div>
                                  </div>
                                  <div class="col-12">
                                      <div class="form-group">
                                          <label for="">Pertanyaan</label>
                                          <textarea name="pertanyaan[]" id="editor1" rows="10" cols="80">
                                          </textarea>
                                      </div>
                                  </div>
                                  <div id="lanjut"></div>
                                  <div class="modal-footer">
                                      <button type="button" id="tambah_soal" class="btn btn-primary">Tambah Soal</button>
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
      var count = 1;
      $(document).on('click', '#tambah_soal', function() {
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
          html += ' <label class="form-file-label" for="inputGroupFile01">' +
              '<span class = "form-file-text"> Choose file... </span>' +
              '<span class = "form-file-button"> Browse </span></label>';
          html += ' </div></div>';
          html += '<div class="col-12">';
          html += '<div class="form-group">'
          html += ' <label for="">Pertanyaan</label>';
          html += '<textarea name="pertanyaan[]" id="editor' + count + '" rows="10" cols="80"></textarea>';
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