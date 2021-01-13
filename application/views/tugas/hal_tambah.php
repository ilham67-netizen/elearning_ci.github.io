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
            <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/') ?>">Menu Tugas</a></li>
            <li class="breadcrumb-item"><a href="<?= site_url($this->uri->segment(1) . '/lihat_tugas/' . $this->uri->segment(3)) ?>">Lihat Tugas Prodi</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= $title; ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
  <section class="section">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <form class="form form-vertical" action="<?= site_url('tugas/process/' . $this->uri->segment(3)) ?>" method="POST">
            <div class="form-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Kode Tugas</label>
                    <input type="text" class="form-control" readonly="" required="" name="kd_tugas" placeholder="Masukkan Kode Tugas" autocomplete="off" value="<?= $kode_auto ?>">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Tanggal Uplod</label>
                    <input type="text" readonly="" class="form-control" required="" name="tanggal_uplod" value="<?= date('Y/m/d H:i') ?>" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Judul Tugas</label>
                    <input type="text" class="form-control" required="" name="judul_tugas" value="" placeholder="Masukkan Judul Tugas" autocomplete="off">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>Batas Waktu</label>
                    <input type="datetime-local" class="form-control" required="" name="batas_waktu" value="" autocomplete="off">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Semester</label>
                    <select class="choices form-select" id="semester" name="semester" required="">
                      <option value="" selected="">--- Pilih Semester ---</option>
                      <?php for ($i = 1; $i <= 7; $i++) {
                      ?>
                        <option value="<?php echo $i ?>"><?php echo $i; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="kelas">
                      <label>Kelas</label>
                      <select class="choices form-control" name="kelas" id="kelas3" required="">
                        <option selected="" value="">--- Pilih Kelas ---</option>
                        <?php foreach ($row as $row2) : ?>
                          <option value="<?php echo $row2->kd_kelas; ?>"><?php echo $row2->nama_kelas; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div id="kelas2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="matkul">
                      <label>Mata Kuliah</label>
                      <select class="choices form-control" name="kd_matkul" id="matkul3" required="">
                        <option selected="" value="">--- Pilih Matkul ---</option>
                      </select>
                    </div>
                    <div id="matkul2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div id="dosen">
                      <label>Dosen</label>
                      <select class="choices form-control" name="nip_dosen" id="dosen3" required="">
                        <option selected="" value="">--- Pilih Dosen ---</option>
                      </select>
                    </div>
                    <div id="dosen2"></div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                  </div>
                </div>
                <div class="dropzone">

                  <div class="dz-message" style="height: 100px;">
                    <center>
                      <h3 style="margin-top: 50px;"> Klik atau Drop File Tugas Di sini</h3><br><span data-feather="upload-cloud"></span>
                    </center>
                  </div>
                </div>
                <center><input type="submit" name="add" class="btn btn-primary ml-1" value="Tambah"></center>

              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>

  </div>
  <script type="text/javascript">
    $(document).ready(function() {

      // $('#semester').change(function(){ 

      //   $.ajax({
      //     url : "<?= site_url('tugas/getkelas') ?>",
      //     method : "POST",
      //     data : {prodi: "<?= $this->uri->segment(3) ?>"},
      //     async : true,
      //     dataType : 'json',
      //     success: function(data){

      //       var html = '';
      //       var i;
      //       $('#kelas').remove();             
      //       html += '<label >Kelas</label>';
      //       html += ' <select class="js-choice form-select" id="kelas3"  name="kelas" required="">'
      //       html += '<option value="" selected>--- Pilih Kelas ---</option>';
      //       for(i=0; i<data.length; i++){
      //         html += '<option value='+data[i].kd_kelas+'>'+data[i].nama_kelas+'</option>';
      //       }
      //       html += ' </select>';

      //       $('#kelas2').html(html);
      //       const choices = new Choices('.js-choice');

      //     }
      //   });
      //   return false;
      // }); 

      $('#kelas3').change(function() {
        var id = $(this).val();
        var id2 = $('#semester').val();
        $.ajax({
          url: "<?= site_url('tugas/getmatkul') ?>",
          method: "POST",
          data: {
            kelas: id,
            prodi: "<?= $this->uri->segment(3) ?>",
            semester: id2
          },
          async: true,
          dataType: 'json',
          success: function(data) {

            var html = '';
            var i;
            $('#matkul').remove();
            html += '<label >MATA KULIAH</label>';
            html += ' <select class="js-choice2 form-select" id="matkul3"  name="kd_matkul" required="">';
            html += '<option value="" selected>--- Pilih Matkul ---</option>';
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].kd_matkul + '>' + data[i].nama_matkul + '</option>';
            }
            html += ' </select>';

            $('#matkul2').html(html);
            const choices = new Choices('.js-choice2');
          }
        });
        return false;
      });

      $('#matkul2').change(function() {
        var id = $('#matkul3').val();
        $.ajax({
          url: "<?= site_url('tugas/getkeldos') ?>",
          method: "POST",
          data: {
            matkul: id
          },
          async: true,
          dataType: 'json',
          success: function(data) {

            var html2 = '';
            var i;
            $('#dosen').remove();
            html2 += '<label >Dosen</label>';
            html2 += ' <select class="js-choice3 form-select" id="dosen3"  name="nip_dosen" required="">';
            for (i = 0; i < data.length; i++) {
              html2 += '<option value=' + data[i].nip_dosen + ' selected disabled>' + data[i].nama_dosen + '</option>';
            }
            html2 += ' </select>';

            $('#dosen2').html(html2);
            const choices2 = new Choices('.js-choice3');
          }
        });
        return false;
      });
    });
  </script>
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    var foto_upload = new Dropzone(".dropzone", {
      url: "<?= site_url('tugas/file_upload/' . $kode_auto) ?>",
      maxFilesize: 7,
      method: "post",
      acceptedFiles: ".jpg, .png, .jpeg, .pdf, .zip",
      paramName: "userfile",
      dictInvalidFileType: "Type file ini tidak dizinkan",
      addRemoveLinks: true,
    });
    foto_upload.on("sending", function(a, b, c) {
      a.token = Math.random();
      c.append("token_foto", a.token);
    });

    foto_upload.on("removedfile", function(a) {
      var token = a.token;
      $.ajax({
        type: "POST",
        data: {
          token: token
        },
        url: "<?= site_url('tugas/hapus_file') ?>",
        cache: false,
        dataType: 'json',
        success: function() {
          console.log("remove file sukses");
        },
        error: function() {
          console.log("remove file gagal");
        }
      });
    });
  </script>